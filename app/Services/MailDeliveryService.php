<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class MailDeliveryService
{
    /**
     * Send Contact Inquiry directly to Kirollos Samy's inbox.
     * Uses HTTPS Resend API (Port 443) or SMTP.
     *
     * @param array $data ['name', 'email', 'subject', 'message']
     * @return array [bool 'delivered', string|null 'method', string|null 'error']
     */
    public static function sendInquiryEmail(array $data): array
    {
        $resendApiKey = env('RESEND_API_KEY');
        $recipient = 'kerollossami@gmail.com';

        // 1. Try Resend via HTTPS (Port 443 - zero firewall blocks on Railway)
        if (!empty($resendApiKey)) {
            try {
                $fromAddress = env('RESEND_FROM_ADDRESS') ?: 'onboarding@resend.dev';
                $fromName = 'Portfolio Inquiry (' . $data['name'] . ')';

                $response = Http::withToken($resendApiKey)
                    ->timeout(10)
                    ->post('https://api.resend.com/emails', [
                        'from' => "{$fromName} <{$fromAddress}>",
                        'to' => [$recipient],
                        'reply_to' => $data['email'],
                        'subject' => "New Portfolio Message: {$data['subject']} — from {$data['name']}",
                        'html' => view('emails.contact', ['data' => $data])->render(),
                    ]);

                if ($response->successful()) {
                    Log::info("Resend HTTPS API successfully delivered inquiry to: {$recipient}");
                    return ['delivered' => true, 'method' => 'resend_https', 'error' => null];
                }

                $errBody = $response->body();
                Log::warning("Resend HTTPS returned error: " . $errBody);
            } catch (\Throwable $resendEx) {
                Log::warning("Resend HTTPS request exception: " . $resendEx->getMessage());
            }
        }

        // 2. Fallback to SMTP
        try {
            config(['mail.mailers.smtp.timeout' => 5]);
            Mail::to($recipient)->send(new ContactMail($data));
            Log::info("SMTP successfully delivered inquiry to: {$recipient}");
            return ['delivered' => true, 'method' => 'smtp', 'error' => null];
        } catch (\Throwable $smtpEx) {
            Log::warning("SMTP dispatch failed: " . $smtpEx->getMessage());
            return ['delivered' => false, 'method' => null, 'error' => $smtpEx->getMessage()];
        }
    }

    /**
     * Send Admin Password Reset OTP via Laravel Mail with Resend HTTPS fallback.
     *
     * @param string $email
     * @param string $otp
     * @param string $name
     * @return array [bool 'delivered', string|null 'method', string|null 'error']
     */
    public static function sendPasswordResetOtp(string $email, string $otp, string $name = 'Administrator'): array
    {
        // 1. Try standard Laravel Mail (honors Mail::fake in tests and configured SMTP/mailpit)
        try {
            Mail::to($email)->send(new \App\Mail\AdminPasswordResetOtpMail($otp, $name));
            Log::info("Admin password reset OTP sent via Mail to: {$email}");
            return ['delivered' => true, 'method' => 'mail', 'error' => null];
        } catch (\Throwable $mailEx) {
            Log::warning("Standard Mail dispatch failed for OTP to {$email}: " . $mailEx->getMessage());

            // 2. Fallback to Resend HTTPS API if API key is present
            $resendApiKey = env('RESEND_API_KEY');
            if (!empty($resendApiKey)) {
                try {
                    $fromAddress = env('RESEND_FROM_ADDRESS') ?: 'onboarding@resend.dev';
                    $fromName = 'Portfolio Security (' . config('app.name', 'Portfolio CMS') . ')';

                    $response = Http::withToken($resendApiKey)
                        ->timeout(10)
                        ->post('https://api.resend.com/emails', [
                            'from' => "{$fromName} <{$fromAddress}>",
                            'to' => [$email],
                            'subject' => "Your Admin Verification Code: {$otp} — Portfolio CMS",
                            'html' => view('emails.admin_password_reset_otp', ['otp' => $otp, 'name' => $name])->render(),
                            'text' => view('emails.admin_password_reset_otp_text', ['otp' => $otp, 'name' => $name])->render(),
                        ]);

                    if ($response->successful()) {
                        Log::info("Resend HTTPS API delivered reset OTP to: {$email}");
                        return ['delivered' => true, 'method' => 'resend_https', 'error' => null];
                    }

                    Log::warning("Resend HTTPS returned error for OTP: " . $response->body());
                } catch (\Throwable $resendEx) {
                    Log::warning("Resend HTTPS fallback failed for OTP: " . $resendEx->getMessage());
                }
            }

            // Always log the OTP so developers/admins can see it in storage/logs/laravel.log
            Log::info("EMERGENCY / LOCAL OTP for {$email}: {$otp}");
            return ['delivered' => false, 'method' => null, 'error' => $mailEx->getMessage()];
        }
    }
}
