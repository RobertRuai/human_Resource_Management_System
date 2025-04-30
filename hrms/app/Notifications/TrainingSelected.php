<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;

class TrainingSelected extends Notification
{
    use Queueable;

    protected $training;

    public function __construct($training)
    {
        $this->training = $training;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'training_id' => $this->training->id,
            'title' => $this->training->title,
            'description' => $this->training->description,
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('You have been selected for a training: ' . $this->training->title)
            ->action('View Training', url('/trainings/' . $this->training->id));
    }
}
