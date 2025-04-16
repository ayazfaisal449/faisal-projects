<?php namespace Services\Users;

/*
 * Created by Kevin @Cranium Creations*
 */

use Illuminate\Support\Facades\Facade;

class UsersFacade extends Facade {

	protected static function getFacadeAccessor() {
		return 'users';
	}
	
}