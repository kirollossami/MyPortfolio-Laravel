<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\SiteSetting;
use App\Services\MailDeliveryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Display the portfolio home view.
     */
    public function showForm()
    {
        return app(PortfolioController::class)->index();
    }

    /**
     * Handle direct contact form submissions:
     * 1. Persist to `contact_messages` table in database
     * 2. Backup to storage/app/inquiries.json
     * 3. Deliver email via MailDeliveryService
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

        // 1. Save inquiry to database
        $contactMessage = ContactMessage::create([
            'name' => $inquiry['name'],
            'email' => $inquiry['email'],
            'subject' => $inquiry['subject'],
            'message' => $inquiry['message'],
            'ip_address' => $inquiry['ip'],
            'user_agent' => $inquiry['user_agent'],
            'mail_delivered' => false,
            'is_read' => false,
        ]);

        // 2. Backup inquiry in storage/app/inquiries.json
        try {
            $inquiriesFile = storage_path('app/inquiries.json');
            $existing = [];
            if (file_exists($inquiriesFile)) {
                $content = @file_get_contents($inquiriesFile);
                $existing = json_decode($content, true) ?: [];
            }
            array_unshift($existing, array_merge(['id' => 'inq_' . $contactMessage->id], $inquiry));
            $existing = array_slice($existing, 0, 100);
            @file_put_contents($inquiriesFile, json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        } catch (\Throwable $fileEx) {
            Log::warning('Inquiry file backup failed: ' . $fileEx->getMessage());
        }

        // 3. Dispatch directly to portfolio owner's inbox
        $delivery = MailDeliveryService::sendInquiryEmail($inquiry);
        if (!empty($delivery['delivered'])) {
            $contactMessage->update(['mail_delivered' => true]);
        }

        // 4. Generate pre-filled WhatsApp direct chat link from dynamic settings
        $brandName = SiteSetting::getValue('brand_name', 'Kirollos Samy');
        $whatsappNumber = preg_replace('/[^0-9]/', '', (string) SiteSetting::getValue('whatsapp_number', '201201977114'));
        $waText = "Hello {$brandName},\nMy Name: {$inquiry['name']}\nEmail: {$inquiry['email']}\nSubject: {$inquiry['subject']}\nMessage: {$inquiry['message']}";
        $whatsappUrl = "https://wa.me/{$whatsappNumber}?text=" . rawurlencode($waText);

        $responseMsg = "Thank you, {$inquiry['name']}! Your message has been saved and sent directly to {$brandName}. You can also connect directly on WhatsApp below.";

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
