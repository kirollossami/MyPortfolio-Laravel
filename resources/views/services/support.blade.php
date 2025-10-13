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
<!-- ======= Maintenance & Support Section ======= -->
<section id="maintenance-support" class="services section-bg py-5">
  <div class="container" data-aos="fade-up">

    <div class="section-header text-center mb-5">
      <h2 class="fw-bold">Maintenance & Support</h2>
      <p class="text-muted">Keep your web applications secure, updated, and running smoothly.</p>
    </div>

    <div class="row gy-4">

      <div class="col-lg-6">
        <img src="{{ asset('assets/img/services/maintenance-support.jpg') }}" class="img-fluid rounded shadow" alt="Maintenance & Support">
      </div>

      <div class="col-lg-6 d-flex flex-column justify-content-center">
        <h3 class="fw-bold mb-3">Why Choose My Maintenance & Support Services?</h3>
        <p>
          Ensuring your applications remain up-to-date and error-free is critical for business continuity. 
          I provide **comprehensive maintenance and technical support** to minimize downtime, improve performance, 
          and enhance security.
        </p>
        <ul class="list-unstyled">
          <li><i class="bi bi-check-circle-fill text-primary me-2"></i> Bug fixes and troubleshooting</li>
          <li><i class="bi bi-check-circle-fill text-primary me-2"></i> Regular updates and patches</li>
          <li><i class="bi bi-check-circle-fill text-primary me-2"></i> Performance optimization</li>
          <li><i class="bi bi-check-circle-fill text-primary me-2"></i> Security monitoring & improvements</li>
          <li><i class="bi bi-check-circle-fill text-primary me-2"></i> 24/7 support availability</li>
        </ul>
        <a href="#contact" class="btn btn-primary mt-3">Request Support</a>
      </div>

    </div>
  </div>
</section>
@endsection
