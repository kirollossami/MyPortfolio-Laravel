<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    public function downloadBySlug(string $slug)
    {
        $certificate = Certificate::where('slug', $slug)->firstOrFail();

        return $this->servePdf($certificate->pdf_path, Str::slug($certificate->title, '_') . '.pdf');
    }

    protected function servePdf(?string $relativePath, string $downloadName)
    {
        if (!$relativePath) {
            abort(404, 'Certificate PDF not configured.');
        }

        if (Str::startsWith($relativePath, ['http://', 'https://'])) {
            return redirect()->away($relativePath);
        }

        $file = public_path(ltrim($relativePath, '/'));
        if (!is_file($file)) {
            abort(404, 'File not found!');
        }

        return response()->download($file, $downloadName, [
            'Content-Type' => 'application/pdf',
            'Cache-Control' => 'no-cache, must-revalidate',
        ]);
    }

    protected function downloadLegacy(string $slug, string $fallbackPath, string $downloadName)
    {
        $cert = Certificate::where('slug', $slug)->first();
        if ($cert && $cert->pdf_path) {
            return $this->servePdf($cert->pdf_path, $downloadName);
        }

        return $this->servePdf($fallbackPath, $downloadName);
    }

    public function certificatedownload()
    {
        return $this->downloadLegacy('cert_nti', 'assets/pdf/certificate.pdf', 'certificate.pdf');
    }

    public function BasicSQLcertificatedownload()
    {
        return $this->downloadLegacy('cert_sql_basic', 'assets/pdf/sql_basic_certificate.pdf', 'sql_basic_certificate.pdf');
    }

    public function IntermediateSQLcertificatedownload()
    {
        return $this->downloadLegacy('cert_sql_intermediate', 'assets/pdf/sql_intermediate_certificate.pdf', 'sql_intermediate_certificate.pdf');
    }

    public function AdvancedSQLcertificatedownload()
    {
        return $this->downloadLegacy('cert_sql_advanced', 'assets/pdf/sql_advanced_certificate.pdf', 'sql_advanced_certificate.pdf');
    }

    public function GitHubCertificateDownload()
    {
        return $this->downloadLegacy('cert_github', 'assets/pdf/Git&GitHub_Certificate.pdf', 'Git&GitHub_Certificate.pdf');
    }

    public function DEPICertificateDownload()
    {
        return $this->downloadLegacy('cert_depi', 'assets/pdf/Kirollos Samy Ishaq Tawfik - DEPI.pdf', 'Kirollos Samy Ishaq Tawfik - DEPI.pdf');
    }
}
