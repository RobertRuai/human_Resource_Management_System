<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\notification;
use App\Models\audit_log;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Display a listing of the notifications
    public function index()
    {
        $users = User::all();
        $notifications = notification::all();
        return view('notifications.index', compact('notifications', 'users'));
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

        $notification = notification::create($validatedData);
        audit_log::create([
            'user_id' => auth()->id(), // Current logged-in user
            'action' => 'create',
            'model' => 'Notification',
            'model_id' => $notification->id,
            'description' => 'Created a new notification with ID ' . $notification->id,
        ]);

        return redirect()->route('notifications.index')->with('success', 'Notification created successfully.');
    }

    // Display the specified notification
    public function show(notification $notification)
    {
        $user = User::all();
        return view('notifications.show', compact('notification'));
    }

    // Show the form for editing the specified notification
    public function edit(notification $notification)
    {
        $users = User::all();
        return view('notifications.edit', compact('notification', 'users'));
    }

    // Update the specified notification in storage
    public function update(Request $request, notification $notification)
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
    public function destroy(notification $notification)
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
