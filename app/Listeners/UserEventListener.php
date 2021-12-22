<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
        User::orderBy('created_at', 'desc')->first()->each(function($user) use ($event){
            $user->notify(new UserRegisteredNotification($event->data));
        });
    }
    public function onCreated($event){
        \Log::info('User Registered: '.$event->user->id);

        $event->user->notify(new UserRegistered($user));

        
    }
}
