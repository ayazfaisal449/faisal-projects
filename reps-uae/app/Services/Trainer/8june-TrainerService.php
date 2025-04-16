<?php namespace Services\Trainer;

use Models\Users\Users;
use Cranium\Trainer\Models\Trainer;
use Cranium\Trainer\Models\TrainerTemp;
use Cranium\TrainerQualification\Models\TrainerQualification;
use Cranium\TrainerRegistrationCategory\Models\TrainerRegistrationCategory;
use Cranium\TrainerMedia\Models\TrainerMedia;
use Cranium\RegistrationCategory\Models\RegistrationCategory;
use Cranium\WorkExperience\Models\WorkExperience;
use Cranium\Trainer\Models\SubscriptionPayment;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

use Intervention\Image\Facades\Image;

class TrainerService {

	protected $userProvider;
	protected $trainerMediaProvider;
        protected $trainerQualificationProvider;
        protected $trainerRegistrationCategoryProvider;
        protected $registrationCategory;
        protected $trainerWorkExperience;
        protected $trainerUpgradeStatusProvider;
        protected $trainerUpgradeLevelProvider;
        protected $trainerProvider;
    
	/*
	* initialise 
	* Created By Kevin @ Cranium Creations
	*/
	public function __construct($userProvider, $trainerMediaProvider, 
        $trainerQualificationProvider, $trainerRegistrationCategoryProvider,
        $registrationCategory, $trainerWorkExperience, $trainerUpgradeStatusProvider,
        $trainerUpgradeLevelProvider,$trainerProvider) {
        
		$this->userProvider = $userProvider;
		$this->trainerMediaProvider = $trainerMediaProvider;	
        $this->trainerQualificationProvider = $trainerQualificationProvider;
        $this->trainerRegistrationCategoryProvider = $trainerRegistrationCategoryProvider;
        $this->registrationCategory = $registrationCategory;
        $this->trainerWorkExperience = $trainerWorkExperience;
        $this->trainerUpgradeStatusProvider = $trainerUpgradeStatusProvider;
        $this->trainerUpgradeLevelProvider = $trainerUpgradeLevelProvider;
        $this->trainerProvider = $trainerProvider;
	}
    
    /**
     *
     * @param  
     * @returns object
     * saves user of group trainer 
     * Created By Kevin @ Cranium Creations
     */
    public function saveUserTrainerGroup()
    {
        //get the trainer session 
        $userDetails = Session::get('trainerDetails');
        
        //create a new trainer user 
        $user = Sentry::createUser(array(
            'email'     => $userDetails['email'],
            'password'  =>$userDetails['password'],
            'activated' => true,
            'first_name' => $userDetails['first_name'],
            'last_name' => $userDetails['last_name']
        ));
        
        $userDetails['id'] = $user->id;
        
        //find the trainer group and assign the group to user
        $group = Sentry::findGroupByName('Trainer');
        $user->addGroup($group);
        
        //save user id in session
        Session::put('trainerDetails', $userDetails);
        
        return $user;
    }
    
    public function createTrainerQualification($qualification) {
        return $this->trainerQualificationProvider
                              ->createModel()
                              ->fill($qualification)
                              ->save();
    }
    

    /**
     *
     * @param obj $user 
     * @returns bool
     * saves user as trainer 
     * Created By Kevin @ Cranium Creations
     */
    public function saveTrainer($user)
    {
        //get the user details for the session
        $userDetails = Session::get('trainerDetails');
        
        $photo = $userDetails['photo'][0]['name'];
       if (!empty($userDetails['image'][0]['name'])) {
            $image = $userDetails['image'][0]['name'];
        } else {
            $image = '';
        }
        
//        $id = $this->createId($user->id);
        
        $insert_data = array(
            'user_id' => $user->id,
            'nationality_id' => $userDetails['nationality_id'],
            'country_id' => isset($userDetails['country_id']) ? $userDetails['country_id'] : 234, // UAE DEFAULT
            'dob' => $userDetails['dob'],
            'gender' => $userDetails['gender'],
            'city' => $userDetails['city'],
            'mobile_phone' => $userDetails['mobile_phone'],
            'photo' => $photo,
            'image' => $image,
           // 'emirates_id_no' => (isset($userDetails['emirates_id'])?$userDetails['emirates_id']:''),
            'emirates_id_no' => $userDetails['emirates_id_no'],
            'expiry_date' => date('Y-m-d',strtotime('+1 years')),
            'status_id'=>$userDetails['status_id'],
            'work_email' => $userDetails['work_email'],
            'reps_id' => "reps$user->id"
        );

        // add insurance if available
        $insurance_data = Session::get('insurance_data');
        if (isset($insurance_data['disease'])) {
            if ($insurance_data['disease'] != '') {
                $insert_data['avail_insurance'] = 1;
                $insert_data['disease'] = $insurance_data['disease'];
                $insert_data['criminal'] = $insurance_data['criminal'];
                $insert_data['negligence'] = $insurance_data['negligence'];
                $insert_data['insurer'] = $insurance_data['insurer'];
            }
        }
        Session::put('insurance_data', []);

        $trainer = $this->userProvider->createTrainerModel()->fill($insert_data); 
        $trainer->save();
        Session::put('new_reps_user_id', "reps$user->id");
//        $trainer = $user->addTrainer($data);
        
        //make the photo directory
        File::makeDirectory(Config::get('trainer.path').'/'.$user->id.'/photo', 0755);
         File::makeDirectory(Config::get('trainer.path').'/'.$user->id.'/image', 0755);
       
       //for image from tmp directory
         File::copyDirectory( Config::get('tmp.tmpPath').'/'.$userDetails['tmpFolder'].'/photo',
        Config::get('trainer.path').'/'.$user->id.'/image');
        
         $file_locs = Config::get('trainer.path').'/'.$user->id.'/photo/'.$image;

        //mv the photo directory form the tmp directory
        File::copyDirectory( Config::get('tmp.tmpPath').'/'.$userDetails['tmpFolder'].'/photo',
        Config::get('trainer.path').'/'.$user->id.'/photo');

        
        
        $file_loc = Config::get('trainer.path').'/'.$user->id.'/photo/'.$photo;
        
        $img = Image::make($file_loc);
        
        // if ($img->height >= $img->width) {
        //     $img->resize(null, 170, true, true)
        //         ->resizeCanvas(130,170,null,false, "#ffffff")
        //         ->save($file_loc, 100);
        // } else {
        //     $img->resize(130, null, true, true)
        //         ->resizeCanvas(130,170,null,false, "#ffffff")
        //         ->save($file_loc, 100);
        // }


        if ($img->height() >= $img->width()) {
            $img->resize(null, 170, function ($constraint) {
                    $constraint->aspectRatio(); // Maintain aspect ratio
                })
                ->resizeCanvas(130, 170, null, false, '#ffffff')
                ->save($file_loc, 100);
        } else {
            $img->resize(130, null, function ($constraint) {
                    $constraint->aspectRatio(); // Maintain aspect ratio
                })
                ->resizeCanvas(130, 170, null, false, '#ffffff')
                ->save($file_loc, 100);
        }
        
        return $user->trainer;
    }
    
