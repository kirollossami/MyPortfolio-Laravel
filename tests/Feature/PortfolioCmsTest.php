<?php

namespace Tests\Feature;

use App\Mail\AdminPasswordResetOtpMail;
use App\Models\ArchitecturePillar;
use App\Models\Certificate;
use App\Models\ContactMessage;
use App\Models\KirobotEntry;
use App\Models\Project;
use App\Models\SiteSetting;
use App\Models\TechStack;
use App\Models\Testimonial;
use App\Models\User;
use Database\Seeders\PortfolioSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class PortfolioCmsTest extends TestCase
{
    use RefreshDatabase;

    private function createAdmin(string $email = 'owner@example.com', string $password = 'SecretPass123!'): User
    {
        return User::create([
            'name' => 'Portfolio Admin',
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(PortfolioSeeder::class);
    }

    public function test_public_frontend_renders_all_dynamic_sections_from_database(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertSee('Kirollos Samy')
            ->assertSee('Clean Architecture &amp; SOLID', false)
            ->assertSee('UniStay')
            ->assertSee('SQL (Advanced) Certification')
            ->assertSee('Eng. Islam Ramadan')
            ->assertSee('All Frameworks (7)')
            ->assertSee('All Architectures (7)');
    }

    public function test_database_updates_reflect_immediately_on_frontend(): void
    {
        SiteSetting::setMany(['brand_name' => 'Dynamic Architect'], 'brand');
        TechStack::create(['name' => 'Kubernetes', 'color' => 'cyan', 'sort_order' => 99, 'is_active' => true]);
        Project::create([
            'slug' => 'cloud-gateway',
            'title' => 'Cloud Gateway Microservice',
            'framework' => 'dotnet',
            'framework_label' => 'ASP.NET Core',
            'architecture' => 'clean',
            'architecture_label' => 'Clean Architecture',
            'short_description' => 'Short gateway summary',
            'long_description' => 'Long gateway architecture overview',
            'sort_order' => 99,
            'is_active' => true,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertSee('Dynamic Architect')
            ->assertSee('Kubernetes')
            ->assertSee('Cloud Gateway Microservice')
            ->assertSee('All Frameworks (8)');
    }

    public function test_contact_submission_persists_message_to_database(): void
    {
        $response = $this->postJson(route('contact.submit'), [
            'name' => 'Jane Recruiter',
            'email' => 'jane@company.com',
            'subject' => 'Senior Backend Role',
            'message' => 'We would love to schedule an architecture interview with you.',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Jane Recruiter',
            'email' => 'jane@company.com',
            'subject' => 'Senior Backend Role',
            'is_read' => false,
        ]);
    }

    public function test_admin_routes_require_authentication(): void
    {
        $this->get('/admin')->assertRedirect(route('login'));
        $this->get('/admin/projects')->assertRedirect(route('login'));
        $this->get('/admin/settings')->assertRedirect(route('login'));
    }

    public function test_admin_login_and_dashboard_access(): void
    {
        $this->createAdmin('owner@example.com', 'SecretPass123!');

        $this->post(route('login.attempt'), [
            'email' => 'owner@example.com',
            'password' => 'SecretPass123!',
        ])->assertRedirect(route('admin.dashboard'));

        $this->get(route('admin.dashboard'))
            ->assertStatus(200)
            ->assertSee('Dashboard Overview');
    }

    public function test_admin_can_crud_all_dynamic_portfolio_resources(): void
    {
        $admin = $this->createAdmin();
        $this->actingAs($admin);

        // 1. Settings update
        $this->put(route('admin.settings.update'), [
            'site_title' => 'Updated Portfolio Title',
            'meta_description' => 'Updated meta description',
            'meta_keywords' => 'laravel, dotnet',
            'meta_author' => 'Kirollos Samy',
            'brand_name' => 'Kirollos Updated',
            'brand_full_name' => 'Kirollos Samy Ishaq',
            'brand_subtitle' => 'SYSTEMS ARCHITECT',
            'is_available' => '1',
            'availability_text' => 'Open to Consulting',
            'hero_title_prefix' => 'Engineering ',
            'hero_title_highlight' => 'Resilient',
            'hero_title_suffix' => ' Backends',
            'hero_description' => 'Custom hero description',
            'architecture_badge' => 'Pillars',
            'architecture_title' => 'Core Systems',
            'architecture_subtitle' => 'Sub',
            'projects_badge' => 'Work',
            'projects_title' => 'Projects',
            'projects_subtitle' => 'Sub',
            'credentials_badge' => 'Certs',
            'credentials_title' => 'Credentials',
            'credentials_subtitle' => 'Sub',
            'testimonials_badge' => 'Proof',
            'testimonials_title' => 'Testimonials',
            'testimonials_subtitle' => 'Sub',
            'contact_badge' => 'Hire',
            'contact_title' => 'Contact',
            'contact_subtitle' => 'Sub',
            'contact_form_title' => 'Message',
            'contact_form_subtitle' => 'Sub',
            'contact_notice' => 'Notice',
            'contact_email' => 'kerollossami@gmail.com',
            'whatsapp_display' => '+201000000000',
            'whatsapp_url' => 'https://wa.me/201000000000',
            'whatsapp_number' => '201000000000',
            'linkedin_display' => 'linkedin.com/in/kirollossamy',
            'linkedin_url' => 'https://www.linkedin.com/in/kirollossamy',
            'github_url' => 'https://github.com/kirollossami',
            'footer_credit_name' => 'Kirollos Samy',
            'footer_copyright' => 'All rights reserved.',
            'kirobot_enabled' => '1',
            'kirobot_greeting' => 'Hello from DB!',
        ])->assertRedirect(route('admin.settings.edit'));

        $this->assertSame('Kirollos Updated', SiteSetting::getValue('brand_name'));

        // 2. TechStack CRUD
        $this->post(route('admin.tech-stacks.store'), [
            'name' => 'GraphQL',
            'color' => 'purple',
            'sort_order' => 12,
            'is_active' => '1',
        ])->assertRedirect(route('admin.tech-stacks.index'));
        $stack = TechStack::where('name', 'GraphQL')->firstOrFail();
        $this->put(route('admin.tech-stacks.update', $stack), [
            'name' => 'GraphQL Federation',
            'color' => 'cyan',
            'sort_order' => 13,
            'is_active' => '1',
        ])->assertRedirect(route('admin.tech-stacks.index'));
        $this->assertDatabaseHas('tech_stacks', ['name' => 'GraphQL Federation']);
        $this->delete(route('admin.tech-stacks.destroy', $stack))->assertRedirect(route('admin.tech-stacks.index'));

        // 3. Architecture Pillar CRUD
        $this->post(route('admin.pillars.store'), [
            'title' => 'Event-Driven Systems',
            'description' => 'Kafka and RabbitMQ pipelines.',
            'icon' => 'bi-lightning',
            'color' => 'amber',
            'bullets_text' => "Outbox Pattern\nIdempotent Consumers",
            'sort_order' => 5,
            'is_active' => '1',
        ])->assertRedirect(route('admin.pillars.index'));
        $pillar = ArchitecturePillar::where('title', 'Event-Driven Systems')->firstOrFail();
        $this->assertCount(2, $pillar->bullets);
        $this->delete(route('admin.pillars.destroy', $pillar))->assertRedirect(route('admin.pillars.index'));

        // 4. Project CRUD (including optional live_url)
        $this->post(route('admin.projects.store'), [
            'title' => 'FinLedger API',
            'framework' => 'laravel',
            'framework_label' => 'Laravel 11',
            'architecture' => 'clean',
            'architecture_label' => 'Clean Architecture',
            'badge_text' => 'Verified',
            'tech_tags_text' => 'Laravel, Redis, PostgreSQL',
            'short_description' => 'Double-entry ledger API.',
            'long_description' => 'Detailed double-entry ledger architecture.',
            'highlights_text' => "ACID Safety\nZero Drift",
            'live_url' => 'https://finledger.example.com',
            'is_active' => '1',
        ])->assertRedirect(route('admin.projects.index'));
        $project = Project::where('title', 'FinLedger API')->firstOrFail();
        $this->assertSame('https://finledger.example.com', $project->live_url);

        $this->put(route('admin.projects.update', $project), [
            'title' => 'FinLedger API',
            'framework' => 'laravel',
            'framework_label' => 'Laravel 11',
            'architecture' => 'clean',
            'architecture_label' => 'Clean Architecture',
            'badge_text' => 'Verified',
            'tech_tags_text' => 'Laravel, Redis, PostgreSQL',
            'short_description' => 'Double-entry ledger API.',
            'long_description' => 'Detailed double-entry ledger architecture.',
            'highlights_text' => "ACID Safety\nZero Drift",
            'live_url' => 'https://live.finledger.example.com',
            'is_active' => '1',
        ])->assertRedirect(route('admin.projects.index'));
        $this->assertSame('https://live.finledger.example.com', $project->fresh()->live_url);
        $this->get(route('home'))
            ->assertSee('live.finledger.example.com')
            ->assertViewHas('projectsPayload', function ($payload) {
                return collect($payload)->contains(
                    fn ($item) => ($item['liveUrl'] ?? null) === 'https://live.finledger.example.com'
                );
            });

        $this->delete(route('admin.projects.destroy', $project))->assertRedirect(route('admin.projects.index'));

        // 5. Certificate CRUD
        $this->post(route('admin.certificates.store'), [
            'title' => 'AWS Solutions Architect',
            'issuer' => 'Amazon Web Services',
            'badge_text' => 'CERTIFIED',
            'color' => 'amber',
            'description' => 'Cloud architecture certification.',
            'issued_date' => 'Jan 2026',
            'is_active' => '1',
        ])->assertRedirect(route('admin.certificates.index'));
        $cert = Certificate::where('title', 'AWS Solutions Architect')->firstOrFail();
        $this->delete(route('admin.certificates.destroy', $cert))->assertRedirect(route('admin.certificates.index'));

        // 6. Testimonial CRUD
        $this->post(route('admin.testimonials.store'), [
            'author_name' => 'CTO Partner',
            'author_role' => 'Chief Technology Officer',
            'badge_text' => 'CLIENT',
            'color' => 'cyan',
            'quote' => 'Outstanding backend delivery.',
            'is_active' => '1',
        ])->assertRedirect(route('admin.testimonials.index'));
        $testimonial = Testimonial::where('author_name', 'CTO Partner')->firstOrFail();
        $this->delete(route('admin.testimonials.destroy', $testimonial))->assertRedirect(route('admin.testimonials.index'));

        // 7. KiroBot Entry CRUD
        $this->post(route('admin.kirobot.store'), [
            'type' => 'keyword',
            'key' => 'rabbitmq',
            'label' => 'RABBITMQ',
            'content' => 'Asynchronous message broker for reliable background processing.',
            'is_active' => '1',
        ])->assertRedirect(route('admin.kirobot.index'));
        $entry = KirobotEntry::where('key', 'rabbitmq')->firstOrFail();
        $this->delete(route('admin.kirobot.destroy', $entry))->assertRedirect(route('admin.kirobot.index'));

        // 8. Inbox Message view & toggle
        $msg = ContactMessage::create([
            'name' => 'Test Lead',
            'email' => 'lead@example.com',
            'subject' => 'Project Scope',
            'message' => 'Let us collaborate on a new API.',
        ]);
        $this->get(route('admin.messages.show', $msg))->assertStatus(200);
        $this->assertTrue($msg->fresh()->is_read);
        $this->patch(route('admin.messages.toggle-read', $msg))->assertRedirect();
        $this->assertFalse($msg->fresh()->is_read);
        $this->delete(route('admin.messages.destroy', $msg))->assertRedirect(route('admin.messages.index'));
    }

    public function test_resume_and_certificate_downloads_return_valid_responses(): void
    {
        $this->get(route('download.resume'))->assertStatus(200);
        $this->get(route('certificates.download', 'cert_sql_advanced'))->assertStatus(200);
    }

    public function test_seeder_does_not_create_hardcoded_admin_when_env_unset(): void
    {
        $this->assertSame(0, User::count());
        $this->get(route('login'))->assertRedirect(route('admin.setup'));
    }

    public function test_first_admin_setup_flow_creates_admin_and_locks_once_configured(): void
    {
        config(['portfolio.admin_setup_key' => null]);

        $this->get(route('admin.setup'))
            ->assertStatus(200)
            ->assertSee('Initial Admin Setup');

        $this->post(route('admin.setup.store'), [
            'name' => 'First Admin',
            'email' => 'first@example.com',
            'password' => 'StrongPass123!',
            'password_confirmation' => 'StrongPass123!',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticated();
        $this->assertSame(1, User::count());

        auth()->logout();

        $this->get(route('admin.setup'))->assertRedirect(route('login'));
        $this->post(route('admin.setup.store'), [
            'name' => 'Rogue Admin',
            'email' => 'rogue@example.com',
            'password' => 'StrongPass123!',
            'password_confirmation' => 'StrongPass123!',
        ])->assertStatus(403);
    }

    public function test_artisan_admin_create_command_creates_admin_user(): void
    {
        $this->artisan('admin:create', [
            '--name' => 'CLI Admin',
            '--email' => 'cli@example.com',
            '--password' => 'CliSecret123!',
        ])->assertExitCode(0);

        $this->assertDatabaseHas('users', [
            'name' => 'CLI Admin',
            'email' => 'cli@example.com',
        ]);
    }

    public function test_admin_can_add_and_remove_other_admins_but_not_self(): void
    {
        $primary = $this->createAdmin('primary@example.com');
        $this->actingAs($primary);

        $this->post(route('admin.admins.store'), [
            'admin_name' => 'Co Admin',
            'admin_email' => 'coadmin@example.com',
            'admin_password' => 'CoAdminPass123!',
            'admin_password_confirmation' => 'CoAdminPass123!',
        ])->assertRedirect();

        $coAdmin = User::where('email', 'coadmin@example.com')->firstOrFail();

        $this->delete(route('admin.admins.destroy', $primary))->assertSessionHasErrors('admin');
        $this->assertDatabaseHas('users', ['id' => $primary->id]);

        $this->delete(route('admin.admins.destroy', $coAdmin))->assertRedirect();
        $this->assertDatabaseMissing('users', ['id' => $coAdmin->id]);
    }

    public function test_setup_enforces_admin_setup_key_and_blocks_unconfigured_production(): void
    {
        config(['portfolio.admin_setup_key' => 'rail-secret-2026']);

        $this->get(route('admin.setup'))
            ->assertStatus(200)
            ->assertSee('ADMIN_SETUP_KEY');

        $this->post(route('admin.setup.store'), [
            'name' => 'Owner Admin',
            'email' => 'owner@example.com',
            'password' => 'StrongPass123!',
            'password_confirmation' => 'StrongPass123!',
            'setup_key' => 'wrong-key',
        ])->assertSessionHasErrors('setup_key');

        $this->assertSame(0, User::count());

        $this->post(route('admin.setup.store'), [
            'name' => 'Owner Admin',
            'email' => 'owner@example.com',
            'password' => 'StrongPass123!',
            'password_confirmation' => 'StrongPass123!',
            'setup_key' => 'rail-secret-2026',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertSame(1, User::count());
    }

    public function test_setup_requires_setup_key_in_production_environment(): void
    {
        config(['portfolio.admin_setup_key' => null]);
        $this->app['env'] = 'production';

        $this->get(route('admin.setup'))
            ->assertStatus(200)
            ->assertSee('Setup Key Required in Production');

        $this->withSession(['_token' => 'test-csrf-token'])
            ->post(route('admin.setup.store'), [
                '_token' => 'test-csrf-token',
                'name' => 'Hijacker',
                'email' => 'hijack@example.com',
                'password' => 'StrongPass123!',
                'password_confirmation' => 'StrongPass123!',
            ])->assertStatus(403);

        $this->assertSame(0, User::count());
    }

    public function test_forgot_password_requires_existing_admin_and_renders_properly(): void
    {
        // When no admin exists, forgot password redirects to setup
        $this->get(route('admin.password.request'))->assertRedirect(route('admin.setup'));

        $this->createAdmin('admin@example.com');

        $this->get(route('admin.password.request'))
            ->assertStatus(200)
            ->assertSee('Reset Password')
            ->assertSee('Send 6-Digit Code');

        $this->get(route('login'))
            ->assertStatus(200)
            ->assertSee('Forgot password?');
    }

    public function test_forgot_password_rejects_unregistered_email(): void
    {
        $this->createAdmin('admin@example.com');

        $this->post(route('admin.password.email'), [
            'email' => 'unknown@example.com',
        ])->assertSessionHasErrors('email');
    }

    public function test_forgot_password_sends_otp_and_flow_allows_resetting_password(): void
    {
        Mail::fake();

        $admin = $this->createAdmin('admin@example.com', 'OldPassword123!');

        // 1. Request OTP
        $this->post(route('admin.password.email'), [
            'email' => 'admin@example.com',
        ])->assertRedirect(route('admin.password.otp'));

        $this->assertDatabaseHas('password_reset_tokens', [
            'email' => 'admin@example.com',
        ]);

        $otpSent = null;
        Mail::assertSent(AdminPasswordResetOtpMail::class, function ($mail) use (&$otpSent) {
            $otpSent = $mail->otp;
            return $mail->hasTo('admin@example.com') && strlen($mail->otp) === 6;
        });

        $this->assertNotNull($otpSent);

        // 2. View Verify OTP page
        $this->get(route('admin.password.otp'))
            ->assertStatus(200)
            ->assertSee('admin@example.com')
            ->assertSee('Enter Security Code');

        // 3. Test invalid OTP fails
        $this->post(route('admin.password.verify'), [
            'email' => 'admin@example.com',
            'otp' => '000000',
        ])->assertSessionHasErrors('otp');

        // 4. Verify with the real OTP
        $this->post(route('admin.password.verify'), [
            'email' => 'admin@example.com',
            'otp' => $otpSent,
        ])->assertRedirect(route('admin.password.reset'));

        // 5. View Reset Password page
        $this->get(route('admin.password.reset'))
            ->assertStatus(200)
            ->assertSee('Create New Password')
            ->assertSee('admin@example.com');

        // 6. Test password validation (mismatched confirmation)
        $this->post(route('admin.password.update'), [
            'email' => 'admin@example.com',
            'password' => 'NewSecret456!',
            'password_confirmation' => 'DifferentSecret789!',
        ])->assertSessionHasErrors('password');

        // 7. Submit valid new password
        $this->post(route('admin.password.update'), [
            'email' => 'admin@example.com',
            'password' => 'NewSecret456!',
            'password_confirmation' => 'NewSecret456!',
        ])->assertRedirect(route('login'))
          ->assertSessionHas('status');

        // Verify token was cleared
        $this->assertDatabaseMissing('password_reset_tokens', [
            'email' => 'admin@example.com',
        ]);

        // 8. Old password fails
        $this->post(route('login.attempt'), [
            'email' => 'admin@example.com',
            'password' => 'OldPassword123!',
        ])->assertSessionHasErrors('email');

        // 9. New password successfully logs in!
        $this->post(route('login.attempt'), [
            'email' => 'admin@example.com',
            'password' => 'NewSecret456!',
        ])->assertRedirect(route('admin.dashboard'));
    }

    public function test_resend_otp_and_expiration_guards(): void
    {
        Mail::fake();

        $this->createAdmin('admin@example.com');

        $this->post(route('admin.password.resend'), [
            'email' => 'admin@example.com',
        ])->assertRedirect(route('admin.password.otp', ['email' => 'admin@example.com']));

        Mail::assertSent(AdminPasswordResetOtpMail::class);

        // Test expired token rejection
        DB::table('password_reset_tokens')->where('email', 'admin@example.com')->update([
            'created_at' => now()->subMinutes(20),
        ]);

        $this->post(route('admin.password.verify'), [
            'email' => 'admin@example.com',
            'otp' => '123456',
        ])->assertSessionHasErrors('otp');
    }
}

