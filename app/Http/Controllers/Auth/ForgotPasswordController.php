<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    /**
     * Validate the email for the given request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
//        dd($request->email);
        $user = User::where('email', $request->email)
            ->whereNull('deleted_at')
            ->first();
//        dd($user);
        if ($user) {
            PasswordReset::where('email', $request->email)->delete();
            $token = Str::random(60);

            $url = config('app.url') . '/password/reset/' . $token;
            PasswordReset::create([
                'email' => $request->email,
                'token' => $token,
            ]);

            sendForgotPasswordEmail($user, 'Forgot Password', $url);

        }


        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
//        $response = $this->broker()->sendResetLink(
//            $this->credentials($request)
//        );
//        dd($response);
//        return $response == Password::RESET_LINK_SENT
//            ? $this->sendResetLinkResponse($request, $response)
//            : $this->sendResetLinkFailedResponse($request, $response);

        return back()->with('status', 'We have emailed your password reset link!');
    }

    public function createToken($email)
    {
        // Customize your token generation logic here
        return hash('sha256', $email . time());
    }
}
