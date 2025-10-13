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
}
