<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\ForgetPasswordRequest;
use App\Http\Requests\API\LoginAPIRequest;
use App\Http\Requests\API\PasswordResetCodeRequest;
use App\Http\Requests\API\RegistrationAPIRequest;
use App\Http\Requests\API\UpdatePasswordRequest;
use App\Mail\PasswordResetCode;
use App\Mail\PasswordChanged;
use App\Models\PasswordReset;
use App\Models\User;
use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Aws\S3\S3Client;

class AuthAPIController extends AppBaseController
{
    private $usersRepository;
    private $rolesRepository;

    public function __construct(UsersRepository $usersRepo)
    {
        $this->usersRepository = $usersRepo;
    }

    public function login(LoginAPIRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (!auth()->attempt($credentials)) {
            return $this->sendError('Invalid login credentials, please try again.', 401);
        }

        $user = auth()->user();
        $token = $user->createToken('access_token')->plainTextToken;

        return $this->sendResponse([
            'token' => $token,
            'user' => $user,
        ], 'Logged In Successfully');

    }

    public function register(RegistrationAPIRequest $request)
    {
        try {
            $input = $request->all();
            $user = $this->usersRepository->create($input);

            return $this->sendResponse([
                'user' => $user,
            ], 'User saved successfully.');

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

            $resetPassword = PasswordReset::updateOrCreate(
                ['email' => $email],
                ['token' => $code]
            );

            Mail::to($email)->send(
                new PasswordResetCode([
                    'user' => $user,
                    'verification_code' => $code,
                ])
            );

            return $this->sendResponse([], 'Password Verification Code Send To Your Email Successfully');

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function verifyPasswordResetCode(PasswordResetCodeRequest $request)
    {
        try {
            $resetPassword = PasswordReset::where('token', $request->verification_code)->exists();

            if (!$resetPassword) {
                return $this->sendError('Invalid Code', 403);
            }

            return $this->sendResponse([], 'Code Verify successfully');

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        try {
            $resetPassword = PasswordReset::where([
                ['email', $request->email],
                ['token', $request->verification_code]
            ])->exists();

            if(!$resetPassword) {
                return $this->sendError('Invalid Code', 403);
            }

            $user = User::where('email', $request->email)->first();
            $user->update([
                'password' => $request->password,
            ]);

            Mail::to($request->email)->send(
                new PasswordChanged([
                    'user' => $user
                ])
            );

            return $this->sendResponse(['user' => $user], 'Password Changed Successfully');

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

// public function forgetPassword(ForgetPasswordRequest $request)
// {
//     try {
//         $status = Password::sendResetLink($request->only('email'));

//         if ($status) {
//             return $this->sendResponse([], 'Reset Password Email Sent Successfully');
//         }

//     } catch (\Exception $e) {

//         return $this->sendError($e->getMessage(), 500);
//     }
// }
