<?php namespace Services\Trainer;

/*
 * Created by Jahir @Cranium Creations*
 */

use Illuminate\Support\Facades\Facade;

class TrainerFacade extends Facade {

	protected static function getFacadeAccessor() {
		return 'trainer';
	}
	
}