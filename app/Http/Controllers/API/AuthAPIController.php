<?php

namespace App\Http\Controllers\API;

use App\Constants\EmailServiceTemplateNames;
use App\Http\Controllers\AppBaseController;
use App\Http\Middleware\EnsureEmailIsVerified;
use App\Http\Requests\API\ForgetPasswordAPIRequest;
use App\Http\Requests\API\LoginAPIRequest;
use App\Http\Requests\API\RegistrationAPIRequest;
use App\Http\Requests\API\ResetPasswordAPIRequest;
use App\Http\Requests\API\SocialLoginAPIRequest;
use App\Http\Requests\API\DeleteAccountAPIRequest;
use App\Http\Requests\API\ResendOTPAPIRequest;
use App\Http\Requests\API\VerifyOTPAPIRequest;
use App\Http\Requests\API\ChangePasswordAPIRequest;
use App\Jobs\SendEmail;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Models\User;
use App\Models\Role;
use App\Models\VerifyEmail;
use App\Repositories\UserDetailRepository;
use App\Repositories\UserDeviceRepository;
use App\Repositories\UsersRepository;
use App\Repositories\UserSocialAccountRepository;
use Aws\S3\S3Client;
use DateTime;
use Error;
use Illuminate\Support\Carbon;
use DB;
use Illuminate\Support\Facades\Hash;

class AuthAPIController extends AppBaseController
{
    public function __construct(
        private UsersRepository $userRepository,
        private UserDetailRepository $userDetailRepository,
        private UserDeviceRepository $userDeviceRepository,
        private UserSocialAccountRepository $userSocialAccountRepository
    ) {
    }

    public function login(LoginAPIRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (!auth()->attempt($credentials)) {
            return $this->sendError('Invalid login credentials, please try again.', 400);
        }

        $user = auth()->user();
        if (!$user->details)
            return $this->sendError('User details is missing.', 404);
        if ($user->details->is_social_login)
            return $this->sendError('This email is signed as a social acount.', 403);

        if (!$user->hasVerifiedEmail())
            return EnsureEmailIsVerified::getUnVerifiedEmailApiResponse($user);

        $searchUserDevice      = $request->only('device_token');
        $userDevice            = $request->only('device_type', 'device_token');
        $userDevice['user_id'] = $user->id;
        $this->userDeviceRepository->updateOrCreate($searchUserDevice, $userDevice);

        $token = $user->createToken('access_token');

        return $this->sendResponse([
            'token' => self::getTokenResponse($token),
            'user'  => $user,
        ], 'Logged In Successfully');
    }