    /**
     *
     * @param obj $user 
     * @returns bool
     * saves trainer registration cateogry 
     * Created By Kevin @ Cranium Creations
     */
    public function saveTrainerRegistrationCategory($trainer)
    {
        //get the user details for the session
        $userDetails = Session::get('trainerDetails');
        
        $default = array();
        //add registration category       
        for($i=0; $i<count($userDetails['registration_cateogry_id']); $i++)
        {
           $default[] = $trainer->addTrainerRegistrationCategory( array (
                'trainer_id' => $trainer->id,
                'registration_category_id' => $userDetails['registration_cateogry_id'][$i]
            ));
        }
        
        return $default;
    }
    
    /**
     *
     * @param obj trainer 
     * @returns object
     * saves trainer photograph 
     * Created By Kevin @ Cranium Creations
     */
    public function saveTrainerWorkPlace($trainer,$user)
    {
        //get the user details for the session
        $userDetails = Session::get('trainerDetails');
        
        if (!empty($userDetails['cv'][0]['name'])) {
            $cv = $userDetails['cv'][0]['name'];
        } else {
            $cv = '';
        }
        
        //add trainer work Place
//        $trainerWorkPlace = $trainer->addTrainerWorkExperience ( array (
//            'trainer_id' => $trainer->id,
//            'work_place' => json_encode($userDetails['work_place']),
//            'job_title' => (isset($userDetails['job_title'])?$userDetails['job_title']:''),
//            'cv' => $cv
//        ));
        
        $this->trainerWorkExperience->createModel()->fill(array (
            'trainer_id' => $trainer->id,
            'work_place' => json_encode($userDetails['work_place']),
            'job_title' => (isset($userDetails['job_title'])?$userDetails['job_title']:''),
            'cv' => $cv
        ))->save();
        
        //make the cv directory
        File::makeDirectory(Config::get('trainer.path').'/'.$user->id.'/cv', 0755, true);
        
        if ($cv) {
            //mv the cv directory form the tmp directory
            File::copyDirectory( Config::get('tmp.tmpPath').'/'.$userDetails['tmpFolder'].'/cv',
                Config::get('trainer.path').'/'.$user->id. '/cv');
        }
        
        return $trainer->trainerWorkExperience;    
    }
    
    /**
     *
     * @param obj trainer
     * @returns object
     * saves trainer passport 
     * Created By Kevin @ Cranium Creations
     */
    public function saveTrainerPassport($trainer, $user)
    {
        //get the user details for the session
        $userDetails = Session::get('trainerDetails');
        
        //add trainer Passport
        $tainerPassport = array();
        for($i=0; $i<count($userDetails['passport']); $i++)
        {
             $tainerPassport[] = $trainer->addTrainerMedia( array(
                'trainer_id' => $trainer->id,
                'media_type_id' => 1,
                'media_filename' => $userDetails['passport'][$i]['name']
            ) );
        }
        
        //make the passport directory
        File::makeDirectory(Config::get('trainer.path').'/'.$user->id.'/passport', 0755);
        
        //mv the passport directory form the tmp directory
        File::copyDirectory( Config::get('tmp.tmpPath').'/'.$userDetails['tmpFolder'].'/passport',
            Config::get('trainer.path').'/'.$user->id.'/passport');
        
    }
    
