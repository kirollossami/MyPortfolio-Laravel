<?php

namespace Database\Seeders;

use App\Models\ArchitecturePillar;
use App\Models\Certificate;
use App\Models\ContactMessage;
use App\Models\KirobotEntry;
use App\Models\Project;
use App\Models\SiteSetting;
use App\Models\TechStack;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Optional Admin User (only seeded if ADMIN_EMAIL & ADMIN_PASSWORD are provided in environment)
        $adminEmail = config('portfolio.admin_email');
        $adminPassword = config('portfolio.admin_password');
        if (!empty($adminEmail) && !empty($adminPassword)) {
            User::updateOrCreate(
                ['email' => strtolower(trim($adminEmail))],
                [
                    'name' => config('portfolio.admin_name', 'Portfolio Admin'),
                    'password' => Hash::make($adminPassword),
                    'email_verified_at' => now(),
                ]
            );
        }

        // 2. Site Settings
        $settings = [
            // SEO & General
            'site_title' => ['value' => 'Kirollos Samy Ishaq | Full-Stack Developer & Backend Engineer (.NET Core & Laravel)', 'group' => 'seo'],
            'meta_description' => ['value' => 'Official portfolio of Kirollos Samy Ishaq - Full-Stack Developer & Backend Engineer specializing in C#, .NET Core Web API, ASP.NET Core MVC, Laravel, Clean Architecture, SQL Server, and Redis Caching.', 'group' => 'seo'],
            'meta_keywords' => ['value' => 'Kirollos Samy Ishaq, Backend Engineer, Full-Stack Developer, .NET Core, C#, ASP.NET Core Web API, Laravel, PHP, Clean Architecture, SOLID Principles, SQL Server, Redis, Fawaterak, Paymob, Cairo Egypt', 'group' => 'seo'],
            'meta_author' => ['value' => 'Kirollos Samy Ishaq', 'group' => 'seo'],
            'og_url' => ['value' => 'https://kirollossamy.up.railway.app/', 'group' => 'seo'],

            // Brand & Media
            'brand_name' => ['value' => 'Kirollos Samy', 'group' => 'brand'],
            'brand_full_name' => ['value' => 'Kirollos Samy Ishaq', 'group' => 'brand'],
            'brand_subtitle' => ['value' => '.NET & LARAVEL SPECIALIST', 'group' => 'brand'],
            'nav_logo_path' => ['value' => 'assets/img/profile/kirollos_nav_logo.png', 'group' => 'brand'],
            'favicon_path' => ['value' => 'assets/img/favicon.png', 'group' => 'brand'],
            'hero_image_path' => ['value' => 'assets/img/profile/KirollosSamy.png', 'group' => 'hero'],
            'resume_path' => ['value' => 'assets/pdf/resume.pdf', 'group' => 'hero'],

            // Hero
            'is_available' => ['value' => '1', 'group' => 'hero'],
            'availability_text' => ['value' => 'Available for Backend & High-Impact Engineering Roles', 'group' => 'hero'],
            'hero_title_prefix' => ['value' => 'Building ', 'group' => 'hero'],
            'hero_title_highlight' => ['value' => 'High-Performance', 'group' => 'hero'],
            'hero_title_suffix' => ['value' => ' Backend Architecture & Scalable Web Solutions', 'group' => 'hero'],
            'hero_description' => ['value' => 'Full-Stack Developer & Backend Engineer specializing in <strong>C# .NET Core</strong>, <strong>Laravel</strong>, <strong>Clean Architecture</strong>, and <strong>High-Throughput Database Systems</strong>. Architecting rock-solid RESTful APIs, sub-50ms query pipelines, and resilient enterprise software.', 'group' => 'hero'],

            // Section Headers
            'architecture_badge' => ['value' => 'Core Pillars', 'group' => 'sections'],
            'architecture_title' => ['value' => 'Backend Architecture & System Competencies', 'group' => 'sections'],
            'architecture_subtitle' => ['value' => 'Engineering principles built on fault isolation, transactional safety, and scalable web API patterns.', 'group' => 'sections'],

            'projects_badge' => ['value' => 'Portfolio & Architecture', 'group' => 'sections'],
            'projects_title' => ['value' => 'Featured Production-Grade Projects', 'group' => 'sections'],
            'projects_subtitle' => ['value' => 'Proven software systems handling tenancy booking, examination engines, payment-integrated ecommerce, and enterprise portals.', 'group' => 'sections'],

            'credentials_badge' => ['value' => 'Verified Badges', 'group' => 'sections'],
            'credentials_title' => ['value' => 'Certifications & Engineering Milestones', 'group' => 'sections'],
            'credentials_subtitle' => ['value' => 'Officially verified technical credentials in advanced SQL, full-stack .NET, PHP/Laravel, and distributed DevOps workflows. Click any certificate to inspect full credentials.', 'group' => 'sections'],

            'testimonials_badge' => ['value' => 'Verified Social Proof', 'group' => 'sections'],
            'testimonials_title' => ['value' => 'Testimonials & Mentorship Endorsements', 'group' => 'sections'],
            'testimonials_subtitle' => ['value' => 'Direct feedback and recommendations from industry mentors and certified engineering instructors at NTI (National Telecommunication Institute) and DEPI (Digital Egypt Pioneers Initiative).', 'group' => 'sections'],

            'contact_badge' => ['value' => 'Initiate Collaboration', 'group' => 'sections'],
            'contact_title' => ['value' => "Let's Build Something Exceptional", 'group' => 'sections'],
            'contact_subtitle' => ['value' => 'Available for Backend Developer & Engineering roles, architectural consultations, and full-stack enterprise projects.', 'group' => 'sections'],
            'contact_form_title' => ['value' => 'Send a Secure Message', 'group' => 'sections'],
            'contact_form_subtitle' => ['value' => "Delivered directly to Kirollos Samy's inbox.", 'group' => 'sections'],
            'contact_notice' => ['value' => "Direct Transmission: Messages deliver instantly to Kirollos Samy's inbox with zero verification codes required.", 'group' => 'sections'],

            // Contact & Social
            'contact_email' => ['value' => 'kerollossami@gmail.com', 'group' => 'contact'],
            'whatsapp_display' => ['value' => '+20 10 340 37540 / +20 12 891 98945', 'group' => 'contact'],
            'whatsapp_url' => ['value' => 'https://wa.me/message/HEKWNGDE4LGHK1?src=qr', 'group' => 'contact'],
            'whatsapp_number' => ['value' => '201201977114', 'group' => 'contact'],
            'linkedin_display' => ['value' => 'linkedin.com/in/kirollossamy', 'group' => 'contact'],
            'linkedin_url' => ['value' => 'https://www.linkedin.com/in/kirollossamy', 'group' => 'contact'],
            'github_url' => ['value' => 'https://github.com/kirollossami', 'group' => 'contact'],

            // Footer & KiroBot
            'footer_credit_name' => ['value' => 'Kirollos Samy Ishaq', 'group' => 'footer'],
            'footer_copyright' => ['value' => 'Kirollos Samy Ishaq Tawfik. 100% Original Intellectual Property.', 'group' => 'footer'],
            'kirobot_enabled' => ['value' => '1', 'group' => 'kirobot'],
            'kirobot_greeting' => ['value' => "Hello! I'm KiroBot, your AI Architecture Guide. Voice is active 🔊! Click on ANY project, skill badge, architecture pillar, certificate, or text across the site, and I will explain its architecture and speak it aloud!", 'group' => 'kirobot'],
        ];

        foreach ($settings as $key => $meta) {
            SiteSetting::firstOrCreate(
                ['key' => $key],
                ['value' => $meta['value'], 'group' => $meta['group']]
            );
        }

        // 3. Core Tech Stack Badges
        if (TechStack::count() === 0) {
            $stacks = [
                ['name' => '.NET Core / C#', 'color' => 'sky'],
                ['name' => 'ASP.NET Core Web API', 'color' => 'blue'],
                ['name' => 'Laravel', 'color' => 'rose'],
                ['name' => 'SQL Server', 'color' => 'emerald'],
                ['name' => 'Redis', 'color' => 'amber'],
                ['name' => 'Paymob & Fawaterak', 'color' => 'sky'],
                ['name' => 'Hostinger VPS', 'color' => 'indigo'],
                ['name' => 'cPanel', 'color' => 'orange'],
                ['name' => 'CI/CD', 'color' => 'teal'],
                ['name' => 'Testing', 'color' => 'emerald'],
                ['name' => 'Deployment', 'color' => 'blue'],
            ];
            foreach ($stacks as $idx => $stack) {
                TechStack::create([
                    'name' => $stack['name'],
                    'color' => $stack['color'],
                    'sort_order' => $idx + 1,
                    'is_active' => true,
                ]);
            }
        }

        // 4. Architecture Pillars
        if (ArchitecturePillar::count() === 0) {
            $pillars = [
                [
                    'title' => 'Clean Architecture & SOLID',
                    'description' => 'Domain-Driven design, Onion Architecture, and N-Tier separation with CQRS patterns and Dependency Injection.',
                    'icon' => 'bi-diagram-2',
                    'color' => 'indigo',
                    'bullets' => [
                        'Domain / Application / Infra Isolation',
                        'Repository & Unit of Work',
                        'FluentValidation & DTO Mappings',
                    ],
                ],
                [
                    'title' => 'API Security & Payments',
                    'description' => 'RESTful APIs with JWT authentication, role policies, and payment integrations (Fawaterak, Paymob, Tap).',
                    'icon' => 'bi-arrow-left-right',
                    'color' => 'cyan',
                    'bullets' => [
                        'Verified Payment Webhooks',
                        'JWT & Token Rotation',
                        'OpenAPI & Swagger UI',
                    ],
                ],
                [
                    'title' => 'Database & Redis Cache',
                    'description' => 'SQL Server & MySQL optimization, recursive queries, index execution plans, and sub-5ms Redis caching.',
                    'icon' => 'bi-database-gear',
                    'color' => 'emerald',
                    'bullets' => [
                        'Stored Procedures & Triggers',
                        'Redis In-Memory Caching',
                        'Query Execution Profiling',
                    ],
                ],
                [
                    'title' => 'DevOps, Testing & VPS',
                    'description' => 'Hostinger VPS configuration, cPanel hosting, automated CI/CD pipelines, unit/integration testing, and zero-downtime deployment.',
                    'icon' => 'bi-cloud-check',
                    'color' => 'purple',
                    'bullets' => [
                        'Hostinger VPS & cPanel',
                        'Automated CI/CD & Deployment',
                        'Unit & Integration Testing',
                    ],
                ],
            ];
            foreach ($pillars as $idx => $pillar) {
                ArchitecturePillar::create(array_merge($pillar, [
                    'sort_order' => $idx + 1,
                    'is_active' => true,
                ]));
            }
        }

        // 5. Projects
        if (Project::count() === 0) {
            $projects = [
                [
                    'slug' => 'unistay',
                    'title' => 'UniStay — Student Housing Booking Platform',
                    'framework' => 'dotnet',
                    'framework_label' => 'ASP.NET Core Web API',
                    'architecture' => 'ntier',
                    'architecture_label' => 'N-Tier Architecture',
                    'image_path' => 'assets/img/projects/unistay.png',
                    'badge_text' => '🟢 Production Deployed',
                    'badge_color' => 'text-cyan-400 bg-black/80 border-white/15',
                    'tech_tags' => ['ASP.NET Core Web API', 'Angular', 'N-Tier', 'SQL Server', 'JWT Auth'],
                    'short_description' => 'Full-stack accommodation booking system built with ASP.NET Core Web API, Angular frontend, Entity Framework Core, and SQL Server. Implemented atomic room reservations, JWT role authentication, and Swagger API documentation.',
                    'long_description' => 'Engineered a scalable multi-campus student housing platform using ASP.NET Core Web API, Angular, Entity Framework Core, and SQL Server. Solved real-time room inventory concurrency issues with ACID database transactions, preventing double-bookings. Built role-based access control (Student, Landlord, Admin) and automated email confirmation workflows.',
                    'highlights' => [
                        'Atomic room reservation pipeline preventing race-condition double bookings',
                        'JWT token authentication with refresh token rotation and role authorization policies',
                        'Entity Framework Core Code-First migrations with Fluent API schema configurations',
                        'Interactive Swagger/OpenAPI documentation and Angular frontend client',
                    ],
                    'demo_url' => 'https://lnkd.in/p/ennnGR6c',
                    'demo_label' => 'View LinkedIn Showcase',
                    'github_url' => 'https://github.com/kirollossami',
                ],
                [
                    'slug' => 'examination',
                    'title' => 'Automated Examination & Assessment Engine',
                    'framework' => 'dotnet',
                    'framework_label' => 'C# .NET / SQL Server',
                    'architecture' => 'clean',
                    'architecture_label' => 'Clean Architecture',
                    'image_path' => 'assets/img/projects/examination.jpg',
                    'badge_text' => '⚡ High-Concurrency DB Engine',
                    'badge_color' => 'text-emerald-400 bg-black/80 border-white/15',
                    'tech_tags' => ['SQL Server SPs', 'C# .NET Engine', 'ACID Transactions', 'Audit Logging'],
                    'short_description' => 'Computerized examination and scoring system engineered with optimized SQL Server Stored Procedures, Views, and Transactions, paired with a C# assessment execution core for deterministic question pools and instant grade evaluations.',
                    'long_description' => 'High-throughput assessment engine capable of generating deterministic randomized exams across complex question banks. Heavy business rules and scoring algorithms are compiled directly inside SQL Server Stored Procedures and indexed Views for zero-latency question retrieval, with ACID transaction safeguards against exam submission timeouts.',
                    'highlights' => [
                        'Complex SQL Server Stored Procedures with execution plan tuning and zero table scans',
                        'C# assessment core with deterministic randomization algorithms for cheat prevention',
                        'Automated real-time grading calculation with immediate student score telemetry',
                        'Auditing triggers logging every submission attempt and system interaction',
                    ],
                    'demo_url' => 'https://github.com/kirollossami',
                    'demo_label' => 'View SQL & C# Architecture',
                    'github_url' => 'https://github.com/kirollossami',
                ],
                [
                    'slug' => 'medflow',
                    'title' => 'MedFlow AI — Clinical Workflow & Healthcare Platform',
                    'framework' => 'dotnet',
                    'framework_label' => 'ASP.NET Core & Laravel',
                    'architecture' => 'microservices',
                    'architecture_label' => 'RESTful APIs & Microservices',
                    'image_path' => 'assets/img/projects/medflow.jpg',
                    'badge_text' => '🏥 Clinical Workflow API',
                    'badge_color' => 'text-cyan-400 bg-black/80 border-white/15',
                    'tech_tags' => ['.NET Core / Laravel', 'RESTful APIs', 'Redis Caching', 'Sub-50ms Latency'],
                    'short_description' => 'Healthcare backend managing patient triage queues, physician availability, and encrypted health records. Features Redis caching for real-time doctor schedules, automated background notifications, and role-based ACL security.',
                    'long_description' => 'Mission-critical healthcare backend engineered with RESTful APIs, Redis in-memory caching for sub-5ms doctor schedule queries, and asynchronous background worker queues. Strictly enforces patient privacy compliance with AES-256 field encryption and granular role-based ACLs.',
                    'highlights' => [
                        'Sub-50ms API response SLA achieved via Redis in-memory cache distribution',
                        'Role-based ACLs isolating Doctor, Patient, Triage Nurse, and Hospital Admin operations',
                        'Encrypted EHR (Electronic Health Record) vault with cryptographically verified access logs',
                        'Asynchronous job scheduler dispatching SMS & email appointment reminders',
                    ],
                    'demo_url' => 'https://github.com/kirollossami',
                    'demo_label' => 'View Architecture Specs',
                    'github_url' => 'https://github.com/kirollossami',
                ],
                [
                    'slug' => 'rawkemya',
                    'title' => 'Raw Kemya — B2B Chemical Distribution & Payment Engine',
                    'framework' => 'laravel',
                    'framework_label' => 'Laravel (PHP)',
                    'architecture' => 'mvc',
                    'architecture_label' => 'Modular Monolith',
                    'image_path' => 'assets/img/projects/raw_kemya.jpg',
                    'badge_text' => '💳 Dual Payment Gateway',
                    'badge_color' => 'text-cyan-400 bg-black/80 border-white/15',
                    'tech_tags' => ['Laravel', 'Paymob & Fawaterak', 'State Machine', 'Nginx VPS'],
                    'short_description' => 'Wholesale chemical ordering backend. Features dual payment gateway integration (Paymob and Fawaterak) with cryptographically verified webhooks, dynamic inventory stock reservation, and automated PDF invoice generation.',
                    'long_description' => 'Enterprise chemical distribution system handling wholesale bulk procurement. Integrated both Paymob and Fawaterak payment providers with HMAC cryptographically validated webhooks, dynamic inventory stock reservation with expiration timers, and automated PDF invoice generation.',
                    'highlights' => [
                        'Dual payment gateway failover system (Paymob & Fawaterak) with verified webhook HMACs',
                        'Inventory stock reservation lock during checkout preventing overselling volatile chemical lots',
                        'Automated transactional PDF invoices dispatched via queued mailers',
                        'Production deployed on Nginx Linux VPS with automated SSL and database replication',
                    ],
                    'demo_url' => 'https://github.com/kirollossami',
                    'demo_label' => 'View Payment Workflow',
                    'github_url' => 'https://github.com/kirollossami',
                ],
                [
                    'slug' => 'hotelbooking',
                    'title' => 'Hotel Booking Management Platform',
                    'framework' => 'nodejs',
                    'framework_label' => 'Node.js & Express',
                    'architecture' => 'microservices',
                    'architecture_label' => 'RESTful APIs & Microservices',
                    'image_path' => 'assets/img/projects/Hotel Booking Managment.png',
                    'badge_text' => '🏨 Hospitality Architecture',
                    'badge_color' => 'text-yellow-400 bg-black/80 border-white/15',
                    'tech_tags' => ['Node.js', 'Express', 'JWT Authentication', 'REST APIs', 'MongoDB/SQL'],
                    'short_description' => 'Comprehensive hospitality booking backend handling guest reservations, room availability state machines, dynamic seasonal pricing calculation, and automated check-in/check-out ledger.',
                    'long_description' => 'High-performance Node.js & Express RESTful API backend managing reservation lifecycles, dynamic seasonal room pricing models, guest check-in/check-out ledger, and automated payment receipts.',
                    'highlights' => [
                        'Non-blocking asynchronous Node.js event loop processing concurrent reservation queries',
                        'Modular routing architecture with express middleware for JWT authorization',
                        'Comprehensive room categorization and dynamic seasonal pricing calculation engine',
                        'Robust error-handling middleware with centralized logging and HTTP status formatting',
                    ],
                    'demo_url' => 'https://www.linkedin.com/posts/kirollossamy_codvedajourney-codvedaexperience-futurewithcodveda-activity-7389320280520683522-FStA?utm_source=share&utm_medium=member_desktop&rcm=ACoAAFeMbnkBo3Qlhw5z8VmxjWD0wV_ZAib3PF0',
                    'demo_label' => 'View LinkedIn Showcase',
                    'github_url' => 'https://github.com/kirollossami',
                ],
                [
                    'slug' => 'educationsystem',
                    'title' => 'Training Company Education System',
                    'framework' => 'laravel',
                    'framework_label' => 'Laravel (PHP)',
                    'architecture' => 'mvc',
                    'architecture_label' => 'MVC Architecture',
                    'image_path' => 'assets/img/projects/Education_System.png',
                    'badge_text' => '🎓 Educational ERP',
                    'badge_color' => 'text-indigo-400 bg-black/80 border-white/15',
                    'tech_tags' => ['Laravel Framework', 'Eloquent ORM', 'Blade UI', 'MySQL', 'Role ACL'],
                    'short_description' => 'Educational management portal built with Laravel Framework for course tracking, student enrollment pipelines, instructor assignments, quiz grading, and progress analytics.',
                    'long_description' => 'Multi-tenant learning portal engineered with Laravel, Eloquent ORM, and MySQL. Features course syllabus tracking, student enrollment workflows, instructor assignment grading, and PDF certificate generation.',
                    'highlights' => [
                        'Eloquent ORM relational schema handling students, instructors, courses, and submissions',
                        'Blade view templating paired with responsive UI and interactive progress charts',
                        'Role-based access control protecting administrative grading portals and student resources',
                        'Automated student completion certificates generated dynamically upon course graduation',
                    ],
                    'demo_url' => 'https://lnkd.in/p/eN9pdeHj',
                    'demo_label' => 'View LinkedIn Showcase',
                    'github_url' => 'https://github.com/kirollossami',
                ],
                [
                    'slug' => 'dashboardphp',
                    'title' => 'Enterprise Admin Dashboard & CRM',
                    'framework' => 'laravel',
                    'framework_label' => 'Native PHP',
                    'architecture' => 'mvc',
                    'architecture_label' => 'Pure Native PHP & MVC',
                    'image_path' => 'assets/img/projects/Dashboard Design Using Native PHP.png',
                    'badge_text' => '📊 High-Efficiency CRM',
                    'badge_color' => 'text-cyan-400 bg-black/80 border-white/15',
                    'tech_tags' => ['Native PHP', 'MySQL Database', 'Session Security', 'Zero-Dependency'],
                    'short_description' => 'Lightweight, zero-overhead administrative control center and CRM engineered with pure Native PHP, robust session security, complex SQL joins, and dynamic reporting charts.',
                    'long_description' => 'Custom administrative portal built from scratch using pure Native PHP (OOP & Procedural) without bulky external frameworks. Features sub-10ms page rendering, secure session management, customer order analytics, and dynamic MySQL reporting.',
                    'highlights' => [
                        'Pure Native PHP engineering demonstrating deep mastery of the core runtime and PDO',
                        'Custom routing and MVC separation implemented without third-party dependencies',
                        'Complex multi-table SQL queries generating real-time sales and inventory metrics',
                        'Strict XSS sanitation, CSRF token validation, and SQL injection prevention via prepared statements',
                    ],
                    'demo_url' => 'https://www.linkedin.com/posts/kirollossamy_nti-summertraining-webdevelopment-activity-7367533742602539008-rJTX?utm_source=share&utm_medium=member_desktop&rcm=ACoAAFeMbnkBo3Qlhw5z8VmxjWD0wV_ZAib3PF0',
                    'demo_label' => 'View LinkedIn Showcase',
                    'github_url' => 'https://github.com/kirollossami',
                ],
            ];
            foreach ($projects as $idx => $project) {
                Project::create(array_merge($project, [
                    'sort_order' => $idx + 1,
                    'is_active' => true,
                ]));
            }
        }

        // 6. Certificates
        if (Certificate::count() === 0) {
            $certificates = [
                [
                    'slug' => 'cert_sql_advanced',
                    'title' => 'SQL (Advanced) Certification',
                    'issuer' => 'HackerRank Verified',
                    'badge_text' => 'GOLD MEDAL',
                    'color' => 'emerald',
                    'description' => 'Demonstrated mastery of recursive queries, window aggregations (`DENSE_RANK()`, `ROW_NUMBER()`), and deep query plan optimizations across large-scale datasets.',
                    'issued_date' => 'Dec 2025',
                    'image_path' => 'assets/img/AdvancedSQL.png',
                    'pdf_path' => 'assets/pdf/sql_advanced_certificate.pdf',
                ],
                [
                    'slug' => 'cert_depi',
                    'title' => 'Full Stack .NET Web Development',
                    'issuer' => 'DEPI — Digital Egypt Pioneers',
                    'badge_text' => 'MCIT TRACK',
                    'color' => 'indigo',
                    'description' => '200-Hour intensive track covering C#, ASP.NET Core Web API, Entity Framework Core, SQL Server, N-Tier Architecture, and modern frontend development.',
                    'issued_date' => 'Class 2026',
                    'image_path' => 'assets/img/Kirollos Samy Ishaq - Depi.png',
                    'pdf_path' => 'assets/pdf/Kirollos Samy Ishaq Tawfik - DEPI.pdf',
                ],
                [
                    'slug' => 'cert_nti',
                    'title' => 'Full Stack PHP & Laravel',
                    'issuer' => 'NTI Institute Egypt',
                    'badge_text' => 'MINISTRY DIPLOMA',
                    'color' => 'cyan',
                    'description' => '120-Hour intensive curriculum in native PHP engineering, Laravel framework, MySQL optimization, and professional freelance consulting.',
                    'issued_date' => 'Class 2025',
                    'image_path' => 'assets/img/Kirollos Samy Ishaq Tawfik.png',
                    'pdf_path' => 'assets/pdf/certificate.pdf',
                ],
                [
                    'slug' => 'cert_sql_intermediate',
                    'title' => 'SQL (Intermediate) Certification',
                    'issuer' => 'HackerRank Verified',
                    'badge_text' => 'SPECIALIST',
                    'color' => 'purple',
                    'description' => 'Advanced multi-table joins, subqueries, grouping set rollups, indexing strategies, and relational schema integrity across SQL servers.',
                    'issued_date' => 'Nov 2025',
                    'image_path' => 'assets/img/IntermediateSQL.png',
                    'pdf_path' => 'assets/pdf/sql_intermediate_certificate.pdf',
                ],
                [
                    'slug' => 'cert_sql_basic',
                    'title' => 'SQL (Basic) Certification',
                    'issuer' => 'HackerRank Verified',
                    'badge_text' => 'FOUNDATION',
                    'color' => 'blue',
                    'description' => 'Relational algebra fundamentals, data filtering predicates, aggregate functions, and normalized DDL/DML transactions.',
                    'issued_date' => 'Oct 2025',
                    'image_path' => 'assets/img/BasicSQL.png',
                    'pdf_path' => 'assets/pdf/sql_basic_certificate.pdf',
                ],
                [
                    'slug' => 'cert_github',
                    'title' => 'Git & GitHub Professional',
                    'issuer' => 'ElMadrasah Academy',
                    'badge_text' => 'DEVOPS & VCS',
                    'color' => 'amber',
                    'description' => 'Distributed version control, branching models (GitFlow), interactive rebase, pull request review cycles, and merge conflict resolution.',
                    'issued_date' => 'Sep 2025',
                    'image_path' => 'assets/img/GitHubCertificate.png',
                    'pdf_path' => 'assets/pdf/Git&GitHub_Certificate.pdf',
                ],
            ];
            foreach ($certificates as $idx => $cert) {
                Certificate::create(array_merge($cert, [
                    'sort_order' => $idx + 1,
                    'is_active' => true,
                ]));
            }
        }

        // 7. Testimonials
        if (Testimonial::count() === 0) {
            $testimonials = [
                [
                    'author_name' => 'Eng. Islam Ramadan',
                    'author_role' => 'Technical Instructor at NTI',
                    'author_subtitle' => 'Full Stack PHP & Laravel',
                    'author_image_path' => 'assets/img/testimonials/eng_islam_ramadan.jpeg',
                    'badge_text' => 'NTI INSTRUCTOR',
                    'color' => 'cyan',
                    'quote' => 'جهد محترم يحترم , عاش جدا يا هندسة , Keep going 💪💪',
                    'is_rtl' => true,
                    'linkedin_url' => 'https://www.linkedin.com/feed/update/urn:li:ugcPost:7367531327102844928?commentUrn=urn%3Ali%3Acomment%3A%28ugcPost%3A7367531327102844928%2C7367886165582012416%29&dashCommentUrn=urn%3Ali%3Afsd_comment%3A%287367886165582012416%2Curn%3Ali%3AugcPost%3A7367531327102844928%29',
                ],
                [
                    'author_name' => 'Eng. Islam Ramadan',
                    'author_role' => 'Technical Instructor at NTI',
                    'author_subtitle' => 'Full Stack PHP & Laravel',
                    'author_image_path' => 'assets/img/testimonials/eng_islam_ramadan.jpeg',
                    'badge_text' => 'TOP STUDENT',
                    'color' => 'cyan',
                    'quote' => 'Greeeeeet work eng kirolos One of best students Keep going 💪',
                    'is_rtl' => false,
                    'linkedin_url' => 'https://www.linkedin.com/feed/update/urn:li:ugcPost:7369440555149262848?commentUrn=urn%3Ali%3Acomment%3A%28ugcPost%3A7369440555149262848%2C7370007198694813697%29&dashCommentUrn=urn%3Ali%3Afsd_comment%3A%287370007198694813697%2Curn%3Ali%3AugcPost%3A7369440555149262848%29',
                ],
                [
                    'author_name' => 'Eng. Abdelrahman Shaaban',
                    'author_role' => 'Technical Instructor at DEPI',
                    'author_subtitle' => 'Full Stack .NET Development',
                    'author_image_path' => 'assets/img/testimonials/Eng_Abdelrahman.jpg',
                    'badge_text' => 'DEPI .NET LEAD',
                    'color' => 'indigo',
                    'quote' => 'Proud of your progress wishing you all the best',
                    'is_rtl' => false,
                    'linkedin_url' => 'https://www.linkedin.com/feed/update/urn:li:ugcPost:7409554845323587584?commentUrn=urn%3Ali%3Acomment%3A%28ugcPost%3A7409554845323587584%2C7409806894380535808%29&dashCommentUrn=urn%3Ali%3Afsd_comment%3A%287409806894380535808%2Curn%3Ali%3AugcPost%3A7409554845323587584%29',
                ],
                [
                    'author_name' => 'Eng. Hossam Ashraf',
                    'author_role' => 'Soft Skills Instructor at DEPI',
                    'author_subtitle' => 'Professional Leadership',
                    'author_image_path' => 'assets/img/testimonials/Eng_HossamAshraf.jpg',
                    'badge_text' => 'DEPI MENTOR',
                    'color' => 'emerald',
                    'quote' => 'عاااش يا هندسه فخور جدا بيك ربنا يوفقك في اللي جي ❤️',
                    'is_rtl' => true,
                    'linkedin_url' => 'https://www.linkedin.com/feed/update/urn:li:activity:7437545935284482048?commentUrn=urn%3Ali%3Acomment%3A%28activity%3A7437545935284482048%2C7437826334766051328%29&dashCommentUrn=urn%3Ali%3Afsd_comment%3A%287437826334766051328%2Curn%3Ali%3Aactivity%3A7437545935284482048%29',
                ],
                [
                    'author_name' => 'Eng. Hossam Ashraf',
                    'author_role' => 'Soft Skills Instructor at DEPI',
                    'author_subtitle' => 'Professional Leadership',
                    'author_image_path' => 'assets/img/testimonials/Eng_HossamAshraf.jpg',
                    'badge_text' => 'DEPI GRADUATION',
                    'color' => 'emerald',
                    'quote' => 'الف مبروك يا هندسة مبروووك التخرج وربنا يوفقك ف اللي جي ❤️❤️',
                    'is_rtl' => true,
                    'linkedin_url' => 'https://www.linkedin.com/feed/update/urn:li:activity:7449447854357565440?commentUrn=urn%3Ali%3Acomment%3A%28activity%3A7449447854357565440%2C7449458538038431744%29&dashCommentUrn=urn%3Ali%3Afsd_comment%3A%287449458538038431744%2Curn%3Ali%3Aactivity%3A7449447854357565440%29',
                ],
            ];
            foreach ($testimonials as $idx => $item) {
                Testimonial::create(array_merge($item, [
                    'sort_order' => $idx + 1,
                    'is_active' => true,
                ]));
            }
        }

        // 8. KiroBot Section Radar & Knowledge Base Entries
        if (KirobotEntry::count() === 0) {
            $sectionExplanations = [
                'hero' => "Welcome! You are viewing Kirollos Samy's command deck. Notice the active availability badge and sub-50ms API latency benchmark target.",
                'architecture' => 'Exploring the 4 Pillars: Clean Architecture with SOLID, secure REST APIs with Fawaterak & Paymob, database tuning with Redis, and Hostinger VPS / CI/CD deployment.',
                'projects' => "Reviewing Featured Projects: Check out UniStay's N-Tier architecture, the Examination Engine's stored procedures, and MedFlow AI's Redis caching layer.",
                'credentials' => 'Inspecting Verified Credentials: Kirollos earned HackerRank SQL (Advanced), DEPI 200h .NET Diploma, and NTI Web Development certifications.',
                'testimonials' => "Inspecting Verified Endorsements: 5 high-impact recommendations from technical instructors at NTI and DEPI praising Kirollos's backend engineering proficiency and top-student status.",
                'contact' => 'Ready to collaborate? Transmit a secure brief through this form or reach out directly on WhatsApp or LinkedIn!',
            ];
            $idx = 1;
            foreach ($sectionExplanations as $key => $content) {
                KirobotEntry::create([
                    'type' => 'section',
                    'key' => $key,
                    'label' => strtoupper($key) . ' Section Radar',
                    'content' => $content,
                    'sort_order' => $idx++,
                    'is_active' => true,
                ]);
            }

            $knowledgeBase = [
                'clean architecture' => 'Clean Architecture organizes software into concentric layers: Core Domain at the center, followed by Application use-cases with CQRS handlers, Infrastructure repositories, and API Presentation, ensuring zero vendor lock-in and 100% testability.',
                'solid' => 'SOLID Principles: Single Responsibility, Open-Closed, Liskov Substitution, Interface Segregation, and Dependency Inversion. Kirollos applies SOLID to eliminate code fragility and guarantee maintainability.',
                'cqrs' => 'Command Query Responsibility Segregation (CQRS): Segregates write mutations (Commands) from read queries (Queries), optimizing database throughput and scaling data pipelines independently.',
                'n-tier' => 'N-Tier Architecture: Rigid multi-layer separation isolating Presentation (Angular/Blade), Business Logic Layer (BLL), Data Access Layer (DAL), and SQL Server database storage.',
                'jwt' => 'JSON Web Tokens: Stateless, cryptographically signed authentication with HMAC-SHA256, short-lived access tokens, and secure refresh token rotation stored in HttpOnly cookies.',
                'redis' => 'Redis In-Memory Cache: Kirollos achieves sub-5ms data access by caching volatile doctor availability schedules, student room inventory, and session tokens.',
                'fawaterak' => 'Fawaterak Payment Gateway: Automated multi-provider invoice generation, checkout redirects, and cryptographically verified webhook transaction reconciliation.',
                'paymob' => 'Paymob Payment Gateway: Card tokenization, checkout iframes, and cryptographically verified HMAC webhook signatures with idempotent transaction ledgers.',
                'hostinger' => 'Hostinger Linux VPS: Configured with SSH key hardening, UFW firewall security, systemd background worker daemons, and automated backup schedules.',
                'vps' => 'Linux Virtual Private Server (VPS): Complete server administration including Nginx reverse proxies, SSL/TLS certificates, supervisor daemons, and zero-downtime releases.',
                'cpanel' => 'cPanel Hosting Automation: DNS zone file configurations, automated SSL cert issuance, scheduled cron jobs, and database administration.',
                'ci/cd' => 'CI/CD Automation: Continuous Integration and Continuous Deployment pipelines running automated linter checks, unit tests, and production deployments on Git commits.',
                'testing' => 'Automated Testing: Comprehensive unit, integration, and API contract test suites using xUnit (.NET) and PHPUnit (Laravel) to eliminate regressions.',
                'deployment' => 'Zero-Downtime Deployment: Automated production code deployment pipelines, atomic database migrations, and environment secret encryption.',
                'contact' => 'Direct Contact: Reach Kirollos Samy directly via email (kerollossami@gmail.com) or WhatsApp (+201201977114).',
                'stored procedures' => 'Stored Procedures: Compiled SQL Server database logic ensuring zero network overhead, sub-millisecond execution, and cheat-proof exam grading calculations.',
                'hackerrank' => 'HackerRank Verified Gold Medal: Achieved top accreditation confirming advanced proficiency in recursive CTEs, window functions, and execution plan optimization.',
                'depi' => 'DEPI (Digital Egypt Pioneers Initiative): 200-hour Ministry of Communications track specializing in enterprise C#, ASP.NET Core, and modern web engineering.',
                'nti' => 'NTI (National Telecommunication Institute): Intensive Ministry of Communications diploma certifying Full-Stack PHP, Laravel, and MySQL database administration.',
                '.net' => ".NET Core & C#: Kirollos's primary high-performance backend ecosystem, delivering sub-50ms API throughput and Clean Architecture standards.",
                'c#' => 'C# is an enterprise object-oriented language. Kirollos utilizes modern C# language features, async/await concurrency, and deterministic resource management.',
                'asp.net' => 'ASP.NET Core Web API: Built with modular middleware pipelines, JWT role authorization, FluentValidation filters, and Swagger OpenAPI schemas.',
                'ef core' => 'Entity Framework Core: Object-Relational Mapper (ORM) configured with fluent API modeling, shadow properties, split queries, and optimized database migrations.',
                'laravel' => 'Laravel Framework: Kirollos utilizes Eloquent ORM, Service Providers, queued event listeners, Blade UI, and database migrations.',
                'php' => 'PHP & Native PHP: Deep mastery of the core PHP runtime (both OOP and Procedural), raw PDO database connections, and session security.',
                'node' => 'Node.js & Express: Non-blocking asynchronous event-loop architecture handling concurrent hospitality booking queries and dynamic seasonal room pricing.',
                'sql server' => 'Microsoft SQL Server: Advanced relational schema design, clustered/non-clustered indexing, execution plan tuning, and ACID transactions.',
                'mysql' => 'MySQL: Relational database administration, schema normalization, multi-table joins, and transaction safeguards engineered across Laravel applications.',
                'postgresql' => 'PostgreSQL: Advanced open-source relational database utilizing JSONB indexing, connection pooling, and complex transactional consistency.',
                'docker' => 'Docker Containerization: Lightweight, reproducible containers encapsulating application runtimes, database instances, and caching services for consistent environments.',
                'angular' => 'Angular Frontend: Modern TypeScript framework utilizing reactive forms, RxJS observables, and modular component architecture.',
                'blade' => 'Laravel Blade: High-performance templating engine rendering dynamic views with component slots, directive caches, and minimal runtime overhead.',
                'github' => 'Git & GitHub Workflow: Professional distributed version control, GitFlow branching models, interactive rebase, and code review lifecycles.',
                'resume' => "Kirollos Samy's Resume: Detailed official engineering resume highlighting production projects, verified certifications, and backend system architecture metrics.",
                'email' => "Direct Inquiries: Delivered instantly and directly to Kirollos Samy's personal inbox (kerollossami@gmail.com).",
                'whatsapp' => 'WhatsApp Direct: Instant direct communications channel with Kirollos Samy (+20 10 340 37540) for engineering opportunities.',
                'linkedin' => 'LinkedIn Profile: Connect with Kirollos Samy on LinkedIn to view verified endorsements, professional connections, and engineering updates.',
                'unistay' => 'UniStay Platform: Enterprise student housing platform built on N-Tier architecture, integrating Paymob escrow payments and Redis availability caching.',
                'examination' => 'Examination Engine: Automated testing and assessment platform powered by compiled SQL Server stored procedures and real-time fraud detection.',
                'medflow' => 'MedFlow AI: Enterprise clinical management system featuring automated appointment scheduling, doctor shift management, and encrypted patient records.',
                'taskflow' => 'TaskFlow Pro: Collaborative workflow and Kanban board application implementing real-time team notifications and role-based permissions.',
                'quickcart' => 'QuickCart: High-concurrency e-commerce engine with inventory locking, Fawaterak payment processing, and automated order fulfillment.',
                'latency' => 'Sub-50ms API Latency: Architectural design benchmark achieved through index tuning, Redis caching, non-blocking asynchronous I/O, and payload minimization.',
                'availability' => 'Immediate Availability: Kirollos Samy is actively available for full-time engineering roles, backend systems development, or contract assignments.',
            ];
            $kIdx = 1;
            foreach ($knowledgeBase as $key => $content) {
                KirobotEntry::create([
                    'type' => 'keyword',
                    'key' => $key,
                    'label' => strtoupper($key),
                    'content' => $content,
                    'sort_order' => $kIdx++,
                    'is_active' => true,
                ]);
            }
        }

        // 9. Import existing inquiries.json into contact_messages if empty
        if (ContactMessage::count() === 0) {
            $inquiriesFile = storage_path('app/inquiries.json');
            if (is_file($inquiriesFile)) {
                $items = json_decode((string) file_get_contents($inquiriesFile), true);
                if (is_array($items)) {
                    foreach (array_reverse($items) as $item) {
                        if (empty($item['email']) || empty($item['message'])) {
                            continue;
                        }
                        ContactMessage::create([
                            'name' => $item['name'] ?? 'Visitor',
                            'email' => $item['email'],
                            'subject' => $item['subject'] ?? 'Portfolio Inquiry',
                            'message' => $item['message'],
                            'ip_address' => $item['ip'] ?? null,
                            'user_agent' => $item['user_agent'] ?? null,
                            'mail_delivered' => false,
                            'is_read' => false,
                        ]);
                    }
                }
            }
        }
    }
}

