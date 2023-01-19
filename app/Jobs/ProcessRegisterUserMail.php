<?php

namespace App\Jobs;

use App\Mail\UserRegistered;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ProcessRegisterUserMail implements ShouldQueue
{
    /**
     * ---------------------------------------------------------------
     * php artisan queue:failed
     * php artisan queue:retry ce7bb17c-cdd8-41f0-a8ec-7b4fef4e5ece
     * php artisan queue:retry --queue=name
     * php artisan queue:retry all
     * php artisan queue:forget 91401d2c-0784-4f43-824c-34f94a33c24d
     * php artisan queue:flush
     * ---------------------------------------------------------------
     */

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Provide instance of user
     *
     * @var App\Model\User $user
     */
    public $user;

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var int
     */
    public $backoff = 60;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user->email)->send(new UserRegistered($this->user));
    }

    /**
     * Handle a job failure.
     * @param  \Throwable  $exception
     *
     * @return void
     */
    public function failed(Throwable $exception)
    {
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new UserRegistered($this->user, 'Could Not Send Email to User For Registration'));
    }
}
