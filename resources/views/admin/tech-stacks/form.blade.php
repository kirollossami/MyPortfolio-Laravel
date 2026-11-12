@extends('admin.layouts.app')

@section('title', $techStack->exists ? 'Edit Tech Badge' : 'Add Tech Badge')
@section('page_title', $techStack->exists ? 'Edit Tech Stack Badge' : 'Add Tech Stack Badge')

@section('content')
<div class="panel-card p-6 max-w-2xl">
  <form action="{{ $techStack->exists ? route('admin.tech-stacks.update', $techStack) : route('admin.tech-stacks.store') }}" method="POST" class="space-y-4">
    @csrf
    @if($techStack->exists) @method('PUT') @endif

    <div>
      <label class="form-label">Technology Name *</label>
      <input type="text" name="name" value="{{ old('name', $techStack->name) }}" required class="form-input" placeholder="e.g. .NET Core / C#">
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div>
        <label class="form-label">Color Theme *</label>
        <select name="color" class="form-input">
          @foreach(['sky','blue','rose','emerald','amber','indigo','orange','teal','purple','cyan'] as $color)
            <option value="{{ $color }}" {{ old('color', $techStack->color) === $color ? 'selected' : '' }}>{{ ucfirst($color) }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="form-label">Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $techStack->sort_order ?? 0) }}" min="0" class="form-input">
      </div>
    </div>

    <label class="inline-flex items-center gap-2 text-sm text-slate-200 cursor-pointer">
      <input type="checkbox" name="is_active" value="1" {{ old('is_active', $techStack->is_active ?? true) ? 'checked' : '' }} class="rounded bg-[#090d16] border-white/20 text-emerald-500">
      <span>Visible on Frontend</span>
    </label>

    <div class="flex items-center gap-3 pt-4 border-t border-white/10">
      <button type="submit" class="btn-primary">
        <i class="bi bi-save"></i> {{ $techStack->exists ? 'Update Badge' : 'Create Badge' }}
      </button>
      <a href="{{ route('admin.tech-stacks.index') }}" class="btn-secondary">Cancel</a>
    </div>
  </form>
</div>
@endsection

