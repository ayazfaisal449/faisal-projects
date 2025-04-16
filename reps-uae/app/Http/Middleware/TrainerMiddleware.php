<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class TrainerMiddleware
{
    public function handle($request, Closure $next)
    {
       
        if (Sentry::check()) {
            $user = \Models\Users\Users::find(Sentry::getUser()->id);
            if (!$user->hasAccess('trainer.dashboard')) {
                return Redirect::action('TrainerController@logIn');
            }
        } else {
            return Redirect::action('TrainerController@logIn');
        }

        return $next($request);
    }
}

