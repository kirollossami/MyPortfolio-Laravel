<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminPasswordResetOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $otp;
    public string $name;

    public function __construct(string $otp, string $name = 'Administrator')
    {
        $this->otp = $otp;
        $this->name = $name;
    }

    public function build()
    {
        return $this->from(config('mail.from.address', 'kerollossami@gmail.com'), config('mail.from.name', 'Kirollos Samy Portfolio'))
            ->subject('Your Admin Verification Code: ' . $this->otp . ' — Portfolio CMS')
            ->view('emails.admin_password_reset_otp')
            ->text('emails.admin_password_reset_otp_text')
            ->with([
                'otp' => $this->otp,
                'name' => $this->name,
            ]);
    }
}
