<?php namespace Services\Slider;

use Illuminate\Support\ServiceProvider;

use Services\Slider\SliderService;
use Cranium\Slider\Models\SliderProvider;
class SliderServiceProvider extends ServiceProvider {

    public function register()
    {
       $this->app->bind('slider', function()
        {
            return new SliderService( new SliderProvider());
        });
    }

}