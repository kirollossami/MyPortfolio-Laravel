@extends('admin.layouts.app')

@section('title', 'Admin Account')
@section('page_title', 'Admin Accounts & Security')
@section('page_subtitle', 'Update your credentials or add/manage other dashboard administrators.')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
  <!-- Update Own Profile -->
  <div class="panel-card p-6 space-y-4">
    <h2 class="text-base font-bold text-white border-b border-white/10 pb-3">My Admin Account</h2>
    <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-4">
      @csrf
      @method('PUT')

      <div>
        <label class="form-label">Admin Name *</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="form-input">
      </div>

      <div>
        <label class="form-label">Login Email *</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="form-input">
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-white/10">
        <div>
          <label class="form-label">New Password (optional)</label>
          <input type="password" name="password" class="form-input" placeholder="Min 8 characters">
        </div>
        <div>
          <label class="form-label">Confirm New Password</label>
          <input type="password" name="password_confirmation" class="form-input" placeholder="Repeat password">
        </div>
      </div>

      <div class="pt-2">
        <button type="submit" class="btn-primary">
          <i class="bi bi-shield-check"></i> Update My Account
        </button>
      </div>
    </form>
  </div>

  <!-- Add New Admin -->
  <div class="panel-card p-6 space-y-4">
    <h2 class="text-base font-bold text-white border-b border-white/10 pb-3">Add New Admin</h2>
    @if($errors->createAdmin->any())
      <div class="p-3 rounded-xl bg-rose-500/15 border border-rose-500/30 text-rose-200 text-xs space-y-1">
        @foreach($errors->createAdmin->all() as $err)
          <div>{{ $err }}</div>
        @endforeach
      </div>
    @endif

    <form action="{{ route('admin.admins.store') }}" method="POST" class="space-y-4">
      @csrf
      <div>
        <label class="form-label">Name *</label>
        <input type="text" name="admin_name" value="{{ old('admin_name') }}" required class="form-input" placeholder="New Admin Name">
      </div>
      <div>
        <label class="form-label">Email *</label>
        <input type="email" name="admin_email" value="{{ old('admin_email') }}" required class="form-input" placeholder="newadmin@example.com">
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label class="form-label">Password *</label>
          <input type="password" name="admin_password" required class="form-input" placeholder="Min 8 characters">
        </div>
        <div>
          <label class="form-label">Confirm Password *</label>
          <input type="password" name="admin_password_confirmation" required class="form-input" placeholder="Repeat password">
        </div>
      </div>
      <div class="pt-2">
        <button type="submit" class="btn-primary">
          <i class="bi bi-person-plus-fill"></i> Add Admin User
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Existing Admins List -->
<div class="panel-card overflow-hidden">
  <div class="px-6 py-4 border-b border-white/10 flex items-center justify-between">
    <h2 class="text-base font-bold text-white">Authorized Administrators ({{ $admins->count() }})</h2>
    <span class="text-xs font-mono text-slate-400">CLI: php artisan admin:create</span>
  </div>
  <div class="overflow-x-auto">
    <table class="w-full text-left text-sm">
      <thead class="bg-white/5 text-xs font-mono uppercase text-slate-400">
        <tr>
          <th class="px-5 py-3">Name</th>
          <th class="px-5 py-3">Email</th>
          <th class="px-5 py-3">Created</th>
          <th class="px-5 py-3 text-right">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-white/5">
        @foreach($admins as $admin)
          <tr>
            <td class="px-5 py-3 font-semibold text-white">
              {{ $admin->name }}
              @if($admin->id === $user->id)
                <span class="ml-2 px-2 py-0.5 rounded bg-sky-500/15 text-sky-300 font-mono text-[10px]">YOU</span>
              @endif
            </td>
            <td class="px-5 py-3 font-mono text-xs text-slate-300">{{ $admin->email }}</td>
            <td class="px-5 py-3 font-mono text-xs text-slate-400">{{ $admin->created_at?->format('Y-m-d') }}</td>
            <td class="px-5 py-3 text-right">
              @if($admin->id !== $user->id)
                <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" class="inline" onsubmit="return confirm('Remove this admin user?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-danger">Remove</button>
                </form>
              @else
                <span class="text-xs font-mono text-slate-500">Active Session</span>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
