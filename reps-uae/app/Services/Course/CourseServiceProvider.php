<?php namespace Services\Course;

/*
 *	Created By Raj @ Cranium Creations
 */
use Illuminate\Support\ServiceProvider;
use Cranium\CourseProvider\Models\CourseProviderProvider;
use Cranium\Course\Models\CourseProvider;
use Cranium\RegistrationCategory\Models\RegistrationCategoryProvider;

class CourseServiceProvider extends ServiceProvider {

    public function register()
    {
       $this->app->bind('course', function()
        {
            return new CourseService( new CourseProvider(), new CourseProviderProvider(),
                new RegistrationCategoryProvider() );
        });
    }

}