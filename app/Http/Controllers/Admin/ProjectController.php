<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::ordered()->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.form', [
            'project' => new Project([
                'is_active' => true,
                'badge_color' => 'text-cyan-400 bg-black/80 border-white/15',
                'demo_label' => 'View Showcase / Demo',
            ]),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        if ($request->hasFile('image')) {
            $data['image_path'] = MediaService::upload($request->file('image'), 'projects');
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.form', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $this->validatedData($request, $project);
        if ($request->hasFile('image')) {
            $data['image_path'] = MediaService::upload($request->file('image'), 'projects', $project->image_path);
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        MediaService::deleteUploadedFile($project->image_path);
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted.');
    }

    protected function validatedData(Request $request, ?Project $project = null): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'slug' => [
                'nullable',
                'string',
                'max:120',
                Rule::unique('projects', 'slug')->ignore($project?->id),
            ],
            'framework' => 'required|string|max:60',
            'framework_label' => 'required|string|max:120',
            'architecture' => 'required|string|max:60',
            'architecture_label' => 'required|string|max:120',
            'badge_text' => 'nullable|string|max:120',
            'badge_color' => 'nullable|string|max:120',
            'tech_tags_text' => 'nullable|string|max:1000',
            'short_description' => 'required|string|max:2000',
            'long_description' => 'required|string|max:5000',
            'highlights_text' => 'nullable|string|max:4000',
            'demo_url' => 'nullable|url|max:500',
            'demo_label' => 'nullable|string|max:120',
            'live_url' => 'nullable|url|max:500',
            'github_url' => 'nullable|url|max:500',
            'image' => 'nullable|image|max:6144',
            'image_path_manual' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $slugSource = ($validated['slug'] ?? null) ?: $validated['title'];
        $slug = Str::slug($slugSource);
        if ($slug === '') {
            $slug = 'project-' . Str::random(6);
        }
        if (!$project && Project::where('slug', $slug)->exists()) {
            $slug .= '-' . Str::random(4);
        }

        $techTags = array_values(array_filter(array_map(
            'trim',
            explode(',', $validated['tech_tags_text'] ?? '')
        )));

        $highlights = array_values(array_filter(array_map(
            'trim',
            preg_split('/\r\n|\r|\n/', $validated['highlights_text'] ?? '')
        )));

        $data = [
            'slug' => $slug,
            'title' => $validated['title'],
            'framework' => strtolower(trim($validated['framework'])),
            'framework_label' => $validated['framework_label'],
            'architecture' => strtolower(trim($validated['architecture'])),
            'architecture_label' => $validated['architecture_label'],
            'badge_text' => $validated['badge_text'] ?? '',
            'badge_color' => ($validated['badge_color'] ?? null) ?: 'text-cyan-400 bg-black/80 border-white/15',
            'tech_tags' => $techTags,
            'short_description' => $validated['short_description'],
            'long_description' => $validated['long_description'],
            'highlights' => $highlights,
            'demo_url' => $validated['demo_url'] ?? null,
            'demo_label' => ($validated['demo_label'] ?? null) ?: 'View Showcase / Demo',
            'live_url' => $validated['live_url'] ?? null,
            'github_url' => $validated['github_url'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ];

        if (!empty($validated['image_path_manual']) && !$request->hasFile('image')) {
            $data['image_path'] = $validated['image_path_manual'];
        }

        return $data;
    }
}
