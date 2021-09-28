<?php

namespace App\Listeners;

use App\Events\UserAccountCreated;
use App\Mail\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendVerificationTokenEmail
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
     * @param  UserAccountCreated  $event
     * @return void
     */
    public function handle(UserAccountCreated $event)
    {
        $user = $event->user;

        retry(5, function () use($user){
            Mail::to($user)->send(new UserCreated($user));
        }, 100);
    }
}
