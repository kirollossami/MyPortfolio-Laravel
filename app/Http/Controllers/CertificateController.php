<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function certificatedownload(){
        $certificate_file = public_path('assets/pdf/certificate.pdf');

        if(!file_exists($certificate_file)){
            abort(404, 'file not found!');
        }

        return response()->download($certificate_file, 'certificate.pdf', [
            'Content-Type' => 'application/octet-stream',
            'Cache-Control' => 'no-cache, must-revalidate'
        ]);
    }

    public function BasicSQLcertificatedownload(){
        $certificate_file = public_path('assets/pdf/sql_basic_certificate.pdf');

        if(!file_exists($certificate_file)){
            abort(404, 'file not found!');
        }

        return response()->download($certificate_file, 'sql_basic_certificate.pdf', [
            'Content-Type' => 'application/octet-stream',
            'Cache-Control' => 'no-cache, must-revalidate'
        ]);
    }

    public function IntermediateSQLcertificatedownload(){
        $certificate_file = public_path('assets/pdf/sql_intermediate_certificate.pdf');

        if(!file_exists($certificate_file)){
            abort(404, 'file not found!');
        }

        return response()->download($certificate_file, 'sql_intermediate_certificate.pdf', [
            'Content-Type' => 'application/octet-stream',
            'Cache-Control' => 'no-cache, must-revalidate'
        ]);
    }

    public function AdvancedSQLcertificatedownload(){
        $certificate_file = public_path('assets/pdf/sql_advanced_certificate.pdf');

        if(!file_exists($certificate_file)){
            abort(404, 'file not found!');
        }

        return response()->download($certificate_file, 'sql_advanced_certificate.pdf', [
            'Content-Type' => 'application/octet-stream',
            'Cache-Control' => 'no-cache, must-revalidate'
        ]);
    }

    public function GitHubCertificateDownload(){
        $certificate_file = public_path('assets/pdf/Git&GitHub_Certificate.pdf');

        if(!file_exists($certificate_file)){
            abort(404, 'file not found!');
        }

        return response()->download($certificate_file, 'Git&GitHub_Certificate.pdf', [
            'Content-Type' => 'application/octet-stream',
            'Cache-Control' => 'no-cache, must-revalidate'
        ]);
    }
}
