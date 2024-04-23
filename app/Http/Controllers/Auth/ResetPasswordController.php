<?php

namespace App\Http\Controllers\Auth;

use App\Constants\EmailServiceTemplateNames;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use App\Models\PasswordReset;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use DateTime;
use Flash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function reset(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            Flash::error('This email doesn\'t exists.');
        }

        $resetPassword = PasswordReset::where(['email' => $request->email, 'token' => $request->token])->first();
        if (!$resetPassword)
            Flash::error('This password reset token is invalid.');


        if ($this->checkOTPExpiry($resetPassword->created_at)) {
            $resetPassword->delete();
            Flash::error('This password reset token is expired.');
        }

        $user->update(['password' => $request->password]);
        $resetPassword->delete();


        $message = 'Your password is reset successfully';
        self::sendMessageEmail($user, 'Password Reset', $message);

//        return back()->with('status', 'Password updated Successfully');
        return redirect()->route('login')->with('status', 'Password updated Successfully');

    }


    public static function checkOTPExpiry(DateTime $otpCreatedAt)
    {
        $otpExpireInSeconds = config('constants.expiry_in_seconds.otp');
        return Carbon::parse($otpCreatedAt)->addSeconds($otpExpireInSeconds)->isPast();
    }

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
}
