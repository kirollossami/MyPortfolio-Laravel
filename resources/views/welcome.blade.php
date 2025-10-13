@extends('layout.master')

@section('content')
  <header id="header" class="header dark-background d-flex flex-column justify-content-center">
    <i class="header-toggle d-xl-none bi bi-list"></i>

    <div class="header-container d-flex flex-column align-items-start">
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active"><i class="bi bi-house navicon"></i> Home</a></li>
          <li><a href="#about"><i class="bi bi-person navicon"></i> About</a></li>
          <li><a href="#resume"><i class="bi bi-file-earmark-text navicon"></i> Resume</a></li>
          <li><a href="#portfolio"><i class="bi bi-images navicon"></i> Portfolio</a></li>
          <li><a href="#services"><i class="bi bi-hdd-stack navicon"></i> Services</a></li>
          <li><a href="#contact"><i class="bi bi-envelope navicon"></i> Contact</a></li>
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

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="background-elements">
        <div class="bg-circle circle-1"></div>
        <div class="bg-circle circle-2"></div>
      </div>

      <div class="hero-content">

        <div class="container">
          <div class="row align-items-center">

            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
              <div class="hero-text">
                <h1>Kirollos Samy</h1>
                <h2>Full Stack developer</h2>
                <p class="lead">
                I'm a 
                <span class="typed fw-bold text-primary" 
                        data-typed-items="Full Stack Developer, RESTful API Designer, Responsive UI Specialist, Database Designer, Problem Solver, Clean Code Programmer, Lifelong Learner">
                </span>
                </p>

                <p class="description">Passionate about Web Development — creating exceptional digital experiences that combine innovative design with powerful functionality.  
                Let’s bring your vision to life.</p>

                <div class="hero-actions">
                  <a href="#portfolio" class="btn btn-primary">View My Work</a>
                  <a href="#contact" class="btn btn-outline">Get In Touch</a>
                </div>

                <div class="social-links">
                  <a href="https://github.com/kirollossami"><i class="bi bi-github"></i></a>
                  <a href="https://www.linkedin.com/in/kirollossamy""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
              <div class="hero-visual">
                <div class="profile-container">
                  <div class="profile-background"></div>
                  <img src="assets/img/profile/Kirollos_Samy.png" alt="Kirollos Samy" class="profile-image">
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-5" data-aos="zoom-in" data-aos-delay="200">
            <div class="profile-card">
              <div class="profile-header">
                <div class="profile-image">
                  <img src="assets/img/profile/Kirollos_Samy1.png" alt="Profile Image" class="img-fluid">
                </div>
                <div class="profile-badge">
                  <i class="bi bi-check-circle-fill"></i>
                </div>
              </div>

              <div class="profile-content">
                <h3>Kirollos Samy</h3>
                <p class="profession"> Full Stack Developer</p>

                <div class="contact-links">
                  <a href="mailto:kerollossami@gmail.com" class="contact-item">
                    <i class="bi bi-envelope"></i>
                    kerollossami@gmail.com
                  </a>
                  <a href="tel:+201034037540" class="contact-item">
                    <i class="bi bi-telephone"></i>
                    +20 10 340 37540
                  </a>
                  <a href="https://maps.app.goo.gl/8xnjcmWM6qEAhXrC6" class="contact-item">
                    <i class="bi bi-geo-alt"></i>
                    October, Gardens in Egypt
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-7" data-aos="fade-left" data-aos-delay="300">
            <div class="about-content">
              <div class="section-header">
                <span class="badge-text">Get to Know Me</span>
                <h2>Passionate About Software Engineering</h2>
              </div>

              <div class="description">
                <p>I’m Kirollos Samy, a dedicated Full Stack Developer with a lifelong passion for technology. My journey
                    began at the age of 12 when I got my first computer, igniting my curiosity and love for everything tech.
                    Today, I apply that passion to building real-world web applications, continuously improving my skills and
                    mastering modern technologies.</p>

                <p>Why work with me ?
                    I specialize in transforming complex website ideas into simple, manageable solutions, breaking down large
                    projects for easier maintenance and updates. With a strong focus on modern design and user experience, I
                    consistently write clean, efficient code to deliver full-featured web applications that make a tangible
                    impact.</p>
              </div>

              <div class="stats-grid">
                <div class="stat-item">
                  <div class="stat-number">3</div>
                  <div class="stat-label">Projects Completed</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number">1</div>
                  <div class="stat-label">Years Experience</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number">97.5%</div>
                  <div class="stat-label">Client Satisfaction</div>
                </div>
              </div>

              <div class="details-grid">
                <div class="detail-row">
                  <div class="detail-item">
                    <span class="detail-label">Specialization</span>
                    <span class="detail-value"> Full Stack Developer</span>
                  </div>
                  <div class="detail-item">
                    <span class="detail-label">Experience Level</span>
                    <span class="detail-value">Junior</span>
                  </div> 
                </div>
                <div class="detail-row">
                  <div class="detail-item">
                    <span class="detail-label">Education</span>
                    <span class="detail-value">Full Stack Developer using PHP, NTI</span>
                    <span class="detail-value">BIS, Thebes Academy</span>
                  </div>
                  <div class="detail-item">
                    <span class="detail-label">Languages</span>
                    <span class="detail-value">English, Arabic, Italian</span>
                  </div>
                </div>
              </div>

              <div class="cta-section">
                <a href="{{ route('download.resume') }}" id="downloadResumeBtn" class="btn btn-primary">
                    <i class="bi bi-download"></i>
                    Download Resume
                </a>

                <script>
                document.getElementById('downloadResumeBtn').addEventListener('click', async () => {
                    const response = await fetch("{{ route('download.resume') }}");

                    const blob = await response.blob();

                    const url = window.URL.createObjectURL(blob);
            
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = "resume.pdf"; 
                    document.body.appendChild(a);
                    a.click(); 
                    a.remove();
                });
                </script>
                <a href="https://wa.me/message/VQCUVT3EV37QD1" class="btn btn-outline">
                    <i class="bi bi-chat-dots"></i>
                    Let's Talk What'app
                </a>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="stats-wrapper">
              <div class="stats-item" data-aos="zoom-in" data-aos-delay="150">
                <div class="icon-wrapper">
                  <i class="bi bi-emoji-smile"></i>
                </div>
                <span data-purecounter-start="0" data-purecounter-end="1" data-purecounter-duration="1" class="purecounter"></span>
                <p>Happy Clients</p>
              </div><!-- End Stats Item -->

              <div class="stats-item" data-aos="zoom-in" data-aos-delay="200">
                <div class="icon-wrapper">
                  <i class="bi bi-journal-richtext"></i>
                </div>
                <span data-purecounter-start="0" data-purecounter-end="2" data-purecounter-duration="1" class="purecounter"></span>
                <p>Projects</p>
              </div><!-- End Stats Item -->

              <div class="stats-item" data-aos="zoom-in" data-aos-delay="250">
                <div class="icon-wrapper">
                  <i class="bi bi-headset"></i>
                </div>
                <span data-purecounter-start="0" data-purecounter-end="120" data-purecounter-duration="1" class="purecounter"></span>
                <p>Hours Of Support</p>
              </div><!-- End Stats Item -->

            </div>
          </div>
        </div>

      </div>

    </section><!-- /Stats Section -->

    <!-- Skills Section -->
    <section id="skills" class="skills section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Technical Skills</h2>
        <p>Technical skills are the core foundation of my work—they are essential tools that enable me to design, build, and deliver effective solutions.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-6">
            <div class="skills-category" data-aos="fade-up" data-aos-delay="200">
              <h3>Front-end Development</h3>
              <div class="skills-animation">
                <div class="skill-item">
                  <div class="d-flex justify-content-between align-items-center">
                    <h4>HTML/CSS</h4>
                    <span class="skill-percentage">95%</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <div class="skill-tooltip">Expert level knowledge of semantic HTML5 and modern CSS3 techniques</div>
                </div>

                <div class="skill-item">
                  <div class="d-flex justify-content-between align-items-center">
                    <h4>JavaScript</h4>
                    <span class="skill-percentage">75%</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <div class="skill-tooltip">Strong proficiency in ES6+, DOM manipulation, and modern frameworks</div>
                </div>

                <div class="skill-item">
                  <div class="d-flex justify-content-between align-items-center">
                    <h4>Bootstrap</h4>
                    <span class="skill-percentage">80%</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <div class="skill-tooltip">Experience with Framework Bootstrap, state management, and component architecture</div>
                </div>
              </div>
            </div><!-- End Frontend Skills -->
          </div>

          <div class="col-lg-6">
            <div class="skills-category" data-aos="fade-up" data-aos-delay="300">
              <h3>Back-end Development</h3>
              <div class="skills-animation">
                <div class="skill-item">
                  <div class="d-flex justify-content-between align-items-center">
                    <h4>PHP</h4>
                    <span class="skill-percentage">95%</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <div class="skill-tooltip">OOP and Native with Express and REST APIs, MVP and MVC</div>
                </div>

                <div class="skill-item">
                  <div class="d-flex justify-content-between align-items-center">
                    <h4>Laravel</h4>
                    <span class="skill-percentage">70%</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <div class="skill-tooltip">Laravel Developer with authentication, authorization, REST APIs, MVP and MVC</div>
                </div>

                <div class="skill-item">
                  <div class="d-flex justify-content-between align-items-center">
                    <h4>MySQL</h4>
                    <span class="skill-percentage">95%</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <div class="skill-tooltip">Database design, optimization, and complex queries</div>
                </div>
              </div>
            </div>
            <!-- End Backend Skills -->
          </div>
        </div>

      </div>

    </section>
    <!-- /Skills Section -->

    <!-- Resume Section -->
    <section id="resume" class="resume section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Resume</h2>
        <p>Proficient Full Stack Developer with strong technical skills in front-end and back-end development, building robust and efficient web applications.</p>
      </div>
      <!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <!-- Left column with summary and contact -->
          <div class="col-lg-4">
            <div class="resume-side" data-aos="fade-right" data-aos-delay="100">
              <div class="profile-img mb-4">
                <img src="assets/img/profile/Kirollos_Samy.png" alt="Profile" class="img-fluid rounded">
              </div>

              <h3>Professional Summary</h3>
              <p>Full Stack Developer (PHP) with strong expertise in designing and developing scalable web applications. I am skilled in both web design (UI/UX Principles, responsive layouts) and web development Front-end (HTML, CSS, JavaScript, Bootstrap) and Backend (PHP, Laravel, RESTful APIs, MySQL) development, with hands-on experience applying MVC architecture. I am proficient in object-oriented programming (OOP) and problem-solving, with the ability to identify root causes and deliver efficient, reliable solutions. Passionate about building robust systems that improve performance and user experience.
              Experienced in working with Database Management Systems (DBMS), particularly MySQL and SQL Server, including database design, queries, and optimization. Adept at analyzing problems, identifying root causes, and implementing efficient solutions to ensure long-term reliability.</p>

              <h3 class="mt-4">Contact Information</h3>
              <ul class="contact-info list-unstyled">
                <li><i class="bi bi-geo-alt"></i> 6th of October, October Gardens, Giza </li>
                <li><i class="bi bi-envelope"></i> kerollossami@gmail.com</li>
                <li><i class="bi bi-phone"></i> +201034037540</li>
                <li><i class="bi bi-linkedin"></i> www.linkedin.com/in/kirollossamy</li>
              </ul>

              <div class="skills-animation mt-4">
                <h3>Technical Skills</h3>
                <div class="skill-item">
                  <div class="d-flex justify-content-between">
                    <span>Web Development</span>
                    <span>82%</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>

                <div class="skill-item">
                  <div class="d-flex justify-content-between">
                    <span>Problem Solving</span>
                    <span>75%</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>

                <div class="skill-item">
                  <div class="d-flex justify-content-between">
                    <span>Back End</span>
                    <span>85%</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>

                <div class="skill-item">
                  <div class="d-flex justify-content-between">
                    <span>Front End</span>
                    <span>80%</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>

                <div class="skill-item">
                  <div class="d-flex justify-content-between">
                    <span>Project Management</span>
                    <span>80%</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Right column with experience and education -->
          <div class="col-lg-8 ps-4 ps-lg-5">
            <!-- Experience Section -->
            <div class="resume-section" data-aos="fade-up">
              <h3><i class="bi bi-briefcase me-2"></i>Professional Experience</h3>

              <div class="resume-item">
                <h4>Full Stack Development Intern (90 Hours Technical + 30 Hours Soft Skills)</h4>
                <h5>Aug 2025 – Sep 2025</h5>
                <p class="company"><i class="bi bi-building"></i> NTI (National Telecommunication Institute)</p>
                <ul>
                  <li>Completed intensive training in <b>Full Stack Development using PHP</b>.</li>
                  <li>Gained hands-on experience with <b>HTML, CSS, JavaScript, Bootstrap, PHP, MySQL, and Laravel</b>.</li>
                    <li>Developed two projects:</li>
                    <ul>
                      <li><b>Dashboard v1</b>: Built using <b>native PHP</b> and MySQL for backend operations.</li>
                      <li><b>Dashboard v2</b>: Rebuilt using the <b>Laravel framework</b>, applying MVC and web architecture best practices.</li>
                    </ul>
                  <li>Strengthened skills in <b>database design, authentication, authorization, and CRUD operations</b>.</li>
                  <li>Collaborated in a team training environment, improving <b>problem-solving and project workflow</b>.</li>
                </ul>
                <h6>Soft Skills & Freelancing Training (30 Hours – NTI Program Extension):</h6>
                <ul>
                  <li>Learned how to <b>start and manage a freelancing career</b>.</li>
                  <li>Created and optimized professional accounts on <b>Upwork, Freelancer, Mostaql, and Freelancer Yard</b>.</li>
                  <li>Gained skills in <b>proposal writing, client communication, and online professionalism</b>.</li>
                  <li>Improved <b>time management, self-discipline, and independent working skills</b> for freelancing success.</li>
                </ul>
              </div>
            </div>

            <!-- Education Section -->
            <div class="resume-section" data-aos="fade-up" data-aos-delay="100">
              <h3><i class="bi bi-mortarboard me-2"></i>Education</h3>
              <div class="resume-item">
                <h4>Graduate Certificate in Full Stack Development using PHP</h4>
                <h5>Sep, 2025</h5>
                <p class="company"><i class="bi bi-building"></i> NTI (National Telecommunication Institute),</p>
                <p>Building web applications using PHP and entering the freelance market</p>
              </div>

              <div class="resume-item">
                <h4>Bachelor of Information Systems (BIS)</h4>
                <h5>2022 - present</h5>
                <p class="company"><i class="bi bi-building"></i> Thebes Higher Institute for Computer and Administrative Sciences (Ongoing, 4th Year)</p>
                <p>Computer Science fundamentals, C++ Language Level 2, Java Language Level 3, Digital Marketing</p>
              </div>

              <div class="resume-item">
                <h4>Technical Diploma in Mechanics and Energy</h4>
                <h5>2016 - 2021</h5>
                <p class="company"><i class="bi bi-building"></i> Salesian Don Bosco Institute, Cairo (2021)</p>
                <p>Relevant Coursework: Engineering Design, SolidWorks, AutoCAD</p>
              </div>
            </div>

            <!-- Certifications Section -->
            <div class="resume-section" data-aos="fade-up" data-aos-delay="200">
              <h3><i class="bi bi-award me-2"></i>Certifications</h3>

              <div class="resume-item d-flex align-items-center justify-content-between">
                  <div class="d-flex align-items-center">
                      <img src="assets/img/Kirollos Samy Ishaq Tawfik.png" alt="NTI Logo" style="width:50px; height:50px; margin-right:15px; border-radius:8px;">
                      <div>
                          <h4>NTI Summer Training</h4>
                          <h5>2025</h5>
                      </div>
                  </div>
                  <a href="{{ route('download.certificate')}}" download id="downloadCertificateBtn" class="btn btn-primary" style="padding:8px 15px;">Download Certificate</a>
                  <script>
                    document.getElementById('downloadCertificateBtn').addEventListener('click', async () => {
                    const response = await fetch("{{ route('download.certificate') }}");

                    const blob = await response.blob();

                    const url = window.URL.createObjectURL(blob);
            
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = "kirollos_samy_certificate.pdf"; 
                    document.body.appendChild(a);
                    a.click(); 
                    a.remove();
                });
                </script>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Resume Section -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Portfolio</h2>
        <p>👉 Here, you’ll find my projects, the tools and technologies I use, and the experiences that shaped my journey as a developer.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <div class="row">
            <div class="col-lg-3 filter-sidebar">
              <div class="filters-wrapper" data-aos="fade-right" data-aos-delay="150">
                <ul class="portfolio-filters isotope-filters">
                  <li data-filter="*" class="filter-active">All Projects</li>
                  <li data-filter=".filter-laravel">Laravel</li>
                  <li data-filter=".filter-native-php">Native PHP</li>
                  <li data-filter=".filter-asp.net">ASP.NET</li>
                  <li data-filter=".filter-apis">APIs</li>
                  <li data-filter=".filter-mvc">MVC</li>
                </ul>
              </div>
            </div>

            <div class="col-lg-9">
              <div class="row gy-4 portfolio-container isotope-container" data-aos="fade-up" data-aos-delay="200">

                <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-native-php">
                  <div class="portfolio-wrap">
                    <img src="assets/img/projects/Dashboard Design Using Native PHP.png" class="img-fluid" alt="Portfolio Image" loading="lazy">
                    <div class="portfolio-info">
                      <div class="content">
                        <span class="category">ProCourses Dashboard</span>
                        <h4>Native PHP</h4>
                        <div class="portfolio-links">
                          <a href="assets/img/projects/Dashboard Design Using Native PHP.png" class="glightbox" title="Dashboard Design Using PHP"><i class="bi bi-plus-lg"></i></a>
                          <a href="https://github.com/kirollossami/First-Final-Project-NTI" title="More Details"><i class="bi bi-arrow-right"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Portfolio Item -->

                <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-laravel filter-mvc">
                  <div class="portfolio-wrap">
                    <img src="assets/img/projects/Education_System.png" class="img-fluid" alt="Portfolio Image" loading="lazy">
                    <div class="portfolio-info">
                      <div class="content">
                        <span class="category">Education System</span>
                        <h4>Laravel Framework</h4>
                        <div class="portfolio-links">
                          <a href="assets/img/projects/Education_System.png" class="glightbox" title="Designing a website for a training company using Framework Laravel"><i class="bi bi-plus-lg"></i></a>
                          <a href="https://github.com/kirollossami/Second-Final-Project-NTI" title="More Details"><i class="bi bi-arrow-right"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- End Portfolio Item -->

              </div><!-- End Portfolio Container -->
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Portfolio Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Offer Services</h2>
        <p>👉 Here, you’ll find my projects, the tools and technologies I use, and the experiences that shaped my journey as a developer.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="service-header">
          <div class="row align-items-center">
            <div class="col-lg-8 col-md-12">
              <div class="service-intro">
                <h2 class="service-heading">
                  <div>Innovative business</div>
                  <div><span>performance solutions</span></div>
                </h2>
              </div>
            </div>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-card position-relative z-1">
              <div class="service-icon">
                <i class="bi bi-palette"></i>
              </div>
              <a href="{{route('custom')}}" class="card-action d-flex align-items-center justify-content-center rounded-circle">
                <i class="bi bi-arrow-up-right"></i>
              </a>
              <h3>
                <a href="{{route('custom')}}">
                  Custom Web Application</span>
                </a>
              </h3>
              <p>
              Build tailored web solutions using PHP & Laravel, delivering secure, scalable, and high-performance applications that align with business needs.
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-card position-relative z-1">
              <div class="service-icon">
                <i class="bi bi-gem"></i>
              </div>
              <a href="{{route('design')}}" class="card-action d-flex align-items-center justify-content-center rounded-circle">
                <i class="bi bi-arrow-up-right"></i>
              </a>
              <h3>
                <a href="{{route('design')}}">
                  Design systems</span>
                </a>
              </h3>
              <p>
              Structured collection of reusable components, design patterns and guidelines that ensure consistency, scalability, and efficiency across digital products.
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-card position-relative z-1">
              <div class="service-icon">
                <i class="bi bi-gear"></i>
              </div>
              <a href="{{route('support')}}" class="card-action d-flex align-items-center justify-content-center rounded-circle">
                <i class="bi bi-arrow-up-right"></i>
              </a>
              <h3>
                <a href="{{route('support')}}">
                  Maintenance & Support</span>
                </a>
              </h3>
              <p>
              Provide ongoing updates, bug fixes, and technical assistance to ensure your applications remain secure, reliable, and up to date with the latest technologies.
              </p>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Testimonials</h2>
        <p>Hear directly from those I’ve had the pleasure of working with. Their feedback reflects the dedication, quality, and impact of my work, giving you a clear idea of what to expect when collaborating with me.</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="testimonial-masonry">

          <div class="testimonial-item" data-aos="fade-up">
            <div class="testimonial-content">
              <div class="quote-pattern">
                <i class="bi bi-quote"></i>
              </div>
              <p>Excellent work—truly commendable. Keep up the great effort!.</p>
              <div class="client-info">
                <div class="client-image">
                  <img src="assets/img/testimonials/eng_islam_ramadan.jpeg" alt="My Instractor">
                </div>
                
                <div class="client-details">
                  <h3>Eng. Islam Ramadan</h3>
                  <span class="position">Full Stack Instractor <br></span>
                  <small>My Instructor at NTI</small>
                </div>
                  <a href="https://www.linkedin.com/feed/update/urn:li:ugcPost:7367531327102844928?commentUrn=urn%3Ali%3Acomment%3A%28ugcPost%3A7367531327102844928%2C7367886165582012416%29&dashCommentUrn=urn%3Ali%3Afsd_comment%3A%287367886165582012416%2Curn%3Ali%3AugcPost%3A7367531327102844928%29" class="card-action d-flex align-items-center justify-content-center rounded-circle">
                  <i class="bi bi-arrow-right"></i>
                </a>
                </div>
            </div>
          </div>

          <div class="testimonial-item" data-aos="fade-up">
            <div class="testimonial-content">
              <div class="quote-pattern">
                <i class="bi bi-quote"></i>
              </div>
              <p>Great work, Engineer Kirollos! One of the best students—keep up the excellent effort.</p>
              <div class="client-info">
                <div class="client-image">
                  <img src="assets/img/testimonials/eng_islam_ramadan.jpeg" alt="My Instractor">
                </div>
                
                <div class="client-details">
                  <h3>Eng. Islam Ramadan</h3>
                  <span class="position">Full Stack Instractor <br></span>
                  <small>My Instructor at NTI</small>
                </div>
                  <a href="https://www.linkedin.com/feed/update/urn:li:ugcPost:7369440555149262848?commentUrn=urn%3Ali%3Acomment%3A%28ugcPost%3A7369440555149262848%2C7370007198694813697%29&dashCommentUrn=urn%3Ali%3Afsd_comment%3A%287370007198694813697%2Curn%3Ali%3AugcPost%3A7369440555149262848%29" class="card-action d-flex align-items-center justify-content-center rounded-circle">
                  <i class="bi bi-arrow-right"></i>
                </a>
                </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Testimonials Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">
      @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
      @endif

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>I’m always open to new opportunities, collaborations, or just a friendly chat! Whether you have a project idea, a question, or feedback, feel free to reach out. I’ll make sure to get back to you as soon as possible.</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row g-4 g-lg-5">
          <div class="col-lg-5">
            <div class="info-box">
              <h3>Contact Info</h3>
              <p>Let’s start working together!</p>

              <div class="info-item">
                <div class="icon-box">
                  <i class="bi bi-geo-alt"></i>
                </div>
                <div class="content">
                  <h4>Our Location</h4>
                  <p>October Gardens, Giza</p>
                  <p>Egypt</p>
                </div>
              </div>

              <div class="info-item">
                <div class="icon-box">
                  <i class="bi bi-telephone"></i>
                </div>
                <div class="content">
                  <h4>Phone Number</h4>
                  <p>+201289198945</p>
                  <p>+201034037540</p>
                </div>
              </div>

              <div class="info-item">
                <div class="icon-box">
                  <i class="bi bi-envelope"></i>
                </div>
                <div class="content">
                  <h4>Email Address</h4>
                  <p>kerollossami@gmail.com</p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-7">
            <div class="contact-form">
              <h3>Get In Touch</h3>
              <p>I am happy to receive any message and will get back to you via email.</p>

              <form action="{{ route('contact.submit') }}" method="POST" class="php-email-form">
                @csrf

                <div class="row gy-4">

                  <div class="col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  


                  <div class="col-md-6 ">
                    <input type="email" class="form-control" name="email" placeholder="Your Email"  required>
                    @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  


                  <div class="col-12">
                    <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                    @error('subject')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  


                  <div class="col-12">
                    <textarea class="form-control" name="message" rows="6" placeholder="Message"  required></textarea>
                    @error('message')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  


                  <div class="col-12 text-center">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
                    
                    @if(session('success'))
                      <div class="sent-message">{{ session('success') }}</div>
                    @endif
                    
                    <button type="submit" class="btn">Send Message</button>
                  </div>
                            
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                </div>
              </form>

            </div>
          </div>

        </div>

      </div>

    </section>
    <!-- /Contact Section -->

  </main>
@endsection