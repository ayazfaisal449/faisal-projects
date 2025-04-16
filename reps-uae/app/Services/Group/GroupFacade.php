<?php namespace Services\Group;

/*
 * Created by Kevin @Cranium Creations*
 */

use Illuminate\Support\Facades\Facade;

class GroupFacade extends Facade {

	protected static function getFacadeAccessor() {
		return 'group';
	}
	
}