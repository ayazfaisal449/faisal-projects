<?php namespace Cranium\TrainerWorkExperience\Models;

use Illuminate\Database\Eloquent\Model;
use Cranium\Trainer\Models\Trainer;

class TrainerWorkExperience extends Model {
	
	/**
	 * Created By Kevin @ Cranium Creations 
	 * Table name for Trainer
	 */
    protected $table = 'trainer_work_experience';
    
    /**
     * protected fields
     */
    protected $guarded = array();

    /**
     * Ardent Validation 
     */
    public static $rules = array (
        'job_title' => 'required',
        //'cv' => 'mimes:pdf,doc,docx|max:8192',
		// 'cv' => 'max:8192',
    );
    
    /**
     * Setting up the relationship with users
     * Created By jahir @ Cranium Creations
     */
	public function trainer()
	{
		return $this->belongsTo('Cranium\Trainer\Models\Trainer',
            'trainer_id');
	}
  public static function getValidationRules()
    {
        return static::$rules;
    }
}