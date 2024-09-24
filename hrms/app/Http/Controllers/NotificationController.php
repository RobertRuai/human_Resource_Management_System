<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Display a listing of the notifications
    public function index()
    {
        $notifications = Notification::all();
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
            'message' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        Notification::create($validatedData);
        return redirect()->route('notifications.index')->with('success', 'Notification created successfully.');
    }

    // Display the specified notification
    public function show(Notification $notification)
    {
        return view('notifications.show', compact('notification'));
    }

    // Show the form for editing the specified notification
    public function edit(Notification $notification)
    {
        return view('notifications.edit', compact('notification'));
    }

    // Update the specified notification in storage
    public function update(Request $request, Notification $notification)
    {
        $validatedData = $request->validate([
            'message' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $notification->update($validatedData);
        return redirect()->route('notifications.index')->with('success', 'Notification updated successfully.');
    }

    // Remove the specified notification from storage
    public function destroy(Notification $notification)
    {
        $notification->delete();
        return redirect()->route('notifications.index')->with('success', 'Notification deleted successfully.');
    }
}
