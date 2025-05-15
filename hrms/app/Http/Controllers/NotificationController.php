<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\audit_log;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Display a listing of the notifications
    public function index()
    {
        $notifications = DatabaseNotification::all();
        return view('notifications.index', compact('notifications'));
    }

    // Show the form for creating a new notification
    public function create()
    {
        $users = User::all();
        return view('notifications.create', compact('users'));
    }

    // Store a newly created notification in storage
    public function store(Request $request)
    {
        $users = User::all();
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
            'is_read' => 'boolean:0,1,false,true',
        ]);

        // Send notification using Laravel's Notification system
        $recipient = User::findOrFail($request->user_id);
        $sender = auth()->user();
        $recipient->notify(new \App\Notifications\UserMessage($sender, $request->message));

        audit_log::create([
            'user_id' => $sender->id, // Current logged-in user
            'action' => 'create',
            'model' => 'Notification',
            'model_id' => $recipient->id,
            'description' => 'Sent a user-to-user notification to user ID ' . $recipient->id,
        ]);

        return redirect()->route('notifications.index')->with('success', 'Notification sent successfully.');
    }

    // Display the specified notification
    public function show(DatabaseNotification $notification)
    {
        return view('notifications.show', compact('notification'));
    }

    // Show the form for editing the specified notification
    public function edit(DatabaseNotification $notification)
    {
        $users = User::all();
        return view('notifications.edit', compact('notification', 'users'));
    }

    // Mark a notification as read
    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
        }
        return redirect()->back();
    }

    // Update the specified notification in storage
    public function update(Request $request, DatabaseNotification $notification)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
            'is_read' => 'boolean:0,1,false,true',
        ]);

        $notification->update($validatedData);

        audit_log::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'model' => 'Notification',
            'model_id' => $notification->id,
            'description' => 'Updated notification with ID ' . $notification->id,
        ]);

        return redirect()->route('notifications.index')->with('success', 'Notification updated successfully.');
    }

    // Remove the specified notification from storage
    public function destroy(DatabaseNotification $notification)
    {
        $notification->delete();

        audit_log::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model' => 'Notification',
            'model_id' => $notification->id,
            'description' => 'Deleted notification with ID ' . $notification->id,
        ]);

        return redirect()->route('notifications.index')->with('success', 'Notification deleted successfully.');
    }
}
