@extends('admin.layouts.app')

@section('title', $project->exists ? 'Edit Project' : 'Add Project')
@section('page_title', $project->exists ? 'Edit Project' : 'Add New Project')

@section('content')
<div class="panel-card p-6 max-w-4xl">
  <form action="{{ $project->exists ? route('admin.projects.update', $project) : route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
    @csrf
    @if($project->exists) @method('PUT') @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div class="md:col-span-2">
        <label class="form-label">Project Title *</label>
        <input type="text" name="title" value="{{ old('title', $project->title) }}" required class="form-input">
      </div>
      <div>
        <label class="form-label">Slug (optional)</label>
        <input type="text" name="slug" value="{{ old('slug', $project->slug) }}" class="form-input" placeholder="auto-generated">
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
      <div>
        <label class="form-label">Framework Filter Key *</label>
        <select name="framework" class="form-input">
          @foreach(\App\Models\Project::FRAMEWORK_OPTIONS as $key => $label)
            <option value="{{ $key }}" {{ old('framework', $project->framework) === $key ? 'selected' : '' }}>{{ $label }} ({{ $key }})</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="form-label">Framework Display Label *</label>
        <input type="text" name="framework_label" value="{{ old('framework_label', $project->framework_label) }}" required class="form-input" placeholder="ASP.NET Core Web API">
      </div>
      <div>
        <label class="form-label">Architecture Filter Key *</label>
        <select name="architecture" class="form-input">
          @foreach(\App\Models\Project::ARCHITECTURE_OPTIONS as $key => $label)
            <option value="{{ $key }}" {{ old('architecture', $project->architecture) === $key ? 'selected' : '' }}>{{ $label }} ({{ $key }})</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="form-label">Architecture Display Label *</label>
        <input type="text" name="architecture_label" value="{{ old('architecture_label', $project->architecture_label) }}" required class="form-input" placeholder="Clean Architecture">
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div>
        <label class="form-label">Badge Text</label>
        <input type="text" name="badge_text" value="{{ old('badge_text', $project->badge_text) }}" class="form-input" placeholder="🟢 Production Deployed">
      </div>
      <div>
        <label class="form-label">Badge CSS Classes</label>
        <input type="text" name="badge_color" value="{{ old('badge_color', $project->badge_color) }}" class="form-input">
      </div>
      <div>
        <label class="form-label">Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order ?? 0) }}" min="0" class="form-input">
      </div>
    </div>

    <div>
      <label class="form-label">Tech Tags (comma-separated)</label>
      <input type="text" name="tech_tags_text" value="{{ old('tech_tags_text', implode(', ', $project->tech_tags ?? [])) }}" class="form-input" placeholder="ASP.NET Core Web API, Angular, SQL Server, JWT Auth">
    </div>

    <div>
      <label class="form-label">Short Description (Card) *</label>
      <textarea name="short_description" rows="3" required class="form-input">{{ old('short_description', $project->short_description) }}</textarea>
    </div>

    <div>
      <label class="form-label">Long Description (Modal) *</label>
      <textarea name="long_description" rows="4" required class="form-input">{{ old('long_description', $project->long_description) }}</textarea>
    </div>

    <div>
      <label class="form-label">Key Engineering Highlights (one per line)</label>
      <textarea name="highlights_text" rows="4" class="form-input">{{ old('highlights_text', implode("\n", $project->highlights ?? [])) }}</textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="form-label">Live Website / App URL</label>
        <input type="url" name="live_url" value="{{ old('live_url', $project->live_url) }}" class="form-input" placeholder="https://your-live-project.com">
      </div>
      <div>
        <label class="form-label">GitHub Repository URL</label>
        <input type="url" name="github_url" value="{{ old('github_url', $project->github_url) }}" class="form-input" placeholder="https://github.com/username/repo">
      </div>
      <div>
        <label class="form-label">Demo / Showcase URL</label>
        <input type="url" name="demo_url" value="{{ old('demo_url', $project->demo_url) }}" class="form-input" placeholder="https://...">
      </div>
      <div>
        <label class="form-label">Demo Button Label</label>
        <input type="text" name="demo_label" value="{{ old('demo_label', $project->demo_label) }}" class="form-input" placeholder="View Showcase / Demo">
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 rounded-xl bg-white/5 border border-white/10">
      <div>
        <label class="form-label">Upload Project Cover Image</label>
        <input type="file" name="image" accept="image/*" class="text-xs text-slate-300 w-full">
        @if($project->image_path)
          <img src="{{ $project->image_url }}" alt="Preview" class="mt-2 h-24 rounded-lg object-cover border border-white/10">
        @endif
      </div>
      <div>
        <label class="form-label">Or Existing Asset Path</label>
        <input type="text" name="image_path_manual" value="{{ old('image_path_manual', $project->image_path) }}" class="form-input" placeholder="assets/img/projects/unistay.png">
      </div>
    </div>

    <label class="inline-flex items-center gap-2 text-sm text-slate-200 cursor-pointer">
      <input type="checkbox" name="is_active" value="1" {{ old('is_active', $project->is_active ?? true) ? 'checked' : '' }} class="rounded bg-[#090d16] border-white/20 text-emerald-500">
      <span>Visible on Frontend</span>
    </label>

    <div class="flex items-center gap-3 pt-4 border-t border-white/10">
      <button type="submit" class="btn-primary">
        <i class="bi bi-save"></i> {{ $project->exists ? 'Update Project' : 'Create Project' }}
      </button>
      <a href="{{ route('admin.projects.index') }}" class="btn-secondary">Cancel</a>
    </div>
  </form>
</div>
@endsection

