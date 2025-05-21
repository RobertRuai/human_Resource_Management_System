<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Leave;

class LeaveFinalizedByHr extends Notification
{
    use Queueable;

    protected $leave;
    protected $decision;

    public function __construct(Leave $leave, $decision)
    {
        $this->leave = $leave;
        $this->decision = $decision;
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
            'employee_name' => $this->leave->employee->full_name ?? null,
            'supervisor_name' => $this->leave->supervisor ? $this->leave->supervisor->full_name : null,
            'decision' => $this->decision,
            'message' => 'HR has ' . $this->decision . ' the leave request for ' . ($this->leave->employee->full_name ?? 'an employee') . '.',
        ];
    }

    public function toMail($notifiable)
    {
        $subject = $this->decision === 'approved' ? 'Leave Approved by HR' : 'Leave Rejected by HR';
        $line = $this->decision === 'approved'
            ? 'The leave request for ' . ($this->leave->employee->full_name ?? 'an employee') . ' has been approved by HR.'
            : 'The leave request for ' . ($this->leave->employee->full_name ?? 'an employee') . ' has been rejected by HR.';
        return (new MailMessage)
            ->subject($subject)
            ->line($line)
            ->line('Leave Type: ' . $this->leave->type_of_leave)
            ->line('Start Date: ' . $this->leave->start_date)
            ->line('End Date: ' . $this->leave->end_date)
            ->action('View Leave', url('/leaves/' . $this->leave->id));
    }
}
