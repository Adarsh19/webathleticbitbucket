<?php
/**
 * Login Listner class to listen login event.
 *
 * @var array
 * Team:
 * Created By:
 * Date: 03.06.18
 *
 **/

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Auth\Events\Login;

class LoginEvent
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
    public function handle(Login $event)
    {
        $subject = trans('common.check_in');
        $description = trans('common.logged_in_successfully');
        activity($subject)
            ->by($event->user)
            ->log($description);
    }
}