     /**
     *
     * @param obj trainer 
     * @returns bool
     * saves trainer photograph 
     * Created By Kevin @ Cranium Creations
     */
    public function saveTrainerQualifications($trainer, $user)
    {
        //get the user details for the session
        $userDetails = Session::get('trainerDetails');
        
        //get qualification submitted by the user
        $qualification = $userDetails['qualifications'];
        
        $default = array();
        //add trainer Qualifications
        for($i=0; $i<count($qualification); $i++)
        {
            $certificates = array();
            for( $j=0; $j<count($qualification[$i]['certificates']); $j++ )
            {
                $certificates[] = $qualification[$i]['certificates'][$j]['name'];
            }
            
            $default[] = $this->createTrainerQualification(array (
                'trainer_id' => $trainer->id,
                'course_name' => isset($qualification[$i]['course_name']) ? $qualification[$i]['course_name']:'',
                'course_provider' => isset($qualification[$i]['course_provider']) ? $qualification[$i]['course_provider']:'',
                'date_completed' => isset($qualification[$i]['course_name']) ? $qualification[$i]['date_completed']:'',
                'certificate' => json_encode($certificates),
            ));
            
//            $default[] = $trainer->addTrainerQualification( array (
//                'trainer_id' => $trainer->id,
//                'course_name' => isset($qualification[$i]['course_name']) ? $qualification[$i]['course_name']:'',
//                'course_provider' => isset($qualification[$i]['course_provider']) ? $qualification[$i]['course_provider']:'',
//                'date_completed' => isset($qualification[$i]['course_name']) ? $qualification[$i]['date_completed']:'',
//                'certificate' => json_encode($certificates),
//            ));
            
        }
               
        //make the certificate directory
        File::makeDirectory(Config::get('trainer.path').'/'.$user->id.'/certificate', 0755);
         
        //mv the certificate directory form the tmp directory
        File::copyDirectory( Config::get('tmp.tmpPath').'/'.$userDetails['tmpFolder'].'/certificate',
            Config::get('trainer.path').'/'.$user->id.'/certificate');

        return $default;
    }
    
    /**
     *
     * @param session data 
     * @returns bool
     * saves user details 
     * Created By Kevin @ Cranium Creations
     */
    public function save()
    {
        //get the user details for the session
        //$userDetails = Session::get('trainerDetails');
            
        return DB::transaction(function()
        {   
            //save user details for trainer
            $user = $this->saveUserTrainerGroup();
           
            //create a directory
            File::makeDirectory(Config::get('trainer.path').'/'.$user->id, 0755, true);
           
            //save trainer details
            $trainer = $this->saveTrainer($user);
            
            //save trainer work Place
            $trainerWorkPlace = $this->saveTrainerWorkPlace($trainer, $user);
            
            //save trainer registration cateogry
            $trainerRegistry = $this->saveTrainerRegistrationCategory($trainer);
            
            //save trainer qualifications
            $trainerQualification = $this->saveTrainerQualifications($trainer, $user);
            
            //make a directory for status upgrade requests
            File::makeDirectory(Config::get('trainer.path').'/'.$user->id.'/status_upgrade', 0755, true);
        
            //make a directory for level and category upgrade requests
            File::makeDirectory(Config::get('trainer.path').'/'.$user->id.'/level_upgrade', 0755, true);
            
            return true;
        });
        
        return false;
        
        //save trainer CV
        //$trainerCv = $this->saveTrainerCv($trainer, $user);
        
        //save trainer passport
        //$trainerPassport = $this->saveTrainerPassport($trainer, $user);
        
        //delete tmp folder 
        //File::deleteDirectory(Config::get('tmp.tmpPath').'/'.$userDetails['tmpFolder']);
   
    }
    
    public function getSubscriptionPaymentByInvoiceId($invoice_id) {
        return $this->userProvider->getSubscriptionPaymentByInvoiceId($invoice_id);
    }
    
    public function getSubscriptionPaymentByTraineeEmail($email) {
        return $this->userProvider->getSubscriptionPaymentByTraineeEmail($email);
    }
    
    public function getSubscriptionPaymentByTrainerId($trainer_id) {
        return $this->userProvider->getSubscriptionPaymentByTrainerId($trainer_id);
    }

     /**
     * @param
     * @return registration category
     * Get trainer registration category
     * Created By Kevin @ Cranium Creations
	 * Modified By Raj @ Cranium Creations
	 * Modified By Sebin @ Cranium Creations
     */
    public function getRegCategory()
    {
        $user = Sentry::getUser();
        $trainer = $this->userProvider
                    ->getTrainerForUser($user->id);

        $regCategory = $this->userProvider
                        ->getTrainerRegCategory($trainer->id);	
		//echo $regCategory;exit;

        $default = array();
        foreach($regCategory as $value)
        {
            //$regCat = RegistrationCategory::find($value->id);
			$regCat = RegistrationCategory::find($value->registration_category_id);
			if($regCat){
				$default[] = array (
					'user' => $user->id,
					'trainer' => $trainer->id,
					'id' => $value->id,
					'level' => $regCat->level,
                    //'regCatId'=>$value->id
					'regCatId'=>$value->registration_category_id
				); 
			}
        }
                       
        return $default;        
    }
    
    /**
     * @param
     * @return personal details
     * Get trainer registration category
     * Created By Kevin @ Cranium Creations
     */
    public function getTrainerPersonalDetails()
    {
        $user = Sentry::getUser();
        if(isset($user))
        {
            return $this->userProvider
                    ->getTrainerForUser($user->id);
        }
        else
        {
            return false;
        }
    
    }
    
    /**
     * @param
     * @return trainer registration category
     * Get trainer registration category
     * Created By Kevin @ Cranium Creations
     */
    public function getTrainerQualification()
    {
        $user = Sentry::getUser();
        $trainer = $this->userProvider
                    ->getTrainerForUser($user->id);
                    
        $qualifications = $this->userProvider
                    ->getTrainerQualifications($trainer->id);
        
        //json decode
        foreach($qualifications as $qualification)
        {
            $qualification->certificate = json_decode($qualification->certificate);
        }
        
        return $qualifications;
    
    }
    
    public function getTrainerQualificationById($id) {
        return $this->trainerQualificationProvider->getById($id);
    }
    
    public function getTrainerQualificationsByTrainer($trainer_id) {
        return $this->trainerQualificationProvider->getByTrainerId($trainer_id);
    }
    
    /**
     * @param
     * @return registration category
     * Get trainer registration category
     * Created By Kevin @ Cranium Creations
     */
    public function getRegistrationCategory()
    {
        return $this->registrationCategory->getAll();
    }
    
