<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TechStack;
use Illuminate\Http\Request;

class TechStackController extends Controller
{
    public function index()
    {
        $techStacks = TechStack::ordered()->get();

        return view('admin.tech-stacks.index', compact('techStacks'));
    }

    public function create()
    {
        return view('admin.tech-stacks.form', ['techStack' => new TechStack(['is_active' => true, 'color' => 'sky'])]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        TechStack::create($data);

        return redirect()->route('admin.tech-stacks.index')->with('success', 'Tech stack badge created.');
    }

    public function edit(TechStack $techStack)
    {
        return view('admin.tech-stacks.form', compact('techStack'));
    }

    public function update(Request $request, TechStack $techStack)
    {
        $data = $this->validatedData($request);
        $techStack->update($data);

        return redirect()->route('admin.tech-stacks.index')->with('success', 'Tech stack badge updated.');
    }

    public function destroy(TechStack $techStack)
    {
        $techStack->delete();

        return redirect()->route('admin.tech-stacks.index')->with('success', 'Tech stack badge deleted.');
    }

    protected function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'color' => 'required|string|in:sky,blue,rose,emerald,amber,indigo,orange,teal,purple,cyan',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}

