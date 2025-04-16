<?php namespace Services\Group;

/*
 *	Created By Kevin @ Cranium Creations
 */
use Illuminate\Support\ServiceProvider;
use Services\Group\GroupService;
use Models\Group\GroupProvider;
use Cartalyst\Sentry\Sentry;

class GroupServiceProvider extends ServiceProvider {

    public function register()
    {
       $this->app->bind('group', function()
        {
            return new GroupService( new GroupProvider(), new Sentry);
        });
    }

}