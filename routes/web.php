<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ResumesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/resume/download', [ResumesController::class, 'resumedownload'])->name('download.resume');

Route::get('/certificate/download', [CertificateController::class, 'certificatedownload'])->name('download.certificate');
Route::get('/certificate/BasicSQLcertificatedownload', [CertificateController::class, 'BasicSQLcertificatedownload'])->name('download.BasicSQLcertificate');
Route::get('/certificate/IntermediateSQLcertificatedownload', [CertificateController::class, 'IntermediateSQLcertificatedownload'])->name('download.IntermediateSQLcertificate');
Route::get('/certificate/AdvancedSQLcertificatedownload', [CertificateController::class, 'AdvancedSQLcertificatedownload'])->name('download.AdvancedSQLcertificate');
Route::get('/certificate/GitHubCertificateDownload', [CertificateController::class, 'GitHubCertificateDownload'])->name('download.GitHubcertificate');

Route::view('/custom-web-application', 'services.custom')->name('custom');
Route::view('/design-systems', 'services.design')->name('design');
Route::view('/maintenance-support', 'services.support')->name('support');

Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');
