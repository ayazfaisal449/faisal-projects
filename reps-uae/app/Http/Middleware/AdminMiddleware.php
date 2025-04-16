<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Sentry\Facades\Laravel\Sentry; 

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
      
        if (Sentry::check()) {
     
            $user = \Models\Users\Users::find(Sentry::getUser()->id);
          
            if (!$user->hasAccess('admin.dashboard')) {
                return Redirect::action('AdminController@logIn');
            }
        } else {
            
            return Redirect::action('AdminController@logIn');
        }

        return $next($request);
    }
}


