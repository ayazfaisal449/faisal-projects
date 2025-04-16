<?php namespace Services\Permission;

/*
 *	Created By Kevin @ Cranium Creations
 */
use Illuminate\Support\ServiceProvider;
use Services\Permission\PermissionService;
use Models\Permission\PermissionProvider;
use Cartalyst\Sentry\Sentry;

class PermissionServiceProvider extends ServiceProvider {

    public function register()
    {
       $this->app->bind('permission', function()
        {
            return new PermissionService( new PermissionProvider(), new Sentry);
        });
    }

}