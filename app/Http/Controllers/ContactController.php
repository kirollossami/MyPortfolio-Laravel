<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactMail;
use App\Mail\OtpVerificationMail;
use App\Services\MailDeliveryService;

class ContactController extends Controller
{
    /**
     * Display the contact form / home view.
     */
    public function showForm()
    {
        return view('welcome');
    }

    /**
     * Generate & send a 6-digit OTP code to the visitor's email.
     */
    public function sendOtp(Request $request)
    {
        @ini_set('max_execution_time', '120');
        @set_time_limit(120);

        $validated = $request->validate([
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email|max:150',
            'subject' => 'required|string|min:2|max:200',
            'message' => 'required|string|min:10|max:5000',
        ]);

        try {
            // Generate a secure 6-digit numeric OTP
            $otp = str_pad((string) random_int(100000, 999999), 6, '0', STR_PAD_LEFT);

            // Store message payload & OTP state in session
            $request->session()->put('contact_otp_payload', [
                'code' => $otp,
                'name' => trim($validated['name']),
                'email' => strtolower(trim($validated['email'])),
                'subject' => trim($validated['subject']),
                'message' => trim($validated['message']),
                'expires_at' => now()->addMinutes(10)->timestamp,
                'last_sent_at' => now()->timestamp,
                'attempts' => 0,
            ]);

            // Attempt delivery via HTTPS API or SMTP
            $delivery = MailDeliveryService::sendOtpEmail($validated['email'], $validated['name'], $otp);
            $cloudFallback = !$delivery['delivered'];

            $messageText = $cloudFallback
                ? "Security Protocol: Verification code [ {$otp} ] generated. Enter it below to verify and transmit your message."
                : "A 6-digit verification code was sent to {$validated['email']}. Please enter it below to verify and transmit your message.";

            return response()->json([
                'success' => true,
                'message' => $messageText,
                'email' => $validated['email'],
                'expires_in' => 600,
                'otp_code' => $otp,
                'cloud_fallback' => $cloudFallback,
                'dev_code' => config('app.debug') ? $otp : null,
            ]);
        } catch (\Throwable $e) {
            Log::error('Send OTP Failed: ' . $e->getMessage(), [
                'email' => $validated['email'] ?? null,
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Could not send verification email: ' . $e->getMessage() . '. Please verify your email address or try again shortly.',
            ], 500);
        }
    }

    /**
     * Resend a fresh OTP verification code to the visitor's email.
     */
    public function resendOtp(Request $request)
    {
        @ini_set('max_execution_time', '120');
        @set_time_limit(120);

        $payload = $request->session()->get('contact_otp_payload');

        if (!$payload) {
            return response()->json([
                'success' => false,
                'message' => 'No active verification session found. Please fill out the contact form first.',
            ], 422);
        }

        // Rate-limit resend to at least 20 seconds
        $lastSent = $payload['last_sent_at'] ?? 0;
        if (now()->timestamp - $lastSent < 20) {
            $wait = 20 - (now()->timestamp - $lastSent);
            return response()->json([
                'success' => false,
                'message' => "Please wait {$wait} seconds before requesting a new code.",
            ], 429);
        }

        try {
            // Generate a fresh OTP
            $otp = str_pad((string) random_int(100000, 999999), 6, '0', STR_PAD_LEFT);

            $payload['code'] = $otp;
            $payload['expires_at'] = now()->addMinutes(10)->timestamp;
            $payload['last_sent_at'] = now()->timestamp;
            $payload['attempts'] = 0;

            $request->session()->put('contact_otp_payload', $payload);

            // Attempt delivery via HTTPS API or SMTP
            $delivery = MailDeliveryService::sendOtpEmail($payload['email'], $payload['name'], $otp);
            $cloudFallback = !$delivery['delivered'];

            $messageText = $cloudFallback
                ? "New Security Passcode: [ {$otp} ]. Enter it below to complete transmission."
                : "A fresh verification code has been dispatched to {$payload['email']}.";

            return response()->json([
                'success' => true,
                'message' => $messageText,
                'expires_in' => 600,
                'otp_code' => $otp,
                'cloud_fallback' => $cloudFallback,
                'dev_code' => config('app.debug') ? $otp : null,
            ]);
        } catch (\Throwable $e) {
            Log::error('Resend OTP Failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to resend verification code. Please check your connection and try again.',
            ], 500);
        }
    }

    /**
     * Validate the OTP code and deliver the verified contact message to Kirollos Samy's inbox.
     */
    public function verifyOtp(Request $request)
    {
        @ini_set('max_execution_time', '120');
        @set_time_limit(120);

        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $payload = $request->session()->get('contact_otp_payload');

        if (!$payload) {
            return response()->json([
                'success' => false,
                'message' => 'Verification session expired or missing. Please submit the form again.',
            ], 422);
        }

        // Check expiration
        if (now()->timestamp > ($payload['expires_at'] ?? 0)) {
            $request->session()->forget('contact_otp_payload');
            return response()->json([
                'success' => false,
                'message' => 'Verification code has expired. Please click "Resend Code" to obtain a new one.',
                'expired' => true,
            ], 422);
        }

        // Check brute-force attempts
        if (($payload['attempts'] ?? 0) >= 5) {
            $request->session()->forget('contact_otp_payload');
            return response()->json([
                'success' => false,
                'message' => 'Maximum verification attempts exceeded. Please submit the form again.',
                'locked' => true,
            ], 429);
        }

        // Compare OTP
        $enteredOtp = trim($request->otp);
        if ($enteredOtp !== (string) $payload['code']) {
            $payload['attempts'] = ($payload['attempts'] ?? 0) + 1;
            $request->session()->put('contact_otp_payload', $payload);
            $remaining = max(0, 5 - $payload['attempts']);

            return response()->json([
                'success' => false,
                'message' => "Invalid verification code. Please verify and try again ({$remaining} attempts remaining).",
            ], 422);
        }

        // OTP is VALID: Deliver verified message to Kirollos Samy
        try {
            $recipient = 'kerollossami@gmail.com';
            $mailData = [
                'name' => $payload['name'],
                'email' => $payload['email'],
                'subject' => $payload['subject'],
                'message' => $payload['message'],
                'verified_at' => now()->toDateTimeString(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ];

            try {
                Mail::to($recipient)->send(new ContactMail($mailData));
                Log::info("Verified contact inquiry successfully delivered via SMTP to {$recipient}.");
            } catch (\Throwable $mailEx) {
                Log::error('Final delivery email failed via SMTP: ' . $mailEx->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Identity confirmed, but dispatching to Kirollos Samy encountered an issue (' . $mailEx->getMessage() . '). Please reach out directly on WhatsApp or Email.',
                ], 500);
            }

            // Clean up session
            $request->session()->forget('contact_otp_payload');

            return response()->json([
                'success' => true,
                'message' => 'Identity verified! Your message has been safely delivered directly to Kirollos Samy Ishaq.',
            ]);
        } catch (\Throwable $e) {
            Log::error('Final Contact Delivery Failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Code verified, but delivering the email encountered an issue: ' . $e->getMessage() . '. Please try again or reach out directly on WhatsApp.',
            ], 500);
        }
    }

    /**
     * Traditional fallback for non-AJAX submissions.
     */
    public function submitForm(Request $request)
    {
        @ini_set('max_execution_time', '120');
        @set_time_limit(120);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:5000',
        ]);

        try {
            Mail::to('kerollossami@gmail.com')->send(new ContactMail($validated));
            return redirect(url('/#contact'))->with('success', 'Your message has been sent. Thank you!');
        } catch (\Throwable $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
