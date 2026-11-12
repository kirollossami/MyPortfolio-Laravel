<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KirobotEntry;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KirobotEntryController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type');
        $entries = KirobotEntry::query()
            ->when($type, fn ($q) => $q->where('type', $type))
            ->ordered()
            ->get();

        return view('admin.kirobot.index', compact('entries', 'type'));
    }

    public function create()
    {
        return view('admin.kirobot.form', [
            'entry' => new KirobotEntry(['type' => 'keyword', 'is_active' => true]),
        ]);
    }

    public function store(Request $request)
    {
        KirobotEntry::create($this->validatedData($request));

        return redirect()->route('admin.kirobot.index')->with('success', 'KiroBot entry added.');
    }

    public function edit(KirobotEntry $kirobot)
    {
        return view('admin.kirobot.form', ['entry' => $kirobot]);
    }

    public function update(Request $request, KirobotEntry $kirobot)
    {
        $kirobot->update($this->validatedData($request, $kirobot));

        return redirect()->route('admin.kirobot.index')->with('success', 'KiroBot entry updated.');
    }

    public function destroy(KirobotEntry $kirobot)
    {
        $kirobot->delete();

        return redirect()->route('admin.kirobot.index')->with('success', 'KiroBot entry deleted.');
    }

    protected function validatedData(Request $request, ?KirobotEntry $entry = null): array
    {
        $validated = $request->validate([
            'type' => 'required|in:section,keyword',
            'key' => [
                'required',
                'string',
                'max:120',
                Rule::unique('kirobot_entries', 'key')
                    ->where(fn ($q) => $q->where('type', $request->input('type')))
                    ->ignore($entry?->id),
            ],
            'label' => 'nullable|string|max:150',
            'content' => 'required|string|max:2000',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        return [
            'type' => $validated['type'],
            'key' => strtolower(trim($validated['key'])),
            'label' => $validated['label'] ?? strtoupper(trim($validated['key'])),
            'content' => $validated['content'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ];
    }
}

