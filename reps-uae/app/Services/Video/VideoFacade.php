<?php namespace Cranium\VideoGallery\Services;

use Illuminate\Support\Facades\Facade;

class VideoFacade extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'video';
    }
}
