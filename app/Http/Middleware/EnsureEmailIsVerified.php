<?php

namespace App\Http\Middleware;

use App\Models\Role;
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
    public function handle($request, Closure $next, $guard = null)
    {
        $user = $request->user();
        $userDetails = $user?->details;

        if(!in_array($guard, ['api', 'web'])) {
            return $request->expectsJson()
                ? response()->json([ 'success' => false, 'message' => 'Invalid Guard.' ], 403)
                : abort(403, 'Invalid Guard');
        }

        if ($guard == 'api') {
            if(!$user->hasRole(Role::API_USER))
                return response()->json([ 'success' => false, 'message' => 'User does not have the right role.' ], 403);

            if ($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail())
                return self::getUnVerifiedEmailApiResponse($user);

            if(!$userDetails)
                return response()->json([ 'success' => false, 'message' => 'User detail is missing.' ], 403);

        } else {
            if (!$user->hasAnyRole([Role::SUPER_ADMIN, Role::ADMIN, ...Role::MENTOR])) {
                auth()->guard()->logout();
                $request->session()->invalidate();
                return abort(403, 'User does not have the right role.');
            }

            // if ($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail())
            //     return Redirect::guest(URL::route($redirectToRoute ?: 'verification.notice'));
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
