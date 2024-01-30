<?php

namespace App\Http\Controllers\API;

use App\Constants\EmailServiceTemplateNames;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\ForgetPasswordRequest;
use App\Http\Requests\API\LoginAPIRequest;
use App\Http\Requests\API\PasswordResetCodeRequest;
use App\Http\Requests\API\RegistrationAPIRequest;
use App\Http\Requests\API\ResetPasswordRequest;
use App\Http\Requests\API\SocialLoginAPIRequest;
use App\Http\Requests\ResendOTPRequest;
use App\Http\Requests\VerifyOTPRequest;
use App\Jobs\SendEmail;
use App\Models\PasswordReset;
use App\Models\User;
use App\Models\Role;
use App\Models\VerfiyEmail;
use App\Repositories\UserDetailRepository;
use App\Repositories\UserDeviceRepository;
use App\Repositories\UsersRepository;
use App\Repositories\UserSocialAccountRepository;
use Aws\S3\S3Client;
use DateTime;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Carbon;

class AuthAPIController extends AppBaseController
{

    public function __construct(
        private UsersRepository $userRepository,
        private UserDetailRepository $userDetailRepository,
        private UserDeviceRepository $userDeviceRepository,
        private UserSocialAccountRepository $userSocialAccountRepository,
        // private RolesRepository $rolesRepository
    ) {}

    public function login(LoginAPIRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (!auth()->attempt($credentials)) {
            return $this->sendError('Invalid login credentials, please try again.', 401);
        }

        $user = auth()->user();
        $userDevice = $searchUserDevice = $request->only(['device_type', 'device_token']);
        $userDevice['user_id'] = $user->id;
        $this->userDeviceRepository->updateOrCreate($searchUserDevice, $userDevice);

        $token = $user->createToken('access_token');

        return $this->sendResponse([
            'token' => self::getTokenResponse($token),
            'user' => $user,
        ], 'Logged In Successfully');

    }

