<?php namespace Cranium\RegistrationCategory\Services;

/*
 *	Created By Kevin @ Cranium Creations
 */
use Illuminate\Support\ServiceProvider;
use Cranium\RegistrationCategory\Services\RegistrationCategoryService;
use Cranium\RegistrationCategory\Models\RegistrationCategoryProvider;

class RegistrationCategoryServiceProvider extends ServiceProvider {

    public function register()
    {
       $this->app->bind('registrationCategory', function()
        {
            return new RegistrationCategoryService( new RegistrationCategoryProvider());
        });
    }

}