    public function socialLogin(SocialLoginAPIRequest $request)
    {
        try {

            $user                   = null;
            $input                  = $request->validated();
            $userSocialAccountModel = $this->userSocialAccountRepository->model();
            $userSocialAccount      = $userSocialAccountModel::where($request->only('platform', 'client_id'))->first();

            $userEmail = $input['email'] ?? null;
            $userName  = $input['name'] ?? null;
            $firstName = $input['first_name'] ?? null;
            $lastName  = $input['last_name'] ?? null;

            if ($userSocialAccount && $userSocialAccount->user ?? null) {
                $user = $userSocialAccount->user;
            } else {
                if ($request->platform == 'apple') {
                    $jwtDecodeResponse = JWTDecodeUserInfo($request->token);
                    $jwtUserInfo       = $jwtDecodeResponse['data'];
                    $userEmail         = $jwtUserInfo['email'];
                    // $jwtUserInfo['email_verified']

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
                    $user      = $userModel::where(['email' => $userEmail])->first();
                }

                // Check User is already exists with this email
                if ($user) {
                    throw new Error('The email has already been taken.');
                }

                // Register user with only social details and no password.
                $userData             = [];
                $userData['name']     = $userName ?? "user_" . $input['client_id'];
                $userData['email']    = $userEmail ?? $input['client_id'] . '_' . $input['platform'] . '@' . config('app.name') . '.com';

//                $emailRequest       = new Request(['email' => $userData['email']]);
//                $stripe_customer    = PaymentController::post($emailRequest, 'create.customer');
//                $userData['stripe_customer_id'] = $stripe_customer['data']['id'];

                $userData['password'] = bcrypt(substr(str_shuffle(MD5(microtime())), 0, 12));
                $user                 = $this->userRepository->create($userData);
                $user->markEmailAsVerified();

                $userRole = Role::whereName(Role::API_USER)->first();
                $user->syncRoles($userRole);

                $userDetails['user_id']         = $user->id;
                $userDetails['is_social_login'] = 1;

                $this->userDetailRepository->create($userDetails);

                // Add social media link to the user
                $searchUserSocialAccount                 = $request->only('token');
                $userSocialAccountRequestData            = $request->only('platform', 'client_id', 'token', 'expires_at');
                $userSocialAccountRequestData['user_id'] = $user->id;
                $this->userSocialAccountRepository->updateOrCreate($searchUserSocialAccount, $userSocialAccountRequestData);
            }

            if (!$user->hasVerifiedEmail())
                return EnsureEmailIsVerified::getUnVerifiedEmailApiResponse($user);

            $searchUserDevice      = $request->only('device_token');
            $userDevice            = $request->only('device_type', 'device_token');
            $userDevice['user_id'] = $user->id;
            $this->userDeviceRepository->updateOrCreate($searchUserDevice, $userDevice);

            if (isset($userName) && $user->name !== $userName) {
                $user->name = $userName;
                $user->save();
            }

            //update social login user image
            $userDetails = [];
            isset($input['image']) ? $userDetails['image'] = $input['image'] : null;
            $firstName ? $userDetails['first_name'] = $firstName : null;
            $lastName ? $userDetails['last_name'] = $lastName : null;

            if (count($userDetails)) {
                $user->details()->update($userDetails);
            }

            if (!$token = $user->createToken('access_token')) {
                throw new Error('Invalid credentials, please try login again');
            }

            $response = [
                'token' => self::getTokenResponse($token),
                'user'  => $user->fresh()
            ];

            return $this->sendResponse($response, 'You have social-login successfully');
        } catch (Error $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function register(RegistrationAPIRequest $request)
    {
        try {

            $input             = $request->all();
//            $emailRequest      = new Request(['email' => $input['email']]);
//
//            $stripe_customer             = PaymentController::post($emailRequest, 'create.customer');
//            $input['stripe_customer_id'] = $stripe_customer['data']['id'];
            $user                        = $this->userRepository->create($input);

            $code = rand(1111, 9999);
            saveVerifyEmailOTP($user->id, $code);
            sendOTPEmail($user, 'Email Verification Code', $code);

            $userRole = Role::whereName(Role::API_USER)->first();
            $user->syncRoles($userRole);

            $userDetail            = $request->only('phone_number', 'phone_number_country_code');
            $userDetail['user_id'] = $user->id;
            $this->userDetailRepository->create($userDetail);

            $searchUserDevice      = $request->only('device_token');
            $userDevice            = $request->only('device_type', 'device_token');
            $userDevice['user_id'] = $user->id;
            $this->userDeviceRepository->updateOrCreate($searchUserDevice, $userDevice);

            return $this->sendResponse([
                'user' => $user->fresh(),
            ], 'User saved successfully.');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function resendOTP(ResendOTPAPIRequest $request)
    {
        try {
            $userModel = $this->userRepository->model();
            $user      = $userModel::where('email', $request->email)->first();

            if (!$user)
                return $this->sendError('User not found.', 404);

            if (!$user->details)
                return $this->sendError('User details is missing.', 404);
            if ($user->details->is_social_login)
                return $this->sendError('This email is signed as a social acount.', 403);

            $code = rand(1111, 9999);
            match ($request->type) {
                'email' => saveVerifyEmailOTP($user->id, $code),
                'password' => self::savePasswordResetOTP($user->email, $code)
            };

            $subject = ucfirst($request->type) . ' Verification Code';
            sendOTPEmail($user, $subject, $code);

            return $this->sendResponse([], 'Your OTP send to your email successfully.');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function verifyOTP(VerifyOTPAPIRequest $request)
    {
        try {
            $userModel = $this->userRepository->model();
            $user      = $userModel::where('email', $request->email)->first();

            if (!$user)
                return $this->sendError('User not found.', 404);

            $otp     = $request->otp;
            $otpCode = match ($request->type) {
                'email' => VerifyEmail::where(['user_id' => $user->id, 'code' => $otp])->first(),
                'password' => PasswordReset::where(['email' => $user->email, 'token' => $otp])->first()
            };

            if (!$otpCode)
                return $this->sendError('Invalid OTP Code.', 404);

            if (self::checkOTPExpiry($otpCode->created_at)) {
                $otpCode->delete();
                return $this->sendError('Your OTP expired.', 410);
            }

            $response = [];
            if ($otpCode instanceof VerifyEmail) {
                $user->markEmailAsVerified();
                $otpCode->delete();

                $token    = $user->createToken('access_token');
                $response = [
                    'token' => self::getTokenResponse($token),
                    'user'  => $user,
                ];
            }

            return $this->sendResponse($response, 'Your OTP is verified successfully.');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function forgetPassword(ForgetPasswordAPIRequest $request)
    {
        try {
            $code  = rand(1111, 9999);
            $email = $request->email;
            $user  = User::where('email', $email)->first();

            if (!$user)
                return $this->sendError('User not found.', 404);

            if (!$user->details)
                return $this->sendError('User details is missing.', 404);
            if ($user->details->is_social_login)
                return $this->sendError('This email is signed as a social acount.', 403);

            self::savePasswordResetOTP($user->email, $code);
            sendOTPEmail($user, 'Password Verification Code', $code);

            return $this->sendResponse([], 'Password Verification Code send to your email successfully');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function resetPassword(ResetPasswordAPIRequest $request)
    {
        try {
            $resetPassword = PasswordReset::where(['email' => $request->email, 'token' => $request->code])->first();
            if (!$resetPassword)
                return $this->sendError('Invalid Code.', 403);

            if (self::checkOTPExpiry($resetPassword->created_at)) {
                $resetPassword->delete();
                return $this->sendResponse([], 'Your OTP expired.');
            }

            $user = User::where('email', $request->email)->first();
            if (!$user)
                return $this->sendError('User not found.', 404);

            if (!$user->details)
                return $this->sendError('User details is missing.', 404);
            if ($user->details->is_social_login)
                return $this->sendError('This email is signed as a social acount.', 403);

            $user->update(['password' => $request->password]);
            $resetPassword->delete();

            $message = 'Your password is reset successfully';
            self::sendMessageEmail($user, 'Password Reset', $message);

            return $this->sendResponse(['user' => $user], 'Password Reset Successfully');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function deleteAccount(DeleteAccountAPIRequest $request)
    {
        try {
            $user = $request->user();
            if (!$user)
                return $this->sendError('User not found.', 404);

            if (!$userDetail = $user->details)
                return $this->sendError('User Detail not found.', 404);

            $userDetail->update([
                'delete_account_type_id' => $request->delete_account_type_id
            ]);

            $message = 'Your account is deleted successfully';
            self::sendMessageEmail($user, 'Account Deleted', $message);

            $user->delete();

            return $this->sendResponse([], 'Your account is deleted successfully');
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

    public static function checkOTPExpiry(DateTime $otpCreatedAt)
    {
        $otpExpireInSeconds = config('constants.expiry_in_seconds.otp');
        return Carbon::parse($otpCreatedAt)->addSeconds($otpExpireInSeconds)->isPast();
    }

    public static function savePasswordResetOTP($email, $code)
    {
        return PasswordReset::updateOrCreate(['email' => $email], ['token' => $code]);
    }

// public static function saveVerifyEmailOTP($user_id, $code)
// {
//     return VerifyEmail::updateOrCreate(['user_id' => $user_id], ['code' => $code]);
// }

// public static function sendOTPEmail($user, $subject, $code)
// {
//     $data = [
//         'name' => $user->details->first_name ?? 'User',
//         'otp' => $code
//     ];
//     $sendEmailJob = new SendEmail($user->email, $subject, $data, EmailServiceTemplateNames::OTP_TEMPLATE);
//     dispatch($sendEmailJob);
// }

    public function sendMessageEmail($user, $subject, $message)
    {
        try {
            $data         = ['message' => $message];
            $sendEmailJob = new SendEmail($user->email, $subject, $data, EmailServiceTemplateNames::MESSAGE_TEMPLATE);
            dispatch($sendEmailJob);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function changePassword(ChangePasswordAPIRequest $request)
    {
        try {
            $user = auth()->user();

            if (!$user)
                return $this->sendError('User not found.', 404);
            if (!$user->details)
                return $this->sendError('User details is missing.', 404);
            if ($user->details->is_social_login)
                return $this->sendError('This email is signed as a social acount.', 403);

            if (!Hash::check($request->current_password, $user->password))
                return $this->sendError("Oops, the current password you entered is incorrect", 422);

            if ($user && Hash::check($request->password, $user->password))
                return $this->sendError('New password must be different from the old password', 403);

            $user->update(['password' => $request->password]);

            return $this->sendResponse(['user' => $user], 'Password updated Successfully');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 422);
        }
    }

    public function logout(Request $request)
    {
        try {
            $user = $request->user();

            if ($user)
                $user->tokens()->delete();

            return $this->sendResponse(new \stdClass(), 'Logout Successfully');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 422);
        }
    }

    public function awsBucketToken()
    {
        $s3Client = new S3Client([
            'version'     => 'latest',
            'region'      => config('filesystems.disks.s3.region'),
            'credentials' => [
                'key'    => config('filesystems.disks.s3.key'),
                'secret' => config('filesystems.disks.s3.secret')
            ]
        ]);

        $s3Bucket  = config('filesystems.disks.s3.bucket');
        $s3Key     = "file";
        $s3Options = [];

        $command = $s3Client->getCommand('PutObject', [
            'Bucket'   => $s3Bucket,
            'Key'      => $s3Key,
            'MetaData' => $s3Options,
        ]);

        $request = $s3Client->createPresignedRequest($command, '+20 minutes');

        $url = (string)$request->getUri();

        return response()->json(['url' => $url], 201);
    }
}
