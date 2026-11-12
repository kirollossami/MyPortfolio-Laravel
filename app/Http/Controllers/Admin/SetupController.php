<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SetupController extends Controller
{
    public function show()
    {
        if (User::exists()) {
            return redirect()->route('login');
        }

        $setupKey = config('portfolio.admin_setup_key');
        $requiresSetupKey = filled($setupKey);
        $missingProductionKey = app()->isProduction() && !$requiresSetupKey;

        return view('admin.auth.setup', compact('requiresSetupKey', 'missingProductionKey'));
    }

    public function store(Request $request)
    {
        if (User::exists()) {
            abort(403, 'Initial admin setup has already been completed.');
        }

        $setupKey = config('portfolio.admin_setup_key');

        if (app()->isProduction() && blank($setupKey)) {
            abort(403, 'ADMIN_SETUP_KEY must be set in production before using web setup.');
        }

        $rules = [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        if (filled($setupKey)) {
            $rules['setup_key'] = ['required', 'string'];
        }

        $validated = $request->validate($rules);

        if (filled($setupKey) && !hash_equals((string) $setupKey, (string) $validated['setup_key'])) {
            return back()
                ->withInput($request->only('name', 'email'))
                ->withErrors(['setup_key' => 'Invalid setup key.']);
        }

        $user = User::create([
            'name' => trim($validated['name']),
            'email' => strtolower(trim($validated['email'])),
            'password' => Hash::make($validated['password']),
            'email_verified_at' => now(),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Admin account created and signed in!');
    }
}
