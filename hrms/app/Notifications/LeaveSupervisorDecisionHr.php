<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Leave;

class LeaveSupervisorDecisionHr extends Notification
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
            'decision' => $this->decision,
            'message' => 'Supervisor has ' . $this->decision . ' a leave request for ' . ($this->leave->employee->full_name ?? 'an employee') . '.',
        ];
    }

    public function toMail($notifiable)
    {
        $subject = $this->decision === 'approved' ? 'Leave Approved by Supervisor' : 'Leave Rejected by Supervisor';
        $line = $this->decision === 'approved'
            ? 'A leave request for ' . ($this->leave->employee->full_name ?? 'an employee') . ' has been approved by the supervisor and requires your attention.'
            : 'A leave request for ' . ($this->leave->employee->full_name ?? 'an employee') . ' has been rejected by the supervisor.';
        return (new MailMessage)
            ->subject($subject)
            ->line($line)
            ->line('Leave Type: ' . $this->leave->type_of_leave)
            ->line('Start Date: ' . $this->leave->start_date)
            ->line('End Date: ' . $this->leave->end_date)
            ->action('View Leave', url('/leaves/' . $this->leave->id));
    }
}
