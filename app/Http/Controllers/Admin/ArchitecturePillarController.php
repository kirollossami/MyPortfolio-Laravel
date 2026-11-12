<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArchitecturePillar;
use Illuminate\Http\Request;

class ArchitecturePillarController extends Controller
{
    public function index()
    {
        $pillars = ArchitecturePillar::ordered()->get();

        return view('admin.pillars.index', compact('pillars'));
    }

    public function create()
    {
        return view('admin.pillars.form', [
            'pillar' => new ArchitecturePillar(['is_active' => true, 'color' => 'indigo', 'icon' => 'bi-diagram-2']),
        ]);
    }

    public function store(Request $request)
    {
        ArchitecturePillar::create($this->validatedData($request));

        return redirect()->route('admin.pillars.index')->with('success', 'Architecture pillar created.');
    }

    public function edit(ArchitecturePillar $pillar)
    {
        return view('admin.pillars.form', compact('pillar'));
    }

    public function update(Request $request, ArchitecturePillar $pillar)
    {
        $pillar->update($this->validatedData($request));

        return redirect()->route('admin.pillars.index')->with('success', 'Architecture pillar updated.');
    }

    public function destroy(ArchitecturePillar $pillar)
    {
        $pillar->delete();

        return redirect()->route('admin.pillars.index')->with('success', 'Architecture pillar deleted.');
    }

    protected function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'required|string|max:1000',
            'icon' => 'required|string|max:80',
            'color' => 'required|string|in:indigo,cyan,emerald,purple,amber,sky,rose',
            'bullets_text' => 'nullable|string|max:2000',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $bullets = array_values(array_filter(array_map(
            'trim',
            preg_split('/\r\n|\r|\n/', $validated['bullets_text'] ?? '')
        )));

        return [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'icon' => $validated['icon'],
            'color' => $validated['color'],
            'bullets' => $bullets,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ];
    }
}

