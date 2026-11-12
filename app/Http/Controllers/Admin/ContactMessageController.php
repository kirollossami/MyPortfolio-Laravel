<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        $messages = ContactMessage::query()
            ->when($filter === 'unread', fn ($q) => $q->where('is_read', false))
            ->when($filter === 'read', fn ($q) => $q->where('is_read', true))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $unreadCount = ContactMessage::where('is_read', false)->count();

        return view('admin.messages.index', compact('messages', 'filter', 'unreadCount'));
    }

    public function show(ContactMessage $message)
    {
        $message->markAsRead();

        return view('admin.messages.show', compact('message'));
    }

    public function toggleRead(ContactMessage $message)
    {
        $isRead = !$message->is_read;
        $message->update([
            'is_read' => $isRead,
            'read_at' => $isRead ? now() : null,
        ]);

        return back()->with('success', $isRead ? 'Marked as read.' : 'Marked as unread.');
    }

    public function updateNotes(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'admin_notes' => 'nullable|string|max:3000',
        ]);

        $message->update(['admin_notes' => $validated['admin_notes'] ?? null]);

        return back()->with('success', 'Notes saved.');
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Inquiry deleted.');
    }
}

