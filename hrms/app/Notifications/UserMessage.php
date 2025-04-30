<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;

class UserMessage extends Notification
{
    use Queueable;

    protected $fromUser;
    protected $message;

    public function __construct($fromUser, $message)
    {
        $this->fromUser = $fromUser;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'from_user_id' => $this->fromUser->id,
            'from_user_name' => $this->fromUser->username ?? $this->fromUser->name,
            'message' => $this->message,
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('You have a new message from ' . ($this->fromUser->username ?? $this->fromUser->name))
            ->line($this->message)
            ->action('View Notifications', url('/notifications'));
    }
}
