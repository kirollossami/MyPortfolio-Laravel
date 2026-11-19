<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\MailDeliveryService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * Show form to request a password reset OTP.
     */
    public function showLinkRequestForm()
    {
        if (!User::exists()) {
            return redirect()->route('admin.setup');
        }

        return view('admin.auth.forgot_password');
    }

    /**
     * Send 6-digit OTP code to the administrator's email.
     */
    public function sendResetOtp(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = strtolower(trim($validated['email']));
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()
                ->withInput()
                ->withErrors(['email' => 'No administrator account was found with that email address.']);
        }

        $otp = str_pad((string) random_int(100000, 999999), 6, '0', STR_PAD_LEFT);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => Hash::make($otp),
                'created_at' => now(),
            ]
        );

        session(['password_reset_email' => $email]);

        MailDeliveryService::sendPasswordResetOtp($user->email, $otp, $user->name);

        return redirect()
            ->route('admin.password.otp')
            ->with('status', "A 6-digit verification code has been sent to {$email}. Please check your inbox.");
    }

    /**
     * Show form to enter and verify the 6-digit OTP code.
     */
    public function showVerifyOtpForm(Request $request)
    {
        if (!User::exists()) {
            return redirect()->route('admin.setup');
        }

        $email = session('password_reset_email') ?: $request->query('email');

        if (!$email) {
            return redirect()->route('admin.password.request');
        }

        return view('admin.auth.verify_otp', compact('email'));
    }

    /**
     * Verify the 6-digit OTP code submitted by the user.
     */
    public function verifyOtp(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $email = strtolower(trim($validated['email']));
        $otp = trim($validated['otp']);

        $record = DB::table('password_reset_tokens')->where('email', $email)->first();

        if (!$record) {
            return back()
                ->withInput()
                ->withErrors(['otp' => 'No active verification code found for this email. Please request a new code.']);
        }

        // Expire after 15 minutes
        if (Carbon::parse($record->created_at)->addMinutes(15)->isPast()) {
            return back()
                ->withInput()
                ->withErrors(['otp' => 'This verification code has expired. Please request a new one.']);
        }

        if (!Hash::check($otp, $record->token)) {
            return back()
                ->withInput()
                ->withErrors(['otp' => 'Invalid 6-digit verification code. Please check your email and try again.']);
        }

        // OTP verified successfully - generate a temporary token for the password reset form
        $verifiedToken = Str::random(64);

        session([
            'password_reset_verified_email' => $email,
            'password_reset_verified_token' => $verifiedToken,
        ]);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => Hash::make($verifiedToken),
                'created_at' => now(),
            ]
        );

        return redirect()
            ->route('admin.password.reset')
            ->with('status', 'Verification code confirmed! Please enter your new password.');
    }

    /**
     * Resend a fresh 6-digit OTP code.
     */
    public function resendOtp(Request $request)
    {
        $email = strtolower(trim($request->input('email') ?: session('password_reset_email')));

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()
                ->route('admin.password.request')
                ->withErrors(['email' => 'Please enter your registered administrator email.']);
        }

        $otp = str_pad((string) random_int(100000, 999999), 6, '0', STR_PAD_LEFT);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => Hash::make($otp),
                'created_at' => now(),
            ]
        );

        session(['password_reset_email' => $email]);

        MailDeliveryService::sendPasswordResetOtp($user->email, $otp, $user->name);

        return redirect()
            ->route('admin.password.otp', ['email' => $email])
            ->with('status', "A fresh 6-digit verification code has been sent to {$email}.");
    }

    /**
     * Show form to set a new password.
     */
    public function showResetForm(Request $request)
    {
        if (!User::exists()) {
            return redirect()->route('admin.setup');
        }

        $verifiedEmail = session('password_reset_verified_email');
        $email = $verifiedEmail ?: session('password_reset_email') ?: $request->query('email');

        if (!$verifiedEmail && !$request->has('otp')) {
            // If they haven't verified OTP yet, send them to the OTP verification page
            if (session('password_reset_email') || $request->query('email')) {
                return redirect()->route('admin.password.otp', ['email' => $email]);
            }

            return redirect()->route('admin.password.request');
        }

        return view('admin.auth.reset_password', [
            'email' => $email,
            'isVerified' => (bool) $verifiedEmail,
        ]);
    }

    /**
     * Update user password after verification.
     */
    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'otp' => ['nullable', 'string', 'size:6'],
        ]);

        $email = strtolower(trim($validated['email']));
        $record = DB::table('password_reset_tokens')->where('email', $email)->first();

        if (!$record) {
            return redirect()
                ->route('admin.password.request')
                ->withErrors(['email' => 'Password reset session expired. Please start over.']);
        }

        if (Carbon::parse($record->created_at)->addMinutes(15)->isPast()) {
            return redirect()
                ->route('admin.password.request')
                ->withErrors(['email' => 'Your password reset token has expired. Please request a new code.']);
        }

        $isSessionVerified = session('password_reset_verified_email') === $email
            && session('password_reset_verified_token')
            && Hash::check((string) session('password_reset_verified_token'), $record->token);

        $isOtpVerified = !empty($validated['otp']) && Hash::check($validated['otp'], $record->token);

        if (!$isSessionVerified && !$isOtpVerified) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['otp' => 'Verification code is invalid or not verified yet.']);
        }

        $user = User::where('email', $email)->firstOrFail();
        $user->password = Hash::make($validated['password']);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $email)->delete();
        session()->forget([
            'password_reset_email',
            'password_reset_verified_email',
            'password_reset_verified_token',
        ]);

        return redirect()
            ->route('login')
            ->with('status', 'Your password has been reset successfully! Please sign in with your new password.');
    }
}
