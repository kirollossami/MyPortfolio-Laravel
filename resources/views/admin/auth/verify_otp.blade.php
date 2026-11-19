<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verify Security Code | Portfolio CMS</title>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#07090e] text-slate-100 flex items-center justify-center p-4" style="font-family: 'Plus Jakarta Sans', sans-serif;">
  <div class="w-full max-w-md rounded-2xl bg-[#0d131f]/90 border border-white/10 p-8 shadow-2xl space-y-6">
    <div class="text-center space-y-2">
      <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-cyan-500 to-blue-600 mx-auto flex items-center justify-center font-mono font-bold text-white text-lg shadow-lg shadow-cyan-500/30">
        <i class="bi bi-shield-check"></i>
      </div>
      <h1 class="text-2xl font-extrabold text-white">Enter Security Code</h1>
      <p class="text-xs font-mono text-cyan-400 uppercase tracking-wider">Step 2 of 3: Verify 6-Digit OTP</p>
    </div>

    <div class="p-3.5 rounded-xl bg-slate-800/50 border border-white/10 text-xs text-slate-300 space-y-1 text-center">
      <div>We sent a 6-digit verification code to:</div>
      <div class="font-mono font-bold text-cyan-300 break-all">{{ $email }}</div>
      <div class="text-[11px] text-slate-400 font-mono pt-1">Code is valid for 15 minutes</div>
    </div>

    @if(session('status'))
      <div class="p-3.5 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-xs">
        {{ session('status') }}
      </div>
    @endif

    @if($errors->any())
      <div class="p-3.5 rounded-xl bg-rose-500/15 border border-rose-500/30 text-rose-300 text-xs">
        {{ $errors->first() }}
      </div>
    @endif

    <form action="{{ route('admin.password.verify') }}" method="POST" class="space-y-4">
      @csrf
      <input type="hidden" name="email" value="{{ $email }}">

      <div>
        <label class="block text-xs font-mono uppercase text-slate-400 mb-1.5 text-center">
          6-Digit Verification Code
        </label>
        <input 
          type="text" 
          name="otp" 
          maxlength="6" 
          pattern="[0-9]{6}" 
          inputmode="numeric" 
          autocomplete="one-time-code" 
          required 
          autofocus 
          class="w-full py-3 px-4 rounded-xl bg-[#090d16] border border-cyan-500/40 text-cyan-300 text-2xl font-mono font-bold text-center tracking-[0.4em] focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-500/20" 
          placeholder="••••••"
        >
      </div>

      <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-cyan-600 to-blue-600 hover:brightness-110 font-semibold text-sm text-white shadow-lg shadow-cyan-600/25 transition-all flex items-center justify-center gap-2">
        <i class="bi bi-check2-circle text-base"></i>
        <span>Verify Code &amp; Continue</span>
      </button>
    </form>

    <div class="flex items-center justify-between pt-2">
      <form action="{{ route('admin.password.resend') }}" method="POST">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <button type="submit" class="text-xs font-mono text-cyan-400 hover:text-cyan-300 transition-colors flex items-center gap-1.5 bg-transparent border-0 p-0 cursor-pointer">
          <i class="bi bi-arrow-repeat"></i>
          <span>Resend Code</span>
        </button>
      </form>

      <a href="{{ route('admin.password.request') }}" class="text-xs font-mono text-slate-400 hover:text-white transition-colors">
        Change Email
      </a>
    </div>

    <div class="pt-4 border-t border-white/10 text-center">
      <a href="{{ route('login') }}" class="text-xs font-mono text-slate-400 hover:text-sky-400 transition-colors inline-flex items-center gap-1">
        <i class="bi bi-arrow-left"></i>
        <span>Cancel &amp; Back to Login</span>
      </a>
    </div>
  </div>
</body>
</html>
