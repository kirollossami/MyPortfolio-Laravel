<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Initial Admin Setup | Portfolio CMS</title>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#07090e] text-slate-100 flex items-center justify-center p-4" style="font-family: 'Plus Jakarta Sans', sans-serif;">
  <div class="w-full max-w-md rounded-2xl bg-[#0d131f]/90 border border-white/10 p-8 shadow-2xl space-y-6">
    <div class="text-center space-y-2">
      <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-cyan-500 mx-auto flex items-center justify-center font-mono font-bold text-white text-lg shadow-lg shadow-emerald-500/25">
        <i class="bi bi-person-plus-fill"></i>
      </div>
      <h1 class="text-2xl font-extrabold text-white">Create First Admin</h1>
      <p class="text-xs font-mono text-emerald-400 uppercase tracking-wider">One-time dashboard setup (locks automatically after creation)</p>
    </div>

    @if(!empty($missingProductionKey))
      <div class="p-4 rounded-xl bg-amber-500/15 border border-amber-500/30 text-amber-200 text-xs space-y-2 leading-relaxed">
        <div class="font-semibold text-amber-300 flex items-center gap-2">
          <i class="bi bi-shield-lock"></i>
          <span>Setup Key Required in Production</span>
        </div>
        <p>Set <code class="px-1.5 py-0.5 rounded bg-black/40 text-amber-300 font-mono">ADMIN_SETUP_KEY</code> in your Railway environment variables and redeploy (or run <code class="px-1.5 py-0.5 rounded bg-black/40 text-amber-300 font-mono">php artisan admin:create</code>) before creating the first admin.</p>
      </div>
    @else
      @if($errors->any())
        <div class="p-3.5 rounded-xl bg-rose-500/15 border border-rose-500/30 text-rose-300 text-xs space-y-1">
          @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      @endif

      <form action="{{ route('admin.setup.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
          <label class="block text-xs font-mono uppercase text-slate-400 mb-1.5">Admin Name *</label>
          <input type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full px-4 py-2.5 rounded-xl bg-[#090d16] border border-white/15 text-white text-sm focus:outline-none focus:border-emerald-400" placeholder="Your Name">
        </div>

        <div>
          <label class="block text-xs font-mono uppercase text-slate-400 mb-1.5">Email Address *</label>
          <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2.5 rounded-xl bg-[#090d16] border border-white/15 text-white text-sm focus:outline-none focus:border-emerald-400" placeholder="you@example.com">
        </div>

        <div>
          <label class="block text-xs font-mono uppercase text-slate-400 mb-1.5">Password (Min 8 chars) *</label>
          <input type="password" name="password" required class="w-full px-4 py-2.5 rounded-xl bg-[#090d16] border border-white/15 text-white text-sm focus:outline-none focus:border-emerald-400" placeholder="••••••••">
        </div>

        <div>
          <label class="block text-xs font-mono uppercase text-slate-400 mb-1.5">Confirm Password *</label>
          <input type="password" name="password_confirmation" required class="w-full px-4 py-2.5 rounded-xl bg-[#090d16] border border-white/15 text-white text-sm focus:outline-none focus:border-emerald-400" placeholder="••••••••">
        </div>

        @if($requiresSetupKey)
          <div>
            <label class="block text-xs font-mono uppercase text-amber-400 mb-1.5">Setup Key (ADMIN_SETUP_KEY) *</label>
            <input type="password" name="setup_key" required class="w-full px-4 py-2.5 rounded-xl bg-[#090d16] border border-amber-500/30 text-white text-sm focus:outline-none focus:border-amber-400" placeholder="Enter environment setup key">
          </div>
        @endif

        <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-cyan-600 hover:brightness-110 font-semibold text-sm text-white shadow-lg shadow-emerald-600/25 transition-all flex items-center justify-center gap-2">
          <i class="bi bi-shield-check"></i>
          <span>Create Admin &amp; Open Dashboard</span>
        </button>
      </form>
    @endif

    <div class="pt-4 border-t border-white/10 text-center">
      <a href="{{ route('home') }}" class="text-xs font-mono text-slate-400 hover:text-sky-400 transition-colors">
        &larr; Back to Public Portfolio
      </a>
    </div>
  </div>
</body>
</html>

