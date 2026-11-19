<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login | Portfolio CMS</title>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#07090e] text-slate-100 flex items-center justify-center p-4" style="font-family: 'Plus Jakarta Sans', sans-serif;">
  <div class="w-full max-w-md rounded-2xl bg-[#0d131f]/90 border border-white/10 p-8 shadow-2xl space-y-6">
    <div class="text-center space-y-2">
      <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-600 to-sky-400 mx-auto flex items-center justify-center font-mono font-bold text-white text-lg shadow-lg shadow-blue-600/30">
        KS
      </div>
      <h1 class="text-2xl font-extrabold text-white">Portfolio Admin CMS</h1>
      <p class="text-xs font-mono text-sky-400 uppercase tracking-wider">Sign in to manage dynamic frontend</p>
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

    <form action="{{ route('login.attempt') }}" method="POST" class="space-y-4">
      @csrf
      <div>
        <label class="block text-xs font-mono uppercase text-slate-400 mb-1.5">Email Address</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-2.5 rounded-xl bg-[#090d16] border border-white/15 text-white text-sm focus:outline-none focus:border-sky-400" placeholder="you@example.com">
      </div>

      <div>
        <div class="flex items-center justify-between mb-1.5">
          <label class="block text-xs font-mono uppercase text-slate-400">Password</label>
          <a href="{{ route('admin.password.request') }}" class="text-xs font-mono text-sky-400 hover:text-sky-300 transition-colors">
            Forgot password?
          </a>
        </div>
        <input type="password" name="password" required class="w-full px-4 py-2.5 rounded-xl bg-[#090d16] border border-white/15 text-white text-sm focus:outline-none focus:border-sky-400" placeholder="••••••••">
      </div>

      <label class="flex items-center gap-2 text-xs text-slate-400 cursor-pointer">
        <input type="checkbox" name="remember" class="rounded bg-[#090d16] border-white/20 text-blue-600">
        <span>Keep me signed in</span>
      </label>

      <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-blue-600 to-sky-500 hover:brightness-110 font-semibold text-sm text-white shadow-lg shadow-blue-600/25 transition-all flex items-center justify-center gap-2">
        <i class="bi bi-shield-lock-fill"></i>
        <span>Access Dashboard</span>
      </button>
    </form>

    <div class="pt-4 border-t border-white/10 text-center">
      <a href="{{ route('home') }}" class="text-xs font-mono text-slate-400 hover:text-sky-400 transition-colors">
        &larr; Back to Public Portfolio
      </a>
    </div>
  </div>
</body>
</html>

