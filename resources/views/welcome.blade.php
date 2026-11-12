@php
  use App\Services\MediaService;
  $s = fn (string $key, string $default = '') => $settings[$key] ?? $default;
  $brandName = $s('brand_name', 'Kirollos Samy');
  $brandFullName = $s('brand_full_name', 'Kirollos Samy Ishaq');
  $brandSubtitle = $s('brand_subtitle', '.NET & LARAVEL SPECIALIST');
  $navLogoUrl = MediaService::url($s('nav_logo_path', 'assets/img/profile/kirollos_nav_logo.png'));
  $faviconUrl = MediaService::url($s('favicon_path', 'assets/img/favicon.png'));
  $heroImageUrl = MediaService::url($s('hero_image_path', 'assets/img/profile/KirollosSamy.png'));
  $contactEmail = $s('contact_email', 'kerollossami@gmail.com');
  $whatsappUrl = $s('whatsapp_url', 'https://wa.me/message/HEKWNGDE4LGHK1?src=qr');
  $linkedinUrl = $s('linkedin_url', 'https://www.linkedin.com/in/kirollossamy');
  $githubUrl = $s('github_url', 'https://github.com/kirollossami');
  $isAvailable = ($s('is_available', '1') === '1');
@endphp
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=5.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $s('site_title', 'Kirollos Samy Ishaq | Full-Stack Developer & Backend Engineer (.NET Core & Laravel)') }}</title>
  
  <!-- SEO & Social Meta Tags -->
  <meta name="description" content="{{ $s('meta_description') }}">
  <meta name="keywords" content="{{ $s('meta_keywords') }}">
  <meta name="author" content="{{ $s('meta_author', $brandFullName) }}">
  <meta name="robots" content="index, follow">
  
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ $s('og_url', url('/')) }}">
  <meta property="og:title" content="{{ $s('site_title') }}">
  <meta property="og:description" content="{{ $s('meta_description') }}">
  <meta property="og:image" content="{{ $heroImageUrl }}">

  <!-- Favicon & App Icons -->
  <link rel="icon" type="image/png" sizes="64x64" href="{{ $faviconUrl }}?v=2">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ $faviconUrl }}?v=2">
  <link rel="shortcut icon" href="{{ $faviconUrl }}?v=2">

  <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

  <!-- Bootstrap Icons CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Tailwind CSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            brandDark: '#07090e',
            brandCanvas: 'var(--bg-canvas)',
            brandCard: 'var(--bg-card)',
            brandBorder: 'var(--border-subtle)',
            brandSapphire: '#2563eb',
            brandSky: '#0284c7',
            brandEmerald: '#10b981',
            brandAmber: '#f59e0b',
          },
          fontFamily: {
            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
            mono: ['"JetBrains Mono"', 'monospace'],
          }
        }
      }
    }
  </script>

  <!-- Immediate Theme Initialization Script (Prevents FOUC) -->
  <script>
    (function () {
      try {
        const stored = localStorage.getItem('ks_portfolio_theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const theme = stored ? stored : (prefersDark ? 'dark' : 'light');
        if (theme === 'light') {
          document.documentElement.classList.add('light');
          document.documentElement.classList.remove('dark');
          document.documentElement.setAttribute('data-theme', 'light');
        } else {
          document.documentElement.classList.add('dark');
          document.documentElement.classList.remove('light');
          document.documentElement.setAttribute('data-theme', 'dark');
        }
      } catch (e) {}
    })();
  </script>

  <!-- 4K Architecture & Light/Dark Mode Custom Design System -->
  <style>
    :root, html.dark, [data-theme="dark"] {
      --bg-base: #07090e;
      --bg-canvas: #090d16;
      --bg-card: rgba(13, 19, 31, 0.72);
      --bg-card-hover: rgba(18, 27, 44, 0.88);
      --bg-card-elevated: #0f172a;
      --bg-nav: rgba(9, 13, 22, 0.85);

      --text-primary: #f8fafc;
      --text-secondary: #94a3b8;
      --text-muted: #64748b;
      --text-inverse: #07090e;

      --border-subtle: rgba(255, 255, 255, 0.08);
      --border-medium: rgba(255, 255, 255, 0.16);
      --border-glow: rgba(37, 99, 235, 0.4);

      /* Bespoke Engineering Palette */
      --accent-sapphire: #2563eb;
      --accent-cobalt: #1d4ed8;
      --accent-sky: #0284c7;
      --accent-ice: #38bdf8;
      --accent-emerald: #10b981;
      --accent-gold: #f59e0b;

      --pill-bg: rgba(255, 255, 255, 0.05);
      --pill-border: rgba(255, 255, 255, 0.1);
      --input-bg: rgba(10, 15, 26, 0.85);

      --modal-backdrop: rgba(4, 7, 13, 0.88);
      --glass-blur: blur(20px);
      --glass-shadow: 0 20px 45px -15px rgba(0, 0, 0, 0.8), 0 0 0 1px var(--border-subtle) inset;
      --card-shadow-hover: 0 20px 45px -12px rgba(37, 99, 235, 0.25);
      --transition-smooth: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    html.light, [data-theme="light"] {
      --bg-base: #f8fafc;
      --bg-canvas: #f1f5f9;
      --bg-card: rgba(255, 255, 255, 0.88);
      --bg-card-hover: #ffffff;
      --bg-card-elevated: #ffffff;
      --bg-nav: rgba(255, 255, 255, 0.88);

      --text-primary: #0f172a;
      --text-secondary: #334155;
      --text-muted: #64748b;
      --text-inverse: #ffffff;

      --border-subtle: rgba(15, 23, 42, 0.09);
      --border-medium: rgba(15, 23, 42, 0.18);
      --border-glow: rgba(37, 99, 235, 0.28);

      --accent-sapphire: #1d4ed8;
      --accent-cobalt: #1e40af;
      --accent-sky: #0284c7;
      --accent-ice: #0369a1;
      --accent-emerald: #059669;
      --accent-gold: #d97706;

      --pill-bg: rgba(15, 23, 42, 0.04);
      --pill-border: rgba(15, 23, 42, 0.09);
      --input-bg: rgba(248, 250, 252, 0.95);

      --modal-backdrop: rgba(15, 23, 42, 0.65);
      --glass-blur: blur(20px);
      --glass-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.07), 0 0 0 1px var(--border-subtle) inset;
      --card-shadow-hover: 0 20px 40px -12px rgba(29, 78, 216, 0.14);
      --transition-smooth: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    body {
      background-color: var(--bg-canvas);
      color: var(--text-primary);
      font-family: 'Plus Jakarta Sans', sans-serif;
      overflow-x: hidden;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    h1, h2, h3, h4, h5, h6 {
      color: var(--text-primary);
      letter-spacing: -0.025em;
    }

    p {
      color: var(--text-secondary);
    }

    /* Ambient Background Mesh */
    .cyber-bg-mesh {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      z-index: -2;
      pointer-events: none;
      background-color: var(--bg-canvas);
      transition: background-color 0.3s ease;
    }

    html.dark .cyber-bg-mesh {
      background-image: 
        radial-gradient(circle at 18% 18%, rgba(37, 99, 235, 0.12) 0%, transparent 45%),
        radial-gradient(circle at 82% 22%, rgba(2, 132, 199, 0.09) 0%, transparent 40%),
        radial-gradient(circle at 50% 80%, rgba(16, 185, 129, 0.06) 0%, transparent 50%),
        linear-gradient(to right, rgba(255, 255, 255, 0.015) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(255, 255, 255, 0.015) 1px, transparent 1px);
      background-size: 100% 100%, 100% 100%, 100% 100%, 64px 64px, 64px 64px;
    }

    html.light .cyber-bg-mesh {
      background-image: 
        radial-gradient(circle at 18% 18%, rgba(37, 99, 235, 0.06) 0%, transparent 45%),
        radial-gradient(circle at 82% 22%, rgba(2, 132, 199, 0.05) 0%, transparent 40%),
        radial-gradient(circle at 50% 80%, rgba(16, 185, 129, 0.04) 0%, transparent 50%),
        linear-gradient(to right, rgba(15, 23, 42, 0.025) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(15, 23, 42, 0.025) 1px, transparent 1px);
      background-size: 100% 100%, 100% 100%, 100% 100%, 64px 64px, 64px 64px;
    }

    /* Interactive Cursor Spotlight */
    .cursor-spotlight {
      position: fixed;
      top: 0;
      left: 0;
      width: 700px;
      height: 700px;
      border-radius: 50%;
      pointer-events: none;
      background: radial-gradient(circle, rgba(37, 99, 235, 0.08) 0%, rgba(2, 132, 199, 0.03) 45%, transparent 70%);
      transform: translate(-50%, -50%);
      z-index: -1;
      will-change: transform;
    }

    /* Glass Cards */
    .glass-card {
      background: var(--bg-card);
      backdrop-filter: var(--glass-blur);
      -webkit-backdrop-filter: var(--glass-blur);
      border: 1px solid var(--border-subtle);
      border-radius: 16px;
      box-shadow: var(--glass-shadow);
      transition: var(--transition-smooth);
      position: relative;
    }

    .glass-card:hover {
      background: var(--bg-card-hover);
      border-color: var(--border-glow);
      box-shadow: var(--card-shadow-hover);
      transform: translateY(-3px);
    }

    /* Light Theme Typography & Micro-Utility Adaptors */
    html.light .text-white {
      color: #0f172a !important;
    }
    html.light .text-slate-100,
    html.light .text-slate-200 {
      color: #1e293b !important;
    }
    html.light .text-slate-300 {
      color: #334155 !important;
    }
    html.light .text-slate-400 {
      color: #475569 !important;
    }
    html.light .text-slate-500 {
      color: #64748b !important;
    }
    html.light .border-white\/5,
    html.light .border-white\/10,
    html.light .border-white\/15,
    html.light .border-white\/20 {
      border-color: var(--border-subtle) !important;
    }
    html.light .bg-white\/5 {
      background-color: var(--pill-bg) !important;
    }
    html.light .bg-white\/10 {
      background-color: var(--pill-border) !important;
    }
    html.light .bg-slate-950\/70,
    html.light .bg-slate-950\/80,
    html.light .bg-slate-950\/90,
    html.light .bg-slate-900\/90,
    html.light .bg-slate-900 {
      background-color: var(--input-bg) !important;
    }
    html.light .bg-cyberDark {
      background-color: var(--bg-canvas) !important;
    }
    html.light footer {
      background-color: #f1f5f9 !important;
      border-color: var(--border-subtle) !important;
    }
    html.light input,
    html.light textarea,
    html.light select {
      background-color: #ffffff !important;
      color: #0f172a !important;
      border-color: rgba(15, 23, 42, 0.16) !important;
    }
    html.light input:focus,
    html.light textarea:focus,
    html.light select:focus {
      border-color: #2563eb !important;
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12) !important;
    }
    html.light input::placeholder,
    html.light textarea::placeholder {
      color: #94a3b8 !important;
    }
    html.light #projectDetailModal > div,
    html.light #certificateLightboxModal > div {
      background: #ffffff !important;
      border-color: rgba(15, 23, 42, 0.12) !important;
      box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.2) !important;
    }
    html.light .kirobot-speech-bubble {
      background: #ffffff !important;
      color: #0f172a !important;
      border-color: rgba(37, 99, 235, 0.3) !important;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12) !important;
    }
    html.light #kiroBotSpeechText {
      color: #1e293b !important;
    }
    html.light .kirobot-avatar-button {
      background: #ffffff !important;
      border-color: #2563eb !important;
      box-shadow: 0 10px 25px rgba(37, 99, 235, 0.25) !important;
    }
    html.light .text-cyan-300,
    html.light .text-cyan-400 {
      color: #0284c7 !important;
    }
    html.light .text-sky-300,
    html.light .text-sky-400 {
      color: #0369a1 !important;
    }
    html.light .text-emerald-300,
    html.light .text-emerald-400 {
      color: #047857 !important;
    }
    html.light .text-indigo-300,
    html.light .text-indigo-400 {
      color: #4338ca !important;
    }
    html.light .text-purple-300,
    html.light .text-purple-400 {
      color: #6d28d9 !important;
    }
    html.light .text-blue-300,
    html.light .text-blue-400 {
      color: #1d4ed8 !important;
    }
    html.light .text-yellow-400,
    html.light .text-amber-300,
    html.light .text-amber-400 {
      color: #b45309 !important;
    }
    html.light .text-rose-300,
    html.light .text-rose-400 {
      color: #be123c !important;
    }
    html.light .bg-black\/80 {
      background-color: rgba(255, 255, 255, 0.95) !important;
      color: #0f172a !important;
      border-color: rgba(15, 23, 42, 0.12) !important;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08) !important;
    }

    /* Buttons */
    .btn-cyber-primary {
      display: inline-flex;
      align-items: center;
      gap: 0.65rem;
      padding: 0.8rem 1.75rem;
      font-size: 0.925rem;
      font-weight: 600;
      color: #ffffff !important;
      background: linear-gradient(135deg, var(--accent-cobalt) 0%, var(--accent-sky) 100%);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(37, 99, 235, 0.35);
      transition: var(--transition-smooth);
    }

    .btn-cyber-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 28px rgba(37, 99, 235, 0.5);
      filter: brightness(1.08);
      color: #ffffff !important;
    }

    .btn-cyber-outline {
      display: inline-flex;
      align-items: center;
      gap: 0.65rem;
      padding: 0.8rem 1.75rem;
      font-size: 0.925rem;
      font-weight: 600;
      color: var(--text-primary);
      background: var(--pill-bg);
      backdrop-filter: var(--glass-blur);
      -webkit-backdrop-filter: var(--glass-blur);
      border: 1px solid var(--border-subtle);
      border-radius: 10px;
      transition: var(--transition-smooth);
    }

    .btn-cyber-outline:hover {
      background: var(--pill-border);
      border-color: var(--accent-sapphire);
      color: var(--accent-sapphire);
      transform: translateY(-2px);
    }

    /* Floating Navbar */
    .floating-nav {
      position: fixed;
      top: 1rem;
      left: 50%;
      transform: translateX(-50%);
      width: 94%;
      max-width: 1400px;
      height: 68px;
      background: var(--bg-nav);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid var(--border-subtle);
      border-radius: 16px;
      z-index: 1000;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 1.25rem;
      box-shadow: var(--glass-shadow);
      transition: background 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
    }

    @media (min-width: 640px) {
      .floating-nav {
        padding: 0 1.75rem;
        height: 72px;
        top: 1.25rem;
      }
    }

    /* Theme Toggle Button */
    .theme-toggle-btn {
      width: 38px;
      height: 38px;
      border-radius: 10px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: var(--pill-bg);
      border: 1px solid var(--border-subtle);
      color: var(--text-primary);
      cursor: pointer;
      font-size: 1.05rem;
      transition: var(--transition-smooth);
    }

    .theme-toggle-btn:hover {
      background: var(--pill-border);
      border-color: var(--accent-sapphire);
      color: var(--accent-sapphire);
      transform: rotate(15deg) scale(1.05);
    }

    /* Mobile Nav Toggle Button */
    .mobile-nav-toggle-btn {
      width: 38px;
      height: 38px;
      border-radius: 10px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: var(--pill-bg);
      border: 1px solid var(--border-subtle);
      color: var(--text-primary);
      cursor: pointer;
      transition: var(--transition-smooth);
    }

    .mobile-nav-toggle-btn:hover {
      background: var(--pill-border);
      color: var(--accent-sapphire);
    }

    /* Mobile Drawer */
    .mobile-drawer-backdrop {
      background: var(--modal-backdrop);
    }
    .mobile-drawer-panel {
      background: var(--bg-card-elevated);
      border-color: var(--border-subtle);
      color: var(--text-primary);
    }

    /* Project Filters & Modal Transitions */
    .project-filter-btn {
      background: var(--pill-bg);
      color: var(--text-secondary);
      border: 1px solid var(--border-subtle);
      cursor: pointer;
      white-space: nowrap;
    }
    .project-filter-btn:hover {
      background: var(--pill-border);
      color: var(--text-primary);
      border-color: var(--accent-sky);
      transform: translateY(-1px);
    }
    .project-filter-btn.active-filter {
      background: linear-gradient(135deg, var(--accent-cobalt) 0%, var(--accent-sky) 100%);
      color: #ffffff !important;
      border-color: var(--accent-sapphire);
      box-shadow: 0 0 18px rgba(37, 99, 235, 0.35);
      font-weight: 700;
    }
    .page-pill-btn {
      min-width: 38px;
      height: 38px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
      font-family: 'JetBrains Mono', monospace;
      font-size: 0.85rem;
      font-weight: 600;
      transition: var(--transition-smooth);
    }
    .page-pill-btn.active-page {
      background: var(--accent-sapphire);
      color: #ffffff !important;
      font-weight: 800;
      box-shadow: 0 0 18px rgba(37, 99, 235, 0.45);
      border: 1px solid rgba(255, 255, 255, 0.3);
    }
    .page-pill-btn:not(.active-page) {
      background: var(--pill-bg);
      color: var(--text-secondary);
      border: 1px solid var(--border-subtle);
    }
    .page-pill-btn:not(.active-page):hover {
      background: var(--pill-border);
      color: var(--text-primary);
      border-color: var(--accent-sapphire);
    }

    /* Text Selection Highlight Tooltip */
    ::selection {
      background: rgba(37, 99, 235, 0.35);
      color: #ffffff;
    }

    /* KiroBot Floating Companion Styles */
    .kirobot-container {
      position: fixed;
      bottom: 1.5rem;
      z-index: 9999;
      width: 64px;
      height: 64px;
      pointer-events: none;
      touch-action: none;
      transition: left 0.9s cubic-bezier(0.25, 1, 0.5, 1);
    }

    @media (max-width: 640px) {
      .kirobot-container {
        bottom: 1rem;
      }
    }

    .kirobot-speech-bubble {
      position: absolute;
      bottom: calc(100% + 14px);
      pointer-events: auto;
      width: min(380px, calc(100vw - 28px));
      background: var(--bg-card-elevated);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid var(--border-glow);
      border-radius: 16px;
      padding: 1.25rem;
      box-shadow: var(--glass-shadow);
      transition: opacity 0.35s cubic-bezier(0.16, 1, 0.3, 1), transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
      color: var(--text-primary);
    }

    .kirobot-container.dock-left .kirobot-speech-bubble {
      left: 0;
      right: auto;
      transform-origin: bottom left;
    }

    .kirobot-container.dock-right .kirobot-speech-bubble {
      right: 0;
      left: auto;
      transform-origin: bottom right;
    }

    .kirobot-speech-bubble.hidden-bubble {
      opacity: 0;
      transform: scale(0.85) translateY(15px);
      pointer-events: none;
    }

    .kirobot-avatar-button {
      pointer-events: auto;
      width: 64px;
      height: 64px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--bg-card-elevated) 0%, var(--bg-canvas) 100%);
      border: 2px solid var(--accent-sky);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4), 0 0 20px rgba(2, 132, 199, 0.3);
      cursor: grab;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), border-color 0.3s ease, box-shadow 0.3s ease;
      animation: kirobot-hover 4s ease-in-out infinite alternate;
      user-select: none;
      -webkit-user-select: none;
    }

    .kirobot-avatar-button:active {
      cursor: grabbing;
      transform: scale(0.95);
    }

    .kirobot-avatar-button.moving-left svg {
      transform: scaleX(-1);
      transition: transform 0.3s ease;
    }
    .kirobot-avatar-button.moving-right svg {
      transform: scaleX(1);
      transition: transform 0.3s ease;
    }

    .kirobot-avatar-button:hover {
      transform: scale(1.1) rotate(5deg);
      border-color: var(--accent-sapphire);
      box-shadow: 0 12px 35px rgba(0, 0, 0, 0.5), 0 0 25px rgba(37, 99, 235, 0.5);
    }

    /* Momentary Cyber Highlight for Clicked / Inspected Elements */
    .kiro-inspect-highlight {
      outline: 2px solid var(--accent-sky) !important;
      outline-offset: 4px !important;
      box-shadow: 0 0 30px rgba(2, 132, 199, 0.5) !important;
      transition: outline 0.25s ease, box-shadow 0.25s ease !important;
    }

    @keyframes kirobot-hover {
      0% { transform: translateY(0); }
      100% { transform: translateY(-8px); }
    }

    /* Soundwave bars */
    .soundwaves {
      display: inline-flex;
      align-items: flex-end;
      gap: 2px;
      height: 12px;
    }
    .soundwaves span {
      width: 2px;
      height: 100%;
      background: var(--accent-sky);
      border-radius: 1px;
      animation: sound-bounce 1s infinite alternate;
    }
    .soundwaves span:nth-child(2) { animation-delay: 0.2s; height: 60%; }
    .soundwaves span:nth-child(3) { animation-delay: 0.4s; height: 85%; }
    .soundwaves span:nth-child(4) { animation-delay: 0.6s; height: 40%; }

    @keyframes sound-bounce {
      0% { height: 20%; }
      100% { height: 100%; }
    }

    /* Selection Floating Pill */
    #selectionExplainPill {
      position: absolute;
      z-index: 10000;
      background: var(--bg-card-elevated);
      border: 1px solid var(--accent-sky);
      box-shadow: 0 8px 25px rgba(0,0,0,0.5), 0 0 15px rgba(2, 132, 199, 0.3);
      color: var(--text-primary);
      font-size: 0.8rem;
      padding: 0.4rem 0.85rem;
      border-radius: 9999px;
      cursor: pointer;
      display: none;
      align-items: center;
      gap: 0.4rem;
      transform: translate(-50%, -120%);
      font-family: 'JetBrains Mono', monospace;
      animation: fadeIn 0.2s ease;
    }
  </style>
