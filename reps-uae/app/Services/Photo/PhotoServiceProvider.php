<?php namespace Cranium\PhotoGallery\Services;

use Illuminate\Support\ServiceProvider;

use Cranium\PhotoGallery\Services\PhotoService;
use Cranium\PhotoGallery\Models\PhotoProvider;
use Cranium\PhotoGallery\Models\PhotoCategoryProvider;

class PhotoServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('photo',function()
        {
            return new PhotoService(new PhotoProvider,
                new PhotoCategoryProvider);
        });
    }
}