<?php namespace Cranium\VideoGallery\Services;

use Illuminate\Support\ServiceProvider;

use Cranium\VideoGallery\Services\VideoService;
use Cranium\VideoGallery\Models\VideoProvider;
use Cranium\VideoGallery\Models\VideoTypeProvider;
use Cranium\VideoGallery\Models\VideoCategoryProvider;

class VideoServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('video',function()
        {
            return new VideoService(new VideoProvider,
                new VideoTypeProvider,
                new VideoCategoryProvider);
        });
    }
}
