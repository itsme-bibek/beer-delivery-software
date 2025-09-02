<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageToAdmin;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'orderGroup' => 'required|string',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'user_id' => $request->user()->id,
            'order_group' => $request->orderGroup,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'unread'
        ]);

        // Send email notification to admin (optional)
        // You can implement this later if needed

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully! Admin will review and respond soon.'
        ]);
    }

    public function index(Request $request)
    {
        $messages = Message::with('user')
            ->when($request->user()->isUser(), function($query) use ($request) {
                return $query->where('user_id', $request->user()->id);
            })
            ->latest()
            ->paginate(15);

        // Check if user is accessing from user routes
        if ($request->user()->isUser()) {
            return view('frontend.users.messages.index', compact('messages'));
        }

        // Admin view
        return view('frontend.messages.index', compact('messages'));
    }

    public function show(Message $message, Request $request)
    {
        // Ensure user can only view their own messages
        if ($request->user()->isUser() && $message->user_id !== $request->user()->id) {
            abort(403);
        }

        // Check if this is an AJAX request (for modal)
        if ($request->ajax()) {
            return view('frontend.users.messages.show', compact('message'));
        }

        // For regular page view, return full layout
        return view('frontend.messages.show', compact('message'));
    }

    public function reply(Request $request, Message $message)
    {
        // Only admin can reply
        if (!$request->user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'admin_reply' => 'required|string|max:1000',
        ]);

        $message->update([
            'admin_reply' => $request->admin_reply,
            'status' => 'replied',
            'replied_at' => now()
        ]);

        // Send email notification to user (optional)
        // You can implement this later if needed

        return response()->json([
            'success' => true,
            'message' => 'Reply sent successfully!'
        ]);
    }

    public function markAsRead(Message $message, Request $request)
    {
        // Only admin can mark as read
        if (!$request->user()->isAdmin()) {
            abort(403);
        }

        $message->update(['status' => 'read']);

        return response()->json([
            'success' => true,
            'message' => 'Message marked as read'
        ]);
    }

    public function destroy(Message $message, Request $request)
    {
        // Users can only delete their own messages, admins can delete any message
        if ($request->user()->isUser() && $message->user_id !== $request->user()->id) {
            abort(403);
        }

        $message->delete();

        return response()->json([
            'success' => true,
            'message' => 'Message deleted successfully!'
        ]);
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'message_ids' => 'required|array',
            'message_ids.*' => 'exists:messages,id'
        ]);

        $messageIds = $request->message_ids;
        
        if ($request->user()->isUser()) {
            // Users can only delete their own messages
            $messages = Message::whereIn('id', $messageIds)
                ->where('user_id', $request->user()->id)
                ->get();
            
            $messageIds = $messages->pluck('id')->toArray();
        }

        Message::whereIn('id', $messageIds)->delete();

        return response()->json([
            'success' => true,
            'message' => count($messageIds) . ' message(s) deleted successfully!'
        ]);
    }
}
