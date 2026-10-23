<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
     * Handle direct contact form submissions.
     * Delivers message directly to Kirollos Samy's inbox via Resend HTTPS (Port 443) / SMTP.
     */
    public function submitForm(Request $request)
    {
        @ini_set('max_execution_time', '60');
        @set_time_limit(60);

        $validated = $request->validate([
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email|max:150',
            'subject' => 'required|string|min:2|max:200',
            'message' => 'required|string|min:10|max:5000',
        ]);

        $inquiry = [
            'name' => trim($validated['name']),
            'email' => strtolower(trim($validated['email'])),
            'subject' => trim($validated['subject']),
            'message' => trim($validated['message']),
            'submitted_at' => now()->toDateTimeString(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ];

        // 1. Permanently record inquiry in storage/app/inquiries.json
        try {
            $inquiriesFile = storage_path('app/inquiries.json');
            $existing = [];
            if (file_exists($inquiriesFile)) {
                $content = @file_get_contents($inquiriesFile);
                $existing = json_decode($content, true) ?: [];
            }
            array_unshift($existing, array_merge(['id' => uniqid('inq_')], $inquiry));
            // Keep recent 100
            $existing = array_slice($existing, 0, 100);
            @file_put_contents($inquiriesFile, json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        } catch (\Throwable $fileEx) {
            Log::warning('Inquiry file backup failed: ' . $fileEx->getMessage());
        }

        // 2. Dispatch directly to Kirollos Samy's inbox
        $delivery = MailDeliveryService::sendInquiryEmail($inquiry);

        // 3. Generate pre-filled WhatsApp direct chat link
        $waText = "Hello Kirollos,\nMy Name: {$inquiry['name']}\nEmail: {$inquiry['email']}\nSubject: {$inquiry['subject']}\nMessage: {$inquiry['message']}";
        $whatsappUrl = "https://wa.me/201201977114?text=" . rawurlencode($waText);

        $responseMsg = "Thank you, {$inquiry['name']}! Your message has been sent directly to Kirollos Samy. You can also connect directly on WhatsApp below.";

        if ($request->expectsJson() || $request->ajax() || $request->header('Accept') === 'application/json') {
            return response()->json([
                'success' => true,
                'message' => $responseMsg,
                'whatsapp_url' => $whatsappUrl,
                'delivered' => $delivery['delivered'],
            ]);
        }

        return redirect(url('/#contact'))->with('success', $responseMsg);
    }

    /**
     * Stubs for legacy routes to ensure zero errors if cached client JS calls them
     */
    public function sendOtp(Request $request)
    {
        return $this->submitForm($request);
    }

    public function verifyOtp(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Message transmitted successfully!',
        ]);
    }

    public function resendOtp(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Code resent.',
        ]);
    }
}
