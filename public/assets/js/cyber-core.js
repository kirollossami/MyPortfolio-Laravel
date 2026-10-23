/**
 * KIROLLOS SAMY ISHAQ - 4K CYBER-MINIMALISM & INTERACTIVE CORE ENGINE
 * High-performance, zero-dependency Vanilla JavaScript Layer
 */

document.addEventListener('DOMContentLoaded', () => {
  'use strict';

  // =========================================================================
  // 1. CURSOR SPOTLIGHT TRACKING
  // =========================================================================
  const spotlight = document.querySelector('.cursor-spotlight');
  if (spotlight && window.matchMedia('(pointer: fine)').matches) {
    let mouseX = window.innerWidth / 2;
    let mouseY = window.innerHeight / 2;
    let currentX = mouseX;
    let currentY = mouseY;

    window.addEventListener('mousemove', (e) => {
      mouseX = e.clientX;
      mouseY = e.clientY;
    });

    const renderSpotlight = () => {
      currentX += (mouseX - currentX) * 0.15;
      currentY += (mouseY - currentY) * 0.15;
      spotlight.style.transform = `translate(${currentX}px, ${currentY}px) translate(-50%, -50%)`;
      requestAnimationFrame(renderSpotlight);
    };
    renderSpotlight();
  }

  // =========================================================================
  // 2. FLOATING NAVBAR SCROLL SPY & SCROLLED STATE
  // =========================================================================
  const nav = document.querySelector('.cyber-nav');
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.nav-link-item');
  const mobileNavLinks = document.querySelectorAll('.mobile-nav-links a');

  const onScroll = () => {
    const scrollPos = window.scrollY;

    // Toggle navbar glass background intensity
    if (nav) {
      if (scrollPos > 30) {
        nav.classList.add('scrolled');
      } else {
        nav.classList.remove('scrolled');
      }
    }

    // Scroll spy
    let currentSectionId = '';
    sections.forEach((section) => {
      const top = section.offsetTop - 120;
      const height = section.offsetHeight;
      if (scrollPos >= top && scrollPos < top + height) {
        currentSectionId = section.getAttribute('id');
      }
    });

    navLinks.forEach((link) => {
      link.classList.remove('active');
      if (link.getAttribute('href') === `#${currentSectionId}`) {
        link.classList.add('active');
      }
    });

    mobileNavLinks.forEach((link) => {
      link.classList.remove('active');
      if (link.getAttribute('href') === `#${currentSectionId}`) {
        link.classList.add('active');
      }
    });
  };

  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  // =========================================================================
  // 3. MOBILE DRAWER NAVIGATION
  // =========================================================================
  const mobileToggle = document.querySelector('.mobile-nav-toggle');
  const mobileDrawer = document.querySelector('.mobile-nav-drawer');
  const mobileOverlay = document.querySelector('.mobile-drawer-overlay');
  const mobileClose = document.querySelector('.mobile-drawer-close');

  const openMobileMenu = () => {
    if (mobileDrawer && mobileOverlay) {
      mobileDrawer.classList.add('active');
      mobileOverlay.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
  };

  const closeMobileMenu = () => {
    if (mobileDrawer && mobileOverlay) {
      mobileDrawer.classList.remove('active');
      mobileOverlay.classList.remove('active');
      document.body.style.overflow = '';
    }
  };

  if (mobileToggle) mobileToggle.addEventListener('click', openMobileMenu);
  if (mobileClose) mobileClose.addEventListener('click', closeMobileMenu);
  if (mobileOverlay) mobileOverlay.addEventListener('click', closeMobileMenu);

  mobileNavLinks.forEach((link) => {
    link.addEventListener('click', closeMobileMenu);
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeMobileMenu();
      closeSpecModal();
      closeCertModal();
    }
  });

  // =========================================================================
  // 4. 3D CARD TILT & SPECULAR HIGHLIGHT
  // =========================================================================
  const tiltCards = document.querySelectorAll('.tilt-enabled, .pillar-card, .project-card, .cert-card');
  if (window.matchMedia('(pointer: fine)').matches) {
    tiltCards.forEach((card) => {
      card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;

        const rotateX = ((y - centerY) / centerY) * -5;
        const rotateY = ((x - centerX) / centerX) * 5;

        card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-4px)`;
      });

      card.addEventListener('mouseleave', () => {
        card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0)';
      });
    });
  }

  // =========================================================================
  // 5. PROJECT CATEGORY FILTERING
  // =========================================================================
  const filterBtns = document.querySelectorAll('.filter-btn');
  const projectCards = document.querySelectorAll('.project-card-wrapper');

  filterBtns.forEach((btn) => {
    btn.addEventListener('click', () => {
      filterBtns.forEach((b) => b.classList.remove('active'));
      btn.classList.add('active');

      const filterValue = btn.getAttribute('data-filter');

      projectCards.forEach((card) => {
        const categories = card.getAttribute('data-category') || '';
        if (filterValue === 'all' || categories.includes(filterValue)) {
          card.style.display = 'block';
          setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'scale(1)';
          }, 20);
        } else {
          card.style.opacity = '0';
          card.style.transform = 'scale(0.96)';
          setTimeout(() => {
            card.style.display = 'none';
          }, 250);
        }
      });
    });
  });

  // =========================================================================
  // 6. INTERACTIVE ARCHITECTURE VISUALIZER
  // =========================================================================
  const archTabs = document.querySelectorAll('.arch-tab-btn');
  const archFlowContainer = document.getElementById('arch-flow-content');

  const archData = {
    clean: {
      layers: [
        {
          tag: 'Core Domain',
          title: 'Domain Layer',
          desc: 'Entities, Value Objects, Domain Exceptions, Repository Interfaces & Enums with Zero external dependencies.'
        },
        {
          tag: 'Use Cases',
          title: 'Application Layer',
          desc: 'CQRS Handlers, DTOs, AutoMapper profiles, FluentValidation, Business Workflows & Service Contracts.'
        },
        {
          tag: 'External Systems',
          title: 'Infrastructure',
          desc: 'EF Core DbContext, Repositories, SQL Server, Redis Caching, Payment Gateways (Paymob/Fawaterak), Email Dispatchers.'
        },
        {
          tag: 'API Entrypoint',
          title: 'Presentation (API)',
          desc: 'ASP.NET Core Web API Controllers, JWT Middleware, Rate Limiting, Swagger Docs, Global Exception Filter.'
        }
      ]
    },
    ntier: {
      layers: [
        {
          tag: 'Tier 1 - UI',
          title: 'Presentation Tier',
          desc: 'Angular SPA & MVC Views, Form Controls, State Management, Client-side Validation, Axios/HTTP interceptors.'
        },
        {
          tag: 'Tier 2 - BLL',
          title: 'Business Logic Layer',
          desc: 'Core validation rules, Transaction coordinators, Room allocation algorithms, Exam evaluation engines.'
        },
        {
          tag: 'Tier 3 - DAL',
          title: 'Data Access Layer',
          desc: 'ADO.NET, Entity Framework Core, Unit of Work, Stored Procedure Execution, Linq to Entities.'
        },
        {
          tag: 'Tier 4 - RDBMS',
          title: 'Database Server',
          desc: 'Microsoft SQL Server / MySQL, Clustered Indexing, Stored Procedures, ACID Transactions, Views.'
        }
      ]
    },
    pipeline: {
      layers: [
        {
          tag: 'Gateway',
          title: 'Reverse Proxy (Nginx)',
          desc: 'SSL/TLS termination, HTTP/2 multiplexing, Gzip compression, IP rate-limiting, and static asset caching.'
        },
        {
          tag: 'Auth & Security',
          title: 'JWT Auth & Middleware',
          desc: 'Token validation, Role claims resolution, CORS policies, and Request signature authentication.'
        },
        {
          tag: 'Cache Layer',
          title: 'Redis In-Memory Store',
          desc: 'Sub-2ms cache hits for room inventory, session state, user permission graphs, and rate counters.'
        },
        {
          tag: 'Storage & Webhooks',
          title: 'ACID DB & Webhooks',
          desc: 'Row-level locking for checkout concurrency, payment callback listener, and audit log persistence.'
        }
      ]
    }
  };

  if (archTabs.length > 0 && archFlowContainer) {
    archTabs.forEach((tab) => {
      tab.addEventListener('click', () => {
        archTabs.forEach((t) => t.classList.remove('active'));
        tab.classList.add('active');

        const archType = tab.getAttribute('data-arch');
        const selected = archData[archType] || archData.clean;

        archFlowContainer.style.opacity = '0';
        setTimeout(() => {
          archFlowContainer.innerHTML = selected.layers
            .map(
              (l) => `
            <div class="arch-layer-box">
              <div class="arch-layer-tag">${l.tag}</div>
              <h4 class="arch-layer-title">${l.title}</h4>
              <p class="arch-layer-details">${l.desc}</p>
            </div>
          `
            )
            .join('');
          archFlowContainer.style.opacity = '1';
        }, 150);
      });
    });
  }

  // =========================================================================
  // 7. PROJECT ARCHITECTURE SPECS MODAL
  // =========================================================================
  const specModal = document.getElementById('specModal');
  const specModalTitle = document.getElementById('specModalTitle');
  const specModalBody = document.getElementById('specModalBody');
  const specModalClose = document.getElementById('specModalClose');

  const projectSpecs = {
    unistay: {
      title: 'UniStay — Student Housing Booking Platform Architecture',
      content: `
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
          <div style="background: rgba(10,13,20,0.6); padding: 1.25rem; border-radius: 10px; border: 1px solid rgba(255,255,255,0.08);">
            <h4 style="color: var(--accent-cyan); margin-bottom: 0.5rem; font-family: var(--font-mono); font-size: 0.9rem;">ARCHITECTURE PATTERN</h4>
            <p style="font-size: 0.875rem;">N-Tier Enterprise Architecture dividing Presentation (Angular), Web API Controllers, Business Logic Layer (BLL), and Data Access Layer (DAL) with Repository & Unit of Work patterns.</p>
          </div>
          <div style="background: rgba(10,13,20,0.6); padding: 1.25rem; border-radius: 10px; border: 1px solid rgba(255,255,255,0.08);">
            <h4 style="color: var(--accent-indigo); margin-bottom: 0.5rem; font-family: var(--font-mono); font-size: 0.9rem;">DATABASE & PERSISTENCE</h4>
            <p style="font-size: 0.875rem;">Microsoft SQL Server with Entity Framework Core Code-First migrations, indexed foreign keys, soft-deletes, and transaction boundaries during room reservations.</p>
          </div>
        </div>
        <h4 style="color: #fff; margin-bottom: 0.75rem;">Key Engineering Implementations:</h4>
        <ul style="padding-left: 1.25rem; margin-bottom: 1.5rem; font-size: 0.9rem; display: flex; flex-direction: column; gap: 0.5rem;">
          <li><strong>JWT Authentication:</strong> Secure token generation with HMAC-SHA256, refresh token rotation, and role-based policies (Student, Landlord, Admin).</li>
          <li><strong>Booking Concurrency:</strong> Concurrency token resolution on room inventory to eliminate double-booking during peak university enrollment windows.</li>
          <li><strong>OpenAPI / Swagger:</strong> Complete interactive documentation for 28+ REST endpoints with schema models and authorization headers.</li>
          <li><strong>Frontend Integration:</strong> Angular TypeScript client with HTTP interceptors, reactive forms, and lazy-loaded route guards.</li>
        </ul>
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
          <a href="https://lnkd.in/p/ennnGR6c" target="_blank" rel="noopener" class="btn-cyber-primary btn-cyber-sm">
            <i class="bi bi-linkedin"></i> LinkedIn Showcase
          </a>
          <a href="https://github.com/kirollossami" target="_blank" rel="noopener" class="btn-cyber-outline btn-cyber-sm">
            <i class="bi bi-github"></i> View GitHub Code
          </a>
        </div>
      `
    },
    examination: {
      title: 'Automated Examination System — High-Concurrency Engine',
      content: `
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
          <div style="background: rgba(10,13,20,0.6); padding: 1.25rem; border-radius: 10px; border: 1px solid rgba(255,255,255,0.08);">
            <h4 style="color: var(--accent-emerald); margin-bottom: 0.5rem; font-family: var(--font-mono); font-size: 0.9rem;">SQL SERVER ENGINE</h4>
            <p style="font-size: 0.875rem;">Optimized Stored Procedures with ACID Transactions, Table-Valued Parameters, Views, and Triggers for deterministic question randomization and instantaneous grade tallying.</p>
          </div>
          <div style="background: rgba(10,13,20,0.6); padding: 1.25rem; border-radius: 10px; border: 1px solid rgba(255,255,255,0.08);">
            <h4 style="color: var(--accent-cyan); margin-bottom: 0.5rem; font-family: var(--font-mono); font-size: 0.9rem;">C# ASSESSMENT CORE</h4>
            <p style="font-size: 0.875rem;">C# Console & Service layer handling student session lifecycle, stopwatch timing locks, anti-tampering validation, and audit logging.</p>
          </div>
        </div>
        <h4 style="color: #fff; margin-bottom: 0.75rem;">Key Engineering Implementations:</h4>
        <ul style="padding-left: 1.25rem; margin-bottom: 1.5rem; font-size: 0.9rem; display: flex; flex-direction: column; gap: 0.5rem;">
          <li><strong>Randomized Question Pools:</strong> Algorithmic distribution ensuring distinct question sets per student while preserving identical difficulty weightings.</li>
          <li><strong>Audit Trail & Integrity:</strong> Every answer submission is timestamped and recorded in an immutable audit table with snapshot isolation.</li>
          <li><strong>Stored Procedure Optimization:</strong> Complex reporting queries executing sub-20ms across thousands of simulated student results.</li>
        </ul>
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
          <a href="https://github.com/kirollossami" target="_blank" rel="noopener" class="btn-cyber-primary btn-cyber-sm">
            <i class="bi bi-github"></i> Repository & SQL Scripts
          </a>
        </div>
      `
    },
    medflow: {
      title: 'MedFlow AI — Clinical Workflow & Healthcare API Platform',
      content: `
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
          <div style="background: rgba(10,13,20,0.6); padding: 1.25rem; border-radius: 10px; border: 1px solid rgba(255,255,255,0.08);">
            <h4 style="color: var(--accent-cyan); margin-bottom: 0.5rem; font-family: var(--font-mono); font-size: 0.9rem;">PERFORMANCE & CACHING</h4>
            <p style="font-size: 0.875rem;">Redis in-memory caching for real-time doctor availability calendars, keeping triage schedule retrieval strictly under 50ms latency.</p>
          </div>
          <div style="background: rgba(10,13,20,0.6); padding: 1.25rem; border-radius: 10px; border: 1px solid rgba(255,255,255,0.08);">
            <h4 style="color: var(--accent-indigo); margin-bottom: 0.5rem; font-family: var(--font-mono); font-size: 0.9rem;">SECURITY & COMPLIANCE</h4>
            <p style="font-size: 0.875rem;">Strict Role-Based Access Control (Physician, Triage Nurse, Lab Tech, Patient) with AES-256 field-level encryption for sensitive diagnostic data.</p>
          </div>
        </div>
        <h4 style="color: #fff; margin-bottom: 0.75rem;">Key Engineering Implementations:</h4>
        <ul style="padding-left: 1.25rem; margin-bottom: 1.5rem; font-size: 0.9rem; display: flex; flex-direction: column; gap: 0.5rem;">
          <li><strong>Asynchronous Task Queue:</strong> Automated medical notifications, SMS reminders, and prescription generation dispatched via background workers.</li>
          <li><strong>RESTful API Specs:</strong> Clean separation of concerns with Domain-Driven Design principles and standardized JSON:API error envelopes.</li>
          <li><strong>Event-Driven Diagnostics:</strong> Pub/sub event hooks on patient triage status changes, triggering real-time alerts on emergency ward displays.</li>
        </ul>
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
          <a href="https://github.com/kirollossami" target="_blank" rel="noopener" class="btn-cyber-primary btn-cyber-sm">
            <i class="bi bi-github"></i> Architecture Specs
          </a>
        </div>
      `
    },
    rawkemya: {
      title: 'Raw Kemya — B2B Chemical Distribution & Payment Gateway Engine',
      content: `
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
          <div style="background: rgba(10,13,20,0.6); padding: 1.25rem; border-radius: 10px; border: 1px solid rgba(255,255,255,0.08);">
            <h4 style="color: var(--accent-emerald); margin-bottom: 0.5rem; font-family: var(--font-mono); font-size: 0.9rem;">PAYMENT GATEWAYS</h4>
            <p style="font-size: 0.875rem;">Dual payment gateway integration with Paymob (Cards, Wallets) and Fawaterak (Reference Codes, Cash Collection) with HMAC webhook signature verification.</p>
          </div>
          <div style="background: rgba(10,13,20,0.6); padding: 1.25rem; border-radius: 10px; border: 1px solid rgba(255,255,255,0.08);">
            <h4 style="color: var(--accent-cyan); margin-bottom: 0.5rem; font-family: var(--font-mono); font-size: 0.9rem;">ORDER STATE MACHINE</h4>
            <p style="font-size: 0.875rem;">Deterministic order transition lifecycle: Pending -> Authorized -> Paid -> Packaging -> Dispatched -> Completed, with automatic chemical inventory stock reservation.</p>
          </div>
        </div>
        <h4 style="color: #fff; margin-bottom: 0.75rem;">Key Engineering Implementations:</h4>
        <ul style="padding-left: 1.25rem; margin-bottom: 1.5rem; font-size: 0.9rem; display: flex; flex-direction: column; gap: 0.5rem;">
          <li><strong>Webhook Idempotency:</strong> Replay-attack protection and atomic database transactions to guarantee orders are never double-credited.</li>
          <li><strong>Automated Invoicing:</strong> Server-side PDF invoice generation with QR verification codes compliant with tax regulations.</li>
          <li><strong>Nginx & VPS Hosting:</strong> Tuned reverse proxy configuration with fastcgi caching and rate limiting for high-volume wholesale traffic.</li>
        </ul>
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
          <a href="https://github.com/kirollossami" target="_blank" rel="noopener" class="btn-cyber-primary btn-cyber-sm">
            <i class="bi bi-github"></i> View GitHub Architecture
          </a>
        </div>
      `
    }
  };

  const openSpecModal = (projectId) => {
    const spec = projectSpecs[projectId];
    if (spec && specModal && specModalTitle && specModalBody) {
      specModalTitle.textContent = spec.title;
      specModalBody.innerHTML = spec.content;
      specModal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
  };

  const closeSpecModal = () => {
    if (specModal) {
      specModal.classList.remove('active');
      document.body.style.overflow = '';
    }
  };

  document.querySelectorAll('[data-spec-target]').forEach((btn) => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const target = btn.getAttribute('data-spec-target');
      openSpecModal(target);
    });
  });

  if (specModalClose) specModalClose.addEventListener('click', closeSpecModal);
  if (specModal) {
    specModal.addEventListener('click', (e) => {
      if (e.target === specModal) closeSpecModal();
    });
  }

  // =========================================================================
  // 8. CERTIFICATE PREVIEW MODAL
  // =========================================================================
  const certModal = document.getElementById('certModal');
  const certModalImg = document.getElementById('certModalImg');
  const certModalTitle = document.getElementById('certModalTitle');
  const certModalDownload = document.getElementById('certModalDownload');
  const certModalClose = document.getElementById('certModalClose');

  const openCertModal = (imgSrc, title, downloadUrl) => {
    if (certModal && certModalImg && certModalTitle && certModalDownload) {
      certModalImg.src = imgSrc;
      certModalTitle.textContent = title;
      certModalDownload.href = downloadUrl;
      certModal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
  };

  const closeCertModal = () => {
    if (certModal) {
      certModal.classList.remove('active');
      document.body.style.overflow = '';
    }
  };

  document.querySelectorAll('[data-cert-preview]').forEach((btn) => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const src = btn.getAttribute('data-cert-img');
      const title = btn.getAttribute('data-cert-title');
      const dl = btn.getAttribute('data-cert-dl');
      openCertModal(src, title, dl);
    });
  });

  if (certModalClose) certModalClose.addEventListener('click', closeCertModal);
  if (certModal) {
    certModal.addEventListener('click', (e) => {
      if (e.target === certModal) closeCertModal();
    });
  }

  // =========================================================================
  // 9. COPY TO CLIPBOARD UTILITY WITH TOAST FEEDBACK
  // =========================================================================
  const showToast = (message) => {
    let toast = document.getElementById('cyberToast');
    if (!toast) {
      toast = document.createElement('div');
      toast.id = 'cyberToast';
      toast.style.position = 'fixed';
      toast.style.bottom = '2rem';
      toast.style.right = '2rem';
      toast.style.background = 'rgba(10, 13, 20, 0.95)';
      toast.style.border = '1px solid var(--accent-emerald)';
      toast.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.8), 0 0 20px rgba(16, 185, 129, 0.3)';
      toast.style.color = '#fff';
      toast.style.padding = '0.85rem 1.35rem';
      toast.style.borderRadius = '10px';
      toast.style.fontFamily = 'var(--font-mono)';
      toast.style.fontSize = '0.85rem';
      toast.style.zIndex = '3000';
      toast.style.backdropFilter = 'blur(12px)';
      toast.style.transition = 'all 0.3s cubic-bezier(0.16, 1, 0.3, 1)';
      toast.style.opacity = '0';
      toast.style.transform = 'translateY(15px)';
      document.body.appendChild(toast);
    }
    toast.innerHTML = `<i class="bi bi-check2-circle" style="color: var(--accent-emerald); margin-right: 0.5rem;"></i> ${message}`;
    toast.style.opacity = '1';
    toast.style.transform = 'translateY(0)';

    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateY(15px)';
    }, 2800);
  };

  document.querySelectorAll('[data-copy]').forEach((btn) => {
    btn.addEventListener('click', () => {
      const textToCopy = btn.getAttribute('data-copy');
      navigator.clipboard.writeText(textToCopy).then(() => {
        showToast(`Copied to clipboard: ${textToCopy}`);
      });
    });
  });

  // =========================================================================
  // 10. LIVE CAIRO CLOCK & SYSTEM TELEMETRY
  // =========================================================================
  const clockElement = document.getElementById('cairoTime');
  const pingElement = document.getElementById('livePing');

  const updateCairoClock = () => {
    if (clockElement) {
      const now = new Date();
      // Format to Cairo time (Africa/Cairo)
      const options = {
        timeZone: 'Africa/Cairo',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
      };
      clockElement.textContent = now.toLocaleTimeString('en-GB', options) + ' EET';
    }
  };

  setInterval(updateCairoClock, 1000);
  updateCairoClock();

  // Simulated jitter on server ping
  if (pingElement) {
    setInterval(() => {
      const randomPing = Math.floor(Math.random() * (35 - 24 + 1)) + 24;
      pingElement.textContent = `${randomPing}ms`;
    }, 4500);
  }

  // =========================================================================
  // 11. CONTACT FORM CLIENT-SIDE UX
  // =========================================================================
  const contactForm = document.getElementById('portfolioContactForm');
  const submitBtn = document.getElementById('contactSubmitBtn');

  if (contactForm && submitBtn) {
    contactForm.addEventListener('submit', (e) => {
      // Show loading spinner on button
      submitBtn.disabled = true;
      submitBtn.innerHTML = `
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="width: 1rem; height: 1rem; border: 2px solid #fff; border-right-color: transparent; border-radius: 50%; display: inline-block; animation: spin 0.75s linear infinite;"></span>
        Sending Message...
      `;
    });
  }
});
