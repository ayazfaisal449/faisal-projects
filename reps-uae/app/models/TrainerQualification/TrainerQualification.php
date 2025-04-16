<?php namespace Cranium\TrainerQualification\Models;

use Illuminate\Database\Eloquent\Model;
use Cranium\Trainer\Models\Trainer;

class TrainerQualification extends Model {

    /**
     * Created By Kevin @ Cranium Creations 
     * Table name for Trainer
     */
    protected $table = 'trainer_qualification';
     
    public $timestamps = true;
    protected $softDelete = true;
    protected $guarded = array();
    protected $hidden = array();
    
    /**
     * Ardent Validation 
     */
    public static $rules = array (
        'course_name' => 'sometimes',
        'course_provider' => 'sometimes',
        'date_completed' => 'sometimes|date',
        //'certificate' => 'required|mimes:pdf,doc,docx,png,jpg,jpeg,gif|max:8192'
		'certificate' => 'required|max:8192',
		'aid' => 'max:8192'
    );
    
    /**
     * Setting up the relationship with trainers
     * Created By Kevin @ Cranium Creations
     */
	public function trainer()
	{
		return $this->belongsTo('Models\Trainer\Trainer',
            'trainer_id');
	}
    public static function getValidationRules()
    {
        return static::$rules;
    }
}