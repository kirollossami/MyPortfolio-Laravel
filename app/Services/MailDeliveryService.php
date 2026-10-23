<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpVerificationMail;

class MailDeliveryService
{
    /**
     * Send OTP Verification code using HTTPS API (Resend) or SMTP with short timeout.
     *
     * @param string $toEmail
     * @param string $recipientName
     * @param string $otpCode
     * @return array [bool 'delivered', string|null 'method', string|null 'error']
     */
    public static function sendOtpEmail(string $toEmail, string $recipientName, string $otpCode): array
    {
        $resendApiKey = env('RESEND_API_KEY');

        // 1. Try Resend via HTTPS (Port 443 - never blocked by cloud firewalls)
        if (!empty($resendApiKey)) {
            try {
                $fromAddress = env('MAIL_FROM_ADDRESS', 'onboarding@resend.dev');
                $fromName = env('MAIL_FROM_NAME', 'Kirollos Samy Portfolio');

                $response = Http::withToken($resendApiKey)
                    ->timeout(8)
                    ->post('https://api.resend.com/emails', [
                        'from' => "{$fromName} <{$fromAddress}>",
                        'to' => [$toEmail],
                        'subject' => "Security Verification Code: {$otpCode} — Kirollos Samy Inquiries",
                        'html' => view('emails.otp', ['otp' => $otpCode, 'name' => $recipientName])->render(),
                        'text' => view('emails.otp_text', ['otp' => $otpCode, 'name' => $recipientName])->render(),
                    ]);

                if ($response->successful()) {
                    Log::info("Resend HTTPS API successfully delivered OTP to: {$toEmail}");
                    return ['delivered' => true, 'method' => 'resend_https', 'error' => null];
                }

                Log::warning("Resend HTTPS returned error: " . $response->body());
            } catch (\Throwable $resendEx) {
                Log::warning("Resend HTTPS request exception: " . $resendEx->getMessage());
            }
        }

        // 2. Try SMTP with short socket timeout
        try {
            // Set short connection timeout to prevent hanging on cloud firewalls
            config(['mail.mailers.smtp.timeout' => 5]);

            Mail::to($toEmail)->send(new OtpVerificationMail($otpCode, $recipientName));
            Log::info("SMTP successfully delivered OTP to: {$toEmail}");
            return ['delivered' => true, 'method' => 'smtp', 'error' => null];
        } catch (\Throwable $smtpEx) {
            Log::warning("SMTP dispatch failed (likely cloud port block): " . $smtpEx->getMessage());
            return ['delivered' => false, 'method' => null, 'error' => $smtpEx->getMessage()];
        }
    }
}
