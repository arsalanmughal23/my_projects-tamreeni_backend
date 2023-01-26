<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\API\LoginAPIRequest;

class AuthAPIController extends AppBaseController
{
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
            'user'  => $user,
        ], 'Logged In Successfully');

    }

}
