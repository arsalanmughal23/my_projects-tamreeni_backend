<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetCode extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    private $verification_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->user = $data['user'];
        $this->verification_code = $data['verification_code'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('auth.emails.password_reset_code')
            ->from(env('MAIL_FROM_ADDRESS'), $this->user->name)
            ->subject("Password Reset Code")
            ->with([
                'user' => $this->user,
                'verification_code' => $this->verification_code,
            ]);
    }
}
