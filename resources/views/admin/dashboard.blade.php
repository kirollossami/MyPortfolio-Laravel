@extends('admin.layouts.app')

@section('title', 'Dashboard Overview')
@section('page_title', 'Dashboard Overview')
@section('page_subtitle', 'Control every section of your dynamic portfolio frontend from one MVC command center.')

@section('header_actions')
  <a href="{{ route('admin.projects.create') }}" class="btn-primary">
    <i class="bi bi-plus-lg"></i> New Project
  </a>
@endsection

@section('content')
  <!-- KPI Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
    <a href="{{ route('admin.projects.index') }}" class="panel-card p-5 hover:border-cyan-400/40 transition-colors">
      <div class="flex items-center justify-between">
        <span class="text-xs font-mono uppercase text-slate-400">Projects</span>
        <i class="bi bi-kanban text-xl text-cyan-400"></i>
      </div>
      <div class="text-3xl font-extrabold text-white mt-2">{{ $stats['projects'] }}</div>
      <div class="text-xs text-slate-400 mt-1">{{ $stats['active_projects'] }} active on frontend</div>
    </a>

    <a href="{{ route('admin.certificates.index') }}" class="panel-card p-5 hover:border-emerald-400/40 transition-colors">
      <div class="flex items-center justify-between">
        <span class="text-xs font-mono uppercase text-slate-400">Certificates</span>
        <i class="bi bi-patch-check text-xl text-emerald-400"></i>
      </div>
      <div class="text-3xl font-extrabold text-white mt-2">{{ $stats['certificates'] }}</div>
      <div class="text-xs text-slate-400 mt-1">Verified badges & PDFs</div>
    </a>

    <a href="{{ route('admin.testimonials.index') }}" class="panel-card p-5 hover:border-indigo-400/40 transition-colors">
      <div class="flex items-center justify-between">
        <span class="text-xs font-mono uppercase text-slate-400">Testimonials</span>
        <i class="bi bi-chat-quote text-xl text-indigo-400"></i>
      </div>
      <div class="text-3xl font-extrabold text-white mt-2">{{ $stats['testimonials'] }}</div>
      <div class="text-xs text-slate-400 mt-1">{{ $stats['pillars'] }} pillars &middot; {{ $stats['tech_stacks'] }} stack badges</div>
    </a>

    <a href="{{ route('admin.messages.index') }}" class="panel-card p-5 hover:border-amber-400/40 transition-colors">
      <div class="flex items-center justify-between">
        <span class="text-xs font-mono uppercase text-slate-400">Contact Inbox</span>
        <i class="bi bi-inbox text-xl text-amber-400"></i>
      </div>
      <div class="text-3xl font-extrabold text-white mt-2">{{ $stats['messages_unread'] }}</div>
      <div class="text-xs text-slate-400 mt-1">Unread of {{ $stats['messages_total'] }} total inquiries</div>
    </a>
  </div>

  <!-- Recent Inquiries & Recent Projects -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="panel-card p-6 space-y-4">
      <div class="flex items-center justify-between">
        <h2 class="text-base font-bold text-white">Recent Contact Inquiries</h2>
        <a href="{{ route('admin.messages.index') }}" class="text-xs font-mono text-sky-400 hover:underline">View All &rarr;</a>
      </div>

      @forelse($recentMessages as $msg)
        <a href="{{ route('admin.messages.show', $msg) }}" class="block p-3.5 rounded-xl bg-white/5 border border-white/5 hover:border-sky-400/40 transition-colors">
          <div class="flex items-center justify-between gap-2">
            <span class="font-semibold text-sm text-white flex items-center gap-2">
              @if(!$msg->is_read)
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
              @endif
              {{ $msg->name }}
            </span>
            <span class="text-[11px] font-mono text-slate-400">{{ $msg->created_at->diffForHumans() }}</span>
          </div>
          <div class="text-xs text-sky-300 mt-0.5">{{ $msg->subject }}</div>
          <div class="text-xs text-slate-400 truncate mt-1">{{ $msg->message }}</div>
        </a>
      @empty
        <p class="text-sm text-slate-400">No contact inquiries yet.</p>
      @endforelse
    </div>

    <div class="panel-card p-6 space-y-4">
      <div class="flex items-center justify-between">
        <h2 class="text-base font-bold text-white">Published Projects</h2>
        <a href="{{ route('admin.projects.index') }}" class="text-xs font-mono text-sky-400 hover:underline">Manage All &rarr;</a>
      </div>

      @forelse($recentProjects as $proj)
        <div class="flex items-center justify-between gap-3 p-3 rounded-xl bg-white/5 border border-white/5">
          <div class="flex items-center gap-3 min-w-0">
            <img src="{{ $proj->image_url }}" alt="{{ $proj->title }}" class="w-12 h-12 rounded-lg object-cover border border-white/10 flex-shrink-0">
            <div class="min-w-0">
              <div class="font-semibold text-sm text-white truncate">{{ $proj->title }}</div>
              <div class="text-[11px] font-mono text-slate-400">{{ $proj->framework_label }} &middot; {{ $proj->architecture_label }}</div>
            </div>
          </div>
          <a href="{{ route('admin.projects.edit', $proj) }}" class="btn-secondary !py-1.5 !px-3 !text-xs flex-shrink-0">Edit</a>
        </div>
      @empty
        <p class="text-sm text-slate-400">No projects added yet.</p>
      @endforelse
    </div>
  </div>
@endsection

