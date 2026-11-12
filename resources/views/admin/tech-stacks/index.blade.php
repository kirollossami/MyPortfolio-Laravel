@extends('admin.layouts.app')

@section('title', 'Core Tech Stack')
@section('page_title', 'Core Tech Stack Badges')
@section('page_subtitle', 'Manage the technology badges displayed in the Hero section.')

@section('header_actions')
  <a href="{{ route('admin.tech-stacks.create') }}" class="btn-primary">
    <i class="bi bi-plus-lg"></i> Add Tech Badge
  </a>
@endsection

@section('content')
<div class="panel-card overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-left text-sm">
      <thead class="bg-white/5 text-xs font-mono uppercase text-slate-400">
        <tr>
          <th class="px-5 py-3.5">Order</th>
          <th class="px-5 py-3.5">Technology Name</th>
          <th class="px-5 py-3.5">Accent Color</th>
          <th class="px-5 py-3.5">Status</th>
          <th class="px-5 py-3.5 text-right">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-white/5">
        @forelse($techStacks as $stack)
          <tr class="hover:bg-white/[0.02]">
            <td class="px-5 py-3.5 font-mono text-xs text-slate-400">{{ $stack->sort_order }}</td>
            <td class="px-5 py-3.5 font-semibold {{ $stack->textColorClass() }}">{{ $stack->name }}</td>
            <td class="px-5 py-3.5 font-mono text-xs text-slate-300">{{ $stack->color }}</td>
            <td class="px-5 py-3.5">
              <span class="px-2.5 py-0.5 rounded-full text-[11px] font-mono {{ $stack->is_active ? 'bg-emerald-500/15 text-emerald-300' : 'bg-slate-700/40 text-slate-400' }}">
                {{ $stack->is_active ? 'Active' : 'Hidden' }}
              </span>
            </td>
            <td class="px-5 py-3.5 text-right space-x-2">
              <a href="{{ route('admin.tech-stacks.edit', $stack) }}" class="btn-secondary !py-1.5 !px-3 !text-xs">Edit</a>
              <form action="{{ route('admin.tech-stacks.destroy', $stack) }}" method="POST" class="inline" onsubmit="return confirm('Delete this tech badge?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="px-5 py-8 text-center text-slate-400">No tech stack badges yet.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

