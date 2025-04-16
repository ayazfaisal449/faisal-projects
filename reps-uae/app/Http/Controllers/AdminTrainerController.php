<?php
namespace App\Http\Controllers;
require_once '../vendor/2checkout/2checkout-php/lib/Twocheckout.php';
use Carbon\Carbon;
class AdminTrainerController extends BaseController {
    
    //Search for admin
    public function adminTrainerSearch() {
        echo "test"; exit;
    }
    
/*
	 * logs a trainer in
	 * Created By Jahir @ Cranium Creations
	 */
	public function logIn () 
	{
		 return View::make('trainer.login');
	}
	
	/*
	 * get forgot Password view
	 * Created By Jahir @ Cranium Creations
	 */
	public function forgotPassword()
	{
		return View::make('trainer.change_pass.forgotPass');
	}
    
	/*
	 * Resets Password 
	 * Created By Jahir @ Cranium Creations
	 */
	public function resetPassword()
	{
		if(Sentry::getUser())
		{
			$user = Sentry::getUser();
		} 
		else
		{ 	
			$user_email = Input::get('email');
			
			$validator = Validator::make(
        	array(
                'email'=>$user_email
            ),
            array(
                'email'=>'email|required',              
            ));
            if ($validator->fails()) 
            {				
               return Redirect::to('trainer/forgot-password')->withErrors($validator)->withInput();
            } 
				
			$user = Sentry::findUserByLogin($user_email);
		}
			
        $resetCode = Trainer::getResetCode($user);
		
        Mail::send('trainer.mail.changePassword',
            array(
                'resetcode'=> $resetCode,
                'firstname' => $user->first_name
            ),
            function($message) use($user, $user)
            {
                $message->to($user->email,$user->first_name)
                        ->from(Config::get('contact.emailContactFrom'),'Craniumcreations')
                        ->subject(Config::get('contact.emailContactSubject'));
            }
        );
		
		$data['mail_id'] = $user->email;  
		return View::make('trainer.change_pass.changePasswordMessage',$data);
		
	}
	
	/*
	 * Resets Password 
	 * Created By Raj @ Cranium Creations
	 */
	public function resetPasswordLink($code)
	{
		$data['code'] = $code;
		return View::make('trainer.change_pass.changePassword',$data);
	}
	
	/*
	 * Change Password
	 * Created By Jahir @ Cranium Creations
	 */
	public function changePassword () 
	{
		$code = Input::get('reset_code');
		$validator = Validator::make(
        array(
                'reset_code'=> $code,
                'new_password'=>Input::get('new_password')
            ),
            array(
                'reset_code'=>'required',
                'new_password'=>'required|min:8'
            ));
            if ($validator->fails()) 
            {				
               return Redirect::to('trainer/dashboard/reset-pass/'.$code)->withErrors($validator)->withInput();
            } 
            else 
            {
                $resetcode = Input::get('reset_code');
                $new_password = Input::get('new_password');
                $user = $user = Sentry::getUser();
                if ($user->checkResetPasswordCode($resetcode))
                {
                    if ($user->attemptResetPassword($resetcode, $new_password))
                    {
                        return Redirect::to('trainer/dashboard')->with('message','Password reset successfully');
                    }
                    else
                    {
                        return Redirect::to('trainer/dashboard')->with('message','Password reset failed');
                    }
                }
                else
                {
                    return Redirect::to('trainer/dashboard/reset-pass/'.$code)
					->with('message','Password reset code is Invalid');
                }
            }
	}

	/*
	 * delete trainer
	  * @param id (int) id for delete
	 * Created By Jahir @Cranium Creations
	 */
	public function deleteTrainer($id)
	{		
		$trainer = Trainer::getTrainerById($id);
		$user = Sentry::findUserById($trainer[0]->user_id);
		// Delete the user
		$trainer[0]->delete();
		$user->delete();
		return Redirect::to('admin/trainer');
	}
    
