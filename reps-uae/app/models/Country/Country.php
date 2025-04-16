<?php namespace Cranium\Country\Models;

use LaravelBook\Ardent\Ardent;
use Cranium\RegistrationCategory\Models\RegistrationCategory;

class Country extends Ardent { 

    protected $table = 'country';
    
    protected $guarded = array();

}