</head>

<body class="antialiased selection:bg-blue-500/30">

  <!-- Ambient Cyber Background Mesh & Cursor Spotlight -->
  <div class="cyber-bg-mesh" aria-hidden="true"></div>
  <div id="cursorSpotlight" class="cursor-spotlight" aria-hidden="true"></div>

  <!-- Text Selection Floating Explainer Pill -->
  <div id="selectionExplainPill">
    <i class="bi bi-robot text-sky-400"></i>
    <span>KiroBot: Explain Selection</span>
  </div>

  <!-- =========================================================================
       1. FLOATING GLASSMORPHIC NAVIGATION BAR (KSI)
       ========================================================================= -->
  <header class="floating-nav">
    <a href="#hero" class="flex items-center gap-3 group">
      <div class="relative flex-shrink-0">
        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full p-[2px] bg-gradient-to-tr from-blue-600 via-sky-500 to-emerald-400 shadow-md group-hover:scale-105 transition-transform duration-300">
          <img src="{{ $navLogoUrl }}" alt="{{ $brandFullName }} Logo" class="w-full h-full object-cover rounded-full bg-slate-900">
        </div>
        @if($isAvailable)
          <span class="absolute bottom-0 right-0 w-3 h-3 bg-emerald-500 border-2 border-[var(--bg-nav)] rounded-full shadow-sm">
            <span class="absolute inset-0 rounded-full bg-emerald-500 animate-ping opacity-75"></span>
          </span>
        @endif
      </div>
      <div class="flex flex-col">
        <span class="font-bold text-[var(--text-primary)] tracking-tight text-sm sm:text-base leading-tight group-hover:text-blue-500 transition-colors">{{ $brandName }}</span>
        <span class="font-mono text-[10px] sm:text-xs text-[var(--accent-sky)] tracking-wider">{{ $brandSubtitle }}</span>
      </div>
    </a>

    <!-- Nav Links (Desktop) -->
    <nav class="hidden md:flex items-center gap-1 font-medium text-sm text-[var(--text-secondary)]">
      <a href="#about" class="px-3 py-2 rounded-lg hover:text-[var(--text-primary)] hover:bg-[var(--pill-bg)] transition-colors">About</a>
      <a href="#architecture" class="px-3 py-2 rounded-lg hover:text-[var(--text-primary)] hover:bg-[var(--pill-bg)] transition-colors">Architecture</a>
      <a href="#projects" class="px-3 py-2 rounded-lg hover:text-[var(--text-primary)] hover:bg-[var(--pill-bg)] transition-colors">Projects</a>
      <a href="#credentials" class="px-3 py-2 rounded-lg hover:text-[var(--text-primary)] hover:bg-[var(--pill-bg)] transition-colors">Credentials</a>
      <a href="#testimonials" class="px-3 py-2 rounded-lg hover:text-[var(--text-primary)] hover:bg-[var(--pill-bg)] transition-colors">Testimonials</a>
      <a href="#contact" class="px-3 py-2 rounded-lg hover:text-[var(--text-primary)] hover:bg-[var(--pill-bg)] transition-colors">Contact</a>
    </nav>

    <!-- Header Actions -->
    <div class="flex items-center gap-2 sm:gap-3">
      <!-- Light / Dark Mode Toggle Button -->
      <button id="themeToggleBtn" type="button" class="theme-toggle-btn" aria-label="Toggle Light and Dark Mode" title="Toggle Light / Dark Mode">
        <i id="themeIcon" class="bi bi-moon-stars-fill"></i>
      </button>

      <a href="{{ route('download.resume') }}" class="btn-cyber-primary !py-2 !px-3.5 sm:!px-4 !text-xs !rounded-lg group" download>
        <i class="bi bi-cloud-arrow-down-fill text-sky-200 group-hover:translate-y-0.5 transition-transform text-sm"></i>
        <span class="hidden xs:inline">Resume</span>
      </a>

      <a href="{{ $linkedinUrl }}" target="_blank" rel="noopener" class="hidden sm:flex p-2 rounded-lg bg-[var(--pill-bg)] hover:bg-[var(--pill-border)] text-[var(--text-secondary)] hover:text-blue-500 transition-colors" title="LinkedIn Profile">
        <i class="bi bi-linkedin text-lg"></i>
      </a>

      <!-- Mobile Hamburger Menu Button -->
      <button id="mobileNavToggleBtn" type="button" class="mobile-nav-toggle-btn md:hidden" aria-label="Open Mobile Menu" title="Open Menu">
        <i class="bi bi-list text-xl"></i>
      </button>
    </div>
  </header>

  <!-- Mobile Navigation Drawer -->
  <div id="mobileNavDrawer" class="mobile-drawer-backdrop fixed inset-0 z-[10005] bg-black/60 backdrop-blur-md opacity-0 pointer-events-none transition-all duration-300 md:hidden">
    <div id="mobileDrawerPanel" class="mobile-drawer-panel fixed top-0 right-0 bottom-0 w-[84%] max-w-[340px] bg-[var(--bg-card-elevated)] border-l border-[var(--border-subtle)] p-6 flex flex-col justify-between shadow-2xl transform translate-x-full transition-transform duration-300">
      <div>
        <div class="flex items-center justify-between pb-5 border-b border-[var(--border-subtle)]">
          <div class="flex items-center gap-3">
            <img src="{{ $navLogoUrl }}" alt="{{ $brandName }}" class="w-10 h-10 rounded-full border border-[var(--border-subtle)]">
            <div>
              <h4 class="font-bold text-sm text-[var(--text-primary)]">{{ $brandName }}</h4>
              <p class="text-[10px] font-mono text-[var(--accent-sky)]">{{ $brandSubtitle }}</p>
            </div>
          </div>
          <button id="mobileNavCloseBtn" type="button" class="w-8 h-8 rounded-lg flex items-center justify-center text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--pill-bg)] transition-colors">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>

        <nav class="flex flex-col gap-1 py-6 font-medium text-base">
          <a href="#about" class="mobile-nav-link px-4 py-3 rounded-xl text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--pill-bg)] transition-colors flex items-center justify-between">
            <span>About</span>
            <i class="bi bi-chevron-right text-xs opacity-50"></i>
          </a>
          <a href="#architecture" class="mobile-nav-link px-4 py-3 rounded-xl text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--pill-bg)] transition-colors flex items-center justify-between">
            <span>Architecture</span>
            <i class="bi bi-chevron-right text-xs opacity-50"></i>
          </a>
          <a href="#projects" class="mobile-nav-link px-4 py-3 rounded-xl text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--pill-bg)] transition-colors flex items-center justify-between">
            <span>Projects</span>
            <i class="bi bi-chevron-right text-xs opacity-50"></i>
          </a>
          <a href="#credentials" class="mobile-nav-link px-4 py-3 rounded-xl text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--pill-bg)] transition-colors flex items-center justify-between">
            <span>Credentials</span>
            <i class="bi bi-chevron-right text-xs opacity-50"></i>
          </a>
          <a href="#testimonials" class="mobile-nav-link px-4 py-3 rounded-xl text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--pill-bg)] transition-colors flex items-center justify-between">
            <span>Testimonials</span>
            <i class="bi bi-chevron-right text-xs opacity-50"></i>
          </a>
          <a href="#contact" class="mobile-nav-link px-4 py-3 rounded-xl text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--pill-bg)] transition-colors flex items-center justify-between">
            <span>Contact</span>
            <i class="bi bi-chevron-right text-xs opacity-50"></i>
          </a>
        </nav>
      </div>

      <div class="pt-6 border-t border-[var(--border-subtle)] space-y-4">
        <a href="{{ route('download.resume') }}" class="btn-cyber-primary w-full justify-center !py-2.5 !text-xs" download>
          <i class="bi bi-cloud-arrow-down-fill"></i> Download Resume
        </a>
        <div class="flex items-center justify-center gap-3">
          <a href="{{ $linkedinUrl }}" target="_blank" rel="noopener" class="p-2.5 rounded-xl bg-[var(--pill-bg)] text-[var(--text-secondary)] hover:text-blue-500 transition-colors" title="LinkedIn">
            <i class="bi bi-linkedin text-lg"></i>
          </a>
          <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="p-2.5 rounded-xl bg-[var(--pill-bg)] text-[var(--text-secondary)] hover:text-emerald-500 transition-colors" title="WhatsApp">
            <i class="bi bi-whatsapp text-lg"></i>
          </a>
          <a href="mailto:{{ $contactEmail }}" class="p-2.5 rounded-xl bg-[var(--pill-bg)] text-[var(--text-secondary)] hover:text-sky-500 transition-colors" title="Email">
            <i class="bi bi-envelope-at text-lg"></i>
          </a>
          <a href="{{ $githubUrl }}" target="_blank" rel="noopener" class="p-2.5 rounded-xl bg-[var(--pill-bg)] text-[var(--text-secondary)] hover:text-[var(--text-primary)] transition-colors" title="GitHub">
            <i class="bi bi-github text-lg"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

  <main class="max-w-[1400px] mx-auto px-4 sm:px-6 pt-28 sm:pt-36 pb-24">

    <!-- =========================================================================
         2. HERO SECTION
         ========================================================================= -->
    <section id="hero" class="py-12 md:py-20">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
        
        <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
          <!-- Live Status Badge -->
          @if($isAvailable)
            <div class="availability-badge inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-500 font-mono text-xs tracking-wide shadow-sm">
              <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
              <span>{{ $s('availability_text', 'Available for Backend & High-Impact Engineering Roles') }}</span>
            </div>
          @endif

          <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-[var(--text-primary)] leading-[1.15]">
            {{ $s('hero_title_prefix', 'Building ') }}<span class="bg-gradient-to-r from-blue-600 via-sky-500 to-blue-500 dark:from-sky-400 dark:via-blue-400 dark:to-cyan-300 bg-clip-text text-transparent">{{ $s('hero_title_highlight', 'High-Performance') }}</span>{{ $s('hero_title_suffix', ' Backend Architecture & Scalable Web Solutions') }}
          </h1>

          <p class="text-[var(--text-secondary)] text-base sm:text-lg leading-relaxed max-w-2xl mx-auto lg:mx-0">
            {!! $s('hero_description') !!}
          </p>

          <!-- Dual CTAs -->
          <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3 sm:gap-4 pt-2">
            <a href="#projects" class="btn-cyber-primary w-full sm:w-auto justify-center">
              <span>Explore Projects</span>
              <i class="bi bi-arrow-right"></i>
            </a>

            <a href="{{ route('download.resume') }}" class="btn-cyber-outline group w-full sm:w-auto justify-center" download>
              <i class="bi bi-cloud-arrow-down-fill text-sky-500 group-hover:translate-y-0.5 transition-transform text-lg"></i>
              <span>Download Resume</span>
            </a>

            <button onclick="navigator.clipboard.writeText('{{ $contactEmail }}'); alert('Copied {{ $contactEmail }} to clipboard!');" class="btn-cyber-outline !px-4 w-full sm:w-auto justify-center" title="Copy Email">
              <i class="bi bi-clipboard-check"></i>
              <span>{{ $contactEmail }}</span>
            </button>
          </div>

          <!-- Quick Tech Stack Badges -->
          <div class="pt-6 border-t border-[var(--border-subtle)] flex flex-wrap items-center justify-center lg:justify-start gap-2 font-mono text-xs text-[var(--text-secondary)]">
            <span class="text-[var(--text-muted)] mr-2 uppercase tracking-wider text-[11px]">Core Stack:</span>
            @foreach($techStacks as $stack)
              <span class="tech-pill px-2.5 py-1 rounded bg-[var(--pill-bg)] border border-[var(--border-subtle)] {{ $stack->textColorClass() }} font-semibold">{{ $stack->name }}</span>
            @endforeach
          </div>
        </div>

        <!-- Right Column: Avatar Frame (Clean, Unobstructed 4K Portrait) -->
        <div class="lg:col-span-5 relative flex justify-center lg:justify-end">
          <div class="relative w-full max-w-[340px] sm:max-w-[380px] lg:max-w-[420px] aspect-[509/772] rounded-2xl overflow-hidden border border-[var(--border-subtle)] bg-[var(--bg-card)] shadow-2xl group flex items-end justify-center">
            <!-- Subtle Ambient Spotlight Behind Avatar -->
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_35%,rgba(37,99,235,0.22),transparent_70%)] pointer-events-none"></div>

            <img id="heroPortraitImg" src="{{ $heroImageUrl }}" alt="{{ $brandFullName }}" class="profile-portrait w-full h-full object-cover object-center relative z-10 filter brightness-[1.02] contrast-[1.04] group-hover:scale-105 transition-transform duration-700">
          </div>
        </div>

      </div>
    </section>

    <!-- =========================================================================
         3. ENGINEERING PILLARS & ARCHITECTURE GRID
         ========================================================================= -->
    <section id="architecture" class="py-20 border-t border-white/5">
      <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
        <span class="px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/30 text-indigo-400 font-mono text-xs uppercase tracking-widest">
          {{ $s('architecture_badge', 'Core Pillars') }}
        </span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
          {{ $s('architecture_title', 'Backend Architecture & System Competencies') }}
        </h2>
        <p class="text-slate-400 text-base">
          {{ $s('architecture_subtitle') }}
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($pillars as $pillar)
          <div class="glass-card p-6 flex flex-col justify-between">
            <div class="space-y-3">
              <div class="w-12 h-12 rounded-xl border {{ $pillar->iconWrapperClasses() }} flex items-center justify-center text-xl shadow-lg">
                <i class="bi {{ $pillar->icon }}"></i>
              </div>
              <h3 class="text-lg font-bold text-white">{{ $pillar->title }}</h3>
              <p class="text-slate-300 text-xs leading-relaxed">
                {{ $pillar->description }}
              </p>
            </div>
            @if(!empty($pillar->bullets))
              <ul class="mt-4 pt-4 border-t border-white/10 space-y-1.5 font-mono text-[11px] text-slate-300">
                @foreach($pillar->bullets as $bullet)
                  <li class="flex items-center gap-1.5"><i class="bi bi-check2 text-cyan-400"></i> {{ $bullet }}</li>
                @endforeach
              </ul>
            @endif
          </div>
        @endforeach
      </div>
    </section>

    <!-- =========================================================================
         4. SHOWCASE PROJECTS WITH FILTERING & PAGINATION
         ========================================================================= -->
    <section id="projects" class="py-20 border-t border-white/5">
      <div class="text-center max-w-3xl mx-auto mb-12 space-y-3">
        <span class="px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-mono text-xs uppercase tracking-widest">
          {{ $s('projects_badge', 'Portfolio & Architecture') }}
        </span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
          {{ $s('projects_title', 'Featured Production-Grade Projects') }}
        </h2>
        <p class="text-slate-400 text-base">
          {{ $s('projects_subtitle') }}
        </p>
      </div>

      <!-- Filter Controls (Frameworks & Architecture) -->
      <div class="glass-card p-6 mb-10 space-y-5">
        <!-- Row 1: Frameworks Filter -->
        <div class="flex flex-col md:flex-row md:items-center gap-3">
          <span class="text-xs font-mono uppercase tracking-wider text-slate-400 flex items-center gap-1.5 min-w-[140px]">
            <i class="bi bi-code-slash text-cyan-400"></i> Framework:
          </span>
          <div class="flex flex-wrap gap-2" id="frameworkFilterButtons">
            <button type="button" data-filter-type="framework" data-filter-value="all" class="project-filter-btn active-filter px-3.5 py-1.5 rounded-lg text-xs font-mono transition-all">
              All Frameworks ({{ $projects->count() }})
            </button>
            @foreach($frameworkFilters as $key => $info)
              <button type="button" data-filter-type="framework" data-filter-value="{{ $key }}" class="project-filter-btn px-3.5 py-1.5 rounded-lg text-xs font-mono transition-all">
                {{ $info['label'] }} ({{ $info['count'] }})
              </button>
            @endforeach
          </div>
        </div>

        <!-- Row 2: Architecture Filter -->
        <div class="flex flex-col md:flex-row md:items-center gap-3 pt-4 border-t border-white/5">
          <span class="text-xs font-mono uppercase tracking-wider text-slate-400 flex items-center gap-1.5 min-w-[140px]">
            <i class="bi bi-diagram-3 text-indigo-400"></i> Architecture:
          </span>
          <div class="flex flex-wrap gap-2" id="archFilterButtons">
            <button type="button" data-filter-type="arch" data-filter-value="all" class="project-filter-btn active-filter px-3.5 py-1.5 rounded-lg text-xs font-mono transition-all">
              All Architectures ({{ $projects->count() }})
            </button>
            @foreach($archFilters as $key => $info)
              <button type="button" data-filter-type="arch" data-filter-value="{{ $key }}" class="project-filter-btn px-3.5 py-1.5 rounded-lg text-xs font-mono transition-all">
                {{ $info['label'] }} ({{ $info['count'] }})
              </button>
            @endforeach
          </div>
        </div>

        <!-- Filter Status Counter & Reset -->
        <div class="flex items-center justify-between pt-3 border-t border-white/5 text-xs font-mono text-slate-400">
          <div>
            Showing <span id="projectCountDisplay" class="text-cyan-400 font-bold">{{ min(4, $projects->count()) }}</span> of <span id="projectTotalDisplay" class="text-white font-bold">{{ $projects->count() }}</span> projects
            <span id="activeFilterBadge" class="hidden ml-2 px-2 py-0.5 rounded bg-cyan-500/10 border border-cyan-500/30 text-cyan-300"></span>
          </div>
          <button id="btnResetFilters" type="button" onclick="window.resetProjectFilters()" class="hidden text-slate-400 hover:text-white transition-colors items-center gap-1">
            <i class="bi bi-x-circle"></i> Reset Filters
          </button>
        </div>
      </div>

      <!-- Dynamic Project Grid Container -->
      <div id="projectsContainer" class="grid grid-cols-1 md:grid-cols-2 gap-8 min-h-[500px]">
        <!-- Injected and paginated dynamically via JavaScript -->
      </div>

      <!-- Empty State (if no project matches filter) -->
      <div id="projectsEmptyState" class="hidden text-center py-16 glass-card p-8">
        <i class="bi bi-search text-4xl text-slate-500 mb-3 block"></i>
        <h4 class="text-lg font-bold text-white mb-1">No Projects Match Selected Filter</h4>
        <p class="text-slate-400 text-sm mb-4">Try choosing another filter to browse other system projects.</p>
        <button onclick="window.resetProjectFilters()" class="btn-cyber-primary !py-2 !px-4 !text-xs">
          Reset All Filters
        </button>
      </div>

      <!-- Pagination Controls -->
      <div id="projectPagination" class="mt-12 flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-white/10">
        <button id="btnPrevPage" type="button" class="btn-cyber-outline !py-2 !px-4 !text-xs flex items-center gap-2 disabled:opacity-30 disabled:pointer-events-none">
          <i class="bi bi-chevron-left"></i>
          <span>Previous Page</span>
        </button>

        <div id="paginationPills" class="flex items-center gap-2">
          <!-- Page Pills injected via JavaScript -->
        </div>

        <button id="btnNextPage" type="button" class="btn-cyber-outline !py-2 !px-4 !text-xs flex items-center gap-2 disabled:opacity-30 disabled:pointer-events-none">
          <span>Next Page</span>
          <i class="bi bi-chevron-right"></i>
        </button>
      </div>
    </section>

    <!-- =========================================================================
         5. CREDENTIALS & CERTIFICATIONS
         ========================================================================= -->
    <section id="credentials" class="py-20 border-t border-white/5">
      <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
        <span class="px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 font-mono text-xs uppercase tracking-widest">
          {{ $s('credentials_badge', 'Verified Badges') }}
        </span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
          {{ $s('credentials_title', 'Certifications & Engineering Milestones') }}
        </h2>
        <p class="text-slate-400 text-base">
          {{ $s('credentials_subtitle') }}
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($certificates as $cert)
          @php $certTheme = $cert->themeClasses(); @endphp
          <div class="glass-card p-7 flex flex-col justify-between group {{ $certTheme['hover_border'] }} transition-all">
            <div class="space-y-4">
              <div class="flex items-center justify-between">
                <button type="button" onclick="openCertificateModal('{{ $cert->slug }}')" class="w-14 h-14 rounded-xl bg-white/5 border border-white/10 p-1.5 {{ $certTheme['thumb_hover'] }} hover:scale-105 transition-all text-left" title="Click to View Full Certificate">
                  <img src="{{ $cert->image_url }}" alt="{{ $cert->title }}" class="w-full h-full object-contain">
                </button>
                <span class="px-2.5 py-0.5 rounded border {{ $certTheme['badge'] }} font-mono text-[11px] font-bold">{{ $cert->badge_text }}</span>
              </div>
              <div>
                <span class="font-mono text-xs text-cyan-400 uppercase tracking-wider">{{ $cert->issuer }}</span>
                <h3 class="text-lg font-bold text-white group-hover:text-cyan-300 transition-colors">{{ $cert->title }}</h3>
              </div>
              <p class="text-slate-300 text-sm leading-relaxed">
                {{ $cert->description }}
              </p>
            </div>
            <div class="mt-6 pt-5 border-t border-white/10 flex flex-wrap items-center justify-between gap-3">
              <span class="font-mono text-xs text-slate-500">{{ $cert->issued_date }}</span>
              <div class="flex items-center gap-2">
                <button type="button" onclick="openCertificateModal('{{ $cert->slug }}')" class="btn-cyber-primary !py-1.5 !px-3 !text-xs flex items-center gap-1.5" title="View Certificate Image">
                  <i class="bi bi-eye-fill"></i> View Image
                </button>
                @if($cert->pdf_path)
                  <a href="{{ $cert->download_url }}" class="btn-cyber-outline !py-1.5 !px-3 !text-xs" download title="Download Verified PDF">
                    <i class="bi bi-download"></i> PDF
                  </a>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </section>

    <!-- =========================================================================
         6. INSTRUCTOR TESTIMONIALS & ENDORSEMENTS
         ========================================================================= -->
    <section id="testimonials" class="py-20 border-t border-white/5">
      <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
        <span class="px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-mono text-xs uppercase tracking-widest">
          {{ $s('testimonials_badge', 'Verified Social Proof') }}
        </span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
          {{ $s('testimonials_title', 'Testimonials & Mentorship Endorsements') }}
        </h2>
        <p class="text-slate-400 text-base">
          {{ $s('testimonials_subtitle') }}
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($testimonials as $testimonial)
          @php $tTheme = $testimonial->themeClasses(); @endphp
          <div class="glass-card p-7 flex flex-col justify-between group {{ $tTheme['hover_border'] }} transition-all duration-300">
            <div class="space-y-4">
              <div class="flex items-center justify-between">
                <span class="w-10 h-10 rounded-xl {{ $tTheme['icon_box'] }} flex items-center justify-center text-xl shadow-lg">
                  <i class="bi bi-quote"></i>
                </span>
                <span class="px-2.5 py-0.5 rounded border {{ $tTheme['badge'] }} font-mono text-[11px] font-bold">{{ $testimonial->badge_text }}</span>
              </div>
              
              <p class="text-white text-base font-medium leading-relaxed italic" @if($testimonial->is_rtl) style="direction: rtl; text-align: right;" @endif>
                "{{ $testimonial->quote }}"
              </p>
            </div>

            <div class="mt-6 pt-5 border-t border-white/10 flex items-center justify-between gap-3">
              <div class="flex items-center gap-3">
                <img src="{{ $testimonial->author_image_url }}" alt="{{ $testimonial->author_name }}" class="w-11 h-11 rounded-full object-cover border {{ $tTheme['avatar_border'] }} shadow-sm">
                <div>
                  <h4 class="text-sm font-bold text-white leading-tight">{{ $testimonial->author_name }}</h4>
                  <p class="text-[11px] font-mono {{ $tTheme['role_text'] }}">{{ $testimonial->author_role }}</p>
                  @if($testimonial->author_subtitle)
                    <p class="text-[10px] text-slate-400">{{ $testimonial->author_subtitle }}</p>
                  @endif
                </div>
              </div>

              @if($testimonial->linkedin_url)
                <a href="{{ $testimonial->linkedin_url }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 {{ $tTheme['link_hover'] }} text-slate-400 flex items-center justify-center transition-colors flex-shrink-0" title="Verify Recommendation on LinkedIn">
                  <i class="bi bi-linkedin"></i>
                </a>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    </section>

    <!-- =========================================================================
         7. CONTACT & CUSTOM BRANDED FOOTER
         ========================================================================= -->
    <section id="contact" class="py-20 border-t border-white/5">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        <!-- Contact Details -->
        <div class="lg:col-span-5 space-y-6">
          <span class="px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 font-mono text-xs uppercase tracking-widest">
            {{ $s('contact_badge', 'Initiate Collaboration') }}
          </span>
          <h2 class="text-3xl font-extrabold text-white tracking-tight">{{ $s('contact_title', "Let's Build Something Exceptional") }}</h2>
          <p class="text-slate-300 text-base leading-relaxed">
            {{ $s('contact_subtitle') }}
          </p>

          <div class="space-y-4 pt-4">
            <a href="mailto:{{ $contactEmail }}" class="flex items-center gap-4 p-4 rounded-xl bg-white/5 border border-white/10 hover:border-cyan-400 transition-colors">
              <div class="w-11 h-11 rounded-lg bg-cyan-500/20 text-cyan-400 flex items-center justify-center text-xl">
                <i class="bi bi-envelope-at-fill"></i>
              </div>
              <div>
                <p class="text-xs font-mono text-slate-400">Direct Email</p>
                <p class="text-sm font-semibold text-white">{{ $contactEmail }}</p>
              </div>
            </a>

            <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="flex items-center gap-4 p-4 rounded-xl bg-white/5 border border-white/10 hover:border-emerald-400 transition-colors">
              <div class="w-11 h-11 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl">
                <i class="bi bi-whatsapp"></i>
              </div>
              <div>
                <p class="text-xs font-mono text-slate-400">WhatsApp Direct</p>
                <p class="text-sm font-semibold text-white">{{ $s('whatsapp_display', '+20 10 340 37540 / +20 12 891 98945') }}</p>
              </div>
            </a>

            <a href="{{ $linkedinUrl }}" target="_blank" rel="noopener" class="flex items-center gap-4 p-4 rounded-xl bg-white/5 border border-white/10 hover:border-indigo-400 transition-colors">
              <div class="w-11 h-11 rounded-lg bg-indigo-500/20 text-indigo-400 flex items-center justify-center text-xl">
                <i class="bi bi-linkedin"></i>
              </div>
              <div>
                <p class="text-xs font-mono text-slate-400">LinkedIn Profile</p>
                <p class="text-sm font-semibold text-white">{{ $s('linkedin_display', 'linkedin.com/in/kirollossamy') }}</p>
              </div>
            </a>
          </div>
        </div>

        <!-- Contact Form -->
        <div class="lg:col-span-7 glass-card p-8 sm:p-10">
          <h3 class="text-2xl font-bold text-white mb-2">{{ $s('contact_form_title', 'Send a Secure Message') }}</h3>
          <p class="text-slate-400 text-sm mb-6">{{ $s('contact_form_subtitle') }}</p>

          @if(session('success'))
            <div class="p-4 mb-6 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-sm flex items-center gap-2">
              <i class="bi bi-check-circle-fill"></i>
              <span>{{ session('success') }}</span>
            </div>
          @endif

          <form id="contactForm" action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div class="space-y-1.5">
                <label class="text-xs font-mono text-slate-300 uppercase">Your Name *</label>
                <input type="text" id="contactName" name="name" required class="w-full px-4 py-3 rounded-xl bg-slate-950/70 border border-white/10 text-white focus:border-cyan-400 focus:outline-none transition-colors" placeholder="e.g. Michael Thorne">
              </div>
              <div class="space-y-1.5">
                <label class="text-xs font-mono text-slate-300 uppercase">Email Address *</label>
                <input type="email" id="contactEmail" name="email" required class="w-full px-4 py-3 rounded-xl bg-slate-950/70 border border-white/10 text-white focus:border-cyan-400 focus:outline-none transition-colors" placeholder="e.g. michael@enterprise.com">
              </div>
            </div>

            <div class="space-y-1.5">
              <label class="text-xs font-mono text-slate-300 uppercase">Subject *</label>
              <input type="text" id="contactSubject" name="subject" required class="w-full px-4 py-3 rounded-xl bg-slate-950/70 border border-white/10 text-white focus:border-cyan-400 focus:outline-none transition-colors" placeholder="Backend Engineering / Web Architecture Project">
            </div>

            <div class="space-y-1.5">
              <label class="text-xs font-mono text-slate-300 uppercase">Message &amp; Project Scope *</label>
              <textarea id="contactMessage" name="message" rows="5" required class="w-full px-4 py-3 rounded-xl bg-slate-950/70 border border-white/10 text-white focus:border-cyan-400 focus:outline-none transition-colors" placeholder="Describe your technical requirements or system architecture goals..."></textarea>
            </div>

            <!-- Direct Delivery Notice -->
            <div class="p-3.5 rounded-xl bg-emerald-500/10 border border-emerald-500/25 flex items-center gap-2.5 text-xs font-mono text-emerald-300">
              <i class="bi bi-envelope-check-fill text-emerald-400 text-lg flex-shrink-0"></i>
              <span>{{ $s('contact_notice') }}</span>
            </div>

            <!-- Inline Form Status -->
            <div id="contactFormStatus" class="hidden p-4 rounded-xl text-sm font-medium"></div>

            <button type="submit" id="btnSubmitContact" class="btn-cyber-primary w-full justify-center !py-3.5 group">
              <span id="btnSubmitContactText">Send Message Directly</span>
              <i class="bi bi-send-fill text-cyan-300 group-hover:translate-x-1 transition-transform"></i>
            </button>
          </form>
        </div>

      </div>
    </section>

    <!-- =========================================================================
         CERTIFICATE IMAGE LIGHTBOX MODAL
         ========================================================================= -->
    <div id="certificateLightboxModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/90 backdrop-blur-md opacity-0 pointer-events-none transition-all duration-300">
      <div class="relative w-full max-w-4xl max-h-[92vh] flex flex-col rounded-2xl border border-white/15 bg-gradient-to-b from-[#121824] to-[#0a0d14] p-6 sm:p-7 shadow-2xl shadow-cyan-500/20 transform scale-95 transition-all duration-300 overflow-hidden">
        
        <!-- Header -->
        <div class="flex items-center justify-between pb-4 mb-4 border-b border-white/10">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-cyan-500/20 text-cyan-400 flex items-center justify-center text-xl shadow-lg shadow-cyan-500/20">
              <i class="bi bi-patch-check-fill"></i>
            </div>
            <div>
              <h3 id="certLightboxTitle" class="text-lg font-bold text-white tracking-tight">Verified Credential</h3>
              <p id="certLightboxIssuer" class="text-xs font-mono text-cyan-400">OFFICIAL ACCREDITATION</p>
            </div>
          </div>
          
          <button id="btnCloseCertModal" type="button" onclick="closeCertificateModal()" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 text-slate-400 hover:text-white hover:bg-white/10 flex items-center justify-center transition-colors">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>

        <!-- Image Container -->
        <div class="relative flex-grow flex items-center justify-center overflow-auto rounded-xl bg-slate-950/80 border border-white/10 p-4 min-h-[300px]">
          <img id="certLightboxImage" src="" alt="Certificate Full Preview" class="max-h-[60vh] max-w-full object-contain rounded-lg shadow-2xl">
        </div>

        <!-- Footer Actions -->
        <div class="pt-4 mt-4 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-3">
          <span id="certLightboxBadge" class="px-2.5 py-1 rounded font-mono text-xs font-bold"></span>
          
          <div class="flex items-center gap-3 w-full sm:w-auto">
            <a id="certLightboxOpenTab" href="#" target="_blank" rel="noopener" class="btn-cyber-outline !py-2 !px-4 !text-xs flex-1 sm:flex-initial justify-center items-center gap-1.5">
              <i class="bi bi-box-arrow-up-right"></i> Open Image in New Tab
            </a>
            <a id="certLightboxDownloadPdf" href="#" class="btn-cyber-primary !py-2 !px-4 !text-xs flex-1 sm:flex-initial justify-center items-center gap-1.5" download>
              <i class="bi bi-download"></i> Download Verified PDF
            </a>
          </div>
        </div>

      </div>
    </div>

    <!-- =========================================================================
         PROJECT DETAIL MODAL
         ========================================================================= -->
    <div id="projectDetailModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/90 backdrop-blur-md opacity-0 pointer-events-none transition-all duration-300">
      <div class="relative w-full max-w-4xl max-h-[92vh] flex flex-col rounded-2xl border border-white/15 bg-gradient-to-b from-[#121824] to-[#0a0d14] p-6 sm:p-8 shadow-2xl shadow-indigo-500/20 transform scale-95 transition-all duration-300 overflow-hidden">
        
        <!-- Header -->
        <div class="flex items-start justify-between pb-4 mb-4 border-b border-white/10">
          <div class="space-y-1">
            <div class="flex flex-wrap items-center gap-2">
              <span id="modalProjectBadge" class="px-2.5 py-0.5 rounded font-mono text-[11px] font-bold"></span>
              <span id="modalProjectFrameworkTag" class="px-2.5 py-0.5 rounded bg-white/5 border border-white/10 font-mono text-[11px] text-cyan-300"></span>
              <span id="modalProjectArchTag" class="px-2.5 py-0.5 rounded bg-white/5 border border-white/10 font-mono text-[11px] text-indigo-300"></span>
            </div>
            <h3 id="modalProjectTitle" class="text-2xl font-bold text-white tracking-tight pt-1"></h3>
          </div>
          
          <button id="btnCloseProjectModal" type="button" onclick="closeProjectModal()" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 text-slate-400 hover:text-white hover:bg-white/10 flex items-center justify-center transition-colors flex-shrink-0">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>

        <!-- Scrollable Body -->
        <div class="overflow-y-auto pr-2 space-y-6 flex-grow">
          <!-- Project Hero Image -->
          <div class="relative h-64 sm:h-80 rounded-xl overflow-hidden bg-slate-900 border border-white/10">
            <img id="modalProjectImage" src="" alt="Project Preview" class="w-full h-full object-cover">
          </div>

          <!-- Description -->
          <div class="space-y-2">
            <h4 class="text-xs font-mono uppercase tracking-wider text-cyan-400">System Architecture Overview</h4>
            <p id="modalProjectDescription" class="text-slate-300 text-sm leading-relaxed"></p>
          </div>

          <!-- Technical Architecture Highlights -->
          <div class="space-y-3">
            <h4 class="text-xs font-mono uppercase tracking-wider text-indigo-400">Key Engineering Highlights &amp; Performance Standards</h4>
            <ul id="modalProjectHighlights" class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-xs font-mono text-slate-300">
              <!-- Injected dynamically -->
            </ul>
          </div>
        </div>

        <!-- Footer Actions -->
        <div class="pt-5 mt-4 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-3">
          <button type="button" onclick="closeProjectModal()" class="text-xs font-mono text-slate-400 hover:text-white transition-colors">
            Close Viewer
          </button>
          
          <div class="flex items-center gap-3 w-full sm:w-auto">
            <a id="modalProjectGithubLink" href="#" target="_blank" rel="noopener" class="btn-cyber-outline !py-2.5 !px-4 !text-xs flex-1 sm:flex-initial justify-center items-center gap-1.5">
              <i class="bi bi-github text-sm"></i> Source Code
            </a>
            <a id="modalProjectDemoLink" href="#" target="_blank" rel="noopener" class="btn-cyber-primary !py-2.5 !px-4 !text-xs flex-1 sm:flex-initial justify-center items-center gap-1.5">
              <span>View Showcase / Demo</span>
              <i class="bi bi-box-arrow-up-right"></i>
            </a>
          </div>
        </div>

      </div>
    </div>

  </main>

  <!-- =========================================================================
       CUSTOM FOOTER (EXCLUSIVELY BRANDED)
       ========================================================================= -->
  <footer class="border-t border-white/10 bg-[#06080d] py-12 px-6">
    <div class="max-w-[1440px] mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
      
      <!-- Custom Copyright & Authorship -->
      <div class="space-y-1 text-center md:text-left">
        <p class="text-sm font-medium text-slate-200">
          Developed with Excellence by <a href="{{ $linkedinUrl }}" target="_blank" rel="noopener" class="text-cyan-400 font-bold hover:underline">{{ $s('footer_credit_name', $brandFullName) }}</a>
        </p>
        <p class="text-xs font-mono text-slate-500">
          © <span id="currentYear"></span> {{ $s('footer_copyright', 'Kirollos Samy Ishaq Tawfik. 100% Original Intellectual Property.') }}
        </p>
      </div>

      <!-- Direct Verified Social Badges -->
      <div class="flex flex-wrap items-center justify-center gap-3">
        <a href="{{ $linkedinUrl }}" target="_blank" rel="noopener" class="px-3.5 py-1.5 rounded-lg bg-indigo-500/10 border border-indigo-500/30 text-indigo-300 hover:text-white hover:bg-indigo-500/20 text-xs font-mono flex items-center gap-1.5 transition-colors">
          <i class="bi bi-linkedin text-sm"></i>
          <span>LinkedIn</span>
        </a>

        <a href="{{ $githubUrl }}" target="_blank" rel="noopener" class="px-3.5 py-1.5 rounded-lg bg-white/5 border border-white/10 text-slate-300 hover:text-white hover:bg-white/10 text-xs font-mono flex items-center gap-1.5 transition-colors">
          <i class="bi bi-github text-sm"></i>
          <span>GitHub</span>
        </a>

        <a href="mailto:{{ $contactEmail }}" class="px-3.5 py-1.5 rounded-lg bg-cyan-500/10 border border-cyan-500/30 text-cyan-300 hover:text-white hover:bg-cyan-500/20 text-xs font-mono flex items-center gap-1.5 transition-colors">
          <i class="bi bi-envelope text-sm"></i>
          <span>Email</span>
        </a>

        <a href="{{ route('admin.dashboard') }}" class="px-3.5 py-1.5 rounded-lg bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 hover:text-white hover:bg-emerald-500/20 text-xs font-mono flex items-center gap-1.5 transition-colors" title="Admin Dashboard">
          <i class="bi bi-speedometer2 text-sm"></i>
          <span>Dashboard</span>
        </a>
      </div>

    </div>
  </footer>

  <!-- =========================================================================
       AI COMPANION WIDGET ("KiroBot")
       ========================================================================= -->
  @if(($s('kirobot_enabled', '1')) === '1')
  <div id="kiroBotWidget" class="kirobot-container">
    
    <!-- Dynamic Speech Bubble -->
    <div id="kiroSpeechBubble" class="kirobot-speech-bubble">
      <div class="flex items-center justify-between pb-2 mb-2 border-b border-white/10 text-xs font-mono">
        <div class="flex items-center gap-2 text-cyan-400">
          <div class="soundwaves">
            <span></span><span></span><span></span><span></span>
          </div>
          <span id="kiroBotModeTag">SCROLL RADAR</span>
        </div>
        <div class="flex items-center gap-2">
          <button id="kiroVoiceToggle" class="text-cyan-400 hover:text-white p-1" title="Voice Synthesis Enabled (Click to Mute)">
            <i class="bi bi-volume-up-fill" id="kiroVoiceIcon"></i>
          </button>
          <button id="kiroCloseBubble" class="text-slate-400 hover:text-white p-1" title="Minimize Speech">
            <i class="bi bi-dash-lg"></i>
          </button>
        </div>
      </div>

      <p id="kiroBotSpeechText" class="text-slate-200 text-xs leading-relaxed min-h-[44px]">
        {{ $s('kirobot_greeting') }}
      </p>

      <!-- Quick Action Pills -->
      <div class="mt-3 pt-2.5 border-t border-white/10 flex flex-wrap gap-1.5 items-center">
        <span class="px-2 py-0.5 rounded bg-cyan-500/10 border border-cyan-500/25 text-[10px] font-mono text-cyan-300">💡 Click anything to inspect!</span>
        <button onclick="window.kiroBotSpeak('architecture')" class="px-2 py-0.5 rounded bg-white/5 hover:bg-white/10 border border-white/10 text-[10px] font-mono text-cyan-300">
          Explain Architecture
        </button>
        <button onclick="window.kiroBotSpeak('hire')" class="px-2 py-0.5 rounded bg-white/5 hover:bg-white/10 border border-white/10 text-[10px] font-mono text-indigo-300">
          Why Hire {{ $brandName }}?
        </button>
        <button onclick="window.kiroBotSpeak('stack')" class="px-2 py-0.5 rounded bg-white/5 hover:bg-white/10 border border-white/10 text-[10px] font-mono text-emerald-300">
          Summarize Skills
        </button>
      </div>
    </div>

    <!-- Floating Cyber Robot Avatar (SVG) -->
    <button id="kiroBotAvatarBtn" class="kirobot-avatar-button" title="Summon KiroBot Assistant">
      <svg class="w-10 h-10" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
        <!-- Robot Antenna -->
        <line x1="50" y1="20" x2="50" y2="10" stroke="#06b6d4" stroke-width="3" stroke-linecap="round"/>
        <circle cx="50" cy="8" r="4" fill="#06b6d4" class="animate-ping"/>
        <!-- Robot Head -->
        <rect x="22" y="20" width="56" height="48" rx="12" fill="#1e293b" stroke="#06b6d4" stroke-width="3"/>
        <!-- Cyber Visor -->
        <rect x="30" y="32" width="40" height="16" rx="6" fill="#0a0d14" stroke="#6366f1" stroke-width="2"/>
        <!-- Glowing Ocular Eyes -->
        <circle cx="40" cy="40" r="4" fill="#06b6d4">
          <animate attributeName="opacity" values="1;0.3;1" dur="2s" repeatCount="indefinite"/>
        </circle>
        <circle cx="60" cy="40" r="4" fill="#06b6d4">
          <animate attributeName="opacity" values="1;0.3;1" dur="2s" repeatCount="indefinite"/>
        </circle>
        <!-- Audio Grid Mouth -->
        <line x1="38" y1="56" x2="62" y2="56" stroke="#10b981" stroke-width="2" stroke-linecap="round"/>
        <!-- Head Bolts -->
        <rect x="18" y="38" width="4" height="12" rx="2" fill="#6366f1"/>
        <rect x="78" y="38" width="4" height="12" rx="2" fill="#6366f1"/>
      </svg>
    </button>

  </div>
  @endif

  <!-- =========================================================================
       VANILLA JAVASCRIPT LOGIC (KiroBot, Text Selection, Scroll Radar)
       ========================================================================= -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Dynamic Year in Footer
      document.getElementById('currentYear').textContent = new Date().getFullYear();

      // Mouse Spotlight Tracking
      const spotlight = document.getElementById('cursorSpotlight');
      if (spotlight && window.matchMedia('(pointer: fine)').matches) {
        window.addEventListener('mousemove', (e) => {
          spotlight.style.transform = `translate(${e.clientX}px, ${e.clientY}px) translate(-50%, -50%)`;
        });
      }

      // =========================================================================
      // THEME CONTROLLER (LIGHT / DARK 4K MODE)
      // =========================================================================
      const themeToggleBtn = document.getElementById('themeToggleBtn');
      const themeIcon = document.getElementById('themeIcon');

      function applyTheme(theme) {
        if (theme === 'light') {
          document.documentElement.classList.add('light');
          document.documentElement.classList.remove('dark');
          document.documentElement.setAttribute('data-theme', 'light');
          if (themeIcon) {
            themeIcon.className = 'bi bi-sun-fill text-amber-500';
          }
        } else {
          document.documentElement.classList.add('dark');
          document.documentElement.classList.remove('light');
          document.documentElement.setAttribute('data-theme', 'dark');
          if (themeIcon) {
            themeIcon.className = 'bi bi-moon-stars-fill text-sky-400';
          }
        }
      }

      // Sync initial state on load
      const initialTheme = document.documentElement.classList.contains('light') ? 'light' : 'dark';
      applyTheme(initialTheme);

      if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
          const isLight = document.documentElement.classList.contains('light');
          const nextTheme = isLight ? 'dark' : 'light';
          applyTheme(nextTheme);
          try {
            localStorage.setItem('ks_portfolio_theme', nextTheme);
          } catch (e) {}
        });
      }

      // =========================================================================
      // MOBILE DRAWER NAVIGATION CONTROLLER
      // =========================================================================
      const mobileNavToggleBtn = document.getElementById('mobileNavToggleBtn');
      const mobileNavCloseBtn = document.getElementById('mobileNavCloseBtn');
      const mobileNavDrawer = document.getElementById('mobileNavDrawer');
      const mobileDrawerPanel = document.getElementById('mobileDrawerPanel');
      const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');

      window.openMobileDrawer = function() {
        if (!mobileNavDrawer || !mobileDrawerPanel) return;
        const kiroBubble = document.getElementById('kiroSpeechBubble');
        if (kiroBubble) kiroBubble.classList.add('hidden-bubble');
        mobileNavDrawer.classList.remove('opacity-0', 'pointer-events-none');
        mobileDrawerPanel.classList.remove('translate-x-full');
        document.body.style.overflow = 'hidden';
      };

      window.closeMobileDrawer = function() {
        if (!mobileNavDrawer || !mobileDrawerPanel) return;
        mobileNavDrawer.classList.add('opacity-0', 'pointer-events-none');
        mobileDrawerPanel.classList.add('translate-x-full');
        document.body.style.overflow = '';
      };

      if (mobileNavToggleBtn) mobileNavToggleBtn.addEventListener('click', window.openMobileDrawer);
      if (mobileNavCloseBtn) mobileNavCloseBtn.addEventListener('click', window.closeMobileDrawer);
      if (mobileNavDrawer) {
        mobileNavDrawer.addEventListener('click', (e) => {
          if (e.target === mobileNavDrawer) window.closeMobileDrawer();
        });
      }
      mobileNavLinks.forEach(link => {
        link.addEventListener('click', window.closeMobileDrawer);
      });

      // =====================================================================
      // KIROBOT AI COMPANION ENGINE (AUTONOMOUS PATROL & CLICK-TO-EXPLAIN)
      // =====================================================================
      const robotWidget = document.getElementById('kiroBotWidget');
      const bubble = document.getElementById('kiroSpeechBubble');
      const speechText = document.getElementById('kiroBotSpeechText');
      const modeTag = document.getElementById('kiroBotModeTag');
      const avatarBtn = document.getElementById('kiroBotAvatarBtn');
      const closeBtn = document.getElementById('kiroCloseBubble');
      const voiceToggle = document.getElementById('kiroVoiceToggle');
      const voiceIcon = document.getElementById('kiroVoiceIcon');
      const selectionPill = document.getElementById('selectionExplainPill');

      // Requirement 1: Voice Enabled By Default
      let voiceEnabled = true;
      let typingInterval = null;
      let audioUnlocked = false;
      let cachedVoices = [];

      function populateVoices() {
        if ('speechSynthesis' in window) {
          cachedVoices = window.speechSynthesis.getVoices();
        }
      }
      populateVoices();
      if ('speechSynthesis' in window && window.speechSynthesis.onvoiceschanged !== undefined) {
        window.speechSynthesis.onvoiceschanged = populateVoices;
      }

      // Autoplay Audio Unlocker (Unlocks Web Speech on first user interaction)
      function unlockAudio() {
        if (audioUnlocked) return;
        audioUnlocked = true;
        if ('speechSynthesis' in window) {
          try {
            window.speechSynthesis.resume();
          } catch(e) {}
        }
        ['click', 'touchstart', 'keydown', 'scroll'].forEach(evt => {
          document.removeEventListener(evt, unlockAudio);
        });
      }
      ['click', 'touchstart', 'keydown', 'scroll'].forEach(evt => {
        document.addEventListener(evt, unlockAudio, { passive: true, once: true });
      });

      // Voice Player using Web Speech API
      function speakText(text) {
        if (!voiceEnabled || !('speechSynthesis' in window)) return;
        try {
          window.speechSynthesis.resume();
          window.speechSynthesis.cancel();

          const clean = text
            .replace(/https?:\/\/[^\s]+/g, '')
            .replace(/[*#`_~[\]()]/g, '')
            .replace(/[<>{}]/g, '')
            .replace(/\b50ms\b/gi, '50 milliseconds')
            .replace(/\b200h\b/gi, '200 hours')
            .replace(/\bDEPI\b/g, 'D-E-P-I')
            .replace(/\bNTI\b/g, 'N-T-I')
            .replace(/\bCQRS\b/g, 'C-Q-R-S')
            .replace(/\bSQL\b/gi, 'Sequel')
            .replace(/\bAPI\b/gi, 'A-P-I')
            .replace(/\bAPIs\b/gi, 'A-P-Is')
            .replace(/\bVPS\b/g, 'V-P-S')
            .replace(/\bCI\/CD\b/gi, 'C-I C-D')
            .replace(/\bOTP\b/g, 'O-T-P')
            .replace(/\bEF Core\b/gi, 'Entity Framework Core')
            .trim();
          if (!clean) return;

          const utterance = new SpeechSynthesisUtterance(clean);
          utterance.rate = 1.02;
          utterance.pitch = 1.0;
          utterance.lang = 'en-US';

          const voices = cachedVoices.length ? cachedVoices : window.speechSynthesis.getVoices();
          const enVoice = voices.find(v => v.lang.startsWith('en') && (v.name.includes('Natural') || v.name.includes('Google') || v.name.includes('David') || v.name.includes('Alex') || v.name.includes('George')));
          if (enVoice) utterance.voice = enVoice;

          window.speechSynthesis.speak(utterance);
        } catch (err) {
          console.warn('Speech synthesis warning:', err);
        }
      }

      // Typewriter & Audio Synchronizer
      function typewriteText(text, tag = 'SCROLL RADAR') {
        modeTag.textContent = tag;
        bubble.classList.remove('hidden-bubble');
        clearInterval(typingInterval);

        // Speak aloud immediately as text streams
        speakText(text);

        speechText.textContent = '';
        let index = 0;
        typingInterval = setInterval(() => {
          if (index < text.length) {
            speechText.textContent += text.charAt(index);
            index++;
          } else {
            clearInterval(typingInterval);
          }
        }, 14);
      }

      // Voice Toggle Button
      if (voiceToggle) {
        voiceToggle.addEventListener('click', (e) => {
          e.stopPropagation();
          voiceEnabled = !voiceEnabled;
          if (voiceEnabled) {
            voiceIcon.className = 'bi bi-volume-up-fill text-cyan-400';
            voiceToggle.title = 'Voice Synthesis Enabled (Click to Mute)';
            typewriteText('Voice synthesis activated! I will explain architectural insights aloud.', 'AUDIO ENABLED');
          } else {
            voiceIcon.className = 'bi bi-volume-mute-fill text-slate-400';
            voiceToggle.title = 'Voice Synthesis Muted (Click to Enable)';
            if ('speechSynthesis' in window) window.speechSynthesis.cancel();
          }
        });
      }

      // =========================================================================
      // DYNAMIC HORIZONTAL SPACE-AWARE PATROL & INTERACTION
      // =========================================================================
      let robotPosX = window.innerWidth - 88;
      let patrolDirection = -1; // -1 = left, 1 = right
      let isPatrolling = true;
      let isDragging = false;
      let hasDragged = false;
      let dragStartX = 0;
      let dragInitialPosX = 0;

      function getHorizontalBounds() {
        const screenW = window.innerWidth;
        const margin = screenW < 640 ? 12 : 24;
        const robotW = 64;
        const minX = margin;
        const maxX = Math.max(minX, screenW - robotW - margin);
        return { minX, maxX, screenW };
      }

      function updateRobotPosition(targetX, smooth = true) {
        if (!robotWidget) return;
        const { minX, maxX, screenW } = getHorizontalBounds();
        robotPosX = Math.max(minX, Math.min(maxX, targetX));

        robotWidget.style.left = `${robotPosX}px`;
        robotWidget.style.right = 'auto';

        if (smooth) {
          robotWidget.style.transition = 'left 0.9s cubic-bezier(0.25, 1, 0.5, 1)';
        } else {
          robotWidget.style.transition = 'none';
        }

        // Align bubble to prevent clipping (Left vs Right side of screen)
        if (robotPosX < screenW / 2) {
          robotWidget.classList.add('dock-left');
          robotWidget.classList.remove('dock-right');
        } else {
          robotWidget.classList.add('dock-right');
          robotWidget.classList.remove('dock-left');
        }
      }

      // Set initial position & orientation
      const initBounds = getHorizontalBounds();
      updateRobotPosition(initBounds.maxX, false);
      if (avatarBtn) {
        avatarBtn.classList.add('moving-left');
      }

      // Autonomous horizontal patrol loop
      function stepPatrol() {
        if (!isPatrolling || isDragging) return;
        const { minX, maxX } = getHorizontalBounds();
        const availableSpace = maxX - minX;
        if (availableSpace < 40) return;

        const step = Math.min(220, Math.max(90, availableSpace * 0.24));
        let nextX = robotPosX + (patrolDirection * step);

        if (nextX >= maxX) {
          nextX = maxX;
          patrolDirection = -1;
        } else if (nextX <= minX) {
          nextX = minX;
          patrolDirection = 1;
        }

        if (avatarBtn) {
          if (patrolDirection === -1) {
            avatarBtn.classList.remove('moving-right');
            avatarBtn.classList.add('moving-left');
          } else {
            avatarBtn.classList.remove('moving-left');
            avatarBtn.classList.add('moving-right');
          }
        }

        updateRobotPosition(nextX, true);
      }

      // Run patrol step every 4.2s
      const patrolInterval = setInterval(stepPatrol, 4200);

      // Pause patrol when hovering
      if (robotWidget) {
        robotWidget.addEventListener('mouseenter', () => { isPatrolling = false; });
        robotWidget.addEventListener('mouseleave', () => { isPatrolling = true; });
      }

      // Mouse & Touch Dragging
      if (avatarBtn) {
        avatarBtn.addEventListener('mousedown', (e) => {
          if (e.button !== 0) return;
          isDragging = true;
          hasDragged = false;
          dragStartX = e.clientX;
          dragInitialPosX = robotPosX;
          robotWidget.style.transition = 'none';
        });

        window.addEventListener('mousemove', (e) => {
          if (!isDragging) return;
          const delta = e.clientX - dragStartX;
          if (Math.abs(delta) > 4) hasDragged = true;
          updateRobotPosition(dragInitialPosX + delta, false);
        });

        window.addEventListener('mouseup', () => {
          if (isDragging) {
            isDragging = false;
            robotWidget.style.transition = 'left 0.9s cubic-bezier(0.25, 1, 0.5, 1)';
            setTimeout(() => { hasDragged = false; }, 80);
          }
        });

        // Touch handlers for mobile
        avatarBtn.addEventListener('touchstart', (e) => {
          const t = e.touches[0];
          isDragging = true;
          hasDragged = false;
          dragStartX = t.clientX;
          dragInitialPosX = robotPosX;
          robotWidget.style.transition = 'none';
        }, { passive: true });

        window.addEventListener('touchmove', (e) => {
          if (!isDragging) return;
          const t = e.touches[0];
          const delta = t.clientX - dragStartX;
          if (Math.abs(delta) > 4) hasDragged = true;
          updateRobotPosition(dragInitialPosX + delta, false);
        }, { passive: true });

        window.addEventListener('touchend', () => {
          if (isDragging) {
            isDragging = false;
            robotWidget.style.transition = 'left 0.9s cubic-bezier(0.25, 1, 0.5, 1)';
            setTimeout(() => { hasDragged = false; }, 80);
          }
        });

        // Click on Avatar to toggle bubble (if not dragged)
        avatarBtn.addEventListener('click', () => {
          if (!hasDragged) {
            bubble.classList.toggle('hidden-bubble');
          }
        });
      }

      if (closeBtn) {
        closeBtn.addEventListener('click', (e) => {
          e.stopPropagation();
          bubble.classList.add('hidden-bubble');
          if ('speechSynthesis' in window) window.speechSynthesis.cancel();
        });
      }

      // Screen resize recalculates position
      window.addEventListener('resize', () => {
        updateRobotPosition(robotPosX, false);
      });

      // =========================================================================
      // KNOWLEDGE BASE & QUICK ACTION PROMPTS
      // =========================================================================
      window.kiroBotSpeak = (topic) => {
        if (topic === 'architecture') {
          typewriteText("Kirollos enforces Clean Architecture & SOLID: Domain Entities are strictly isolated from Application CQRS handlers and Infrastructure repositories, guaranteeing testability and zero vendor lock-in.", "ARCHITECTURE EXPLAINER");
        } else if (topic === 'hire') {
          typewriteText("Kirollos is a dual specialist in .NET Core Web APIs and Laravel. He holds HackerRank SQL Advanced certification, 200h DEPI training, and builds sub-50ms fault-tolerant systems.", "WHY HIRE KIROLLOS?");
        } else if (topic === 'stack') {
          typewriteText("Core Stack: C#, ASP.NET Core Web API, Entity Framework Core, SQL Server, Redis, Laravel, Hostinger VPS, cPanel, CI/CD, Automated Testing, Zero-Downtime Deployment, and Paymob/Fawaterak Gateways.", "TECH STACK");
        }
      };

      const sectionExplanations = @json($sectionExplanations);

      let currentSection = '';
      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const id = entry.target.getAttribute('id');
            if (id && id !== currentSection && sectionExplanations[id]) {
              currentSection = id;
              typewriteText(sectionExplanations[id], `RADAR: ${id.toUpperCase()}`);
            }
          }
        });
      }, { threshold: 0.35 });

      document.querySelectorAll('section[id]').forEach((sec) => observer.observe(sec));

      const knowledgeBase = @json($knowledgeBase);

      // =========================================================================
      // REQUIREMENT 3: CLICK-TO-EXPLAIN ANYTHING ON THE SITE
      // =========================================================================
      function resolveElementContext(el) {
        if (!el || el === document.body || el === document.documentElement) return null;

        // 1. Explicit data-explain attribute
        const explicitEl = el.closest('[data-explain]');
        if (explicitEl) {
          return {
            topic: explicitEl.getAttribute('data-explain-title') || 'FEATURE',
            text: explicitEl.getAttribute('data-explain')
          };
        }

        // 2. Theme Switcher
        if (el.closest('#themeToggleBtn, [onclick*="toggleTheme"]')) {
          return {
            topic: '4K THEME ENGINE',
            text: 'Display Settings: Toggle seamlessly between Ultra-High Definition 4K Dark Mode and Crisp Light Mode for optimal viewing comfort.'
          };
        }

        // 3. Contact & Direct Communication Actions
        if (el.closest('a[download*="Resume"], [onclick*="Resume"]')) return { topic: 'RESUME DOWNLOAD', text: knowledgeBase['resume'] };
        if (el.closest('button[onclick*="navigator.clipboard.writeText"], a[href^="mailto:"]')) return { topic: 'DIRECT EMAIL', text: knowledgeBase['email'] };
        if (el.closest('a[href*="wa.me"]')) return { topic: 'WHATSAPP DIRECT', text: knowledgeBase['whatsapp'] };
        if (el.closest('a[href*="linkedin.com"]')) return { topic: 'LINKEDIN', text: knowledgeBase['linkedin'] };
        if (el.closest('a[href*="github.com"]')) return { topic: 'GITHUB', text: knowledgeBase['github'] };

        // 4. Hero Portrait & Availability Badge
        if (el.closest('#heroPortraitImg, .profile-portrait, img[src*="KirollosSamy"]')) {
          return {
            topic: 'KIROLLOS SAMY',
            text: 'Kirollos Samy: Full Stack Developer & Backend Software Engineer specializing in high-throughput .NET Core Web APIs and modular Laravel architectures.'
          };
        }
        if (el.closest('.availability-badge, [class*="status"]')) {
          return { topic: 'AVAILABILITY', text: knowledgeBase['availability'] };
        }

        // 5. Project Filter Tabs & Pagination
        const filterBtn = el.closest('button[data-filter], .filter-btn');
        if (filterBtn) {
          const filterName = (filterBtn.innerText || filterBtn.textContent || '').trim();
          return {
            topic: 'PROJECT FILTER',
            text: `Project Filter: Displaying projects engineered with ${filterName}. Kirollos specializes in multi-framework enterprise engineering across .NET Core and Laravel.`
          };
        }
        if (el.closest('#projectPagination, .pagination-btn, .page-btn')) {
          return {
            topic: 'PROJECT ARCHIVE',
            text: 'Project Pagination: Navigating through Kirollos Samy\'s portfolio of production-grade and enterprise backend architectures.'
          };
        }

        // 6. Direct Tech Badge / Skill Keyword clicks (checks badge before card)
        const badgeEl = el.closest('.tech-pill, .skill-chip, [class*="badge"], code');
        if (badgeEl) {
          const badgeText = (badgeEl.innerText || badgeEl.textContent || '').trim().toLowerCase();
          for (const [key, value] of Object.entries(knowledgeBase)) {
            if (badgeText === key || badgeText.includes(key)) {
              return { topic: key.toUpperCase(), text: value };
            }
          }
        }

        // 7. Project Cards
        const projectCard = el.closest('article.glass-card, [onclick*="openProjectModal"]');
        if (projectCard) {
          const titleEl = projectCard.querySelector('h3');
          const title = titleEl ? titleEl.textContent.trim() : 'Project Showcase';
          const descEl = projectCard.querySelector('p');
          const desc = descEl ? descEl.textContent.trim() : '';
          return {
            topic: title.slice(0, 24),
            text: `Project Architecture: ${title}. ${desc}`
          };
        }

        // 8. Architecture Pillars
        const pillarCard = el.closest('#architecture .glass-card');
        if (pillarCard) {
          const titleEl = pillarCard.querySelector('h3');
          const title = titleEl ? titleEl.textContent.trim() : 'Architecture Pillar';
          const descEl = pillarCard.querySelector('p');
          const desc = descEl ? descEl.textContent.trim() : '';
          return {
            topic: title.slice(0, 24),
            text: `Architectural Principle: ${title}. ${desc}`
          };
        }

        // 9. Certificates & Diplomas
        const certCard = el.closest('#credentials .glass-card, [onclick*="openCertificateModal"]');
        if (certCard) {
          const titleEl = certCard.querySelector('h3');
          const title = titleEl ? titleEl.textContent.trim() : 'Verified Credential';
          const descEl = certCard.querySelector('p');
          const desc = descEl ? descEl.textContent.trim() : '';
          return {
            topic: title.slice(0, 24),
            text: `Verified Accreditation: ${title}. ${desc}`
          };
        }

        // 10. Testimonial & Mentorship Endorsements
        const testimonialCard = el.closest('#testimonials .glass-card');
        if (testimonialCard) {
          const nameEl = testimonialCard.querySelector('h4');
          const name = nameEl ? nameEl.textContent.trim() : 'Technical Mentor';
          const quoteEl = testimonialCard.querySelector('p.italic');
          const quote = quoteEl ? quoteEl.textContent.trim() : '';
          return {
            topic: `ENDORSEMENT: ${name}`,
            text: `Mentorship Endorsement from ${name}: "${quote}". Demonstrates Kirollos's top-student standing and engineering mastery.`
          };
        }

        // 11. Keyword matching from text
        const textContent = (el.innerText || el.textContent || '').trim().toLowerCase();
        for (const [key, value] of Object.entries(knowledgeBase)) {
          if (textContent.includes(key)) {
            return { topic: key.toUpperCase(), text: value };
          }
        }

        // 12. General fallback for headings or paragraphs
        const heading = el.closest('h1, h2, h3, h4, h5, h6, p, li, span, button, a');
        if (heading) {
          const clean = (heading.innerText || heading.textContent || '').trim().replace(/\s+/g, ' ');
          if (clean.length > 3 && clean.length < 180) {
            return {
              topic: clean.slice(0, 24),
              text: `Regarding "${clean}": This is an integral component in Kirollos Samy's backend architecture and engineering methodology, built for high performance and reliability.`
            };
          }
        }

        return null;
      }

      // Global Click-To-Explain Listener
      document.addEventListener('click', (e) => {
        // Ignore clicks inside KiroBot widget itself or selection pill
        if (e.target.closest('#kiroBotWidget') || e.target.closest('#selectionExplainPill')) return;

        // Ignore clicks inside form inputs so user can type freely
        if (e.target.closest('input, textarea, select')) return;

        const info = resolveElementContext(e.target);
        if (info) {
          // Momentary cyber highlight on the clicked element
          const highlightEl = e.target.closest('.glass-card, button, a, span, p, h1, h2, h3, h4, h5, h6, li, img') || e.target;
          highlightEl.classList.add('kiro-inspect-highlight');
          setTimeout(() => highlightEl.classList.remove('kiro-inspect-highlight'), 2000);

          // Space-aware positioning: glide robot to opposite horizontal side so speech bubble doesn't block element
          const rect = highlightEl.getBoundingClientRect();
          const targetCenter = rect.left + rect.width / 2;
          const { minX, maxX, screenW } = getHorizontalBounds();
          const desiredX = targetCenter < screenW / 2 ? maxX - 12 : minX + 12;
          updateRobotPosition(desiredX, true);

          // Typewrite & Speak Aloud immediately!
          typewriteText(info.text, `EXPLAINING: ${info.topic.toUpperCase()}`);
        }
      });

      // =========================================================================
      // 3. DIRECT CONTACT FORM ENGINE (ZERO OTP - INSTANT DELIVERY)
      // =========================================================================
      const contactForm = document.getElementById('contactForm');
      const contactFormStatus = document.getElementById('contactFormStatus');
      const btnSubmitContact = document.getElementById('btnSubmitContact');
      const btnSubmitContactText = document.getElementById('btnSubmitContactText');

      function getCsrfToken() {
        const meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
      }

      if (contactForm) {
        contactForm.addEventListener('submit', async (e) => {
          e.preventDefault();

          const name = document.getElementById('contactName').value.trim();
          const email = document.getElementById('contactEmail').value.trim();
          const subject = document.getElementById('contactSubject').value.trim();
          const message = document.getElementById('contactMessage').value.trim();

          if (!name || !email || !subject || !message) {
            contactFormStatus.className = 'p-4 rounded-xl text-sm font-medium bg-rose-500/15 border border-rose-500/30 text-rose-300 flex items-center gap-2';
            contactFormStatus.innerHTML = `<i class="bi bi-exclamation-circle-fill"></i> <span>Please fill in all required fields.</span>`;
            contactFormStatus.classList.remove('hidden');
            return;
          }

          btnSubmitContact.disabled = true;
          btnSubmitContactText.innerHTML = '<span class="inline-block animate-spin mr-2"><i class="bi bi-arrow-repeat"></i></span> Transmitting Message...';
          contactFormStatus.className = 'hidden';

          try {
            const res = await fetch("{{ route('contact.submit') }}", {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json'
              },
              body: JSON.stringify({ name, email, subject, message })
            });

            const data = await res.json();

            if (res.ok && data.success) {
              contactForm.reset();
              contactFormStatus.className = 'p-5 rounded-2xl text-sm font-medium bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 space-y-3.5';
              contactFormStatus.innerHTML = `
                <div class="flex items-center gap-2.5 font-semibold text-emerald-200">
                  <i class="bi bi-check-circle-fill text-xl text-emerald-400 flex-shrink-0"></i>
                  <span>${data.message || 'Your message has been delivered directly to Kirollos Samy!'}</span>
                </div>
                ${data.whatsapp_url ? `
                  <div class="pt-3 border-t border-emerald-500/20 flex flex-wrap items-center justify-between gap-3">
                    <span class="text-xs font-mono text-emerald-300/80">Need an instant response?</span>
                    <a href="${data.whatsapp_url}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-mono text-xs font-bold transition-all shadow-lg shadow-emerald-950/40">
                      <i class="bi bi-whatsapp text-sm"></i>
                      <span>Chat on WhatsApp</span>
                    </a>
                  </div>
                ` : ''}
              `;
              contactFormStatus.classList.remove('hidden');

              if (typeof window.typewriteText === 'function') {
                typewriteText("Transmission complete! Your message has been sent directly to Kirollos Samy's inbox.", "MESSAGE DELIVERED");
              }
            } else {
              contactFormStatus.className = 'p-4 rounded-xl text-sm font-medium bg-rose-500/15 border border-rose-500/30 text-rose-300 flex items-center gap-2';
              contactFormStatus.innerHTML = `<i class="bi bi-exclamation-circle-fill"></i> <span>${data.message || 'Failed to dispatch message. Please try again or reach out on WhatsApp.'}</span>`;
              contactFormStatus.classList.remove('hidden');
            }
          } catch (err) {
            contactFormStatus.className = 'p-4 rounded-xl text-sm font-medium bg-rose-500/15 border border-rose-500/30 text-rose-300 flex items-center gap-2';
            contactFormStatus.innerHTML = `<i class="bi bi-exclamation-circle-fill"></i> <span>Connection error. Please check your network or message Kirollos directly via WhatsApp.</span>`;
            contactFormStatus.classList.remove('hidden');
          } finally {
            btnSubmitContact.disabled = false;
            btnSubmitContactText.textContent = 'Send Message Directly';
          }
        });
      }

      document.addEventListener('mouseup', (e) => {
        const selection = window.getSelection().toString().trim();
        if (selection.length > 2 && selection.length < 80) {
          const rect = window.getSelection().getRangeAt(0).getBoundingClientRect();
          selectionPill.style.left = `${rect.left + rect.width / 2 + window.scrollX}px`;
          selectionPill.style.top = `${rect.top + window.scrollY}px`;
          selectionPill.style.display = 'inline-flex';
          selectionPill.onclick = () => {
            explainText(selection);
            selectionPill.style.display = 'none';
          };
        } else {
          selectionPill.style.display = 'none';
        }
      });

      function explainText(selectedText) {
        const lower = selectedText.toLowerCase();
        let matchedExplanation = null;

        for (const [key, value] of Object.entries(knowledgeBase)) {
          if (lower.includes(key)) {
            matchedExplanation = value;
            break;
          }
        }

        if (!matchedExplanation) {
          matchedExplanation = `Analyzing "${selectedText}": In Kirollos's backend architecture, this is an integral component ensuring high data integrity, reliability, and low-latency API throughput.`;
        }

        typewriteText(matchedExplanation, `EXPLAINING: "${selectedText.slice(0, 18)}..."`);
      }

      // =========================================================================
      // 4. CERTIFICATES LIGHTBOX VIEWER
      // =========================================================================
      const certificatesData = @json($certificatesPayload);

      const certModal = document.getElementById('certificateLightboxModal');
      const certImg = document.getElementById('certLightboxImage');
      const certTitle = document.getElementById('certLightboxTitle');
      const certIssuer = document.getElementById('certLightboxIssuer');
      const certBadge = document.getElementById('certLightboxBadge');
      const certOpenTab = document.getElementById('certLightboxOpenTab');
      const certDownload = document.getElementById('certLightboxDownloadPdf');

      window.openCertificateModal = function(certId) {
        const cert = certificatesData[certId];
        if (!cert || !certModal) return;

        certImg.src = cert.image;
        certTitle.textContent = cert.title;
        certIssuer.textContent = cert.issuer;
        certBadge.textContent = cert.badge;
        certBadge.className = `px-2.5 py-1 rounded font-mono text-xs font-bold border ${cert.badgeClass}`;
        certOpenTab.href = cert.image;
        certDownload.href = cert.pdfUrl;

        certModal.classList.remove('opacity-0', 'pointer-events-none');
        const dialog = certModal.firstElementChild;
        if (dialog) dialog.classList.remove('scale-95');
      };

      window.closeCertificateModal = function() {
        if (!certModal) return;
        certModal.classList.add('opacity-0', 'pointer-events-none');
        const dialog = certModal.firstElementChild;
        if (dialog) dialog.classList.add('scale-95');
      };

      if (certModal) {
        certModal.addEventListener('click', (e) => {
          if (e.target === certModal) window.closeCertificateModal();
        });
      }

      // =========================================================================
      // 5. PROJECTS DATASET, DUAL-FILTERING & PAGINATION ENGINE
      // =========================================================================
      const projectsData = @json($projectsPayload);

      // Filtering & Pagination State
      let selectedFramework = 'all';
      let selectedArch = 'all';
      let currentProjectPage = 1;
      const projectsPerPage = 4;

      const projectsContainer = document.getElementById('projectsContainer');
      const projectsEmptyState = document.getElementById('projectsEmptyState');
      const projectCountDisplay = document.getElementById('projectCountDisplay');
      const projectTotalDisplay = document.getElementById('projectTotalDisplay');
      const activeFilterBadge = document.getElementById('activeFilterBadge');
      const btnResetFilters = document.getElementById('btnResetFilters');
      const paginationPills = document.getElementById('paginationPills');
      const btnPrevPage = document.getElementById('btnPrevPage');
      const btnNextPage = document.getElementById('btnNextPage');

      function getFilteredProjects() {
        return projectsData.filter(p => {
          const matchFramework = (selectedFramework === 'all') || (p.framework === selectedFramework);
          const matchArch = (selectedArch === 'all') || (p.arch === selectedArch);
          return matchFramework && matchArch;
        });
      }

      function renderProjects() {
        if (!projectsContainer) return;

        const filtered = getFilteredProjects();
        const total = filtered.length;
        const totalPages = Math.ceil(total / projectsPerPage) || 1;

        if (currentProjectPage > totalPages) currentProjectPage = totalPages;
        if (currentProjectPage < 1) currentProjectPage = 1;

        const startIndex = (currentProjectPage - 1) * projectsPerPage;
        const endIndex = startIndex + projectsPerPage;
        const visibleProjects = filtered.slice(startIndex, endIndex);

        // Update counts
        if (projectCountDisplay) projectCountDisplay.textContent = visibleProjects.length;
        if (projectTotalDisplay) projectTotalDisplay.textContent = total;

        // Active filter badge & reset button
        if (activeFilterBadge && btnResetFilters) {
          if (selectedFramework !== 'all' || selectedArch !== 'all') {
            const labels = [];
            if (selectedFramework !== 'all') labels.push(`Framework: ${selectedFramework.toUpperCase()}`);
            if (selectedArch !== 'all') labels.push(`Arch: ${selectedArch.toUpperCase()}`);
            activeFilterBadge.textContent = labels.join(' | ');
            activeFilterBadge.classList.remove('hidden');
            btnResetFilters.classList.remove('hidden');
            btnResetFilters.classList.add('inline-flex');
          } else {
            activeFilterBadge.classList.add('hidden');
            btnResetFilters.classList.add('hidden');
            btnResetFilters.classList.remove('inline-flex');
          }
        }

        // Empty state check
        if (total === 0) {
          projectsContainer.innerHTML = '';
          projectsContainer.classList.add('hidden');
          if (projectsEmptyState) projectsEmptyState.classList.remove('hidden');
          if (btnPrevPage) btnPrevPage.disabled = true;
          if (btnNextPage) btnNextPage.disabled = true;
          if (paginationPills) paginationPills.innerHTML = '';
          return;
        }

        projectsContainer.classList.remove('hidden');
        if (projectsEmptyState) projectsEmptyState.classList.add('hidden');

        // Render project cards
        projectsContainer.innerHTML = visibleProjects.map(p => {
          const techChips = p.techTags.map(tag => 
            `<span class="px-2 py-0.5 rounded bg-white/5 border border-white/10 text-cyan-300">${tag}</span>`
          ).join('');

          return `
            <article class="glass-card overflow-hidden flex flex-col group hover:border-cyan-400/40 transition-all duration-300">
              <div class="relative h-64 overflow-hidden bg-slate-900 cursor-pointer" onclick="openProjectModal('${p.id}')">
                <img src="${p.image}" alt="${p.title}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <span class="absolute top-3 left-3 px-2.5 py-1 rounded backdrop-blur-md font-mono text-[11px] ${p.badgeColor}">
                  ${p.badge}
                </span>
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                  <span class="text-xs font-mono text-cyan-300 flex items-center gap-1.5">
                    <i class="bi bi-eye-fill"></i> Click to inspect architecture
                  </span>
                </div>
              </div>

              <div class="p-8 flex flex-col flex-grow justify-between space-y-6">
                <div class="space-y-3">
                  <div class="flex flex-wrap gap-1.5 font-mono text-[11px]">
                    ${techChips}
                  </div>
                  <h3 class="text-2xl font-bold text-white group-hover:text-cyan-400 transition-colors cursor-pointer" onclick="openProjectModal('${p.id}')">
                    ${p.title}
                  </h3>
                  <p class="text-slate-300 text-sm leading-relaxed">
                    ${p.shortDesc}
                  </p>
                </div>

                <div class="space-y-4 pt-4 border-t border-white/10">
                  <!-- Dedicated Prominent View Project Button -->
                  <button type="button" onclick="openProjectModal('${p.id}')" class="btn-cyber-primary w-full justify-center !py-2.5 !text-xs !tracking-wider uppercase group/btn">
                    <i class="bi bi-eye-fill text-cyan-300 group-hover/btn:scale-110 transition-transform"></i>
                    <span>View Project Details</span>
                  </button>

                  <div class="flex items-center justify-between text-xs font-mono">
                    <a href="${p.demoUrl}" target="_blank" rel="noopener" class="text-cyan-400 hover:text-cyan-300 font-semibold inline-flex items-center gap-1.5 hover:underline">
                      <span>${p.demoLabel}</span>
                      <i class="bi bi-box-arrow-up-right"></i>
                    </a>
                    <a href="${p.githubUrl}" target="_blank" rel="noopener" class="text-slate-400 hover:text-white transition-colors flex items-center gap-1" title="View Source on GitHub">
                      <i class="bi bi-github text-lg"></i>
                      <span>GitHub</span>
                    </a>
                  </div>
                </div>
              </div>
            </article>
          `;
        }).join('');

        // Render Pagination Pills
        if (paginationPills) {
          paginationPills.innerHTML = '';
          for (let i = 1; i <= totalPages; i++) {
            const pill = document.createElement('button');
            pill.type = 'button';
            pill.textContent = i;
            pill.className = `page-pill-btn ${i === currentProjectPage ? 'active-page' : ''}`;
            pill.onclick = () => {
              currentProjectPage = i;
              renderProjects();
              scrollProjectsIntoView();
            };
            paginationPills.appendChild(pill);
          }
        }

        // Prev/Next buttons
        if (btnPrevPage) btnPrevPage.disabled = (currentProjectPage <= 1);
        if (btnNextPage) btnNextPage.disabled = (currentProjectPage >= totalPages);
      }

      function scrollProjectsIntoView() {
        const sec = document.getElementById('projects');
        if (sec) {
          sec.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      }

      // Framework Filter Buttons
      const frameworkBtns = document.querySelectorAll('[data-filter-type="framework"]');
      frameworkBtns.forEach(btn => {
        btn.addEventListener('click', () => {
          frameworkBtns.forEach(b => b.classList.remove('active-filter'));
          btn.classList.add('active-filter');
          selectedFramework = btn.getAttribute('data-filter-value') || 'all';
          currentProjectPage = 1;
          renderProjects();
        });
      });

      // Architecture Filter Buttons
      const archBtns = document.querySelectorAll('[data-filter-type="arch"]');
      archBtns.forEach(btn => {
        btn.addEventListener('click', () => {
          archBtns.forEach(b => b.classList.remove('active-filter'));
          btn.classList.add('active-filter');
          selectedArch = btn.getAttribute('data-filter-value') || 'all';
          currentProjectPage = 1;
          renderProjects();
        });
      });

      // Reset Filters
      window.resetProjectFilters = function() {
        selectedFramework = 'all';
        selectedArch = 'all';
        currentProjectPage = 1;

        frameworkBtns.forEach(b => {
          if (b.getAttribute('data-filter-value') === 'all') b.classList.add('active-filter');
          else b.classList.remove('active-filter');
        });

        archBtns.forEach(b => {
          if (b.getAttribute('data-filter-value') === 'all') b.classList.add('active-filter');
          else b.classList.remove('active-filter');
        });

        renderProjects();
      };

      // Pagination Controls
      if (btnPrevPage) {
        btnPrevPage.addEventListener('click', () => {
          if (currentProjectPage > 1) {
            currentProjectPage--;
            renderProjects();
            scrollProjectsIntoView();
          }
        });
      }

      if (btnNextPage) {
        btnNextPage.addEventListener('click', () => {
          const totalPages = Math.ceil(getFilteredProjects().length / projectsPerPage);
          if (currentProjectPage < totalPages) {
            currentProjectPage++;
            renderProjects();
            scrollProjectsIntoView();
          }
        });
      }

      // =========================================================================
      // 6. PROJECT DETAIL MODAL CONTROLLER
      // =========================================================================
      const projectModal = document.getElementById('projectDetailModal');
      const modalProjectBadge = document.getElementById('modalProjectBadge');
      const modalProjectFrameworkTag = document.getElementById('modalProjectFrameworkTag');
      const modalProjectArchTag = document.getElementById('modalProjectArchTag');
      const modalProjectTitle = document.getElementById('modalProjectTitle');
      const modalProjectImage = document.getElementById('modalProjectImage');
      const modalProjectDescription = document.getElementById('modalProjectDescription');
      const modalProjectHighlights = document.getElementById('modalProjectHighlights');
      const modalProjectGithubLink = document.getElementById('modalProjectGithubLink');
      const modalProjectDemoLink = document.getElementById('modalProjectDemoLink');

      window.openProjectModal = function(projectId) {
        const p = projectsData.find(item => item.id === projectId);
        if (!p || !projectModal) return;

        modalProjectBadge.textContent = p.badge;
        modalProjectBadge.className = `px-2.5 py-0.5 rounded font-mono text-[11px] font-bold ${p.badgeColor}`;
        modalProjectFrameworkTag.textContent = p.frameworkLabel;
        modalProjectArchTag.textContent = p.archLabel;
        modalProjectTitle.textContent = p.title;
        modalProjectImage.src = p.image;
        modalProjectImage.alt = p.title;
        modalProjectDescription.textContent = p.longDesc;

        modalProjectHighlights.innerHTML = p.highlights.map(h => 
          `<li class="flex items-start gap-2 p-2.5 rounded-lg bg-white/5 border border-white/5">
            <i class="bi bi-shield-check text-cyan-400 mt-0.5 flex-shrink-0"></i>
            <span>${h}</span>
          </li>`
        ).join('');

        modalProjectGithubLink.href = p.githubUrl;
        modalProjectDemoLink.href = p.demoUrl;
        modalProjectDemoLink.querySelector('span').textContent = p.demoLabel;

        projectModal.classList.remove('opacity-0', 'pointer-events-none');
        const dialog = projectModal.firstElementChild;
        if (dialog) dialog.classList.remove('scale-95');
      };

      window.closeProjectModal = function() {
        if (!projectModal) return;
        projectModal.classList.add('opacity-0', 'pointer-events-none');
        const dialog = projectModal.firstElementChild;
        if (dialog) dialog.classList.add('scale-95');
      };

      if (projectModal) {
        projectModal.addEventListener('click', (e) => {
          if (e.target === projectModal) window.closeProjectModal();
        });
      }

      // Global Escape Key Listener for all Modals & Mobile Drawer
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
          window.closeCertificateModal();
          window.closeProjectModal();
          if (typeof window.closeMobileDrawer === 'function') window.closeMobileDrawer();
        }
      });

      // Initial Project Render
      renderProjects();
    });
  </script>

</body>
</html>