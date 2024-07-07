<?php

namespace App\Notifications;

use App\Models\Feed;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Str;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewFeed extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Feed $feed)
    {
        //
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
                    ->subject("New Feed from {$this->feed->user->name}")
                    ->greeting("New Feed from {$this->feed->user->name}")
                    ->line(Str::limit($this->feed->message, 50))
                    ->action('Go to Feeder', url('/'))
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
            //
        ];
    }
}
