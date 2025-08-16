<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Show the chat interface for a specific application.
     */
    public function show(Request $request, $applicationId)
    {
        $application = Application::with(['job.company.user', 'jobSeeker.user'])
            ->findOrFail($applicationId);

        // Check if user has access to this application
        if (!Auth::user()->isCompany() && !Auth::user()->isJobSeeker()) {
            abort(403);
        }

        if (Auth::user()->isCompany() && $application->job->company_id !== Auth::user()->company->id) {
            abort(403);
        }

        if (Auth::user()->isJobSeeker() && $application->job_seeker_id !== Auth::user()->jobSeeker->id) {
            abort(403);
        }

        $messages = ChatMessage::where('application_id', $applicationId)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('chat.show', compact('application', 'messages'));
    }

    /**
     * Send a message.
     */
    public function send(Request $request, $applicationId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $application = Application::findOrFail($applicationId);

        // Check if user has access to this application
        if (!Auth::user()->isCompany() && !Auth::user()->isJobSeeker()) {
            abort(403);
        }

        if (Auth::user()->isCompany() && $application->job->company_id !== Auth::user()->company->id) {
            abort(403);
        }

        if (Auth::user()->isJobSeeker() && $application->job_seeker_id !== Auth::user()->jobSeeker->id) {
            abort(403);
        }

        // Determine receiver
        $receiverId = Auth::user()->isCompany() 
            ? $application->jobSeeker->user_id 
            : $application->job->company->user_id;

        ChatMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $receiverId,
            'application_id' => $applicationId,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Message sent successfully.');
    }

    /**
     * Mark messages as read.
     */
    public function markAsRead(Request $request, $applicationId)
    {
        ChatMessage::where('application_id', $applicationId)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Get unread message count for the current user.
     */
    public function getUnreadCount()
    {
        $count = ChatMessage::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Get recent conversations for the current user.
     */
    public function getConversations()
    {
        $conversations = ChatMessage::select('application_id')
            ->where(function ($query) {
                $query->where('sender_id', Auth::id())
                    ->orWhere('receiver_id', Auth::id());
            })
            ->with(['application.job.company.user', 'application.jobSeeker.user'])
            ->groupBy('application_id')
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique('application_id')
            ->take(10);

        return response()->json(['conversations' => $conversations]);
    }
}
