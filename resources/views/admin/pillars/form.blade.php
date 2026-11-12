@extends('admin.layouts.app')

@section('title', $pillar->exists ? 'Edit Pillar' : 'Add Pillar')
@section('page_title', $pillar->exists ? 'Edit Architecture Pillar' : 'Add Architecture Pillar')

@section('content')
<div class="panel-card p-6 max-w-3xl">
  <form action="{{ $pillar->exists ? route('admin.pillars.update', $pillar) : route('admin.pillars.store') }}" method="POST" class="space-y-4">
    @csrf
    @if($pillar->exists) @method('PUT') @endif

    <div>
      <label class="form-label">Pillar Title *</label>
      <input type="text" name="title" value="{{ old('title', $pillar->title) }}" required class="form-input" placeholder="e.g. Clean Architecture & SOLID">
    </div>

    <div>
      <label class="form-label">Description *</label>
      <textarea name="description" rows="3" required class="form-input">{{ old('description', $pillar->description) }}</textarea>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
      <div>
        <label class="form-label">Bootstrap Icon Class *</label>
        <input type="text" name="icon" value="{{ old('icon', $pillar->icon ?? 'bi-diagram-2') }}" required class="form-input" placeholder="bi-diagram-2">
      </div>
      <div>
        <label class="form-label">Accent Color *</label>
        <select name="color" class="form-input">
          @foreach(['indigo','cyan','emerald','purple','amber','sky','rose'] as $color)
            <option value="{{ $color }}" {{ old('color', $pillar->color) === $color ? 'selected' : '' }}>{{ ucfirst($color) }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="form-label">Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $pillar->sort_order ?? 0) }}" min="0" class="form-input">
      </div>
    </div>

    <div>
      <label class="form-label">Checklist Bullets (One per line)</label>
      <textarea name="bullets_text" rows="4" class="form-input" placeholder="Domain / Application / Infra Isolation&#10;Repository & Unit of Work">{{ old('bullets_text', implode("\n", $pillar->bullets ?? [])) }}</textarea>
    </div>

    <label class="inline-flex items-center gap-2 text-sm text-slate-200 cursor-pointer">
      <input type="checkbox" name="is_active" value="1" {{ old('is_active', $pillar->is_active ?? true) ? 'checked' : '' }} class="rounded bg-[#090d16] border-white/20 text-emerald-500">
      <span>Visible on Frontend</span>
    </label>

    <div class="flex items-center gap-3 pt-4 border-t border-white/10">
      <button type="submit" class="btn-primary">
        <i class="bi bi-save"></i> {{ $pillar->exists ? 'Update Pillar' : 'Create Pillar' }}
      </button>
      <a href="{{ route('admin.pillars.index') }}" class="btn-secondary">Cancel</a>
    </div>
  </form>
</div>
@endsection

