@extends('layout.master')

@section('content')
<header id="header" class="header dark-background d-flex flex-column justify-content-center">
    <i class="header-toggle d-xl-none bi bi-list"></i>

    <div class="header-container d-flex flex-column align-items-start">
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active"><i class="bi bi-house navicon"></i> Home</a></li>
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
        <h1 class="mb-2 mb-lg-0">Custom Web Applications</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="current">Custom Web Applications</li>
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
                  <img src="{{ asset('assets/img/services/custom-1.webp') }}" alt="Custom App" class="img-fluid" loading="lazy">
                </div>
                <div class="swiper-slide">
                  <img src="{{ asset('assets/img/services/custom-2.webp') }}" alt="Web Development" class="img-fluid" loading="lazy">
                </div>
                <div class="swiper-slide">
                  <img src="{{ asset('assets/img/services/custom-3.webp') }}" alt="Laravel Projects" class="img-fluid" loading="lazy">
                </div>
              </div>
              <div class="swiper-pagination"></div>
            </div>

            <div class="content mt-5">
              <h3>Tailored Web Solutions with PHP & Laravel</h3>
              <p>
                I specialize in building <strong>custom web applications</strong> that are secure, scalable, and user-friendly.  
                Whether you need a business management system, an e-commerce platform, or a tailored CRM, I deliver solutions that align perfectly with your goals.
              </p>
              <p>
                By leveraging modern technologies like <strong>Laravel, MySQL, REST APIs, and responsive UI/UX design</strong>, I ensure your application is both powerful and future-ready.
              </p>

              <div class="features mt-4">
                <div class="row gy-4">
                  <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-box d-flex align-items-center">
                      <i class="bi bi-check"></i>
                      <h4>Custom Business Solutions</h4>
                    </div>
                  </div>
                  <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-box d-flex align-items-center">
                      <i class="bi bi-check"></i>
                      <h4>Secure Authentication Systems</h4>
                    </div>
                  </div>
                  <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-box d-flex align-items-center">
                      <i class="bi bi-check"></i>
                      <h4>API Development & Integration</h4>
                    </div>
                  </div>
                  <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-box d-flex align-items-center">
                      <i class="bi bi-check"></i>
                      <h4>Responsive & Scalable Design</h4>
                    </div>
                  </div>
                </div>
              </div>

              <p class="mt-4">
                My goal is to transform your ideas into fully functional web applications that grow with your business and provide real value to your users.
              </p>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="service-info">
              <h4>Service Information</h4>
              <div class="info-item">
                <i class="bi bi-clock"></i>
                <h5>Project Duration</h5>
                <p>1-6 months (depending on scope)</p>
              </div>
              <div class="info-item">
                <i class="bi bi-code-slash"></i>
                <h5>Technologies</h5>
                <p>PHP, Laravel, MySQL, REST APIs</p>
              </div>
              <div class="info-item">
                <i class="bi bi-telephone"></i>
                <h5>Contact Support</h5>
                <p>kerollossami@gmail.com</p>
              </div>
            </div>

            <div class="related-services mt-5">
              <h4>Related Services</h4>
              <div class="service-item">
                <i class="bi bi-bar-chart"></i>
                <h5><a href="#">API Development</a></h5>
                <p>Custom APIs to connect and scale your systems seamlessly.</p>
              </div>
              <div class="service-item">
                <i class="bi bi-laptop"></i>
                <h5><a href="#">UI/UX Design</a></h5>
                <p>Modern, responsive, and user-friendly interface designs.</p>
              </div>
              <div class="service-item">
                <i class="bi bi-graph-up"></i>
                <h5><a href="#">Maintenance & Support</a></h5>
                <p>Ongoing updates, bug fixes, and technical assistance.</p>
              </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Service Details Section -->

  </main>
@endsection
