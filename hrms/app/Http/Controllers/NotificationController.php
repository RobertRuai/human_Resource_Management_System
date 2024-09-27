<?php

namespace App\Http\Controllers;

use App\Models\notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Display a listing of the notifications
    public function index()
    {
        $notifications = notification::all();
        return view('notifications.index', compact('notifications'));
    }

    // Show the form for creating a new notification
    public function create()
    {
        return view('notifications.create');
    }

    // Store a newly created notification in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
            'is_read' => 'required|boolean',
        ]);

        notification::create($validatedData);
        return redirect()->route('notifications.index')->with('success', 'Notification created successfully.');
    }

    // Display the specified notification
    public function show(notification $notification)
    {
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
            'is_read' => 'required|boolean',
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
