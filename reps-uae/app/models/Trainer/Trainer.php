<?php namespace Cranium\Trainer\Models;
use Illuminate\Database\Eloquent\Model;
use Cranium\TrainerMedia\Models\TrainerMedia;
use Models\Users\Users;
use Cranium\TrainerQualification\Models\TrainerQualification;
use Cranium\TrainerRegistrationCategory\Models\TrainerRegistrationCategory;
use Cranium\TrainerWorkExperience\Models\TrainerWorkExperience;
use Cranium\TrainerUpgradeStatus\Models\TrainerUpgradeStatus;
use Cranium\TrainerUpgradeCategory\Models\TrainerUpgradeCategory;
use Services\Trainer\TrainerService;
use Illuminate\Support\Facades\Validator;
class Trainer extends Model {
	
	/**
	 * Created By Jahir @ Cranium Creations 
	 * Table name for Trainer
	 */
    protected $table = 'trainer';
    
    /**
     * soft delete is enabled
	 */
    protected $softDelete = true;
    
    /**
     * protected fields
     */
    protected $guarded = array();

    /**
     * Ardent Validation 
     */
    public static $rules = array (
        'dob' => 'required|date_format:"Y-m-d"',
        'gender' => 'required',
        'nationality_id' => 'required',
        'city' => 'required|min:1',
        'mobile_phone' => 'required|numeric',
        // 'emirates_id_no' => 'alpha_num',
        'photo' =>'required|image|max:8192',
        'image' =>'image|max:8192',
        'work_email' => 'email',
        'expiry_date' => 'date_format:"Y-m-d"',
    );
    
    /**
     * Setting up the relationship with users
     * Created By jahir @ Cranium Creations
     */
	public function users()
	{
		return $this->belongsTo('Models\Users\Users','user_id');
	}
    
	/**
     * Setting up the relationship with nationality
     * Created By jahir @ Cranium Creations
	 */
	public static function nationality()
	{
		return $this->hasOne('Models\Nationality\Nationality');
	}
    
    /**
     * Setting up the relationship with trainerMedia
     * Created By Kevin @ Cranium Creations
     */
	public function trainerMedia()
	{
		return $this->hasMany('Cranium\TrainerMedia\Models\TrainerMedia',
            'trainer_id');
	}
        
    public function subscriptionPayment() {
        return $this->hasMany('Cranium\Trainer\Models\SubscriptionPayment', 'trainer_id');
    }
    
    //add payment to info history
    public function addSubscriptionPayment($subscriptionPaymentData) {
        return $this->subscriptionPayment()->create($subscriptionPaymentData);
    }
    
    /**
     * Setting up the relationship with trainerQulaifications
     * Created By Kevin @ Cranium Creations
     */
	public function trainerQualifications()
	{
		return $this->hasMany('Cranium\TrainerQualification\Models\TrainerQualification',
            'trainer_id');
	}
    
    /**
     * Setting up the relationship with trainerRegistration
     * Created By Kevin @ Cranium Creations
     */
	public function trainerRegistrationCategories()
	{
		return $this->hasMany('Cranium\TrainerRegistrationCategory\Models\TrainerRegistrationCategory',
            'trainer_id');
	}
    
    /**
     * Setting up the relationship with trainerWorkExperience
     * Created By Kevin @ Cranium Creations
     */
	public function trainerWorkExperience()
	{
		return $this->hasOne('Cranium\TrainerWorkExperience\Models\TrainerWorkExperience',
            'trainer_id');
	}
        
    /**
     * Setting up the relationship with trainerUpgradeStatus
     * Created By Kevin @ Cranium Creations
     */
	public function trainerUpgradeStatus()
	{
		return $this->hasMany('Cranium\TrainerUpgradeStatus\Models\TrainerUpgradeStatus',
            'trainer_id');
	}
    
    /**
     * Setting up the relationship with trainerUpgradeLevel
     * Created By Kevin @ Cranium Creations
     */
	public function trainerUpgradeLevel()
	{
		return $this->hasMany('Cranium\TrainerUpgradeLevel\Models\TrainerUpgradeLevel',
            'trainer_id');
	}
    
    /**
     * @param array tranier Media Data
     * @return Object Trainer
     * Add trainer media
     * Created By Kevin @ Cranium Creations
     */
    public function addTrainerMedia($trainerData)
    {
        return $this->trainerMedia()->create($trainerData);
    }
    
    /**
     * @param array tranier Qualification Data
     * @return Object Trainer
     * Add trainer qualification
     * Created By Kevin @ Cranium Creations
     */
    public function addTrainerQualification($trainerData)
    {
        return $this->trainerQualifications()->create($trainerData);
    }
    
    /**
     * @param array tranier Registration Data
     * @return Object Trainer
     * Add a trainer registration category
     * Created By Kevin @ Cranium Creations
     */
    public function addTrainerRegistrationCategory($trainerData)
    {
        return $this->trainerRegistrationCategories()->create($trainerData);
    }
    
    /**
     * @param array tranier work exp Data
     * @return Object Trainer
     * Add trainer qualification
     * Created By Kevin @ Cranium Creations
     */
    public function addTrainerWorkExperience($trainerData)
    {
        return $this->trainerWorkExperience()->create($trainerData);
    }
    
    /**
     * @param array tranier work exp Data
     * @return Object Trainer
     * Add trainer request to upgrade status
     * Created By Kevin @ Cranium Creations
     */
    public function addTrainerUpgradeStatus($trainerData)
    {
        return $this->trainerUpgradeStatus()->create($trainerData);
    }
    
    /**
     * @param array tranier work exp Data
     * @return Object Trainer
     * Add trainer request to upgrade level
     * Created By Kevin @ Cranium Creations
     */
    public function addTrainerUpgradeLevel($trainerData)
    {
        return $this->trainerUpgradeLevel()->create($trainerData);
    }

    /**
     * Sets the expired value
     *
     * @param boolean
     * @author Chris @ Cranium Creations
     */
    public function setExpired($expired)
    {
        $this->expired = $expired;
        $this->update();

        return true;
    }
    public static function getValidationRules()
    {
        return static::$rules;
    }
}