<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=5.0" name="viewport">
  <title>Kirollos Samy Ishaq | Full-Stack Developer & Backend Engineer (.NET Core & Laravel)</title>
  
  <!-- SEO Meta Tags -->
  <meta name="description" content="Full-Stack Developer & Backend Engineer specializing in C#, .NET Core Web API, ASP.NET Core MVC, Laravel, Clean Architecture, SQL Server, Redis, and high-performance distributed systems.">
  <meta name="keywords" content="Kirollos Samy, Kirollos Samy Ishaq, Backend Engineer, Full Stack Developer, .NET Core, ASP.NET Core, C#, Laravel, PHP, Clean Architecture, SOLID Principles, SQL Server, Redis, Payment Gateways, Paymob, Fawaterak, RESTful API, Cairo Egypt">
  <meta name="author" content="Kirollos Samy Ishaq">
  <meta name="robots" content="index, follow">

  <!-- OpenGraph / Social Media Meta -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://kirollossamy.up.railway.app/">
  <meta property="og:title" content="Kirollos Samy Ishaq | Full-Stack Developer & Backend Engineer">
  <meta property="og:description" content="Building high-performance backend architecture, secure API systems, and scalable web solutions with .NET Core & Laravel.">
  <meta property="og:image" content="{{ asset('assets/img/profile/KirollosSamy.png') }}">

  <!-- Twitter Meta -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Kirollos Samy Ishaq | Full-Stack Developer & Backend Engineer">
  <meta name="twitter:description" content="Building high-performance backend architecture, secure API systems, and scalable web solutions with .NET Core & Laravel.">
  <meta name="twitter:image" content="{{ asset('assets/img/profile/KirollosSamy.png') }}">

  <!-- Favicon -->
  <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('assets/img/favicon.png') }}?v=2">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/apple-touch-icon.png') }}?v=2">
  <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}?v=2">

  <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

  <!-- Bootstrap Icons CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- 4K Cyber-Minimalism & Dark Glassmorphism CSS -->
  <link href="{{ asset('assets/css/cyber-glass.css') }}" rel="stylesheet">
  @yield('styles')
</head>