    /**
     * @param int status
     * @return Collection trainers
     * Get All Trainers
     * Created By Kevin @ Cranium Creations
     */
    public function getAllTrainers($status=NULL)
    {
        $group = Sentry::findGroupByName('Trainer');
        return Sentry::findAllUsersInGroup($group);
    }
    
    public function getExpiringTrainersOneMonth()
    {
        return $this->trainerProvider->getExpiringOneMonth();
    }
    
    public function getExpiringTrainersTwoMonth()
    {
        return $this->trainerProvider->getExpiringTwoMonth();
    }
    
    public function getExpiringTrainers()
    {
        return $this->trainerProvider->getExpiringThisMonth();
    }
    
    public function getExpiringTrainersNextMonth()
    {
        return $this->trainerProvider->getExpiringNextMonth();
    }
    
    public function getActiveTrainers()
    {
        return $this->trainerProvider->getExpiringNextMonth();
    }
    
    public function getTrainersByStatusId($statuses)
    {
        return $this->trainerProvider->getTrainerByStatusId($statuses);
    }
    
    public function getTrainersByStatusIdNotExpired($statuses)
    {
        return $this->trainerProvider->getTrainerByStatusIdNotExpired($statuses);
    }

    /**
     * Gets all trainers expired by a week.
     *
     * @return Collection of expired trainers.
     */
    public function getExpiredByAWeek()
    {
        return $this->trainerProvider->getExpiredByAWeek();
    }
	 
	 /*
     * @param int id
     * @return Collection trainers
     * Get  Trainer by id
     * Created By Raj @ Cranium Creations
     */
     public function getTrainer($id)
	 {        
        return Users::with('trainer')->find($id); 
     }
    
    /*
        * get Trainer password resetcode
        * param $user
        * @return password resetcode
        * Created By Jahir @ Cranium Creations
    */
    public function getResetCode($user)
    {   
        $email = $user->email;
        $name = $user->first_name;
        
        return $user->getResetPasswordCode();
    }
    
    public function getStatusName($id) {
        if ($id == 1) {
            return 'Provisional';
        } else if ($id == 2) {
            return 'Full';
        } else {
            return 'Not Allocated';
        }
    }
    
    /**
     * @param data array
     * @return errors msb bag
     * validate Trainers personal details
     * Created By Kevin @ Cranium Creations
     */
    public function validatePersonalDetails($data)
    {
        //unset user table fields
        unset($data['form']);
        unset($data['first_name']);
        unset($data['_token']);
        unset($data['last_name']);
        unset($data['email']);
        unset($data['password']);
        unset($data['register']);
        
        //validate data from ardent
        $errors = $this->userProvider->validateTrainerPersonalDetails($data);
               

        //check for the photo error when user is logged in
        if(Sentry::check() && !isset($data['photo']) && $errors['status'])
         {	//dd('gere');
            $errors = $errors['messageBag']->getMessages();
            // dd($errors);

			if(isset($data['id']) || isset($data['user_id'])) 
            	unset($errors['photo']);
               unset($errors['image']);
            
            if( count($errors) > 0 )
            {
                //make new Message Bag 
                $messageBag = new MessageBag();
                
                //add the values to the message bag
                foreach ($errors as $key=>$value)
                {
                    $messageBag = $messageBag->add($key,$value[0]);
                }
                
                return array(
                    'status' => true,
                    'messageBag' => $messageBag
                );
            }
            else
            {
                return array(
                    'status' =>false
                );
            }
            
        }

        else
        {
            //check the photograph dimensions
            if (isset($data['photo']))
            {
                try {
                    $photo = Image::make($data['photo']->getRealPath());
                    
                    $msg = 'Minimum dimensions for photograph should be 130x170 pixels';
                    
                    if ($photo->width() < 130 || $photo->height() < 170) 
                    {
                        if (isset($errors['messageBag'])) {
                            
                            $errors['messageBag']->add('photo_dimensions',$msg);
                        } else {
                            
                            $errors['status'] = true;
                            $messageBag = new MessageBag();
                            $errors['messageBag'] = $messageBag->add('photo_dimensions',$msg);
                        }
                    } 
                } catch (\Intervention\Image\Exception\InvalidImageTypeException $e) {
                    
                }
            }
        }
        
        return $errors;
        
    }
    
    /**
     * @param data array
     * @return errors msb bag
     * validate Trainers work experience
     * Created By Kevin @ Cranium Creations
	 * Modified by Sebin
     */
    public function validateWorkExperience($data)
    {
        //unset registration category data
        unset($data['registration_cateogry_id']);
        unset($data['form']);
        unset($data['register']);
        unset($data['_token']);
        
        $results = $this->trainerWorkExperience
            ->validateTrainerWorkExperience($data);
	
		// custom validate file type doc,docx seperately to avoid doc mimetype error
		if(isset($data['cv'])) {
			$filename = $data['cv']->getClientOriginalName();
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
			$allowed =  array('doc','docx' ,'pdf');
			if(!in_array($ext, $allowed) ) {
				if(!isset($results['messageBag'])) {
					$results['messageBag'] = new MessageBag();
				}
				$results['messageBag']->add('cv', 'The cv must be a file of type: pdf, doc, docx.');
				return array('status'=>true,'messageBag'=>$results['messageBag']);
			} else {
				return $results;	
			}
		} 
		
		return $results;	
		
		
		   
    }
    
    /**
     * @param data array
     * @return errors msb bag
     * validate Trainers work experience
     * Created By Kevin @ Cranium Creations
     */
    public function validateRegistationCategory($data)
    {
        if(count($data) > 0)
        {
            for($i=0;$i<count($data);$i++)
            {
               $errors = $this->trainerRegistrationCategoryProvider
                ->validateRegistartionCategory($data[$i]);
            }
        }
        else
        {
            $errors = $this->trainerRegistrationCategoryProvider
                ->validateRegistartionCategory('');
        }
        return $errors;    
    }
    
