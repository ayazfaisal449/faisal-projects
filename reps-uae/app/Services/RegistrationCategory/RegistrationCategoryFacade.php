<?php namespace Cranium\RegistrationCategory\Services;

/*
 * Created by Kevin @Cranium Creations*
 */

use Illuminate\Support\Facades\Facade;

class RegistrationCategoryFacade extends Facade {

	protected static function getFacadeAccessor() {
		return 'registrationCategory';
	}
	
}