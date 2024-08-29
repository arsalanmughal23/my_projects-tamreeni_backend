<?php

namespace App\Http\Middleware;

use App\Models\UserMembership;
use Carbon\Carbon;
use Closure;
use Error;
use Exception;
use Illuminate\Http\Request;

class UserMembershipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $userActiveMembership = $user->active_membership;

        // if(!$userActiveMembership)
        //     return self::makeResponse(false, 'You need to purchase membership', 402);

        $isTrailAvailable = false;
        if($user->trail_expire_at && Carbon::parse($user->trail_expire_at)->isFuture())
            $isTrailAvailable = true;

        // if(!$userActiveMembership || ($userActiveMembership && Carbon::parse($userActiveMembership?->expire_at)->isPast())) {
        if($userActiveMembership?->status != UserMembership::STATUS_ACTIVE) {
            if(!$isTrailAvailable) {
                return self::makeResponse(false, 'You need to purchase membership', 402);
            }
        }

        return $next($request);
    }

    public static function makeResponse($status = false, $message, $code = 403)
    {
        return response()->json([ 'status' => $status, 'message' => $message ], $code);
    }
}
