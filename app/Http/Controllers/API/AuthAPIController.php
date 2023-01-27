<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\LoginAPIRequest;
use App\Http\Requests\API\RegistrationAPIRequest;
use App\Http\Requests\API\ForgetPasswordRequest;
use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\Password;

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

        } catch (\Exception$e) {

            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        try {
            $status = Password::sendResetLink($request->only('email'));

            if ($status) {
                return $this->sendResponse([], 'Reset Password Email Sent Successfully');
            }

        } catch (\Exception $e) {

            return $this->sendError($e->getMessage(), 500);
        }
    }
}
