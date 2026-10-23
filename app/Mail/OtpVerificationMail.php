<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $name;

    public function __construct(string $otp, string $name = 'User')
    {
        $this->otp = $otp;
        $this->name = $name;
    }

    public function build()
    {
        return $this->from(config('mail.from.address', 'kerollossami@gmail.com'), config('mail.from.name', 'Kirollos Samy Portfolio'))
            ->subject('Security Verification Code: ' . $this->otp . ' — Kirollos Samy Inquiries')
            ->view('emails.otp')
            ->text('emails.otp_text')
            ->with([
                'otp' => $this->otp,
                'name' => $this->name,
            ]);
    }
}
