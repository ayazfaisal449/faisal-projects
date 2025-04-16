<?php namespace Services\Course;

/*
 * Created by Raj @Cranium Creations*
 */

use Illuminate\Support\Facades\Facade;

class CourseFacade extends Facade {

	protected static function getFacadeAccessor()
	{
		return 'course';
	}
	
}