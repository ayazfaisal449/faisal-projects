<?php namespace Services\Users;

use Illuminate\Support\ServiceProvider;

use Services\Users\UsersService;
use Models\Users\UsersProvider;

class UsersServiceProvider extends ServiceProvider {

    public function register()
    {
       $this->app->bind('users', function()
        {
            return new UsersService( new UsersProvider());
        });
    }

}