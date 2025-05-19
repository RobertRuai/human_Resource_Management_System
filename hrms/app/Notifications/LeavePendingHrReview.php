<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Leave;

class LeavePendingHrReview extends Notification
{
    use Queueable;

    protected $leave;

    public function __construct(Leave $leave)
    {
        $this->leave = $leave;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toArray($notifiable)
    {
        return [
            'leave_id' => $this->leave->id,
            'leave_type' => $this->leave->type_of_leave,
            'start_date' => $this->leave->start_date,
            'end_date' => $this->leave->end_date,
            'message' => 'Your leave request has been approved by your Supervisor,it is now pending HR review.'
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Leave Request Pending HR Review')
            ->line('Your leave request for ' . $this->leave->type_of_leave . ' from ' . $this->leave->start_date . ' to ' . $this->leave->end_date . ' has been approved by your supervisor and is now pending HR review.')
            ->action('View Leave', url('/leaves/' . $this->leave->id));
    }
}
