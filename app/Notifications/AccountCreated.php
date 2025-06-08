<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountCreated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public string $password
    )
    {
        $this->onConnection('redis');
        $this->onQueue('notifications');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->success()
            ->subject('Welcome to Fork Feed')
            ->greeting("We’re excited to have you on board!")
            ->line('Here’s your account information to help you get started:')
            ->lines([
                'Name: ' . $notifiable->name,
                'Username: [' . '@' . $notifiable->username . ']('. config('app.url') .'/@' . $notifiable->username . ')',
                'Password: ' . $this->password,
            ]);

    }
}
