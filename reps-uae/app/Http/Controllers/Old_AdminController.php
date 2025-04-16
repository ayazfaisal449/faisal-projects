<?php
namespace App\Http\Controllers;
class AdminController extends BaseController {

    /*
     * logs a user in
     * Created By Kevin @ Cranium Creations
     */
    public function logIn () {
        $viewData = array(
            'message' => Session::get('message')
        );

        return View::make('admin.login',$viewData);
    }
        
        public function sendTrainerEmail() {
            
            $data = Input::all();
            
            try {
                Mail::send('trainer.mail.trainerEmail', $data,
                    function($message) use($data)
                    {
                        $message->to($data['email'], $data['name'])
                                ->subject($data['subject']);
                    }
                );
            } catch (Exception $ex) {
                return Response::json(array('status'=>false));
            }
            return Response::json(array('status'=>true));
        }
    
    /*
     * logs a user out
     * Created By Kevin @ Cranium Creations
     */
    public function logOut () {
         Sentry::logout();
         return Redirect::action('AdminController@dashboard');
    }
    
    /*
     * admin dashboard
     * Created By Kevin @ Cranium Creations
     */
    public function dashboard () {
            
            $expiring_now = Trainer::getExpiringTrainers();
            $expiring_nxt = Trainer::getExpiringTrainersNextMonth();
            $on_process = Trainer::getTrainersByStatusId(3);
            $active = Trainer::getTrainersByStatusIdNotExpired("1,2");
            
            $pendingpayments = Trainer::getSubscriptionPayments();
            $pending = array();
            
            foreach ($pendingpayments as $itm) {
                $user = Users::getTrainerById($itm->trainer_id);
                $details = json_decode($itm->details);
                
                if (!empty($user)) {
                    $pending[] = array(
                        'user'=>$user,
                        'trainer'=>Trainer::getTrainerById($user->id),
                        'details'=>$details,
                        'payment_date'=>$itm->created_at->format('Y-m-d'),
                        'payment_id'=>$itm->id
                    );
                }
            }
            
            $pendingUpgradeStatuses = Trainer::getPendingUpgradeStatuses();
            $pendingStatuses = array();
            
            foreach ($pendingUpgradeStatuses as $itm) {
                
                $user = Users::getTrainerById($itm->trainer_id);
                
                $pendingStatuses[] = array(
                    'user'=>$user,
                    'details'=>$itm,
                );
            }
            
            $pendingUpgradeLevels = Trainer::getPendingUpgradeLevels();
            $pendingLevels = array();
            
            foreach ($pendingUpgradeLevels as $itm) {
                
                $user = Users::getTrainerById($itm->trainer_id);
                
                $pendingLevels[] = array(
                    'user'=>$user,
                    'details'=>$itm,
                );
            }
            
            $data = array(
                'expiring_now'=>$expiring_now->count(),
                'expiring_nxt'=>$expiring_nxt->count(),
                'on_process'=>$on_process->count(),
                'active'=>$active->count(),
                'pending_renewals' => $pending,
                'pending_upgrade_status' => $pendingStatuses,
                'pending_upgrade_level' => $pendingLevels
            );
            
            return View::make('admin.dashboard', $data);
    }
    
    /*
     * admin dashboard
     * Created By Kevin @ Cranium Creations
     */
    public function authenticate() {
        
        try {
            $credentials = array(
                'email'    => Input::get('email'),
                'password' => Input::get('password'),
            );
            
            // Try to authenticate the user
            $user = Sentry::authenticate($credentials, false);
            return Redirect::action('AdminController@dashboard');
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            $message = array(
                'status' => 'error',
                'text' => 'Email is required'
            );
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            $message = array(
                'status' => 'error',
                'text' => 'Password is required'
            );
        }
        catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
        {
            $message = array(
                'status' => 'error',
                'text' => 'Invalid user credentials'
            );
        }
        catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            $message = array(
                'status' => 'error',
                'text' => 'User is not active'
            );
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            $message = array(
                'status' => 'error',
                'text' => 'Invalid user credentials'
            );
        }

        // Following is only needed if throttle is enabled
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
        {
            $time = $throttle->getSuspensionTime();

            $message = array(
                'status' => 'error',
                'text' => "User is suspended for [$time] minutes"
            );
        }
        catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
        {
            $message = array(
                'status' => 'error',
                'text' => "User is banned."
            );
        }

