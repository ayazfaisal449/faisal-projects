<?php namespace Cranium\TrainerUpgradeLevel\Models;

use Illuminate\Database\Eloquent\Model;
use Cranium\Trainer\Models\Trainer;

class TrainerUpgradeLevel extends Model {
	
	/**
	 * Created By Kevin @ Cranium Creations 
	 * Table name for Trainer
	 */
    protected $table = 'trainer_upgrade_level';
    
    /**
     * protected fields
     */
    protected $guarded = array();

    /**
     * Ardent Validation 
     */
    public static $rules = array (
        'course_name' => 'sometimes|alpha_spaces',
        'course_provider' => 'sometimes|alpha_spaces',
        'date_completed' => 'sometimes|date',
        'certificate' => 'required|mimes:pdf,doc,docx,png,jpg,gif,jpeg|max:256000',
        'category' => 'required',
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