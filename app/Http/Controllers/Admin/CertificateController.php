<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::ordered()->get();

        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.form', [
            'certificate' => new Certificate(['is_active' => true, 'color' => 'cyan', 'badge_text' => 'VERIFIED']),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        if ($request->hasFile('image')) {
            $data['image_path'] = MediaService::upload($request->file('image'), 'certificates');
        }
        if ($request->hasFile('pdf_file')) {
            $data['pdf_path'] = MediaService::upload($request->file('pdf_file'), 'certificates-pdf');
        }

        Certificate::create($data);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate created successfully.');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.form', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $data = $this->validatedData($request, $certificate);
        if ($request->hasFile('image')) {
            $data['image_path'] = MediaService::upload($request->file('image'), 'certificates', $certificate->image_path);
        }
        if ($request->hasFile('pdf_file')) {
            $data['pdf_path'] = MediaService::upload($request->file('pdf_file'), 'certificates-pdf', $certificate->pdf_path);
        }

        $certificate->update($data);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate updated successfully.');
    }

    public function destroy(Certificate $certificate)
    {
        MediaService::deleteUploadedFile($certificate->image_path);
        MediaService::deleteUploadedFile($certificate->pdf_path);
        $certificate->delete();

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate deleted.');
    }

    protected function validatedData(Request $request, ?Certificate $certificate = null): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'slug' => [
                'nullable',
                'string',
                'max:120',
                Rule::unique('certificates', 'slug')->ignore($certificate?->id),
            ],
            'issuer' => 'required|string|max:160',
            'badge_text' => 'required|string|max:80',
            'color' => 'required|string|in:emerald,indigo,cyan,purple,blue,amber',
            'description' => 'required|string|max:2000',
            'issued_date' => 'nullable|string|max:60',
            'image' => 'nullable|image|max:6144',
            'pdf_file' => 'nullable|mimes:pdf|max:10240',
            'image_path_manual' => 'nullable|string|max:255',
            'pdf_path_manual' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $slugSource = ($validated['slug'] ?? null) ?: $validated['title'];
        $slug = Str::slug($slugSource, '_');
        if ($slug === '') {
            $slug = 'cert_' . Str::random(6);
        }
        if (!$certificate && Certificate::where('slug', $slug)->exists()) {
            $slug .= '_' . Str::random(4);
        }

        $data = [
            'slug' => $slug,
            'title' => $validated['title'],
            'issuer' => $validated['issuer'],
            'badge_text' => $validated['badge_text'],
            'color' => $validated['color'],
            'description' => $validated['description'],
            'issued_date' => $validated['issued_date'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ];

        if (!empty($validated['image_path_manual']) && !$request->hasFile('image')) {
            $data['image_path'] = $validated['image_path_manual'];
        }
        if (!empty($validated['pdf_path_manual']) && !$request->hasFile('pdf_file')) {
            $data['pdf_path'] = $validated['pdf_path_manual'];
        }

        return $data;
    }
}
