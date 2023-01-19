<?php

namespace App\Listeners;

use App\Events\UserRegister;
use App\Jobs\ProcessRegisterUserMail;
use App\Mail\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail
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
     * @param  \App\Events\UserRegister  $event
     * @return void
     */
    public function handle(UserRegister $event)
    {
        ProcessRegisterUserMail::dispatch($event->user);
        // ProcessRegisterUserMail::dispatchIf(true, $event->user);
        // ProcessRegisterUserMail::dispatch($event->user)->delay(now()->addMinutes(1));
    }
}
