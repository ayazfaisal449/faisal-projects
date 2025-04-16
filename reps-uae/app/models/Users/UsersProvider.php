<?php namespace Models\Users;

use Models\Users\Users;
use Cranium\Trainer\Models\Trainer;
use Cranium\Trainer\Models\SubscriptionPayment;
use Cartalyst\Sentry\Users\Eloquent\User as Sentry;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UsersProvider{
    
    private function createSubscriptionPaymentModel() {
        return new SubscriptionPayment();
    }
    
    public function getSubscriptionPaymentByInvoiceId($invoice_id) {
        $sp = $this->createSubscriptionPaymentModel();
        return $sp::where('invoice_id','=',$invoice_id)->get();
    }
    
    public function getSubscriptionPaymentByTraineeEmail($invoice_id) {
        $sp = $this->createSubscriptionPaymentModel();
        return $sp::where('email','=',$invoice_id)->get();
    }
    
    public function getSubscriptionPaymentByTrainerId($trainer_id) {
        $sp = $this->createSubscriptionPaymentModel();
        return $sp::where('trainer_id','=',$trainer_id)->get();
    }
	
    /**
     * reference the user modal
     * Created By Kevin @ Cranium Creations
     */	
	private function createUserModel()
    {
		return new Users();		
	}
    
    /**
     * reference the user modal
     * Created By Kevin @ Cranium Creations
     */	
    public function createTrainerModel()
    {
        return new Trainer();		
    }
    
    /**
     * Validates data from ardent
     *
     * @param array()
     * @return Collection of errors
     * @author Kevin @ Cranium Creations
     */
    public function validateTrainerPersonalDetails($data)
    {   

       
        $rules = Trainer::getValidationRules();
        $validator = Validator::make($data, $rules);
     
        // Create a validator instance
        // $trainer->validate(); 

        if ($validator->fails()) {
            return [
                'status' => true,
                'messageBag' => $validator->errors()
            ];
        }
   
        $trainer = $this->createTrainerModel()->fill($data); 
        return ['status' => false];
    }
	
    /**
     * get all users
     * Created By Kevin @ Cranium Craetions
     */
    public function getAll($active=NULL) 
    {
        $user = $this->createUserModel();
        return $user::where('activated','=',$active)->get();
    }
    
    /*
     * get all users
     * Created By Kevin @ Cranium Craetions
     */
    public function getAllTrainers($active=NULL) 
    {
        $user = $this->createUserModel();
        return $user::where('activated','=',$active)->where('id','<>',1)->get();
    }
    
    /**
     * @param (id) userId
     * @return trainer
     * get trainer for user id
     * Created By Kevin @ Cranium Craetions
     */
    public function getTrainerForUser($userId) 
    {
        $user = $this->createUserModel();
        return $user->find($userId)->trainer; 
    }
     
    /**
     * @param (id) trainerId
     * @return trainer registration category
     * get trainer for user id
     * Created By Kevin @ Cranium Creations
     */
    public function getTrainerRegCategory($trainerId)
    {
        $trainer = $this->createTrainerModel();
        return $trainer->find($trainerId)->trainerRegistrationCategories;
    }
     
    /**
     * @param (id) trainerId
     * @return trainer qualifications
     * get trainer for user id
     * Created By Kevin @ Cranium Creations
     */
    public function getTrainerQualifications($trainerId)
    {
        $trainer = $this->createTrainerModel();
        return $trainer->find($trainerId)->trainerQualifications;
    }
    
    /**
     * @param (id) trainerId
     * @return trainer photo
     * get trainer for user id
     * Created By Kevin @ Cranium Creations
     */
    public function getTrainerPhoto($trainerId)
    {
        $trainer = $this->createTrainerModel();
        return $trainer->find($trainerId)->trainerMedia()
                    ->where('media_type_id', '=', 3)->get();
    }
    
    /**
     * @param (id) trainerId
     * @return trainer passport
     * get trainer for user id
     * Created By Kevin @ Cranium Creations
     */
    public function getTrainerPassport($trainerId)
    {
        $trainer = $this->createTrainerModel();
        return $trainer->find($trainerId)->trainerMedia()
                    ->where('media_type_id', '=', 1)->get();
    }
	
    /*
     * @param array
     * @return Collection trainers
     * Get Trainers
     * Created By Raj @ Cranium Creations
     */
    public function searchTrainers($data)
    {
        $default = array();

        $trainer = $this->createTrainerModel()->newQuery();
     
        //set the reg category join
        $trainer->join('trainer_registration_category',
            'trainer_registration_category.trainer_id','=','trainer.id');
        $trainer->join('registration_category',
            'trainer_registration_category.registration_category_id', '=', 'registration_category.id');
        $trainer->join('status',
            'status.id', '=', 'trainer.status_id');
        
        $trainer->leftJoin('trainer_work_experience','trainer_work_experience.trainer_id','=','trainer.id');
        
        //set the user join
        $trainer->join('users','users.id','=','trainer.user_id');
        
        //set the nationality options
        $trainer->join('nationality','trainer.nationality_id','=','nationality.id');

        //check if the name is set
        if ($data['trainer'] != '')
        {
            $trainer->where(function ($query) use ($data)
            {
                $query->where('users.first_name','LIKE','%' . $data['trainer'] . '%')
                      ->orWhere('users.last_name','LIKE','%' . $data['trainer']. '%')
                      ->orWhereRaw('CONCAT(TRIM(users.first_name), " ", TRIM(users.last_name)) LIKE "%' . $data['trainer'] . '%"', array())
                      ->orWhere('trainer_work_experience.work_place','LIKE','%"%' . $data['trainer'] . '%"%');
            });
        }
        
        if ($data['city'] != NULL)
        {
            $trainer->where('trainer.city','LIKE','%' . $data['city']. '%');
        }
        
        //check if the gender is set
        if($data['gender'] != NUll && ($data['gender'] == 0 || $data['gender'] == 1))
        {
            $trainer->where('trainer.gender','=',$data['gender']);
        }
        
        //check if the level and category
        if($data['level'] != NULL && $data['level'] != 0)
        {
            $trainer->where('trainer_registration_category.registration_category_id', '=', $data['level']);
            $trainer->whereNull('trainer_registration_category.deleted_at');
        }

        // Check nationality
        if ($data['nationality_id'] != NULL && $data['nationality_id'] != 0)
        {
            $trainer->where('trainer.nationality_id','=',$data['nationality_id']);
        }
        
        //to check the status of the trainer
        $trainer->where('trainer.status_id', '!=', 3);
        $trainer->where('users.activated', '=', 1);
        $trainer->where('trainer.expiry_date','>=',date('Y-m-d'));
        
        $trainer->groupBy('trainer.id')->orderBy('users.first_name', 'ASC');

        return $trainer->get(array(
            'users.id',
            'users.first_name',
            'users.last_name',
            'nationality.name as nationality',
            'registration_category.level',
            'trainer.expiry_date',
            'trainer.photo',
            'status.name',
            'trainer.city'))->toArray();		
     }
	 
	 /*
     * @param array
     * @return Collection trainers
     * Get Trainers
     * Created By Sebin @ Cranium Creations
     */
    public function adminSearchTrainers($data)
    {
    
        $default = array();

        $trainer = $this->createTrainerModel()->newQuery();
     
        //set the reg category join
        $trainer->join('trainer_registration_category', 'trainer_registration_category.trainer_id','=','trainer.id');
        $trainer->join('registration_category', 'trainer_registration_category.registration_category_id', '=', 'registration_category.id');
        $trainer->leftJoin('trainer_work_experience','trainer_work_experience.trainer_id','=','trainer.id');
		
        if(isset($data['upgradeRequest']) && $data['upgradeRequest'] != NULL && $data['upgradeRequest'] == 'status')
        {
            //set the upgrade status join
            $trainer->join('trainer_upgrade_status','trainer_upgrade_status.trainer_id','=','trainer.id');
        }
        if(isset($data['upgradeRequest']) && $data['upgradeRequest'] != NULL && $data['upgradeRequest'] == 'level')
        {
            //set the upgrade level join
            $trainer->join('trainer_upgrade_level','trainer_upgrade_level.trainer_id','=','trainer.id');
        }
        
        //set the user join
        $trainer->join('users','users.id','=','trainer.user_id');
		
        
        //check if the name is set
        if(isset($data['trainer']) && $data['trainer'] != '')
        {
            $trainer->where(function ($query) use ($data)
            {
                $query->where('users.first_name','LIKE','%' . $data['trainer'] . '%')
                      ->orWhere('users.last_name','LIKE','%' . $data['trainer']. '%')
                      ->orWhere('trainer.reps_id','LIKE','%' . $data['trainer']. '%')
                      ->orWhereRaw('CONCAT(TRIM(users.first_name), " ", TRIM(users.last_name)) LIKE "%' . $data['trainer'] . '%"', array())
                      ->orWhere('trainer_work_experience.work_place','LIKE','%"%' . $data['trainer'] . '%"%');
            }); 
        }

        //check if the gender is set
        if(isset($data['gender']) && $data['gender'] != "")
        {
            $trainer->where('trainer.gender','=',$data['gender']);
        }
        
        //check if the level and category
        if(isset($data['registrationCategory']) && $data['registrationCategory'] != NULL && $data['registrationCategory'] != 0)
        {
            $trainer->where('trainer_registration_category.registration_category_id','=',$data['registrationCategory']);
            $trainer->whereNull('trainer_registration_category.deleted_at');
        }
		
        if(isset($data['upgradeRequest']) && $data['upgradeRequest'] != NULL && $data['upgradeRequest'] == 'status')
        {
            $trainer->where('trainer_upgrade_status.is_processed','=',0);
        }
		
        if(isset($data['upgradeRequest']) && $data['upgradeRequest'] != NULL && $data['upgradeRequest'] == 'level')
        {
            $trainer->where('trainer_upgrade_level.is_processed','=',0);
        }
		
        if(isset($data['trainerStatus']) && $data['trainerStatus'] != "")
        {
            $trainer->where('trainer.status_id','=',$data['trainerStatus']);
                
        }
        
        if (isset($data['trainerAge']) && ($data['trainerAge'] >= 1 && $data['trainerAge'] <= 7)) {
            
            if ($data['trainerAge'] == 1) {
                
                $trainer->whereRaw('FLOOR(DATEDIFF(CURDATE(), trainer.dob) / 365) <= 24', array());
                
            } else if ($data['trainerAge'] == 2) {
                
                $trainer->whereRaw('FLOOR(DATEDIFF(CURDATE(), trainer.dob) / 365) BETWEEN 25 AND 34', array());
                
            } else if ($data['trainerAge'] == 3) {
                
                $trainer->whereRaw('FLOOR(DATEDIFF(CURDATE(), trainer.dob) / 365) BETWEEN 35 AND 44', array());
                
            } else if ($data['trainerAge'] == 4) {
                
                $trainer->whereRaw('FLOOR(DATEDIFF(CURDATE(), trainer.dob) / 365) BETWEEN 45 AND 54', array());
                
            } else if ($data['trainerAge'] == 5) {
                
                $trainer->whereRaw('FLOOR(DATEDIFF(CURDATE(), trainer.dob) / 365) BETWEEN 55 AND 64', array());
                
            } else if ($data['trainerAge'] == 6) {
                
                $trainer->whereRaw('FLOOR(DATEDIFF(CURDATE(), trainer.dob) / 365) >= 65', array());
            }
        }
        
        if(isset($data['expire']) && ($data['expire'] == "0" || $data['expire'] == "1" || $data['expire'] == "-1"))
        {
            if ($data['expire'] == "0")
            {
                $trainer->whereRaw('YEAR(expiry_date) = YEAR(NOW())', array())
                        ->whereRaw('MONTH(expiry_date) = MONTH(NOW())', array())
                        ->where('status_id','<>',3);
                
            } else if ($data['expire'] == "1") {
                $trainer->whereRaw('YEAR(expiry_date) = YEAR(NOW() + INTERVAL 1 MONTH)', array())
                        ->whereRaw('MONTH(expiry_date) = MONTH(NOW() + INTERVAL 1 MONTH)', array())
                        ->where('status_id','<>',3);
            } else {
                $trainer->whereRaw('expiry_date < NOW()', array())
                        ->where('status_id','<>',3);
            }
        }
        
        if(isset($data['trainerType']) && ($data['trainerType'] == "1"))
        {
            if ($data['trainerType'] == "1") {
//                $trainer->where('users.activated','=',1);
                $trainer->whereRaw("status_id IN (1,2)", array());
                $trainer->whereRaw("expiry_date >= NOW()", array());
            }
        }

        $trainer->groupBy('trainer.id')->orderBy('users.first_name', 'ASC');

        return $trainer->get(array(
            'users.id',
            'users.first_name',
            'users.last_name',
            'registration_category.level',
            'trainer.expiry_date',
            'trainer.status_id',
            'trainer.status_id',
            'trainer.nationality_id',	
            'trainer.reps_id',
            'trainer.dob',
            'trainer.gender',
            'trainer.city',
            'trainer.work_email',
            'trainer.reps_id',
            'trainer.mobile_phone',
            'users.email',
        ));		
     }
    
    /**
     * @param trainer id
     * @return trainer
     * get Trainer By Id
     * Created By Kevin @ Cranium Creations
     */
     public function getTrainerById($id)
     {
        $trainer = $this->createTrainerModel();
        return $trainer->find($id);
     }
    
     
     /**
     * @param trainer id
     * @return trainer work exp
     * gets the Trainer work experience
     * Created By Kevin @ Cranium Creations
     */
     public function getTrainerWorkExperience($id)
     {
        $trainer = $this->createTrainerModel();
        return $trainer->find($id)->trainerWorkExperience()->first();
     }
    
}