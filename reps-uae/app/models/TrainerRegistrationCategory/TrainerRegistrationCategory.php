<?php namespace Cranium\TrainerRegistrationCategory\Models;

use Illuminate\Database\Eloquent\Model;
use Cranium\Trainer\Models\Trainer;
use Cranium\RegistrationCategory\Models\RegistrationCategory;

class TrainerRegistrationCategory extends Model {
	
    /**
     * Created By Kevin @ Cranium Creations 
     * Table name for Trainer
     */
    protected $table = 'trainer_registration_category';
     
    public $timestamps = true;
	protected $softDelete = true;
    protected $guarded = array();
    protected $hidden = array();
    
    /**
     * Ardent Validation 
     */
    public static $rules = array (
        'registration_category_id' => 'required'
    );
     
    /**
     * Setting up the relationship with trainers
     * Created By Kevin @ Cranium Creations
     */
	public function trainer()
	{
		return $this->belongsTo('Cranium\Trainer\Models\Trainer',
            'trainer_id');
	}
    
    /**
     * Setting up the relationship with registration category
     * Created By Kevin @ Cranium Creations
     */
    public function registrationCategory()
	{
		return $this->belongsTo('Cranium\RegistrationCategory\Models\RegistrationCategory',
            'registration_category_id');
	} 
    public static function getValidationRules()
    {
        return static::$rules;
    }
}