    /**
     * @param data array
     * @return errors msb bag
     * validate Trainers work experience
     * Created By Kevin @ Cranium Creations
     */
    public function validateQualifications($data)
    { 
        //get all the errors 
        $errors = $this->trainerQualificationProvider
        ->validateQualification($data);  
        
        //check to see if there are any errors
        if(isset($errors['errors']))
        {
            foreach( $errors['errors'] as &$key )
            {
                foreach($key as &$error)
                {
                    $error = $error->getMessages();
                }
            }
        }
        
        return $errors;
    }
	
	/*
     * @param array
     * @return Collection trainers
     * Get Trainers
     * Created By Raj @ Cranium Creations
     */
    public function searchTrainers($data)
    {
        return $this->userProvider
                    ->searchTrainers($data);		
    }
	 
	 /*
     * @param array
     * @return Collection trainers
     * Get Trainers
     * Created By Sebin @ Cranium Creations
     */
     public function adminSearchTrainers($data) {
        return $this->userProvider->adminSearchTrainers($data);
    }

    /**
     * @param (userId)
     * @return Trainer
     * get the trainer by id
     * Created By Kevin @ Cranium Creations
     */
    public function getTrainerByUserId($userId)
    {
        return $this->userProvider->getTrainerForUser($userId); 
    }
    
