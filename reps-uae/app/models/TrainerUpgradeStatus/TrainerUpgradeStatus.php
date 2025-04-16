<?php namespace Cranium\TrainerUpgradeStatus\Models;

use LaravelBook\Ardent\Ardent;
use Illuminate\Database\Eloquent\Model;

class TrainerUpgradeStatus extends Model {
	
	/**
	 * Created By Kevin @ Cranium Creations 
	 * Table name for Trainer
	 */
    protected $table = 'trainer_upgrade_status';
    
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
}