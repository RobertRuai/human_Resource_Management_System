<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Leave;

class LeaveRequestSubmitted extends Notification
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
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('New Leave Request Submitted')
                    ->line('A new leave request has been submitted by ' . $this->leave->employee->full_name . '.')
                    ->line('Leave Type: ' . $this->leave->type_of_leave)
                    ->line('Start Date: ' . $this->leave->start_date)
                    ->line('End Date: ' . $this->leave->end_date)
                    ->action('Review Leave Request', url('/leaves/' . $this->leave->id))
                    ->line('Thank you for using our application!');
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
            'employee_name' => $this->leave->employee->full_name ?? null,
            'from_user_name' => $this->leave->employee->user->username ?? $this->leave->employee->user->name ?? null,
            'message' => 'A new leave request has been submitted by ' . ($this->leave->employee->full_name ?? 'an employee') . ' and requires your review.',
            'url' => url('/leaves/' . $this->leave->id)
        ];
    }
}
