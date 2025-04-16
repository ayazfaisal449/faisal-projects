<?php namespace Cranium\RegistrationCategory\Models;

use LaravelBook\Ardent\Ardent;
use Cranium\TrainerRegistrationCategory\Models\TrainerRegistrationCategory;
use Illuminate\Database\Eloquent\Model;
class RegistrationCategory extends Model {
	
	/*
	 * Created By Kevin @ Cranium Creations 
	 * Table name for Trainer
	 */
	 protected $table = 'registration_category';
	 
    /**
     * Setting up the relationship with trainer registration category
     * Created By Kevin @ Cranium Creations
     */
    public function trainerRegistrationCategory()
	{
		return $this->hasMany('Cranium\TrainerRegistrationCategory\Models\TrainerRegistrationCategory',
            'registration_category_id');
	} 
    
    /**
     * Setting up the relationship with course
     * Created By Kevin @ Cranium Creations
     */
    public function Course()
	{
		return $this->hasMany('Cranium\Course\Models\Course',
            'registration_category_id');
	}
}