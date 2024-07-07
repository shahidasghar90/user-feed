<?php

namespace App\Listeners;


use App\Events\FeedCreated;
use App\Models\User;
use App\Notifications\NewFeed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendFeedCreatedNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FeedCreated $event): void
    {
        foreach (User::whereNot('id', $event->feed->user_id)->cursor() as $user) {
            $user->notify(new NewFeed($event->feed));
        }
    }
}
