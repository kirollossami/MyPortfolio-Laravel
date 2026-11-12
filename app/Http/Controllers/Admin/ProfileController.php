<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $admins = User::orderBy('id')->get();

        return view('admin.profile.edit', [
            'user' => $request->user(),
            'admins' => $admins,
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:150', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $validated['name'];
        $user->email = strtolower(trim($validated['email']));

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return back()->with('success', 'Admin account updated successfully.');
    }

    public function storeAdmin(Request $request)
    {
        $validated = $request->validateWithBag('createAdmin', [
            'admin_name' => ['required', 'string', 'max:120'],
            'admin_email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'admin_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => trim($validated['admin_name']),
            'email' => strtolower(trim($validated['admin_email'])),
            'password' => Hash::make($validated['admin_password']),
            'email_verified_at' => now(),
        ]);

        return back()->with('success', 'New admin user added successfully.');
    }

    public function destroyAdmin(Request $request, User $admin)
    {
        if ($admin->id === $request->user()->id) {
            return back()->withErrors(['admin' => 'You cannot delete your own currently logged-in account.']);
        }

        $admin->delete();

        return back()->with('success', 'Admin user removed.');
    }
}
