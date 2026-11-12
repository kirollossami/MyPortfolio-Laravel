<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Services\MediaService;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::ordered()->get();

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.form', [
            'testimonial' => new Testimonial(['is_active' => true, 'color' => 'cyan', 'badge_text' => 'ENDORSEMENT']),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        if ($request->hasFile('author_image')) {
            $data['author_image_path'] = MediaService::upload($request->file('author_image'), 'testimonials');
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.form', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $this->validatedData($request);
        if ($request->hasFile('author_image')) {
            $data['author_image_path'] = MediaService::upload(
                $request->file('author_image'),
                'testimonials',
                $testimonial->author_image_path
            );
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        MediaService::deleteUploadedFile($testimonial->author_image_path);
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted.');
    }

    protected function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'author_name' => 'required|string|max:140',
            'author_role' => 'required|string|max:160',
            'author_subtitle' => 'nullable|string|max:160',
            'badge_text' => 'required|string|max:80',
            'color' => 'required|string|in:cyan,indigo,emerald,amber',
            'quote' => 'required|string|max:2000',
            'linkedin_url' => 'nullable|url|max:1000',
            'author_image' => 'nullable|image|max:4096',
            'author_image_path_manual' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = [
            'author_name' => $validated['author_name'],
            'author_role' => $validated['author_role'],
            'author_subtitle' => $validated['author_subtitle'] ?? null,
            'badge_text' => $validated['badge_text'],
            'color' => $validated['color'],
            'quote' => $validated['quote'],
            'is_rtl' => $request->boolean('is_rtl'),
            'linkedin_url' => $validated['linkedin_url'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ];

        if (!empty($validated['author_image_path_manual']) && !$request->hasFile('author_image')) {
            $data['author_image_path'] = $validated['author_image_path_manual'];
        }

        return $data;
    }
}

