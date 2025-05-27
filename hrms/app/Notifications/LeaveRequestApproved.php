<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Leave;

class LeaveRequestApproved extends Notification
{
    use Queueable;

    protected $leave;

    /**
     * Create a new notification instance.
     */
    public function __construct(Leave $leave)
    {
        $this->leave = $leave;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Leave Request Approved')
                    ->line('Your leave request has been approved.')
                    ->line('Leave Type: ' . $this->leave->type_of_leave)
                    ->line('Start Date: ' . $this->leave->start_date)
                    ->line('End Date: ' . $this->leave->end_date)
                    ->line('Enjoy your time off!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'leave_id' => $this->leave->id,
            'leave_type' => $this->leave->type_of_leave,
            'start_date' => $this->leave->start_date,
            'end_date' => $this->leave->end_date,
            'message' => 'Your leave request has been approved by HR. Enjoy your time off!'
        ];
    }
}
