<?php namespace Cranium\CourseProvider\Models;


use Illuminate\Database\Eloquent\Model;
class CourseProvider extends Model {
	
	/*
	 * Table name for Firm
	 * created by Raj @ Cranium Creations	
	 */
	protected $table = 'course_provider';
	 
	/*
	 * soft guarded is enabled
	 * created by Raj @ Cranium Creations	
	 */
	 protected $guarded = array();
	
	/*
	 * soft delete is enabled
	 * created by Raj @ Cranium Creations	
	 */
	protected $softDelete = true;
	
	 /**
     * Ardent Validation 
     */
    public static $rules = array (
    	'name'=> 'required',
    	// 'category'=> 'required',
		'description'=> 'required',
		'website' => 'required',	
		'logo' => 'required|image'
		//'logo' => 'required|mimes:png,jpg,jpeg,gif'
    );
	
	/*
	 * relation with couse
	 * created by Raj @ Cranium Creations	 
	 */	
	public function course()
	{
		return $this->hasMany('Cranium\Course\Models\Course',
            'course_provider_id');	
	}
	
	/*
	 * relation with couse
	 * @return boolean
	 * created by Raj @ Cranium Creations		
	 */	
	public function addCourse($data)
	{
		return $this->course()->create($data) ? true:false;	
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