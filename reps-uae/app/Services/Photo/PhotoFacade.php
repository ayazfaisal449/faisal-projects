<?php namespace Cranium\PhotoGallery\Services;

use Illuminate\Support\Facades\Facade;

class PhotoFacade extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'photo';
    }
}