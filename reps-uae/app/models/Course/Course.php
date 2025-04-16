<?php namespace Cranium\Course\Models;

use Illuminate\Database\Eloquent\Model;
use Cranium\RegistrationCategory\Models\RegistrationCategory;

class Course extends Model {
	
	/*
	 * Table name for Cource
	 */
	 protected $table = 'course';
	
	/*
	 * soft guarded is enabled
	 * created by Raj @ Cranium Creations	
	 */
	protected $guarded = array();
	
	
	 /**
     * Ardent Validation 
     */
    public static $rules = array (
        'name' => 'required',
		'description'=> 'required',
		'course_provider_id'=> 'required',
        'registration_category_id'=>'required'
    );
	
	/*
	 * set up relation with courseProvider
	 * Created By Raj @ Cranium Craetions
	 */
	 public function courseProvider() 
	 {		
		return $this->belongsTo('Cranium\CourseProvider\Models\CourseProvider',
            'course_provider_id');
	 }
     
    /**
     * Setting up the relationship with course provider
     * Created By Kevin @ Cranium Creations
     */
    public function registrationCategory()
	{
		return $this->belongsTo('Cranium\RegistrationCategory\Models\RegistrationCategory',
            'registration_category_id');
	}
	 
	 /*
	 * change status
	 * Return boolean
	 * Created By Raj @ Cranium Craetions
	 */
	 public function changeStatus() 
	 {		
		return parent::save() ? true:false;
	 }
	 
}