    /**
     * @param array
     * @return bool
     * update Trainer Personal Details
     * Created By Kevin @ Cranium Creations
     */
    public function updatePersonalDetails($data)
    {
        $trainer = $this->getTrainerByUserId($data['user_id']);

        //unset unrequired fields
        unset($data['form']);
        unset($data['_token']);
        unset($data['user_id']);
        unset($data['trainer_id']);
        unset($data['save']);
        unset($data['register']);

        return DB::transaction(function() use($data, $trainer)
        {
            
            //update user details
            $user = Sentry::getUser();
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];

            $user->save();

            // unset user table data
            unset($data['first_name']);
            unset($data['last_name']);


             if(isset($data['image']))
            {
                if(File::exists(Config::get('trainer.path').'/'.$trainer->user_id.'/image'))
                { 
                // dd('here');
                    //remove the old photo
                    if(File::isFile(Config::get('trainer.path').'/'.$trainer->user_id.'/image/'.$trainer->image))
                    {
                        File::delete(Config::get('trainer.path').'/'.$trainer->user_id.'/image/'.$trainer->image);
                    }
                    
                    move_uploaded_file( $data['image'][0]['tmpNamePath'],
                          Config::get('trainer.path').'/'.$trainer->user_id.'/image/'.
                          $data['image'][0]['name']);
                      
                }
                else 
                {
                    //make the image directory
                    File::makeDirectory(Config::get('trainer.path').'/'.$user->id.'/image', 0755);
                    
                    move_uploaded_file( $data['image'][0]['tmpNamePath'],
                          Config::get('trainer.path').'/'.$trainer->user_id.'/image/'.
                          $data['image'][0]['name']);
                }

             $data['image'] = $data['image'][0]['name'];

              $file_loc1 = Config::get('trainer.path').'/'.$user->id.'/image/'.$data['image'];
        
                $img = Image::make($file_loc1);

                // if ($img->height() >= $img->width()) {
                //     $img->resize(null, 170, true, true)
                //         ->resizeCanvas(130,170,null,false, "#ffffff")
                //         ->save($file_loc1, 100);
                // } else {
                //     $img->resize(130, null, true, true)
                //         ->resizeCanvas(130,170,null,false, "#ffffff")
                //         ->save($file_loc1, 100);
                // }

                if ($img->height() >= $img->width()) {
                    $img->resize(null, 170, function ($constraint) {
                            $constraint->aspectRatio(); // Maintain aspect ratio
                        })
                        ->resizeCanvas(130, 170, null, false, '#ffffff')
                        ->save($file_loc1, 100);
                } else {
                    $img->resize(130, null, function ($constraint) {
                            $constraint->aspectRatio(); // Maintain aspect ratio
                        })
                        ->resizeCanvas(130, 170, null, false, '#ffffff')
                        ->save($file_loc1, 100);
                }
                
              }

         else
            {
                //get trainer old photo
                $trainer = $this->userProvider->getTrainerForUser($user->id);
               
                $data['image'] = $trainer->image;
            }
            

            // check if the user uploaded a new photo
            if(isset($data['photo']))
            {
                if(File::exists(Config::get('trainer.path').'/'.$trainer->user_id.'/photo'))
                {
                    if(File::isFile(Config::get('trainer.path').'/'.$trainer->user_id.'/photo/'.$trainer->photo))
                    {
                        File::delete(Config::get('trainer.path').'/'.$trainer->user_id.'/photo/'.$trainer->photo);
                    }
                    
                    move_uploaded_file( $data['photo'][0]['tmpNamePath'],
                          Config::get('trainer.path').'/'.$trainer->user_id.'/photo/'.
                          $data['photo'][0]['name']);
                 // dd('here');   //remove the old photo
                      
                }
                else 
                {
                    //make the photo directory
                    File::makeDirectory(Config::get('trainer.path').'/'.$user->id.'/photo', 0755);
                    
                    move_uploaded_file( $data['photo'][0]['tmpNamePath'],
                          Config::get('trainer.path').'/'.$trainer->user_id.'/photo/'.
                          $data['photo'][0]['name']);
                }
                
                $data['photo'] = $data['photo'][0]['name'];
                
                $file_loc = Config::get('trainer.path').'/'.$user->id.'/photo/'.$data['photo'];
        
                $img = Image::make($file_loc);

                if ($img->height() >= $img->width()) {
                    $img->resize(null, 170, function ($constraint) {
                            $constraint->aspectRatio(); // Maintain aspect ratio
                        })
                        ->resizeCanvas(130, 170, null, false, '#ffffff')
                        ->save($file_loc, 100);
                } else {
                    $img->resize(130, null, function ($constraint) {
                            $constraint->aspectRatio(); // Maintain aspect ratio
                        })
                        ->resizeCanvas(130, 170, null, false, '#ffffff')
                        ->save($file_loc, 100);
                }

                // if ($img->height >= $img->width) {
                //     $img->resize(null, 170, true, true)
                //         ->resizeCanvas(130,170,null,false, "#ffffff")
                //         ->save($file_loc, 100);
                // } else {
                //     $img->resize(130, null, true, true)
                //         ->resizeCanvas(130,170,null,false, "#ffffff")
                //         ->save($file_loc, 100);
                // }
            }
            else
            {
                //get trainer old photo
                $trainer = $this->userProvider->getTrainerForUser($user->id);
                $data['photo'] = $trainer->photo;
             
            }
            
            // dd($data);
            $trainer->fill($data);
            $trainer->save();
            
        });
        
    }
    
     
    /**
     * @param qualificationId, trainerId
     * @return bool
     * update Trainer Personal Details
     * Created By Kevin @ Cranium Creations
     
    public function removeQualification($qualificationId)
    {
        $qualification = $this->trainerQualificationProvider->getById($qualificationId);
        
        //get the trainer for the qualification
        $trainer = $this->userProvider->getTrainerById($qualification->trainer_id);
        
        //delete certificates file
        foreach(json_decode($qualification->certificate) as $certificate)
        {
            if(File::isFile(Config::get('trainer.path').'/'.$trainer->user_id.
            '/certificate/'.$certificate))
            {
                File::delete(Config::get('trainer.path').'/'.$trainer->user_id.
                '/certificate/'.$certificate);
            }
        }
        
        return $qualification->delete();
        
    }
    
    /**
     * @param array qualifications
     * @return Bool
     * add new Trainer Qualifications
     * Created By Kevin @ Cranium Creations
     
     public function updateTrainerQualifications($data)
     {
        

        foreach($data as &$value)
        {
            $certificates = array();
            for( $i = 0; $i < count($value['certificate'][0]); $i++)
            {
                 
                move_uploaded_file( $value['certificate'][0][$i]['tmpNamePath'],
                          Config::get('trainer.path').'/'.$value['user_id'].'/certificate/'.
                          $value['certificate'][0][$i]['name']);
                $certificates[] = $value['certificate'][0][$i]['name']; 
                
           }
            
            //encode certificate names in jason
            $value['certificate'] = json_encode($certificates);
            
            //get the trainer from the user id
            $trainer = $this->getTrainerByUserId($value['user_id']);
            
            //unset user_id
            unset($value['user_id']);
            
            //get the trainer by Id
            $trainer->addTrainerQualification($value);
            
        }
        
        return true;
        

     }*/
     
     /**
     * @param 
     * @return trainer work experience
     * add new Trainer Qualifications
     * Created By Kevin @ Cranium Creations
     */
     public function getTrainerWorkExperience()
     {
        $user = Sentry::getUser();
        
        $trainer = $this->getTrainerByUserId($user->id);
        
        return $this->userProvider->getTrainerWorkExperience($trainer->id);
     }

     /**
     * @param array data
     * @return Bool
     * upgrade Trainer status
     * Created By Anil Dev @ Cranium Creations
     */
     public function saveUpgradeStatus($data)
     {
        $user_id = Sentry::getUser()->id;
        $certificates = array();
       for( $j=0; $j<count($data['certificate']); $j++ )
        {
            $certificates[] = $data['certificate'][$j]->getClientOriginalName();
        }
         for( $j=0; $j<count($data['certificate']); $j++ )
        {
                $filename = $data['certificate'][$j]->getClientOriginalName();
                $data['certificate'][$j]->move(Config::get('trainer.path').'/'.$user_id.'/certificate',$filename);
        }  
       
        $trainer = array (
            'trainer_id' => $data['trainer_id'],
            'type_id' => $data['type_id'],
            'course_name' => $data['course_name'],
            'course_provider' => $data['course_provider'],
            'date_completed' => $data['date_completed'],
            'certificate' => json_encode($certificates),            
        );
        
         $t = $this->getTrainerByUserId($user_id);
         $t->addTrainerQualification($trainer);

     }  
     
    /**
     *
     * @param array data 
     * @returns bool
     * saves user details 
     * Created By Raj @ Cranium Creations
     * MOdified By Kevin @ Cranium Creations
     */
    public function updateWorkExperience($data)
    {		
		$user = Sentry::getUser();  
		
		//get logged in trainer	
		$trainer = $this->userProvider->getTrainerById($data['trainer_id']);  
        
        //get Trainer Work Exp
        $trainerWorkExp = $this->trainerWorkExperience->getById($data['id']);
        
        $trainerWorkExp->work_place = json_encode($data['work_place']);
        $trainerWorkExp->trainer_id = $data['trainer_id'];
        $trainerWorkExp->job_title = $data['job_title'];
        $trainerWorkExp->save();
        
        //check if the CV is uploaded 
        if(!empty($data['cv']))
        {
            $trainerWorkExp->cv = $data['cv']->getClientOriginalName();
            $data['cv']->move(Config::get('trainer.path').'/'.$user->id. '/cv',$data['cv']->getClientOriginalName());
        }
        else
        {
            //get the old cv 
            $trainer = $this->userProvider->getTrainerForUser($user->id);
            $trainerWorkExp = $trainer->trainerWorkExperience;
            $data['cv'] = $trainerWorkExp->cv;
            
        }
        
        $trainerWorkExp->save();
        
        return $trainerWorkExp;

//        return $trainerWorkExp->save();
    }
        
    public function updateTrainerWorkExperience($data)
    {		
        $user_id = $data['user_id'];
		
        //get logged in trainer	
        $trainer = $this->userProvider->getTrainerById($data['trainer_id']);  
        
        //get Trainer Work Exp
        $trainerWorkExp = $this->trainerWorkExperience->getById($data['id']);
        
        $trainerWorkExp->work_place = json_encode($data['work_place']);
        $trainerWorkExp->trainer_id = $data['trainer_id'];
        $trainerWorkExp->job_title = $data['job_title'];

        // FOR SOME REASON..
        $trainerWorkExp->save();
        
        $trainerWorkExp = $this->trainerWorkExperience->getById($data['id']);

        //check if the CV is uploaded 
        if(!empty($data['cv'])) {

//            $trainerWorkExp->job_title = $data['cv']->getClientOriginalName();
            
            $oldfile = Config::get('trainer.path').'/'.$user_id. '/cv/'.$trainerWorkExp->cv;
            
            if (is_file($oldfile)) {
                unlink($oldfile);
            }
            
            $filename = $data['cv']->getClientOriginalName();
            $data['cv']->move(Config::get('trainer.path').'/'.$user_id. '/cv',$filename);
            
            $trainerWorkExp->cv = $filename;
        } else {

            $trainer = $this->userProvider->getTrainerForUser($user_id);
            $trainerWorkExp = $trainer->trainerWorkExperience;
            $data['cv'] = $trainerWorkExp->cv;
        }
        
        return $trainerWorkExp->save();
    }
    
    /**
     * @param array data
     * @returns errors
     * trainer validate update
     * Create By Kevin @cranium Creations
     */
    public function validateTrainerUpgradeStatus($data)
    {
        //unset unwanted data
        unset($data['_token']);
        unset($data['register']);
        
        //validate data from ardent
        return $this->trainerUpgradeStatusProvider->validateTrainerUpgrade($data);
        
    }
    
    /**
     * @param array data
     * @returns data
     * trainer upgrade status/level
     * Create By Kevin @cranium Creations
     */
    public function trainerUpgradeStatus($data)
    {
        //unset unwanted data
        unset($data['_token']);
        unset($data['register']);
        unset($data['user_id']);
        
        //remove and re assign the file object
        $certificate = $data['certificate'];
        $data['certificate'] = $data['certificate']->getClientOriginalName();
        
        //get the trainer 
        $trainer = $this->userProvider->getTrainerById($data['trainer_id']);
         
        //save the record
//        $trainerUpgrade = $trainer->addTrainerUpgradeStatus($data);
        
        $r = $this->trainerUpgradeStatusProvider
                  ->createModel()
                  ->fill($data)
                  ->save();
        
        $trainerUpgrade = $this->getTrainerUpgradeStatusByTrainerIdAndNotProcessed($trainer->id);
        
        //path of the record
        $path = Config::get('trainer.path').'/'.$trainer->user_id.'/status_upgrade/';
        
        if(File::isDirectory($path))
        {
            $path .= $trainerUpgrade->id;
            
            // Create a new directory
            File::makeDirectory($path,0777);
            
        }
        else 
        {
            $path .= $trainerUpgrade->id;
            
            // Create a new directory
            File::makeDirectory($path,0777);
        
        }
        
        //move the file 
        $certificate->move($path,$certificate->getClientOriginalName()); 
        
        return $trainer;

    }
    
     /**
     * @param array data
     * @returns errors
     * trainer validate update
     * Create By Kevin @cranium Creations
     */
    public function validateTrainerUpgradeLevel($data)
    {
        //unset unwanted data
        unset($data['_token']);
        unset($data['register']);
        
        //validate data from ardent
        return $this->trainerUpgradeLevelProvider
            ->validateTrainerUpgrade($data);
        
    }
    
    /**
     * @param array data
     * @returns data
     * trainer upgrade level
     * Create By Kevin @cranium Creations
     */
    public function trainerUpgradeLevel($data)
    {
        //unset unwanted data
        unset($data['_token']);
        unset($data['register']);
        unset($data['user_id']);
        
        //remove and re assign the file object
        $certificate = $data['certificate'];
        $data['certificate'] = $data['certificate']->getClientOriginalName();
        
        //get the trainer 
        $trainer = $this->userProvider->getTrainerById($data['trainer_id']);
         
        //save the record
//        $trainerUpgrade = $trainer->addTrainerUpgradeLevel($data);
        
        $trainerUpgrade = $this->trainerUpgradeLevelProvider
                               ->createModel()
                               ->fill($data)
                               ->save();
        
        $trainerUpgrade = $this->getTrainerUpgradeCategoryStatusByTrainerIdAndNotProcessed($data['trainer_id']);
        
        //path of the record
        $path = Config::get('trainer.path').'/'.$trainer->user_id.'/level_upgrade/';
        
        if (!File::isDirectory($path)) {
            $path .= $trainerUpgrade->id;
            File::makeDirectory($path,0777);
        } else {
            $path .= $trainerUpgrade->id;
            File::makeDirectory($path,0777);
        }
        
        //move the file 
        $certificate->move($path,$certificate->getClientOriginalName()); 
        
        return $trainer;
    }

     /**
     * @param id 
     * @returns errors
     * get trainer upgrade status
     * Create By Raj @cranium Creations
     */
    public function getTrainerUpgradeStatusById($id)
    {
       return $this->trainerUpgradeStatusProvider->getById($id);
    }
	
    
     /**
     * @param trainer id
     * get trainer upgrade status
     * Create By Sebin @cranium Creations
     */
    public function getTrainerUpgradeStatusByTrainerIdAndNotProcessed($trainer_id)
    {
      
       return $this->trainerUpgradeStatusProvider->getByTrainerIdAndNotProcessed($trainer_id);
    }
	
	
	public function getTrainerUpgradeCategoryById($id)
    {
       return $this->trainerUpgradeLevelProvider->getById($id);
    }
    
    public function getTrainerUpgradeCategoryStatusByTrainerIdAndNotProcessed($trainer_id)
    { 
       return $this->trainerUpgradeLevelProvider->getByTrainerIdAndNotProcessed($trainer_id);
    }
    
    
    /**
     * @param array data
     * @returns data
     * trainer update status
     * Create By Sebin @cranium Creations
     */
    public function trainerUpdateStatus($data)
    {
        //unset unwanted data
        unset($data['_token']);
        
        //get the trainer 
        $trainer = $this->userProvider->getTrainerById($data['trainer_id']);
        $trainer->status_id = $data['status'];
        $trainer->save();
        
        $trainer_upgrade_status = $this->trainerUpgradeStatusProvider->getById($data['id']);
        $trainer_upgrade_status->is_processed = 1;
        $trainer_upgrade_status->save();

        return $trainer;
    }
	
    public function trainerUpdateCategory($data)
    {
        //unset unwanted data
        unset($data['_token']);
		
        //get the trainer category 
        $trainer_categories = $this->trainerRegistrationCategoryProvider->getTrainerRegCategory($data['trainer_id']);
		
        //delete trainer categories
        foreach ($trainer_categories as $trainer_category) {
            $trainer_category->forceDelete();
        }

        //insert new categories
        //add registration category       
        for($i=0; $i<count($data['registration_category_id']); $i++)
        {
            $input = array (
                'trainer_id' => $data['trainer_id'],
                'registration_category_id' => $data['registration_category_id'][$i]
            );
			
            $category = $this->trainerRegistrationCategoryProvider->create($input) ? true : false;
        }
		
        $trainer_upgrade_category = $this->trainerUpgradeLevelProvider->getById($data['id']);
        $trainer_upgrade_category->is_processed = 1;
        $trainer_upgrade_category->save();

        return $category;

    }
	
	/**
     * @param (trainerId)
     * @return Trainer
     * get the trainer by id
     * Created By Kevin @ Cranium Creations
     */
    public function getTrainerById($userId)
    {
        return $this->userProvider->getTrainerById($userId); 
    }
    public function getTrainerByMemNum($reps_num){
            return $this->trainerProvider->getTrainerByMemNum($reps_num);
        }
    
    //supposed to fix autogeneration of reps id.
    public function createId($user_id) {
        
        return DB::table('repsIds')->insertGetId(
            array('user_id' => $user_id)
        );
    }
    
    public function createPaymentTrace($data) {
        
        $date = new \DateTime;
        
        return DB::table('payment_trace')->insertGetId(array(
            'data' => $data, 
            'created_at' => $date, 
            'updated_at' => $date
        ));
    }
    
    public function getSubscriptionPayments($status = 0) {
        return $this->trainerProvider->getSubscriptionPayments($status);
    }
    
    public function getTempTrainerByEmail($email) {
        
//        return $this->trainerProvider->getTrainerTemp($email);
        
        return DB::table('trainer_temp_table')->where('email', '=', $email)->first();
    }
    
    public function deleteTempTrainerByEmail($email) {
        
        return DB::table('trainer_temp_table')->where('email', '=', $email)->delete();
    }
    
    public function createTempTrainer($data) {
        
//        return $this->trainerProvider
//                    ->createTrainerTempModel()
//                    ->fill($data)
//                    ->save();
        
        $date = new \DateTime;
        
        return DB::table('trainer_temp_table')->insertGetId(array(
            'email'      => $data['email'],
            'json_data'  => $data['json_data'], 
            'created_at' => $date, 
            'updated_at' => $date
        ));
    }
    public function updateTempTrainer($data) {
        
        $date = new \DateTime;
        
        $record = DB::table('trainer_temp_table')
            ->where('email', $data['email'])
            ->first();
        if(!empty($record->id)){
            $id = $record->id;
            $data['updated_at'] = $date;
            $row = DB::table('trainer_temp_table')
                ->where('id', $record->id)
                ->update($data);
        }else{
            $id = DB::table('trainer_temp_table')->insertGetId(array(
                'email'      => $data['email'],
                'json_data'  => $data['json_data'], 
                'created_at' => $date, 
                'updated_at' => $date
            ));
        }

        return $id;

    }
    public function getApprovedSubscriptionPaymentsByTrainerId($trainer_id) {
        return $this->trainerProvider->getApprovedSubscriptionPaymentsByTrainerId($trainer_id);
    }
    
    public function getSubscriptionPaymentById($id) {
        return $this->trainerProvider->getSubscriptionPaymentById($id);
    }
    
    public function getSubscriptionPaymentByOwner($trainer_id) {
        return $this->trainerProvider->getSubscriptionPaymentByOwner($trainer_id);
    }
    
    public function getSubscriptionPaymentByOwnerAndStatus($trainer_id, $status) {
        return $this->trainerProvider->getSubscriptionPaymentByOwnerAndStatus($trainer_id, $status);
    }
    
    public function getPendingUpgradeStatuses() {
        return $this->trainerUpgradeStatusProvider->getNotProcessed();
    }
    
    public function getPendingUpgradeLevels() {
        return $this->trainerUpgradeLevelProvider->getNotProcessed();
    }

}