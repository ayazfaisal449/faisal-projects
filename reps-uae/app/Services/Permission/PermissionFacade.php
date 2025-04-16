<?php namespace Services\Permission;

/*
 * Created by Kevin @Cranium Creations*
 */

use Illuminate\Support\Facades\Facade;

class PermissionFacade extends Facade {

	protected static function getFacadeAccessor() {
		return 'permission';
	}
	
}