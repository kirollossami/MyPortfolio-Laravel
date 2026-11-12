@extends('admin.layouts.app')

@section('title', 'Contact Inbox')
@section('page_title', 'Contact Inquiries Inbox')
@section('page_subtitle', 'Every message submitted on the frontend is stored here in the database.')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-3">
  <div class="flex flex-wrap gap-2">
    <a href="{{ route('admin.messages.index') }}" class="btn-secondary !text-xs {{ !$filter ? '!border-sky-400 !text-sky-300' : '' }}">All</a>
    <a href="{{ route('admin.messages.index', ['filter' => 'unread']) }}" class="btn-secondary !text-xs {{ $filter === 'unread' ? '!border-emerald-400 !text-emerald-300' : '' }}">Unread ({{ $unreadCount }})</a>
    <a href="{{ route('admin.messages.index', ['filter' => 'read']) }}" class="btn-secondary !text-xs {{ $filter === 'read' ? '!border-sky-400 !text-sky-300' : '' }}">Read</a>
  </div>
</div>

<div class="panel-card overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-left text-sm">
      <thead class="bg-white/5 text-xs font-mono uppercase text-slate-400">
        <tr>
          <th class="px-5 py-3.5">Status</th>
          <th class="px-5 py-3.5">Sender</th>
          <th class="px-5 py-3.5">Subject</th>
          <th class="px-5 py-3.5">Email Delivery</th>
          <th class="px-5 py-3.5">Received</th>
          <th class="px-5 py-3.5 text-right">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-white/5">
        @forelse($messages as $msg)
          <tr class="hover:bg-white/[0.02] {{ !$msg->is_read ? 'bg-emerald-500/[0.03]' : '' }}">
            <td class="px-5 py-3.5">
              <span class="px-2.5 py-0.5 rounded-full text-[11px] font-mono {{ !$msg->is_read ? 'bg-emerald-500/20 text-emerald-300' : 'bg-slate-700/40 text-slate-400' }}">
                {{ !$msg->is_read ? 'Unread' : 'Read' }}
              </span>
            </td>
            <td class="px-5 py-3.5">
              <div class="font-semibold text-white">{{ $msg->name }}</div>
              <div class="text-xs font-mono text-slate-400">{{ $msg->email }}</div>
            </td>
            <td class="px-5 py-3.5 text-slate-200 max-w-xs truncate">{{ $msg->subject }}</td>
            <td class="px-5 py-3.5 font-mono text-xs {{ $msg->mail_delivered ? 'text-emerald-400' : 'text-amber-400' }}">
              {{ $msg->mail_delivered ? 'Email Sent' : 'DB Saved' }}
            </td>
            <td class="px-5 py-3.5 text-xs font-mono text-slate-400">{{ $msg->created_at->format('Y-m-d H:i') }}</td>
            <td class="px-5 py-3.5 text-right space-x-2 whitespace-nowrap">
              <a href="{{ route('admin.messages.show', $msg) }}" class="btn-primary !py-1.5 !px-3 !text-xs">Open</a>
              <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" class="inline" onsubmit="return confirm('Delete this message?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="px-5 py-8 text-center text-slate-400">No contact inquiries yet.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div>{{ $messages->links() }}</div>
@endsection