    public function socialLogin(SocialLoginAPIRequest $request)
    {
        try{
            $user    = null;
            $input   = $request->validated();
            $userSocialAccountModel = $this->userSocialAccountRepository->model();
            $userSocialAccount = $userSocialAccountModel::where(['platform' => $input['platform'], 'client_id' => $input['client_id'], 'deleted_at' => null])->first();

            $userEmail = $input['email'] ?? null;
            $userName = $input['name'] ?? null;
            $firstName = $input['first_name'] ?? null;
            $lastName = $input['last_name'] ?? null;

            if ($userSocialAccount && $userSocialAccount->user ?? null) {
                $user = $userSocialAccount->user;
            } else {
                if($request->platform == 'apple'){
                    $jwtDecodeResponse = JWTDecodeUserInfo($request->token);
                    $jwtUserInfo = $jwtDecodeResponse['data'];
                    $userEmail  = $jwtUserInfo['email'];

                    // $emailName  = explode('@', $userEmail)[0];
                    // Replace & Explode: Number & Special Character with [SPACE] Seperator from {$emailName}
                    // $emailNameParts = explode(' ', preg_replace('/[0-9\W]+/', ' ', $emailName));
                    // $firstName  = $emailNameParts[0];
                    // $lastName   = $emailNameParts[1] ?? null;
                    // $userName   = ($firstName && $lastName) ? $firstName.' '.$lastName : $firstName;
                }

                // Check if email address already exists. if yes, then link social account. else register new user.
                if (isset($userEmail)) {
                    $userModel = $this->userRepository->model();
                    $user = $userModel::where(['email' => $userEmail])->first();
                }

                // Check User is exists with Non-Social-User and Verified
                if(($user->details->is_social_login ?? 0) == 0 && ($user->details->email_verified_at ?? 0) == 1){
                    throw new Error('The email has already been taken.');
                }

                if (!$user) {
                    // Register user with only social details and no password.
                    $userData             = [];
                    $userData['name']     = $userName ?? "user_" . $input['client_id'];
                    $userData['email']    = $userEmail ?? $input['client_id'] . '_' . $input['platform'] . '@' . config('app.name') . '.com';
                    $userData['password'] = bcrypt(substr(str_shuffle(MD5(microtime())), 0, 12));
                    $user                 = $this->userRepository->create($userData);

                    $userRole = Role::whereName(Role::API_USER)->first();
                    $user->syncRoles($userRole);

                    $userDetails['user_id']    = $user->id;
                    $userDetails['is_social_login'] = 1;
                    $userDetails['email_verified_at'] = 1;

                    $this->userDetailRepository->create($userDetails);
                }

                // Add social media link to the user
                $userSocialAccountRequestData = $request->only(['platform', 'client_id', 'token', 'expires_at']);
                $userSocialAccountRequestData['user_id'] = $user->id;
                $this->userSocialAccountRepository->create($userSocialAccountRequestData);
            }

            $userDevice = $searchUserDevice = $request->only(['device_type', 'device_token']);
            $userDevice['user_id'] = $user->id;
            $this->userDeviceRepository->updateOrCreate($searchUserDevice, $userDevice);

            if (isset($userName) && $user->name !== $userName) {
                $user->name = $userName;
                $user->save();
            }
            
            //update social login user image
            $userDetails = [];
            $input['image'] ? $userDetails['image'] = $input['image'] : null;
            $firstName ? $userDetails['first_name'] = $firstName : null;
            $lastName ? $userDetails['last_name'] = $lastName : null;

            if(count($userDetails)){
                $user->details()->update($userDetails);
            }

            if (!$token = $user->createToken('access_token')) {
                throw new Error('Invalid credentials, please try login again');
            }

            $response = [
                'token' => self::getTokenResponse($token),
                'user' => $user->fresh()
            ];

            return $this->sendResponse($response, 'You have social-login successfully');

        }catch(Error $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function register(RegistrationAPIRequest $request)
    {
        try {
            $input = $request->all();
            $user = $this->userRepository->create($input);

            $code = rand(1111, 9999);
            $this->saveVerifyEmailOTP($user->id, $code);
            $this->sendOTPEmail($user, 'Email Verification Code', EmailServiceTemplateNames::OTP_TEMPLATE, $code);

            $userRole = Role::whereName(Role::API_USER)->first();
            $user->syncRoles($userRole);

            $userDetail = ['user_id' => $user->id];
            $this->userDetailRepository->create($userDetail);

            $userDevice = $searchUserDevice = $request->only(['device_type', 'device_token']);
            $userDevice['user_id'] = $user->id;
            $this->userDeviceRepository->updateOrCreate($searchUserDevice, $userDevice);

            return $this->sendResponse([
                'user' => $user->fresh(),
            ], 'User saved successfully.');

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }
    
    public function resendOTP(ResendOTPRequest $request)
    {
        try {
            $userModel = $this->userRepository->model();
            $user = $userModel::where('email', $request->email)->first();
            
            if(!$user)
                return $this->sendError('User not found.', 404);

            $code = rand(1111, 9999);
            match($request->type) {
                'email' => $this->saveVerifyEmailOTP($user->id, $code),
                'password' => $this->savePasswordResetOTP($user->email, $code)
            };

            $subject = ucfirst($request->type).' Verification Code';
            $this->sendOTPEmail($user, $subject, EmailServiceTemplateNames::OTP_TEMPLATE, $code);

            return $this->sendResponse([], 'Your OTP send to your email successfully.');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function verifyOTP(VerifyOTPRequest $request)
    {
        try {
            $userModel = $this->userRepository->model();
            $user = $userModel::where('email', $request->email)->first();

            if(!$user)
                return $this->sendError('User not found.', 404);

            $otpCode = null;
            $otp = $request->otp;
            match($request->type) {
                'email' => $otpCode = VerfiyEmail::where(['user_id' => $user->id, 'code' => $otp])->first(),
                'password' => $otpCode = PasswordReset::where(['email' => $user->email, 'token' => $otp])->first()
            };

            if(!$otpCode)
                return $this->sendError('Invalid OTP Code.', 401);

            if($this->checkOTPExpiry($otpCode->created_at)) {
                $otpCode->delete();
                return $this->sendResponse([], 'Your OTP expired.');
            }

            if($otpCode instanceof VerifyEmail) {
                $user->markEmailAsVerified();
                $otpCode->delete();
            }

            return $this->sendResponse([], 'Your OTP is verified successfully.');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        try {
            $code = rand(1111, 9999);
            $email = $request->email;
            $user = User::where('email', $email)->first();

            if(!$user)
                return $this->sendError('User not found.', 404);

            $this->savePasswordResetOTP($user->email, $code);
            $this->sendOTPEmail($user, 'Password Verification Code', EmailServiceTemplateNames::OTP_TEMPLATE, $code);

            return $this->sendResponse([], 'Password Verification Code send to your email successfully');

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }


    public static function getTokenResponse($token)
    {
        // $otpExpireInSeconds = config('constants.expiry_in_seconds.api_token');
        return [
            'access_token' => $token->plainTextToken,
            'token_type'   => 'bearer',
            // 'expires_in' => Carbon::parse($token->accessToken->updated_at)->addSeconds($otpExpireInSeconds),
        ];
    }
    
    public function checkOTPExpiry(DateTime $otpCreatedAt)
    {
        $otpExpireInSeconds = config('constants.expiry_in_seconds.otp');
        return Carbon::parse($otpCreatedAt)->addSeconds($otpExpireInSeconds)->isPast();
    }

    public function savePasswordResetOTP($email, $code)
    {
        return PasswordReset::updateOrCreate(['email' => $email], ['token' => $code]);
    }

    public function saveVerifyEmailOTP($user_id, $code)
    {
        return VerfiyEmail::updateOrCreate(['user_id' => $user_id], ['code' => $code]);
    }

    public function sendOTPEmail($user, $subject, $tamplateName, $code)
    {
        try {
            $data = [
                'name' => $user->details->first_name ?? 'User',
                'otp' => $code
            ];
            $sendEmailJob = new SendEmail($user->email, $subject, $data, $tamplateName);
            dispatch($sendEmailJob);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $resetPassword = PasswordReset::where(['email' => $request->email, 'token' => $request->code])->first();
            if(!$resetPassword)
                return $this->sendError('Invalid Code.', 403);

            if($this->checkOTPExpiry($resetPassword->created_at)) {
                $resetPassword->delete();
                return $this->sendResponse([], 'Your OTP expired.');
            }

            $user = User::where('email', $request->email)->first();
            if(!$user)
                return $this->sendError('User not found.', 404);

            $user->update(['password' => $request->password]);
            $resetPassword->delete();

            return $this->sendResponse(['user' => $user], 'Password Reset Successfully');

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function awsBucketToken()
    {
        $s3Client = new S3Client([
            'version' => 'latest',
            'region' => config('filesystems.disks.s3.region'),
            'credentials' => [
                'key'    => config('filesystems.disks.s3.key'),
                'secret' => config('filesystems.disks.s3.secret')
            ]
        ]);

        $s3Bucket = config('filesystems.disks.s3.bucket');
        $s3Key = "file";
        $s3Options = [];

        $command = $s3Client->getCommand('PutObject', [
            'Bucket' => $s3Bucket,
            'Key' => $s3Key,
            'MetaData' => $s3Options,
        ]);

        $request = $s3Client->createPresignedRequest($command, '+20 minutes');

        $url = (string) $request->getUri();

        return response()->json(['url' => $url], 201);
    }
}