        return Redirect::action('AdminController@logIn')
            ->with('message',$message);
    }
    
    /**
     * trainer Personal Details form
     * Created By Jahir @Cranium Creations
     * Modified By Kevin @ Cranium Creations
     */
    public function trainerPersonalDetailsForm() 
    {   
        //Get all nationalities
        $default = Nationality::getAll();
        $nationality = array();
        foreach($default as $value)
        {
            $nationality[$value->id] = $value->name;
        }

        $data =  array (
            'nationality' => $nationality,
            'mediaTypes' =>  MediaType::getAll(),
            'gender' => array (
                'Male', 'Female',
            ),
            'options' => array(
                'something', 'something', 'something'
            )
        );  
        
        return View::make('trainer.admin_trainer_register.addPersonalDetails',$data);

    }
    
    /**
     * trainer Work Experience form
     * Created By Kevin @Cranium Creations
     */
    public function trainerWorkExperienceForm() 
    {
        $errors = Session::get('workExpErrors');

        $data = array (
            'regCategory' => Trainer::getRegistrationCategory(),
            'work_place' => $errors['work_place'],
            'errors' => (isset($errors['errors']['messageBag'])?
                            $errors['errors']['messageBag']:'')
        );
        
        //forget the old input
        Session::forget('_old_input.work_place');
                        
        return View::make('trainer.admin_trainer_register.addWorkExperience',$data)
        ->withErrors($data['errors']);
    }
    
    /**
     * trainer Qualifications form
     * Created By Kevin @Cranium Creations
     */
    public function trainerQualificationForm()
    {
        $errors = Session::get('qualificationErrors');
        $oldData = Session::get('oldData');
        
        $data = array (
            'errors' => $errors,
            'oldData' => $oldData
        );
    
        //forget the old input
        Session::forget('_old_input');
                    
        return View::make('trainer.admin_trainer_register.addQualification',$data);

    } 
    
    /**
     * registration/update success api back form
     * Created By Kevin @ Cranium Creations
     */
    public function success()
    {           
         return View::make('trainer.admin_trainer_register.success');
    } 
    
     /**
     * registration/update success api back form
     * Created By Raj @ Cranium Creations
     */
    public function renewed()
    {
       return View::make('trainer.admin_trainer_register.renewed');
    } 
    
    private function validateUserData($data) {
        
        $validator = Validator::make(
            array(
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'password' => isset($data['password'])?$data['password']:'',
                'email' => isset($data['email'])?$data['email']:'',
            ),
            array(
                'first_name' => 'required|min:3',
                'last_name' => 'required|min:3',
                'password' => 'required|min:8',
                'email' => 'required|email|unique:users'
            )
        );
        
        if ($validator->fails()) {
            
            $errors = $validator->messages()->getMessages();
            
            if (count($errors) > 0) {
                
                return array('status' => true, 'messageBag' => $validator->messages());
            } else {
                
                return array ('status' => false);
            }
        }
    }
    
    /**
     * save trainer Details
     * Created By Kevin @Cranium Creations
     */
    public function save() 
    {
        
        switch ( Input::get('form') ) 
        {
            //catch the Personal Details form
            case 'Personal Details':
                
                $data = Input::get();

                $data['photo'] = Input::file('photo');
                
                //validate trainer personal details fields
                $errors = Trainer::validatePersonalDetails($data);
                
                //validate user details
                $userErrors = $this->validateUserData($data);

                //check if there are no errors
                if($errors['status'])
                {   
                    //check if there are userErrors
                    if($userErrors['status'])
                    {
                        //merge error Messages
                        $errors['messageBag'] = $errors['messageBag']
                            ->merge($userErrors['messageBag']->getMessages());
                    }
                    
                    return Redirect::action('AdminController@trainerPersonalDetailsForm')
                            ->withErrors($errors['messageBag'])
                            ->withInput(); 
                }
                
                if ($userErrors['status'])
                {
                    return Redirect::to('trainer/registration')
                            ->withErrors($userErrors['messageBag']); 
                }
                
                //$data['passport'] = $this->getTmpFiles($_FILES['passport']);
                $data['photo'] = $this->getTmpFiles($_FILES['photo']);

                //save the data in the session
                Session::put('trainerDetails', $data);

                //create tmp folder with files
                //$result = $this->createTmpFiles($data['passport'],'passport');
                $result = $this->createTmpFiles($data['photo'],'photo');

                if ($result) {
                    return Redirect::action('AdminController@trainerWorkExperienceForm');
                } else {
                    return Redirect::action('AdminController@trainerPersonalDetailsForm');
                }
               
            break;
            
            //catch the Work Experience Form
            case 'Work Experience':
            
                $data = Input::get();
                $data['cv'] = Input::file('cv');
                
                //validate trainer work experience fields
                $errorsWorkExp = Trainer::validateWorkExperience($data);
                
                //check multiple text box field for work_place
                $workPlaceErrors = array (
                    'empty' => $this->validateMulipleTextBox($data['work_place']),
                    'validData' => $this->validateAlplaSpaces($data['work_place'])                        
                );
                
                //validate trainer registration category fields
                if(isset($data['registration_category_id']))
                {
                    $errorsRegCat = Trainer::validateRegistationCategory($data['registration_category_id']);
                }
                else
                {
                    $errorsRegCat = Trainer::validateRegistationCategory(array());
                }
                
                //prepare errors to send to the view 
                if($errorsWorkExp['status'] || $workPlaceErrors['empty']['status'] ||
                   $workPlaceErrors['validData']['status'])
                {   
                    $errors = Array();
                    if($errorsWorkExp['status'] && $errorsRegCat['status']) 
                    {
                        $errors['status'] = $errorsWorkExp['status'];
                        $errors['messageBag'] = $errorsWorkExp['messageBag']
                            ->merge($errorsRegCat['messageBag']->getMessages());
                    }
                    else if($errorsRegCat['status'])
                    {
                        $errors['status'] = $errorsRegCat['status'];
                        $errors['messageBag'] = $errorsRegCat['messageBag'];
                    }
                    else if($errorsWorkExp['status'])
                    {
                        $errors['messageBag'] = $errorsWorkExp['messageBag'];
                    }
                    
                    $errorData = array(
                        'work_place' => $workPlaceErrors,
                        'errors' => $errors
                    );
                    
                    Session::flash('workExpErrors',$errorData);
                    
                    return Redirect::action('AdminController@trainerWorkExperienceForm');          
                }
                else
                {
                    //get session data
                    $userData = Session::get('trainerDetails');
                    
                    $userData['work_place'] = $data['work_place'];
                    $userData['cv'] = $this->getTmpFiles($_FILES['cv']);
                    $userData['registration_cateogry_id'] = $data['registration_category_id'];
                    $userData['job_title'] = $data['job_title'];
                    
                    //save the data in the session
                    Session::put('trainerDetails', $userData);
                    
                    //create tmp folder with files
                    $result = $this->createTmpFiles($userData['cv'],'cv');
                    
                    if($result)
                    {
                        return Redirect::action('AdminController@trainerQualificationForm');
                    }
                    else
                    {
                        return Redirect::action('AdminController@trainerWorkExperienceForm');
                    }
                }
                
            break;
            
            //catch the Qualifications Form
            case 'Qualifications':
                
                //get session data
                $userData = Session::get('trainerDetails');
                
                //get form data
                $courseName = Input::get('course_name');
                $courseProvider = Input::get('course_provider');
                $dateCompleted = Input::get('date_completed');
                $data = array();
                
                //get all the certificates submitted laravel object 
                $certificates = array(
                    Input::file('certificates0'),
                    Input::file('certificates1'),
                    Input::file('certificates2'),
                    Input::file('certificates3'),
                    Input::file('certificates4'),
                    Input::file('certificates5'),
                    Input::file('certificates6'),
                    Input::file('certificates7'),
                    Input::file('certificates8'),
                    Input::file('certificates9')
                );
                
                //get information `
                for($i=0;$i<count($courseName);$i++) 
                {
                    $data[$i] = array(
                        'course_name' => $courseName[$i],
                        'course_provider' => $courseProvider[$i],
                        'date_completed' => $dateCompleted[$i],
                        'certificates' => $this->getTmpFiles($_FILES['certificates'.$i]),
                        'laravelCert' => $certificates[$i],
                    ); 
                }
                
                //get all errors for the form
                $errors = Trainer::validateQualifications($data);
                //dd($errors);
                //print_r($errors);exit;
                

                //check all errors
                $default = array();
                if($errors['status'])
                {   
                    //save Errors in session data
                    Session::flash('qualificationErrors',$errors['errors']);
                    
                    //unset files 
                    foreach($data as &$value)
                    {
                        unset($value['laravelCert']);
                    }
                    
                    //save the old data
                    Session::flash('oldData',$data);
                    
                    //redirect
                    return Redirect::action('AdminController@trainerQualificationForm');
                     
                }
                else
                {
                   //unset files 
                    foreach($data as &$value)
                    {
                        unset($value['laravelCert']);
                    }
                    
                    $userData['qualifications'] = $data;
                    
                    //save the data in the session
                    Session::put('trainerDetails', $userData);
                    
                    //create tmp folder with files
                    for($i=0;$i<count($data);$i++)
                    {
                        for($j=0;$j<count($data[$i]['certificates']);$j++)
                        {
                            $result = $this->createTmpFiles($data[$i]['certificates'][$j],'certificate');
                        }
                    }
                }
                    
                //save all Trainer details from session 
                $result = Trainer::save();
                
                return Redirect::action('AdminController@success');
                
            break;
            
            default:
                //no case true
                return Redirect::action('AdminController@fail');
            break;
        }
        
    }

    /**
     * @param trainer id  
     * trainer upgrade Status form
     * Created By Raj @ Cranium Creations
     */
    public function trainerUpgadeStatusForm($id)
    {
         $input = array(
            0=>array('status','select',null,null,array(''=>'Please Select Status','1'=>'Provisional','2'=>'Full','3'=>'Not Allocated')),               
            1=>array('message','textarea','Message','Your status has been upgraded!'),
            2=>array('id','hidden','id',$id)
        );

        $upgrade_status = Trainer::getTrainerUpgradeStatusById($id);
        $upgrade_category_status = Trainer::getTrainerUpgradeCategoryStatusByTrainerIdAndNotProcessed($upgrade_status->trainer_id);

        $certificates = json_decode($upgrade_status->trainer->trainerQualifications[0]->certificate);

        $data = array(
            'id' => $id,
            'update' => 'Users',
            //'subForm' => $subForm,
            'input' => $input,               
            'form' => 'trainer/upgrade-status',                
            'data'=> $upgrade_status ,
            'upgrade_status'=> $upgrade_status ,
            'upgrade_category_status'=> $upgrade_category_status,
            'certificates'=> $certificates
        );
        return View::make('trainer.adminTrainerUpgadeStatus',$data);
    } 
    
    public function repairQualifications()
    {
        // $trainers = \Cranium\TrainerUpgradeStatus\Models\TrainerUpgradeStatus::all();
        
        // foreach($trainers as $trainer) {
        //     echo $trainer->trainer_id . '<br>'; 
        //     $trainer_data = Trainer::getTrainerUpgradeStatusByTrainerIdAndNotProcessed($trainer->trainer_id);
            // if ($trainer_data != null) {
            //     $trainer_data = $trainer_data->toArray();
            
            //     if (isset($trainer_data['id'])) {
            //         unset($trainer_data['id']);
            //         unset($trainer_data['status_id']);
            //         unset($trainer_data['is_processed']);

            //         $trainer_data['certificate'] = json_encode([$trainer_data['certificate']]);

            //         try {
            //             Trainer::createTrainerQualification($trainer_data);
            //         } catch (Exception $e) {
            //             echo 'error<br>';
            //         }
            //     }
            // }
        // }
        
        $trainers = \Cranium\TrainerUpgradeLevel\Models\TrainerUpgradeLevel::where('is_processed', '=', 1)
            ->groupBy('certificate')
            ->groupBy('trainer_id')
            ->get();
        foreach($trainers as $trainer) {

            $t = \Cranium\TrainerUpgradeLevel\Models\TrainerUpgradeLevel::where('id', '=', $trainer->id)
                ->get();

            foreach ($t as $tt) {
                if ($tt != null) {
                    $tt = $tt->toArray();
                
                    if (isset($tt['id'])) {
                        unset($tt['id']);
                        unset($tt['status_id']);
                        unset($tt['is_processed']);
                        unset($tt['category']);

                        $tt['certificate'] = json_encode([$tt['certificate']]);

                        try {
                            echo $trainer->trainer_id . ' ' . $tt['certificate'] . '<br>';
                            Trainer::createTrainerQualification($tt);
                        } catch (Exception $e) {
                            echo 'error<br>';
                        }
                    }
                }
            }

        }
    }

    
    /**
     * @param trainer id  
     * trainer update Status 
     * Created By Sebin @ Cranium Creations
     */
    public function trainerUpdateStatus()
    {
        $upload = null;
        if (Input::hasFile('attachment')) {
            $upload = Input::file('attachment');
        }
        
        $data = Input::get(); 
        
        $error = 0;
        $statusMsg = '';
        $messageMsg = '';
        
        if(isset($data['status']) && $data['status'] == "") {
            $error = 1;
            $statusMsg = '* The Status field is required.';
        }

        if(isset($data['message']) && $data['message'] == "") {
            $error = 1;
            $messageMsg = '* The Message field is required.';
        }

        if (isset($data['trainer_id']) && $data['trainer_id'] == "") {
            $error = 1; 
        }
        
        if ($error == 0) {
        
            $the_trainer = Users::getTrainerById($data['trainer_id']);
            
            $old_status = $the_trainer->status_id;
            $highest_level = 0;
            
            $trainer_cats = array();
            
            foreach($the_trainer->trainerRegistrationCategories as $cats) {
                
                if ($cats->registrationCategory->id > $highest_level) {
                    $highest_level = substr($cats->registrationCategory->level, 0, 1);
                }

                $trainer_cats[] = $cats->registrationCategory->level;
            }
            
            $trainer_data = Trainer::getTrainerUpgradeStatusByTrainerIdAndNotProcessed($data['trainer_id']);
            if ($trainer_data != null) {
                $trainer_data = $trainer_data->toArray();
                if (isset($trainer_data['id'])) {
                    unset($trainer_data['id']);
                    unset($trainer_data['status_id']);
                    unset($trainer_data['is_processed']);

                    $trainer_data['certificate'] = json_encode([$trainer_data['certificate']]);

                    Trainer::createTrainerQualification($trainer_data);
                }
            }
            $trainer = Trainer::trainerUpdateStatus($data);
            $status = "";

            if($trainer->status_id == 1) {
                $status = "Provisional";
            }
            elseif ($trainer->status_id == 2) {
                $status = "Full";
            }
            elseif ($trainer->status_id == 3) {
                $status = "Not Allocated";
            }

            $user = Sentry::findUserById($trainer->user_id);

            Mail::send('trainer.mail.upgradeStatus',
                array(
                    'update_until' => $trainer->expiry_date,
                    'firstname' => $user->first_name,
                    'messageTxt' => $data['message'],
                    'newStatusId' => $trainer->status_id,
                    'newStatus' => $status,
                    'oldStatusId' => $old_status,
                    'level' => $highest_level,
                    'categories' => $trainer_cats
                ),
                function($message) use($user, $upload)
                {
                    $message->to($user->email,$user->first_name)
                            ->subject('REPs Status Update Provisional to Full.')
                            ->bcc('admin@repsuae.com', 'REPs Admin')
                            ->bcc('faisal.ayaz@sigmads.com', 'REPs Admin 2');
                    
                    if ($upload) {
                        $message->attach($upload->getRealPath(), array('as' => 'Attached file.' . $upload->getClientOriginalExtension(), 'mime' => $upload->getMimeType()));
                    }
                }
            );

            return Redirect::to('admin/trainer');

        } else {
            return Redirect::to('admin/trainer/upgrade-status/'.$data['id'])
                    ->with(array('statusMsg' => $statusMsg, 'messageMsg' => $messageMsg))
                    ->withInput();
        }
       
    } 
    
    /**
     * @param trainer id  
     * trainer upgrade category form
     * Created By Sebin @ Cranium Creations
     */
    public function trainerUpgradeCategoryForm($id)
    {
        
        $upgrade_category_status = Trainer::getTrainerUpgradeCategoryById($id);
        $upgrade_status = Trainer::getTrainerUpgradeStatusByTrainerIdAndNotProcessed($upgrade_category_status->trainer_id);
        
        $the_trainer = Users::getTrainerById($upgrade_category_status->trainer_id);
        
        $trainer_cats = explode(',', $upgrade_category_status->category);
        foreach($the_trainer->trainerRegistrationCategories as $cats) {
            $trainer_cats[] = $cats->registrationCategory->id;
        }
        
        $upgrade_category_status->category = implode(",", $trainer_cats);

        $certificates = json_decode($upgrade_category_status->trainer->trainerQualifications[0]->certificate);
        
        $data = array(
            'id' => $id,              
            'data'=> $upgrade_category_status ,
            'upgrade_category_status'=> $upgrade_category_status,
            'upgrade_status'=> $upgrade_status,
            'certificates'=> $certificates,
            'regCategory' => Trainer::getRegistrationCategory(),
        );
        
        return View::make('trainer.adminTrainerUpgradeCategory',$data);
    } 
    
    public function trainerUpdateCategory()
    {
        $upload = null;
        if (Input::hasFile('attachment')) {
            $upload = Input::file('attachment');
        }
        $data = Input::get(); 
        
        $trainer = Trainer::getTrainerById($data['trainer_id']);
        $user = Sentry::findUserById($trainer->user_id);

        $error = 0;
        $categoryMsg = '';
        $messageMsg = '';
        
        if(!isset($data['registration_category_id']) && empty($data['registration_category_id'])) {
            $error = 1;
            $categoryMsg = '* The Category field is required.';
        }

        if(isset($data['message']) && $data['message'] == "") {
            $error = 1;
            $messageMsg = '* The Message field is required.';
        }

        if ($error == 0) {

            $status = Input::get('status');

            if($status == 1) {
                Trainer::trainerUpdateCategory($data);
                
                $trainer_data = \Cranium\TrainerUpgradeLevel\Models\TrainerUpgradeLevel::where('trainer_id', '=', $data['trainer_id'])
                    ->get();
                
                if (count($trainer_data) > 0) {
                    $trainer_data = $trainer_data->first()->toArray();
                    
                    if (isset($trainer_data['id'])) {
                        
                        unset($trainer_data['id']);
                        unset($trainer_data['status_id']);
                        unset($trainer_data['is_processed']);
                        unset($trainer_data['category']);
    
                        $trainer_data['certificate'] = json_encode([$trainer_data['certificate']]);
    
                        try {
                            Trainer::createTrainerQualification($trainer_data);
                        } catch (Exception $e) {
                            echo 'error<br>';
                        }
                    }
            }
                //dd($tt);
            } else {
                $tlevel = \Cranium\TrainerUpgradeLevel\Models\TrainerUpgradeLevel::where('trainer_id', '=', $data['trainer_id'])
                    ->update(['is_processed'=>'1']);
            }
            
            $the_trainer = Users::getTrainerById($data['trainer_id']);
            $highest_level = 0;

            $trainer_cats = array();
            
            foreach($the_trainer->trainerRegistrationCategories as $cats) {

                if ($cats->registrationCategory->id > $highest_level) {
                    $highest_level = substr($cats->registrationCategory->level, 0, 1);
                }

                $trainer_cats[] = $cats->registrationCategory->level;
            }

            Mail::send('trainer.mail.upgradeLevel',
                array(
                    'valid_until' => Trainer::getTrainerById($data['trainer_id'])->expiry_date,
                    'firstname' => $user->first_name,
                    'messageTxt' => $data['message'],
                    'level' => $highest_level,
                    'categories' => $trainer_cats,
                    'status' => $status
                ),
                function($message) use($user, $upload)
                {
                    $message->to($user->email,$user->first_name)
                            ->subject('REPs Additional Level/ Category Update')
                            // ->bcc('admin@repsuae.com', 'REPs Admin')
                            // ->bcc('faisal.ayaz@sigmads.com', 'REPs Admin 2')
                            ;
                    
                    if ($upload) {
                        $message->attach($upload->getRealPath(), array(
                            'as' => 'Attached file.' . $upload->getClientOriginalExtension(), 
                            'mime' => $upload->getMimeType())
                        );
                    }
                }
            );

            return Redirect::to('admin/trainer');
        } else{
            return Redirect::to('admin/trainer/upgrade-level-category/'.$data['id'])
                    ->with(array('categoryMsg' => $categoryMsg, 'messageMsg' => $messageMsg))
                    ->withInput();
        }
        
    } 
}
