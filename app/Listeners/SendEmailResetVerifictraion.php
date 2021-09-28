<?php

namespace App\Listeners;

use App\Events\UserAccountEmailChanged;
use App\Mail\UserMailChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailResetVerifictraion
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
     * @param  UserAccountEmailChanged  $event
     * @return void
     */
    public function handle(UserAccountEmailChanged $event)
    {
        $user = $event->user;

        retry(5, function() use($user){
            Mail::to($user)->send(new UserMailChanged($user));
        }, 100);
    }
}
