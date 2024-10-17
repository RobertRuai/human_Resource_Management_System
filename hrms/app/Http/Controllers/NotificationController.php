<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\notification;
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
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
            'is_read' => 'boolean:0,1,true,false',
        ]);

        notification::create($validatedData);
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
        return view('notifications.edit', compact('notification'));
    }

    // Update the specified notification in storage
    public function update(Request $request, notification $notification)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
            'is_read' => 'boolean:0,1,true,false',
        ]);

        $notification->update($validatedData);
        return redirect()->route('notifications.index')->with('success', 'Notification updated successfully.');
    }

    // Remove the specified notification from storage
    public function destroy(notification $notification)
    {
        $notification->delete();
        return redirect()->route('notifications.index')->with('success', 'Notification deleted successfully.');
    }
}
