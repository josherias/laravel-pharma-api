<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;


use App\Events\UserAccountCreated;
use App\Listeners\SendVerificationTokenEmail;


use App\Events\UserAccountEmailChanged;
use App\Listeners\SendEmailResetVerifictraion;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],

        UserAccountCreated::class => [
            SendVerificationTokenEmail::class
        ],

        UserAccountEmailChanged::class => [
            SendEmailResetVerifictraion::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
