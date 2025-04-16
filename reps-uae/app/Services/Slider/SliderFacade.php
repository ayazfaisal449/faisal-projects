<?php namespace Services\Slider;

/*
 * Created by Kevin @Cranium Creations*
 */

use Illuminate\Support\Facades\Facade;

class SliderFacade extends Facade {

	protected static function getFacadeAccessor() {
		return 'slider';
	}
	
}