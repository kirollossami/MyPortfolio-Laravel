<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin Dashboard') | Portfolio CMS</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
            mono: ['"JetBrains Mono"', 'monospace'],
          }
        }
      }
    }
  </script>
  <style>
    body { background: #07090e; color: #f8fafc; font-family: 'Plus Jakarta Sans', sans-serif; }
    .panel-card { background: rgba(13, 19, 31, 0.82); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; backdrop-filter: blur(16px); }
    .form-input { width: 100%; background: rgba(9, 13, 22, 0.9); border: 1px solid rgba(255,255,255,0.12); color: #f8fafc; border-radius: 10px; padding: 0.65rem 0.9rem; font-size: 0.875rem; transition: border-color 0.2s, box-shadow 0.2s; }
    .form-input:focus { outline: none; border-color: #38bdf8; box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15); }
    .form-label { display: block; font-size: 0.75rem; font-family: 'JetBrains Mono', monospace; text-transform: uppercase; letter-spacing: 0.05em; color: #94a3b8; margin-bottom: 0.4rem; }
    .btn-primary { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.65rem 1.25rem; font-size: 0.85rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #1d4ed8, #0284c7); border-radius: 10px; border: 1px solid rgba(255,255,255,0.15); transition: all 0.2s; }
    .btn-primary:hover { filter: brightness(1.1); transform: translateY(-1px); }
    .btn-secondary { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.6rem 1.1rem; font-size: 0.85rem; font-weight: 600; color: #e2e8f0; background: rgba(255,255,255,0.05); border-radius: 10px; border: 1px solid rgba(255,255,255,0.1); transition: all 0.2s; }
    .btn-secondary:hover { background: rgba(255,255,255,0.1); color: #fff; }
    .btn-danger { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.45rem 0.85rem; font-size: 0.78rem; font-weight: 600; color: #fda4af; background: rgba(244,63,94,0.12); border-radius: 8px; border: 1px solid rgba(244,63,94,0.25); transition: all 0.2s; }
    .btn-danger:hover { background: rgba(244,63,94,0.22); color: #fff; }
  </style>
</head>
<body class="min-h-screen flex flex-col lg:flex-row">
  @php
    $unreadInboxCount = \App\Models\ContactMessage::where('is_read', false)->count();
    $navItems = [
      ['route' => 'admin.dashboard', 'match' => 'admin.dashboard', 'icon' => 'bi-speedometer2', 'label' => 'Overview'],
      ['route' => 'admin.settings.edit', 'match' => 'admin.settings.*', 'icon' => 'bi-sliders', 'label' => 'Site & Hero Settings'],
      ['route' => 'admin.tech-stacks.index', 'match' => 'admin.tech-stacks.*', 'icon' => 'bi-cpu', 'label' => 'Core Tech Stack'],
      ['route' => 'admin.pillars.index', 'match' => 'admin.pillars.*', 'icon' => 'bi-diagram-3', 'label' => 'Architecture Pillars'],
      ['route' => 'admin.projects.index', 'match' => 'admin.projects.*', 'icon' => 'bi-kanban', 'label' => 'Projects'],
      ['route' => 'admin.certificates.index', 'match' => 'admin.certificates.*', 'icon' => 'bi-patch-check', 'label' => 'Certificates'],
      ['route' => 'admin.testimonials.index', 'match' => 'admin.testimonials.*', 'icon' => 'bi-chat-quote', 'label' => 'Testimonials'],
      ['route' => 'admin.kirobot.index', 'match' => 'admin.kirobot.*', 'icon' => 'bi-robot', 'label' => 'KiroBot Knowledge'],
      ['route' => 'admin.messages.index', 'match' => 'admin.messages.*', 'icon' => 'bi-inbox', 'label' => 'Inbox Messages', 'badge' => $unreadInboxCount],
      ['route' => 'admin.profile.edit', 'match' => 'admin.profile.*', 'icon' => 'bi-person-gear', 'label' => 'Admin Account'],
    ];
  @endphp

  <!-- Mobile Topbar -->
  <header class="lg:hidden flex items-center justify-between px-4 py-3 border-b border-white/10 bg-[#090d16] sticky top-0 z-40">
    <div class="flex items-center gap-2.5">
      <span class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-cyan-500 flex items-center justify-center font-mono text-xs font-bold">KS</span>
      <span class="font-bold text-sm">Portfolio MVC CMS</span>
    </div>
    <button type="button" onclick="document.getElementById('adminSidebar').classList.toggle('-translate-x-full')" class="p-2 rounded-lg bg-white/5 border border-white/10">
      <i class="bi bi-list text-xl"></i>
    </button>
  </header>

  <!-- Sidebar -->
  <aside id="adminSidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-72 bg-[#090d16] border-r border-white/10 flex flex-col justify-between transform -translate-x-full lg:translate-x-0 transition-transform duration-200">
    <div class="p-5 space-y-6 overflow-y-auto">
      <div class="flex items-center justify-between">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-sky-400 flex items-center justify-center font-mono font-bold text-white shadow-lg shadow-blue-600/25">
            KS
          </div>
          <div>
            <div class="font-bold text-sm text-white leading-tight">Portfolio CMS</div>
            <div class="font-mono text-[10px] text-sky-400 uppercase tracking-wider">Laravel MVC Admin</div>
          </div>
        </a>
        <button type="button" onclick="document.getElementById('adminSidebar').classList.add('-translate-x-full')" class="lg:hidden text-slate-400 hover:text-white">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>

      <nav class="space-y-1">
        @foreach($navItems as $item)
          @php $active = request()->routeIs($item['match']); @endphp
          <a href="{{ route($item['route']) }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ $active ? 'bg-blue-600/20 text-sky-300 border border-blue-500/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
            <span class="flex items-center gap-3">
              <i class="bi {{ $item['icon'] }} text-base"></i>
              <span>{{ $item['label'] }}</span>
            </span>
            @if(!empty($item['badge']))
              <span class="px-2 py-0.5 rounded-full bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 font-mono text-[11px] font-bold">{{ $item['badge'] }}</span>
            @endif
          </a>
        @endforeach
      </nav>
    </div>

    <div class="p-4 border-t border-white/10 space-y-2.5 bg-[#07090e]/60">
      <a href="{{ route('home') }}" target="_blank" class="btn-secondary w-full justify-center !text-xs">
        <i class="bi bi-box-arrow-up-right text-sky-400"></i>
        <span>View Live Frontend</span>
      </a>
      <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-danger w-full justify-center !py-2">
          <i class="bi bi-box-arrow-right"></i>
          <span>Sign Out ({{ auth()->user()->name ?? 'Admin' }})</span>
        </button>
      </form>
    </div>
  </aside>

  <!-- Main Workspace -->
  <div class="flex-1 min-w-0 flex flex-col">
    <div class="border-b border-white/10 bg-[#090d16]/70 px-6 py-4 flex flex-wrap items-center justify-between gap-4">
      <div>
        <h1 class="text-xl font-bold text-white">@yield('page_title', 'Dashboard')</h1>
        @hasSection('page_subtitle')
          <p class="text-xs text-slate-400 mt-0.5">@yield('page_subtitle')</p>
        @endif
      </div>
      <div class="flex items-center gap-3">
        @yield('header_actions')
      </div>
    </div>

    <main class="p-6 max-w-7xl w-full mx-auto space-y-6 flex-1">
      @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-sm flex items-center gap-2.5">
          <i class="bi bi-check-circle-fill text-lg"></i>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      @if($errors->any())
        <div class="p-4 rounded-xl bg-rose-500/15 border border-rose-500/30 text-rose-200 text-sm space-y-1">
          <div class="font-semibold flex items-center gap-2">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <span>Please fix the following errors:</span>
          </div>
          <ul class="list-disc list-inside text-xs space-y-0.5 text-rose-300">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @yield('content')
    </main>
  </div>
</body>
</html>

