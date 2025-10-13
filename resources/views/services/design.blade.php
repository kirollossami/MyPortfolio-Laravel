@extends('layout.master')

@section('content')
<header id="header" class="header dark-background d-flex flex-column justify-content-center">
    <i class="header-toggle d-xl-none bi bi-list"></i>

    <div class="header-container d-flex flex-column align-items-start">
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="http://127.0.0.1:8000/#hero" class="active"><i class="bi bi-house navicon"></i> Home</a></li>
          <li><a href="http://127.0.0.1:8000/#about"><i class="bi bi-person navicon"></i> About</a></li>
          <li><a href="http://127.0.0.1:8000/#resume"><i class="bi bi-file-earmark-text navicon"></i> Resume</a></li>
          <li><a href="http://127.0.0.1:8000/#portfolio"><i class="bi bi-images navicon"></i> Portfolio</a></li>
          <li><a href="http://127.0.0.1:8000/#services"><i class="bi bi-hdd-stack navicon"></i> Services</a></li>
          <li><a href="http://127.0.0.1:8000/#contact"><i class="bi bi-envelope navicon"></i> Contact</a></li>
        </ul>
      </nav>

      <div class="social-links text-center">
        <a href="https://www.instagram.com/kirollos.sami?igsh=MWF6MXRldmFoMTZqeg==" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="https://github.com/kirollossami" class="github"><i class="bi bi-github"></i></a>
        <a href="https://www.linkedin.com/in/kirollossamy" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>

    </div>

  </header>
<main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Design Systems</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="current">Design Systems</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Service Details Section -->
    <section id="service-details" class="service-details section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="service-details-slider swiper init-swiper">
              <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "speed": 600,
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": 1,
                  "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                  }
                }
              </script>
              <div class="swiper-wrapper align-items-center">
                <div class="swiper-slide">
                  <img src="{{ asset('assets/img/services/design-1.webp') }}" alt="Design Systems" class="img-fluid" loading="lazy">
                </div>
                <div class="swiper-slide">
                  <img src="{{ asset('assets/img/services/design-2.webp') }}" alt="UI Components" class="img-fluid" loading="lazy">
                </div>
                <div class="swiper-slide">
                  <img src="{{ asset('assets/img/services/design-3.webp') }}" alt="Consistency" class="img-fluid" loading="lazy">
                </div>
              </div>
              <div class="swiper-pagination"></div>
            </div>

            <div class="content mt-5">
              <h3>Consistent & Scalable Design Systems</h3>
              <p>
                I specialize in building <strong>design systems</strong> that ensure consistency, scalability, and efficiency across all your digital products.  
                From typography and colors to reusable components, everything is designed to reflect your brand identity.
              </p>
              <p>
                Leveraging tools like <strong>Figma, Bootstrap, Tailwind, and Laravel Blade</strong>, I deliver design systems that improve collaboration between developers and designers while making products more user-friendly.
              </p>

              <div class="features mt-4">
                <div class="row gy-4">
                  <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-box d-flex align-items-center">
                      <i class="bi bi-check"></i>
                      <h4>Reusable UI Components</h4>
                    </div>
                  </div>
                  <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-box d-flex align-items-center">
                      <i class="bi bi-check"></i>
                      <h4>Consistent Branding</h4>
                    </div>
                  </div>
                  <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-box d-flex align-items-center">
                      <i class="bi bi-check"></i>
                      <h4>Scalable Design Tokens</h4>
                    </div>
                  </div>
                  <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-box d-flex align-items-center">
                      <i class="bi bi-check"></i>
                      <h4>Cross-Platform Consistency</h4>
                    </div>
                  </div>
                </div>
              </div>

              <p class="mt-4">
                My goal is to create systems that save time, reduce design inconsistencies, and make your applications look and feel unified as they scale.
              </p>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="service-info">
              <h4>Service Information</h4>
              <div class="info-item">
                <i class="bi bi-clock"></i>
                <h5>Project Duration</h5>
                <p>2-4 weeks</p>
              </div>
              <div class="info-item">
                <i class="bi bi-brush"></i>
                <h5>Tools</h5>
                <p>Figma, Bootstrap, Tailwind, Laravel Blade</p>
              </div>
              <div class="info-item">
                <i class="bi bi-telephone"></i>
                <h5>Contact Support</h5>
                <p>kerollossami@gmail.com</p>
              </div>
            </div>

            
          </div>

        </div>

      </div>

    </section><!-- /Service Details Section -->

  </main>
@endsection
