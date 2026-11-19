<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Set New Password | Portfolio CMS</title>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#07090e] text-slate-100 flex items-center justify-center p-4" style="font-family: 'Plus Jakarta Sans', sans-serif;">
  <div class="w-full max-w-md rounded-2xl bg-[#0d131f]/90 border border-white/10 p-8 shadow-2xl space-y-6">
    <div class="text-center space-y-2">
      <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-cyan-500 mx-auto flex items-center justify-center font-mono font-bold text-white text-lg shadow-lg shadow-emerald-500/30">
        <i class="bi bi-lock-fill"></i>
      </div>
      <h1 class="text-2xl font-extrabold text-white">Create New Password</h1>
      <p class="text-xs font-mono text-emerald-400 uppercase tracking-wider">Step 3 of 3: Secure Your Account</p>
    </div>

    <div class="p-3.5 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-xs text-emerald-300 space-y-1 text-center">
      <div class="flex items-center justify-center gap-1.5 font-medium">
        <i class="bi bi-shield-check"></i>
        <span>Identity Verified</span>
      </div>
      <div class="font-mono text-slate-300 break-all">{{ $email }}</div>
    </div>

    @if(session('status'))
      <div class="p-3.5 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-xs">
        {{ session('status') }}
      </div>
    @endif

    @if($errors->any())
      <div class="p-3.5 rounded-xl bg-rose-500/15 border border-rose-500/30 text-rose-300 text-xs space-y-1">
        @foreach($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif

    <form action="{{ route('admin.password.update') }}" method="POST" class="space-y-4">
      @csrf
      <input type="hidden" name="email" value="{{ $email }}">

      @if(empty($isVerified))
        <div>
          <label class="block text-xs font-mono uppercase text-slate-400 mb-1.5">6-Digit Verification Code *</label>
          <input type="text" name="otp" maxlength="6" required class="w-full px-4 py-2.5 rounded-xl bg-[#090d16] border border-white/15 text-white text-sm font-mono tracking-widest focus:outline-none focus:border-emerald-400" placeholder="123456">
        </div>
      @endif

      <div>
        <label class="block text-xs font-mono uppercase text-slate-400 mb-1.5">New Password (Min 8 chars) *</label>
        <div class="relative">
          <input type="password" name="password" required autofocus class="w-full px-4 py-2.5 rounded-xl bg-[#090d16] border border-white/15 text-white text-sm focus:outline-none focus:border-emerald-400 pl-10" placeholder="••••••••">
          <i class="bi bi-lock text-slate-500 absolute left-3.5 top-3 text-sm"></i>
        </div>
      </div>

      <div>
        <label class="block text-xs font-mono uppercase text-slate-400 mb-1.5">Confirm New Password *</label>
        <div class="relative">
          <input type="password" name="password_confirmation" required class="w-full px-4 py-2.5 rounded-xl bg-[#090d16] border border-white/15 text-white text-sm focus:outline-none focus:border-emerald-400 pl-10" placeholder="••••••••">
          <i class="bi bi-shield-check text-slate-500 absolute left-3.5 top-3 text-sm"></i>
        </div>
      </div>

      <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-cyan-600 hover:brightness-110 font-semibold text-sm text-white shadow-lg shadow-emerald-600/25 transition-all flex items-center justify-center gap-2">
        <i class="bi bi-save-fill text-xs"></i>
        <span>Update Password &amp; Sign In</span>
      </button>
    </form>

    <div class="pt-4 border-t border-white/10 text-center">
      <a href="{{ route('login') }}" class="text-xs font-mono text-slate-400 hover:text-sky-400 transition-colors inline-flex items-center gap-1">
        <i class="bi bi-arrow-left"></i>
        <span>Cancel &amp; Back to Login</span>
      </a>
    </div>
  </div>
</body>
</html>