<body>
  <!-- Ambient Cyber Mesh & Background Spotlight -->
  <div class="cyber-bg" aria-hidden="true"></div>
  <div class="cursor-spotlight" aria-hidden="true"></div>

  <!-- Floating Glassmorphic Navbar -->
  <header class="cyber-nav-container">
    <nav class="cyber-nav">
      <a href="{{ url('/#hero') }}" class="nav-brand" aria-label="Kirollos Samy Ishaq">
        <div class="nav-brand-avatar-wrap">
          <img src="{{ asset('assets/img/profile/kirollos_nav_logo.png') }}" alt="Kirollos Samy" class="nav-brand-avatar">
          <span class="nav-status-dot"></span>
        </div>
        <div class="nav-brand-info">
          <span class="nav-brand-title">Kirollos Samy</span>
          <span class="nav-brand-sub">.NET & LARAVEL SPECIALIST</span>
        </div>
      </a>

      <ul class="nav-links">
        <li><a href="{{ url('/#about') }}" class="nav-link-item">About</a></li>
        <li><a href="{{ url('/#architecture') }}" class="nav-link-item">Architecture</a></li>
        <li><a href="{{ url('/#projects') }}" class="nav-link-item">Projects</a></li>
        <li><a href="{{ url('/#credentials') }}" class="nav-link-item">Credentials</a></li>
        <li><a href="{{ url('/#testimonials') }}" class="nav-link-item">Testimonials</a></li>
        <li><a href="{{ url('/#milestones') }}" class="nav-link-item">Milestones</a></li>
        <li><a href="{{ url('/#contact') }}" class="nav-link-item">Contact</a></li>
      </ul>

      <div class="nav-actions">
        <a href="{{ route('download.resume') }}" class="btn-cyber-primary btn-cyber-sm group" download="Kirollos_Samy_Resume.pdf">
          <i class="bi bi-cloud-arrow-down-fill text-cyan-300 group-hover:translate-y-0.5 transition-transform"></i>
          <span>Resume</span>
        </a>

        <button class="mobile-nav-toggle" aria-label="Toggle navigation drawer">
          <i class="bi bi-list"></i>
        </button>
      </div>
    </nav>
  </header>

  <!-- Mobile Navigation Drawer -->
  <div class="mobile-drawer-overlay"></div>
  <aside class="mobile-nav-drawer" aria-label="Mobile Navigation">
    <button class="mobile-drawer-close" aria-label="Close navigation drawer">
      <i class="bi bi-x-lg"></i>
    </button>

    <div style="margin-bottom: 2rem;">
      <span class="nav-brand-badge" style="width: 44px; height: 44px; margin-bottom: 0.75rem;">KS</span>
      <h3 style="font-size: 1.15rem; color: #fff;">Kirollos Samy Ishaq</h3>
      <p style="font-family: var(--font-mono); font-size: 0.75rem; color: var(--accent-cyan);">Full-Stack Developer & Backend Engineer</p>
    </div>

    <ul class="mobile-nav-links">
      <li><a href="{{ url('/#hero') }}">Home</a></li>
      <li><a href="{{ url('/#about') }}">About Engineer</a></li>
      <li><a href="{{ url('/#architecture') }}">Core Architecture</a></li>
      <li><a href="{{ url('/#projects') }}">Featured Projects</a></li>
      <li><a href="{{ url('/#credentials') }}">Certifications</a></li>
      <li><a href="{{ url('/#milestones') }}">Career Milestones</a></li>
      <li><a href="{{ url('/#testimonials') }}">Endorsements</a></li>
      <li><a href="{{ url('/#contact') }}">Contact & Inquiries</a></li>
    </ul>

    <div style="margin-top: auto; padding-top: 1.5rem; border-top: 1px solid var(--border-subtle);">
      <a href="{{ route('download.resume') }}" class="btn-cyber-primary group" style="width: 100%; justify-content: center;" download="Kirollos_Samy_Resume.pdf">
        <i class="bi bi-cloud-arrow-down-fill text-cyan-300 group-hover:translate-y-0.5 transition-transform"></i> Download Resume
      </a>
    </div>
  </aside>

  <!-- Main View Content -->
  <main>
    @yield('content')
  </main>

  <!-- Global Modals -->
  <!-- Project Architecture Specs Modal -->
  <div id="specModal" class="modal-cyber-backdrop" role="dialog" aria-modal="true" aria-labelledby="specModalTitle">
    <div class="modal-cyber-dialog">
      <div class="modal-cyber-header">
        <h3 id="specModalTitle" style="font-size: 1.2rem; color: #fff;">Architecture Specifications</h3>
        <button id="specModalClose" class="modal-close-btn" aria-label="Close modal">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
      <div id="specModalBody" class="modal-cyber-body">
        <!-- Injected via JavaScript -->
      </div>
    </div>
  </div>

  <!-- Certificate Preview Modal -->
  <div id="certModal" class="modal-cyber-backdrop" role="dialog" aria-modal="true" aria-labelledby="certModalTitle">
    <div class="modal-cyber-dialog" style="max-width: 780px;">
      <div class="modal-cyber-header">
        <h3 id="certModalTitle" style="font-size: 1.2rem; color: #fff;">Official Certificate Credential</h3>
        <button id="certModalClose" class="modal-close-btn" aria-label="Close modal">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
      <div class="modal-cyber-body" style="padding: 1.5rem; text-align: center;">
        <img id="certModalImg" src="" alt="Certificate Preview" style="width: 100%; max-height: 55vh; object-fit: contain; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid rgba(255,255,255,0.1);">
        <div style="display: flex; justify-content: center; gap: 1rem;">
          <a id="certModalDownload" href="" class="btn-cyber-primary" download>
            <i class="bi bi-download"></i> Download Verified PDF
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Modern Cyber Footer -->
  <footer class="cyber-footer">
    <div class="container-cyber">
      <div class="footer-top-grid">
        <div class="footer-brand">
          <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
            <span class="nav-brand-badge" style="width: 36px; height: 36px;">KS</span>
            <h3 style="margin: 0; color: #fff;">Kirollos Samy Ishaq</h3>
          </div>
          <p>
            Full-Stack Developer & Backend Engineer specializing in high-throughput .NET Core Web API & Laravel ecosystems, Clean Architecture, and database query optimization.
          </p>
          <div style="margin-top: 1.25rem; display: flex; gap: 0.75rem;">
            <a href="https://github.com/kirollossami" target="_blank" rel="noopener" class="btn-cyber-outline btn-cyber-sm" aria-label="GitHub">
              <i class="bi bi-github"></i>
            </a>
            <a href="https://www.linkedin.com/in/kirollossamy" target="_blank" rel="noopener" class="btn-cyber-outline btn-cyber-sm" aria-label="LinkedIn">
              <i class="bi bi-linkedin"></i>
            </a>
            <a href="https://wa.me/message/HEKWNGDE4LGHK1?src=qr" target="_blank" rel="noopener" class="btn-cyber-outline btn-cyber-sm" aria-label="WhatsApp">
              <i class="bi bi-whatsapp"></i>
            </a>
            <a href="mailto:kerollossami@gmail.com" class="btn-cyber-outline btn-cyber-sm" aria-label="Email">
              <i class="bi bi-envelope"></i>
            </a>
          </div>
        </div>

        <div class="footer-col">
          <h4>Architecture Pillars</h4>
          <ul class="footer-links-list">
            <li><a href="{{ url('/#architecture') }}">Clean Architecture & SOLID</a></li>
            <li><a href="{{ url('/#architecture') }}">RESTful API & JWT Auth</a></li>
            <li><a href="{{ url('/#architecture') }}">Payment Gateways (Paymob & Fawaterak)</a></li>
            <li><a href="{{ url('/#architecture') }}">SQL Server & Redis Caching</a></li>
            <li><a href="{{ url('/#architecture') }}">VPS & Nginx Deployment</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Navigation & Downloads</h4>
          <ul class="footer-links-list">
            <li><a href="{{ url('/#projects') }}">Featured Projects</a></li>
            <li><a href="{{ url('/#credentials') }}">HackerRank SQL Certifications</a></li>
            <li><a href="{{ url('/#milestones') }}">DEPI & NTI Milestones</a></li>
            <li><a href="{{ route('download.resume') }}">Download Resume (PDF)</a></li>
            <li><a href="{{ url('/#contact') }}">Get in Touch</a></li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom-bar">
        <p style="color: var(--text-muted); font-size: 0.85rem; margin: 0;">
          © {{ date('Y') }} <strong style="color: #fff;">Kirollos Samy Ishaq</strong>. Engineered with 4K Cyber-Minimalism & Dark Glassmorphism.
        </p>

        <div class="footer-telemetry">
          <div class="telemetry-item">
            <span class="telemetry-dot"></span>
            <span>SYSTEM HEALTH: 99.9%</span>
          </div>
          <div class="telemetry-item">
            <i class="bi bi-hdd-network" style="color: var(--accent-cyan);"></i>
            <span>LATENCY: <strong id="livePing" style="color: #38bdf8;">28ms</strong></span>
          </div>
          <div class="telemetry-item">
            <i class="bi bi-clock" style="color: var(--accent-indigo);"></i>
            <span id="cairoTime">00:00:00 EET</span>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Core JavaScript Engine -->
  <script src="{{ asset('assets/js/cyber-core.js') }}"></script>
  @yield('scripts')
</body>

</html>