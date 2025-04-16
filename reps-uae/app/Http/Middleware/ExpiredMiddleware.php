<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Sentry\Facades\Laravel\Sentry;
use DateTime;

class ExpiredMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = \Models\Users\Users::with('trainer')->find(Sentry::getUser()->id);
        $today_dt = new DateTime(date("Y-m-d"));
        $expire_dt = new DateTime($user->trainer->expiry_date);

        if ($expire_dt < $today_dt) {
            return Redirect::action('TrainerController@renewRegistration');
        }

        return $next($request);
    }
}


