@extends('admin.layouts.app')

@section('title', 'Projects')
@section('page_title', 'Portfolio Projects')
@section('page_subtitle', 'Add, edit, reorder, or toggle projects displayed in the dynamic filterable grid.')

@section('header_actions')
  <a href="{{ route('admin.projects.create') }}" class="btn-primary">
    <i class="bi bi-plus-lg"></i> Add Project
  </a>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
  @forelse($projects as $project)
    <div class="panel-card overflow-hidden flex flex-col justify-between">
      <div>
        <div class="relative h-44 bg-slate-900">
          <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
          <span class="absolute top-3 left-3 px-2.5 py-1 rounded text-[11px] font-mono {{ $project->badge_color }}">
            {{ $project->badge_text }}
          </span>
          <span class="absolute top-3 right-3 px-2.5 py-0.5 rounded-full text-[11px] font-mono {{ $project->is_active ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-slate-800/80 text-slate-300 border border-white/15' }}">
            #{{ $project->sort_order }} &middot; {{ $project->is_active ? 'Active' : 'Hidden' }}
          </span>
        </div>
        <div class="p-5 space-y-2.5">
          <div class="flex flex-wrap gap-1.5 text-[11px] font-mono">
            <span class="px-2 py-0.5 rounded bg-cyan-500/10 text-cyan-300 border border-cyan-500/20">{{ $project->framework_label }}</span>
            <span class="px-2 py-0.5 rounded bg-indigo-500/10 text-indigo-300 border border-indigo-500/20">{{ $project->architecture_label }}</span>
          </div>
          <h3 class="text-base font-bold text-white">{{ $project->title }}</h3>
          <p class="text-xs text-slate-400 line-clamp-2">{{ $project->short_description }}</p>
        </div>
      </div>
      <div class="px-5 py-3.5 border-t border-white/10 flex items-center justify-between gap-2">
        <div class="flex items-center gap-2 min-w-0">
          <span class="font-mono text-[11px] text-slate-500 truncate">{{ $project->slug }}</span>
          @if($project->live_url)
            <a href="{{ $project->live_url }}" target="_blank" rel="noopener" class="px-2 py-0.5 rounded bg-emerald-500/15 text-emerald-300 border border-emerald-500/30 font-mono text-[10px] hover:bg-emerald-500/25 inline-flex items-center gap-1 flex-shrink-0">
              <i class="bi bi-globe2"></i> Live
            </a>
          @endif
        </div>
        <div class="flex items-center gap-2 flex-shrink-0">
          <a href="{{ route('admin.projects.edit', $project) }}" class="btn-secondary !py-1.5 !px-3 !text-xs">Edit</a>
          <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Delete this project?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  @empty
    <div class="panel-card p-8 text-center text-slate-400 md:col-span-2">No projects found.</div>
  @endforelse
</div>
@endsection

