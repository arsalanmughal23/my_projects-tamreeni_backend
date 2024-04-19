<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        $user = $request->user();
        $userDetails = $user?->details;
        if(!$userDetails)
            return response()->json([ 'success' => false, 'message' => 'User detail is missing.' ], 403);

        if ($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail()) {
            if ($request->expectsJson()) {
                return self::getUnVerifiedEmailApiResponse($user);
            } else {
                return Redirect::guest(URL::route($redirectToRoute ?: 'verification.notice'));
            }
        }

        return $next($request);
    }

    public static function getUnVerifiedEmailApiResponse(User $user)
    {
        if (!$user) {
            $responseData = [
                'success' => false, 
                'message' => 'Authentication failed.',
            ];
            return response()->json($responseData, 401);
        }

        $code = rand(1111, 9999);
        saveVerifyEmailOTP($user->id, $code);
        sendOTPEmail($user, 'Email Verification Code', $code);

        $responseData = [
            'success' => false, 
            'message' => 'Your email address is not verified.', 
            'data' => [
                'is_email_verified' => false
            ]
        ];
        return response()->json($responseData, 203);
    }

}