	/*	
     * Manage Trainer page in Admin
     * Created By Kevin @ Cranium Creations
	 */
	public function manage()
    {
        //get All Trainers
        $trainers = Trainer::getAllTrainers(1);
        
        $default = array();
		foreach ($trainers as $value) 
        {
			$default[$value->first_name][] = $value->first_name;
			$default[$value->first_name][] = $value->id;
		}
        
        $paginatedData = $this->paginator($default,10);
        
        $data = array(
            'data' =>  $paginatedData['data'],
            'required'=> array('Name', 'Action'),
            'edit' => 'users',
            'paginator' =>  $paginatedData['links'],
			'levels' => Trainer::getRegistrationCategory()
        );
        
        return View::make('trainer.manage',$data);
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
		
        return View::make('trainer.addPersonalDetails',$data);

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
        				
        return View::make('trainer.addWorkExperience',$data)
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
    				
        return View::make('trainer.addQualification',$data);

    } 
    
    /**
     * registration/update success api back form
     * Created By Kevin @ Cranium Creations
     */
    public function success()
    {			
         return View::make('trainer.success');
    } 
	
	 /**
     * registration/update success api back form
     * Created By Raj @ Cranium Creations
     */
    public function renewed()
    {
       return View::make('trainer.renewed');
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
                $userErrors = $this->validateUser($data);
                
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
                    
                    return Redirect::action('TrainerController@trainerPersonalDetailsForm')
                            ->withErrors($errors['messageBag']); 
                }
                else if($userErrors['status'])
                {
                    
                    return Redirect::to('trainer/registration')
                            ->withErrors($userErrors['messageBag']); 
                }
                else
                {
                    //$data['passport'] = $this->getTmpFiles($_FILES['passport']);
                    $data['photo'] = $this->getTmpFiles($_FILES['photo']);
                    
                    //save the data in the session
                    Session::put('trainerDetails', $data);
                    
                    //create tmp folder with files
                    //$result = $this->createTmpFiles($data['passport'],'passport');
                    $result = $this->createTmpFiles($data['photo'],'photo');
                    
                    if($result)
                    {
                        return Redirect::action('TrainerController@trainerWorkExperienceForm');
                    }
                    else
                    {
                        return Redirect::action('TrainerController@trainerPersonalDetailsForm');
                    }
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
                    
                    return Redirect::action('TrainerController@trainerWorkExperienceForm');          
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
                        return Redirect::action('TrainerController@trainerQualificationForm');
                    }
                    else
                    {
                        return Redirect::action('TrainerController@trainerWorkExperienceForm');
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
                    Input::file('certificates4')
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
                    return Redirect::action('TrainerController@trainerQualificationForm');
                     
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
                
                return Redirect::action('TrainerController@success');
				
            break;
            
            //catch payment Completion
            case 'Payment Completed':
            
                //save all Trainer details from session 
                $result = Trainer::save();
                
                return Redirect::action('TrainerController@success');	
				
            break;
            
            default:
                //no case true
                return Redirect::action('TrainerController@fail');
            break;
        }
        
    }

    /**
     * Trainer Dashboard
     * Created By Kevin @ Cranium Creations
     */
    public function dashboard()
    {
        $data = array(
            'user' => Sentry::getUser(),
            'regCateogry' => Trainer::getRegCategory(),
            'trainerPersonalDetails' =>Trainer::getTrainerPersonalDetails(),
            'trainerQualifications' => Trainer::getTrainerQualification(),
        );
        
       return View::make('trainer.dashboard',$data);
    } 
    
    /**
	 * trainer authenticate
	 * Created By Jahir @ Cranium Creations
     * Modified By Kevin @ Cranium Creations
	 */
	public function authenticate() 
	{	
        // User credentials group
        $credentials = array(
            'email'    => Input::get('email'),
            'password' => Input::get('password'),
        );
            
        // Find the user using the user id
        $user = Sentry::findUserByLogin($credentials['email']);
        // Check if the user is in the administrator group
        if ($user->hasAccess('trainer.dashboard'))
        {
            // Try to authenticate the user
            $user = Sentry::authenticate($credentials, false);
            return Redirect::action('TrainerController@dashboard');
            
        }
        else
        {
            return Redirect::action('TrainerController@logIn');
        }
	}
	
    /**
	 * trainer logout
     * Created By Kevin @ Cranium Creations
	 */
    public function logOut()
    {
        //log the trainer out 
        Sentry::logout();
        
        //redirect to login page 
        return Redirect::action('TrainerController@logIn');
    }
	
	/**
	 * trainer renew registration
     * Created By Raj @ Cranium Creations
	 */
	public function updateWorkExperience(){
		
		$userData['work_place'] = Input::get('work_place');
		$userData['cv'] = Input::file('cv');;
		$userData['registration_cateogry_id'] = Input::get('registration_category_id');
			
		$result = Trainer::updateWorkExperience($userData);
			
		 return Redirect::action('TrainerController@dashboard');	
	}
    
    /*
     * Update Personal Details
     * Created By Kevin @Cranium Creations
     */
     public function updatePersonalDetails()
     {
        $data = Input::get();
        $data['photo'] = Input::file('photo');
        
        //Get all nationalities
        $nations = Nationality::getAll();
        $nationality = array();
        foreach($nations as $value)
        {
            $nationality[$value->id] = $value->name;
        }
        
        $default =  array (
            'nationality' => $nationality,
            'mediaTypes' =>  MediaType::getAll(),
            'gender' => array (
                'Male', 'Female',
            ),
            'trainer' => Trainer::getTrainerPersonalDetails(),
            'user' => Sentry::getUser()
        );
        
        if(isset($data['user_id']) && $data['trainer_id'])
        {   
            //validate trainer personal details fields
            $errors = Trainer::validatePersonalDetails($data);
            
            //validate user details
            $userErrors = $this->validateUser($data);
            
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
                
                return View::make('trainer.updatePersonalDetails',$default)
                            ->withErrors($errors['messageBag']); 
            }
            else if($userErrors['status'])
            {   
                return View::make('trainer.updatePersonalDetails',$default)
                            ->withErrors($userErrors['messageBag']); 
            }
            else
            {
                
                if( isset($data['photo']) && count($data['photo']) > 0 )
                {
                    $data['photo'] = $this->getTmpFiles($_FILES['photo']);
                }
                
                //update trainer details
                if( Trainer::updatePersonalDetails($data) )
                {
                    return Redirect::action('TrainerController@dashboard');
                }
                
                return Redirect::action('TrainerController@dashboard');
            }
        }
        else
        {   
            //create the views
            return View::make('trainer.updatePersonalDetails',$default);
        }
     }	
	
	public function trainerSearch()
    {
		
		$input = Input::get();
		
		$default = Trainer::searchTrainers($input);
		
       	$paginatedData = $this->paginator($default,10);
        
        //Get all nationalities
        $nations = Nationality::getAll();
        $nationality = array();
        foreach($nations as $value)
        {
            $nationality[$value->id] = $value->name;
        }
		 
        $data = array(
            'data' =>  $paginatedData['data'],			
            'edit' => 'users',
            'paginator' =>  $paginatedData['links'],
            'levels' => Trainer::getRegistrationCategory(),
            'nationality'=> $nationality
        );
        
        return View::make('trainer.searchTrainer',$data);
			 
		/*if(Sentry::getUser()) { 	
			
			$data['required'] = array('Name', 'Action');
			
			$admin = Sentry::findGroupByName('Admin');		
			$user = Sentry::findUserByID(Sentry::getUser()->id);
			if ($user->inGroup($admin))			
				return View::make('trainer.manage',$data);	
			else{
				$data['required'] = array('Name');
				return View::make('trainer.userTrainer',$data);
			}
		}
		else {*/
			
            echo "<pre>"; print_r($data); echo "</pre>"; die('here');
            		
			return View::make('trainer.searchTrainer',$data);
		//}
	}
	
	 /*
     * @param 
     * get index page for triner search for user side
     * Created By Raj @ Cranium Creations
     */
    public function trainerSearchUserIndex()
    {
        $default = Nationality::getAll();
		$nationality = array();
        $nationality[0] = 'Select Nationality';
		foreach($default as $value)
		{
			$nationality[$value->id] = $value->name;
		}
        
        $data = array(
            'nationality' => $nationality,
			'levels' => Trainer::getRegistrationCategory(),
            'gender' => array(
                '0' => 'Male',
                '1' => 'Female'
            )
        );
        
        return View::make('trainer.searchTrainer',$data);
	}
	
    /**
     * your qualifications Trainer Qualificaations
     * Created By Kevin @ Cranium Creations
     */
    public function yourQualifications() 
    {

         $data = array (
            'user' => Sentry::getUser(),
            'qualifications' => Trainer::getTrainerQualification()
        );

        return View::make('trainer.updateQualifications',$data);
    }
	
	/**
	 * renew  trainer  registration
     * Created By Raj @ Cranium Creations
	 
	public function renewRegistration()
	{
		
		$id = Sentry::getUser()->id;
		
		$mysqlDate = date('Y-m-d H:i:s');     
		$dt =  Carbon::createFromFormat('Y-m-d H:i:s', $mysqlDate);
		$trainer =  Trainer::getTrainer($id);    
		$trainer->created_at = $dt;
		$trainer->save();
		Mail::send('trainer.mail.renewed', array('firstname' => $trainer->first_name),
		 function($message) use($trainer, $trainer)
		{
			$message->to($trainer->email,$trainer->first_name)
			->from(Config::get('contact.emailContactFrom'),'Craniumcreations')
			->subject(Config::get('contact.emailContactSubject'));
		});
		
		return Redirect::action('TrainerController@renewed');	
		
	}*/

    /**
     * @param currentEmploye qualificaitonId
     * gets the current employer Qualification
     * Created By Kevin @ Cranium Creations
     */
    public function currentEmployer()
    {
        $workExp = Trainer::getTrainerWorkExperience();
        $workPlace = array();
        
        //check for errors if form is submitted
        $errors = Session::get('workExpErrors');
        
        if( isset($errors) && $errors['work_place']['validData']['status'] )
        {
             $workPlace['validData'] = $errors['work_place']['validData'];
        }

        $workPlace['data'] = json_decode($workExp['work_place']);
        
        
        $data = array(
            'user' => Sentry::getUser(),
            'workExp' => $workExp,
            'work_place'  => $workPlace,
            'trainer' => Trainer::getTrainerByUserId(Sentry::getUser()->id),
            'errors' => (isset($errors['errors']['messageBag'])?
                $errors['errors']['messageBag']:'')
        );
        
        //forget the old input
        Session::forget('_old_input.work_place');
                
        return View::make('trainer.currentEmployer',$data)
            ->withErrors($data['errors']);
    }
    
    /**
     * @param currentEmploye qualificaitonId
     * gets the current employer Qualification
     * Created By Kevin @ Cranium Creations
     */
    public function updateCurrentEmployer()
    {
        $data = Input::get();
        $data['cv'] = Input::file('cv');
                
        //validate trainer work experience fields
        $errorsWorkExp = Trainer::validateWorkExperience($data);
                
        //check multiple text box field for work_place
        $workPlaceErrors = array (
            'empty' => $this->validateMulipleTextBox($data['work_place']),
            'validData' => $this->validateAlplaSpaces($data['work_place'])                        
        );
       
        //check if there is only the CV Required Error message
        if( isset($errorsWorkExp['messageBag']) && 
            $errorsWorkExp['messageBag']->count() == 1 && 
            trim( $errorsWorkExp['messageBag']->first('cv') ) == 
            'The cv field is required.')
        {
           
            $errorsWorkExp['status'] = false; 
        }
                 
        //prepare errors to send to the view 
        if($errorsWorkExp['status'] || $workPlaceErrors['empty']['status'] ||
           $workPlaceErrors['validData']['status'])
        {   
            $errors = Array();
            if($errorsWorkExp['status']) 
            {
                $errors['status'] = $errorsWorkExp['status'];
                $errors['messageBag'] = $errorsWorkExp['messageBag'];
            }
            
            $errorData = array(
                'work_place' => $workPlaceErrors,
                'errors' => $errors
            );
            
            Session::flash('workExpErrors',$errorData);
            
            return Redirect::action('TrainerController@currentEmployer');       
        
        }
        else
        {   
            if(Trainer::updateWorkExperience($data))
            {
                return Redirect::action('TrainerController@currentEmployer');
            }
        }
    }
    
    /** 
     * apply to upgrade level
     * Created By Kevin @ Cranium Creations
     */
    public function trainerUpgradeLevel()
    {
        $data = Input::get();
        
        $default = array(
            'regCategory' => Trainer::getRegistrationCategory(),
            'user' => Sentry::getUser(),
            'trainer' => Trainer::getTrainerByUserId(Sentry::getUser()->id),
            'trainerReg' => Trainer::getRegCategory()
        );
        
        if(isset($data) && !empty($data))
        {
            $data['certificate'] = Input::file('certificate');
            
            //validate trainer personal details fields
            $errors = Trainer::validateTrainerUpgradeLevel($data);
            
            if($errors['status'])
            {
                return View::make('trainer.trainerUpgradeLevel',$default)
                            ->withErrors($errors['messageBag']); 
            }
            else
            {
                 Trainer::trainerUpgradeLevel($data);
            }
            
        }
        else
        {
            return View::make('trainer.trainerUpgradeLevel',$default);
        }
    }
    
    /** 
     * apply to upgrade status
     * Created By Kevin @ Cranium Creations
     */
    public function trainerUpgradeStatus()
    {
        $data = Input::get();
        
        $default = array(
            'user' => Sentry::getUser(),
            'trainer' => Trainer::getTrainerByUserId(Sentry::getUser()->id),
        );
        
        if(isset($data) && !empty($data))
        {
            $data['certificate'] = Input::file('certificate');
            
            //validate trainer personal details fields
            $errors = Trainer::validateTrainerUpgradeStatus($data);
            
            if($errors['status'])
            {
                return View::make('trainer.trainerUpgradeStatus',$default)
                            ->withErrors($errors['messageBag']); 
            }
            else
            {
                 Trainer::trainerUpgradeStatus($data);
                 
                 return Redirect::action('TrainerController@dashboard');
            }
        }
        else
        {
            return View::make('trainer.trainerUpgradeStatus',$default);
        }
        
    }
    
    /**
	 * trainer renew registration
     * Created By Raj @ Cranium Creations
	 */
	public function renewRegistration() 
	{
        $data['user_id'] =  $user = Sentry::getUser()->id;
        return View::make('trainer.renewRegistration',$data);			
	}
    
    /**
     * payment api back form
     * Created By Kevin @ Cranium Creations
     */
    public function payment()
    {
       $params = Input::get();
       
       //echo "<pre>"; print_r( $params); echo "</pre>";
       
       return View::make('trainer.renewRegistration',$data);
       
       //Twocheckout_Return::check($params, "tango", 'array');
    }
    
    /**
     * Show the registeration information page.
     *
     * @author Chris @ Cranium Creations
     */
    public function registerInfo()
    {
        return View::make('trainer.registrationInfo');
    }

}