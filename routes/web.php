<?php

use App\Http\Controllers\Admin\ArchitecturePillarController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CertificateController as AdminCertificateController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KirobotEntryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SetupController;
use App\Http\Controllers\Admin\TechStackController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ResumesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Dynamic Portfolio Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PortfolioController::class, 'index'])->name('home');

Route::get('/resume/download', [ResumesController::class, 'resumedownload'])->name('download.resume');

Route::get('/certificates/{slug}/download', [CertificateController::class, 'downloadBySlug'])->name('certificates.download');

// Legacy certificate download routes preserved for backwards compatibility
Route::get('/certificate/download', [CertificateController::class, 'certificatedownload'])->name('download.certificate');
Route::get('/certificate/BasicSQLcertificatedownload', [CertificateController::class, 'BasicSQLcertificatedownload'])->name('download.BasicSQLcertificate');
Route::get('/certificate/IntermediateSQLcertificatedownload', [CertificateController::class, 'IntermediateSQLcertificatedownload'])->name('download.IntermediateSQLcertificate');
Route::get('/certificate/AdvancedSQLcertificatedownload', [CertificateController::class, 'AdvancedSQLcertificatedownload'])->name('download.AdvancedSQLcertificate');
Route::get('/certificate/GitHubCertificateDownload', [CertificateController::class, 'GitHubCertificateDownload'])->name('download.GitHubcertificate');
Route::get('/certificate/DEPICertificateDownload', [CertificateController::class, 'DEPICertificateDownload'])->name('download.DEPICertificateDownload');

Route::view('/custom-web-application', 'services.custom')->name('custom');
Route::view('/design-systems', 'services.design')->name('design');
Route::view('/maintenance-support', 'services.support')->name('support');

Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');
Route::post('/contact/send-otp', [ContactController::class, 'sendOtp'])->name('contact.send_otp');
Route::post('/contact/verify-otp', [ContactController::class, 'verifyOtp'])->name('contact.verify_otp');
Route::post('/contact/resend-otp', [ContactController::class, 'resendOtp'])->name('contact.resend_otp');

Route::redirect('/dashboard', '/admin');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/setup', [SetupController::class, 'show'])->name('admin.setup');
        Route::post('/setup', [SetupController::class, 'store'])->name('admin.setup.store');
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    });

    Route::middleware('auth')->name('admin.')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Site Settings & Media
        Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

        // Core Tech Stack
        Route::resource('tech-stacks', TechStackController::class)->except(['show']);

        // Architecture Pillars
        Route::resource('pillars', ArchitecturePillarController::class)->except(['show']);

        // Projects
        Route::resource('projects', ProjectController::class)->except(['show']);

        // Certificates
        Route::resource('certificates', AdminCertificateController::class)->except(['show']);

        // Testimonials
        Route::resource('testimonials', TestimonialController::class)->except(['show']);

        // KiroBot Knowledge Base & Section Radar
        Route::resource('kirobot', KirobotEntryController::class)->except(['show']);

        // Contact Inquiries Inbox
        Route::get('/messages', [ContactMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
        Route::patch('/messages/{message}/toggle-read', [ContactMessageController::class, 'toggleRead'])->name('messages.toggle-read');
        Route::patch('/messages/{message}/notes', [ContactMessageController::class, 'updateNotes'])->name('messages.notes');
        Route::delete('/messages/{message}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');

        // Admin Account Profile & Administrators
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/admins', [ProfileController::class, 'storeAdmin'])->name('admins.store');
        Route::delete('/admins/{admin}', [ProfileController::class, 'destroyAdmin'])->name('admins.destroy');
    });
});
