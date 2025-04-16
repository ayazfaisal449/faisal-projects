<?php
namespace App\Http\Controllers;
use Illuminate\Support\MessageBag;
class UsersController extends BaseController {
	/*
	* add to mailchimp if not
	 * @param int $id
	 * Created By Jahir @ Cranium Craetions
	 */
	public function mailchimpCheck($id)
    {
		$user = Sentry::findUserById($id);
		$mailchimp = $this->mailChimp();
		$mail = Users::subscribe($mailchimp, $id, $user);
		if ($mail==1)
		{

			return Redirect::to('admin/users')->with('message','Mr '.$user->first_name.' you are added to Cranium mailchimp..... Pls check ur email and confirm');
		}
		else
		{

			return Redirect::to('admin/users')->with('message','Mr '.$user->first_name.' you are already member of Cranium mailchimp');
		}
	}
    /*
	 * Gets all Users
	 * Created By Kevin @ Cranium Creations
	 */
	public function manage () {

		$users = array();
		foreach (Users::getAllUsers(1) as $value) {
			$users[$value->first_name][] = $value->first_name;
			$users[$value->first_name][] = $value->id;
		}

        $paginatedData = $this->paginator($users,10);

        $data = array(
            'data' =>  $paginatedData['data'],
            'required'=> array('Name', 'Action'),
            'edit' => 'users',
            'paginator' =>  $paginatedData['links']
        );

        return View::make('users.manage',$data);

    }

    /*
     * User Form
     * @param id (int) user id for update
     * Created By Kevin @Cranium Creations
     */
    public function userForm($id=Null)
    {
        //find all groups for users
        $groups = Sentry::findAllGroups();

        if (!empty($id)) {

			//find the user by Id
			$user = Sentry::findUserById($id);
			$userGroups = $user->groups;
			//$upgrade_status = Trainer::getTrainerUpgradeStatusById($user->trainer->id);
			$upgrade_status = Trainer::getTrainerUpgradeStatusByTrainerIdAndNotProcessed($user->trainer->id);
			$upgrade_category_status = Trainer::getTrainerUpgradeCategoryStatusByTrainerIdAndNotProcessed($user->trainer->id);

            $input = array(
                0=>array('id','hidden','Id',$user->id),
                1=>array('first_name','text','First Name',$user->first_name),
                2=>array('last_name','text','Last Name',$user->last_name),
                3=>array('email','text','Email Address',$user->email)
            );

            //finding all inputs for subForm
            $subForm = array();

            foreach($groups as $group)
            {
                $flag = false;
                foreach ($userGroups as $ugroup) {
                    if ($group->id == $ugroup->id)
                    {
                        $subForm[] = array(
                            'groups[]',
                            'checkbox',
                            $group->name,
                            $group->id,
                            $group->id,
                            1
                        );
                        $flag = true;
                    }
                }

                if ($flag == false) {
                    $subForm[] = array(
                        'groups[]',
                        'checkbox',
                        $group->name,
                        $group->id,
                        $group->id,
                        0
                    );
                }
            }

            $default = Nationality::getAll();
            $nationality = array();
            foreach($default as $value) {
                $nationality[$value->id] = $value->name;
            }

            $data = array(
                'nationality' => $nationality,
                'mediaTypes' =>  MediaType::getAll(),
                'gender' => array ('Male', 'Female'),
                'update' => 'Users',
                'subForm' => $subForm,
                'input' => $input,
                'data' => $user,
                'form' => 'users',
                'subFormTitle' => 'Groups',
                'upgrade_status' => $upgrade_status,
                'upgrade_category_status' => $upgrade_category_status,
                'editForm'=>'main'

            );

            return View::make('users.update',$data);
        } else {
            $data = array('groups' => $groups);
            return View::make('users.add',$data);
        }

    }

    public function userFormWorkExperience($id=Null) {

        if (!empty($id)) {

            $user = Sentry::findUserById($id);
            $trainerWE = $user->trainer->trainerWorkExperience;
            $trainerRC = $user->trainer->trainerRegistrationCategories;

            $the_data['id'] = $user->id;
            $the_data['trainer_id'] = $trainerWE->trainer_id;
            $the_data['work_place'] = json_decode($trainerWE->work_place);
            $the_data['job_title'] = $trainerWE->job_title;
            $the_data['cv'] = $trainerWE->cv;
            $the_data['status_id'] = $user->trainer->status_id;

            foreach ($trainerRC as $itm) {
                $the_data['registration_category_id'][] = $itm->registration_category_id;
            }

            $data = array(
                'update' => 'Users',
                'data' => $the_data,
                'form' => 'users',
                'regCategory' => Trainer::getRegistrationCategory(),
                'editForm'=>'workexperience'
            );

            return View::make('users.update',$data);
        }
    }

    public function deleteTrainerQualifications($qualification_id=null) {

        if (!empty($qualification_id)) {
            $q = Trainer::getTrainerQualificationById($qualification_id);

            $trainer = Users::getTrainerById($q->trainer_id);

            if ($q) {
                $qs = Trainer::getTrainerQualificationsByTrainer($q->trainer_id);

                if ($qs->count() > 1) {
                    $q->delete();
                    $msg = "Qualification has been deleted!";
                } else {
                    $msg = "Cannot delete qualification.  A trainer needs at least 1 qualification on record.";
                }
            }

            return Redirect::action('UsersController@userFormQualifications', $trainer->user_id)->with('message',$msg);
        }
    }

    public function userFormQualifications($id=Null) {

        if (!empty($id)) {

            $user = Sentry::findUserById($id);
            $trainerQ = $user->trainer->trainerQualifications;
            $trainerR = Trainer::getApprovedSubscriptionPaymentsByTrainerId($user->trainer->id);

            $pending = array();

            foreach ($trainerR as $itm) {
                $userz = Users::getTrainerById($itm->trainer_id);
                $details = json_decode($itm->details);

                if (!empty($userz)) {
                    $pending[] = array(
                        'user'=>$userz,
                        'trainer'=>Trainer::getTrainerById($userz->id),
                        'details'=>$details,
                        'payment_date'=>$itm->created_at->format('Y-m-d'),
                        'payment_id'=>$itm->id
                    );
                }
            }

            $data = array(
                'update' => 'Users',
                'data' => $user,
                'qualifications'=>$trainerQ,
                'renewals'=>$pending,
                'form' => 'users',
                'regCategory' => Trainer::getRegistrationCategory(),
                'editForm'=>'qualification'
            );

            return View::make('users.update',$data);
        }
    }

    public function userFormComments($id = null)
    {

        $data = array(
            'editForm' => 'comment',
            'data' => Sentry::findUserById($id),
            'comments' => \Cranium\Models\Comment::where('user_id', '=', $id)->orderBy('id', 'DESC')->get(),
        );
        return View::make('users.update', $data);
    }

    public function saveComment()
    {
        $data = Input::all();

        $comment = new \Cranium\Models\Comment;
        $comment->fill($data);
        $comment->save();
        return Redirect::back();
    }

    public function userFormNewQualifications($id=Null) {

        if (!empty($id)) {

            $user = Sentry::findUserById($id);

            $qualifications = $user->trainer->trainerQualifications;

            $limit_reached = false;
            if (count($qualifications) > 10) {
                $limit_reached = true;
            }

            $data = array(
                'update' => 'Users',
                'data' => $user,
                'form' => 'users',
                'regCategory' => Trainer::getRegistrationCategory(),
                'editForm'=>'qualification_add',
                'limit_reached'=>$limit_reached
            );

            return View::make('users.update',$data);
        }
    }

    public function save3() {

        $id = Input::get('id');

        $errors_list = new MessageBag();

        $data['course_name'] = Input::get('course_name');
        $data['course_provider'] = Input::get('course_provider');
        $data['date_completed'] = Input::get('date_completed');
        $data['certificates'] = Input::file('certificates');

        $validator = Validator::make(Input::all(), array(
            'course_name' => 'required',
            'course_provider' => 'alpha_spaces',
            'date_completed' => 'date',
            'certificates' => 'required'
        ));

        $file_has_error = false;
        ini_set('post_max_size', '64M');
        ini_set('upload_max_filesize', '64M');

        // echo "<pre>"; dd(Input::file('certificates'));
        foreach(Input::file('certificates') as $file) {
            $validatorF = Validator::make(array('certificates'=> $file), array(
                // 'certificates' => 'required|mimes:png,jpg,jpeg,gif,pdf,doc,docx|size:4500'
                'certificates' => 'required|mimes:png,jpg,jpeg,gif,pdf,doc,docx|max:2048'
            ));
            // if ($validatorF->fails()) {
            //     $errors_list->merge($validatorF->errors());
            //     $file_has_error = true;
            //     break;
            // }
        }

        if ($validator->fails()) {
            $errors_list->merge($validator->errors());
        }

        if ($validator->fails() || $file_has_error) {
            return Redirect::action('UsersController@userFormNewQualifications',$id)->withErrors($errors_list)->withInput();
        }

        $user = Sentry::findUserById($id);

        $certificates = array();

        foreach (Input::file('certificates') as $files) {
            $certificates[] = $files->getClientOriginalName();
            $files->move(Config::get('trainer.path') . "/$user->id/certificate",$files->getClientOriginalName());
        }

        Trainer::createTrainerQualification(array (
            'trainer_id' => $user->trainer->id,
            'course_name' => $data['course_name'],
            'course_provider' => $data['course_provider'],
            'date_completed' => $data['date_completed'],
            'certificate' => json_encode($certificates),
        ));

        return Redirect::action('UsersController@userFormQualifications',$id);
    }

    public function save2() {

        $id = Input::get('id');

        $form_data = Input::get();
        $form_data['cv'] = Input::file('cv');
        $new_status_id = Input::get('status_id');
        $message_for_trainer = Input::get('message_for_trainer');

        if (!empty($id)) {

            $errors_list = new MessageBag();

            $validator = Validator::make($form_data, array(
                    'job_title' => 'required',
                    // 'cv' => 'mimes:pdf,doc,docx|max:256000',
                )
            );

            if(isset($form_data['registration_category_id'])) {

                $pErrors = Trainer::validateRegistationCategory($form_data['registration_category_id']);
            } else {
                $pErrors = Trainer::validateRegistationCategory(array());
            }

            if ($pErrors['status']) {
                $errors_list->merge($pErrors['messageBag']);
            }

            if ($validator->fails()) {
                $errors_list->merge($validator->messages());
            }

            if ($validator->fails() || $pErrors['status']) {

                return Redirect::action('UsersController@userFormWorkExperience',$id)->withErrors($errors_list)->withInput();
            }

            $user = Sentry::findUserById($id);
            $trainerWE = $user->trainer->trainerWorkExperience;
            $trainerRC = $user->trainer->trainerRegistrationCategories;


            $updateList = array(
                'email_address' => $user->email,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'old_status_id' => $user->trainer->status_id,
                'new_status_id' => $new_status_id,
                'old_status_nm' => Trainer::getStatusName($user->trainer->status_id),
                'new_status_nm' => Trainer::getStatusName($new_status_id),
                'message_for_trainer' => $message_for_trainer
            );

            foreach ($trainerRC as $key => $itm) {
                $itm->delete();
            }

            foreach ($form_data['registration_category_id'] as $itm) {
                $user->trainer->addTrainerRegistrationCategory(array(
                    'trainer_id' => $trainerWE->trainer_id,
                    'registration_category_id' => $itm
                ));
            }

            $userData['user_id'] = $id;
            $userData['id'] = $trainerWE->id;
            $userData['trainer_id'] = $trainerWE->trainer_id;
            $userData['job_title'] = Input::get('job_title');
            $userData['work_place'] = Input::get('work_place');
            $userData['cv'] = Input::file('cv');
            $userData['registration_category_id'] = Input::get('registration_category_id');

            $update_work = Trainer::updateTrainerWorkExperience($userData);

            // dd($userData);

            if ($updateList['old_status_id'] != $new_status_id && $updateList['old_status_id'] == 3) {
                $user->trainer->expiry_date = date('Y-m-t',strtotime('+1 years'));
            }
            $user->trainer->status_id = $new_status_id;
            $user->trainer->forceSave();

            $upload = null;
            if (Input::hasFile('attachment')) {
                $upload = Input::file('attachment');
            }

            $the_trainer = Users::getTrainerById($trainerWE->trainer_id);
            $highest_level = 0;

            $trainer_cats = array();

            foreach($the_trainer->trainerRegistrationCategories as $cats) {

                if ($cats->registrationCategory->id > $highest_level) {
                    $highest_level = substr($cats->registrationCategory->level, 0, 1);
                }

                $trainer_cats[] = $cats->registrationCategory->level;
            }

            $updateList['level'] = $highest_level;
            $updateList['categories'] = $trainer_cats;
            $updateList['update_until'] = $user->trainer->expiry_date;

            $subject = 'REPs Status Update ' . $updateList['old_status_nm'] . ' to ' . $updateList['new_status_nm'] . '.';

            if ($updateList['old_status_id'] == 3 && ($new_status_id == 2 || $new_status_id == 1)) {
                $subject = "Welcome to REPs, your registration has been successful";
            }

            $old_status_id = $updateList['old_status_id'];
            // echo 'new: ' . $new_status_id;
            // echo 'old: ' . $old_status_id;
            // die();
            if ($updateList['old_status_id'] != $new_status_id) {
                Mail::send('trainer.mail.statusUpdateNotify', $updateList, function($message) use($updateList, $upload, $subject, $new_status_id, $old_status_id) {
                        $message->to($updateList['email_address'])
                                ->bcc('admin@repsuae.com', 'REPs Admin')
                                ->bcc('faisal.ayaz@sigmads.com', 'REPs Admin 2')

                                // ->bcc('ljv.craniumweb@gmail.com', 'REPs Admin 3')
                                ->subject($subject);

                        if ($upload) {
                            $message->attach($upload->getRealPath(), array('as' => 'Attached file.' . $upload->getClientOriginalExtension(), 'mime' => $upload->getMimeType()));
                        }
                        // New registration to Full
                        if ($old_status_id == 3 && $new_status_id == 2) {
                                // $message->attach(public_path() . '/download/2017_Provisional_to_Full_Status_Letter.pdf');
                        }
                        // New registration to Provisional
                        if ($old_status_id == 3 && $new_status_id == 1) {
                                $message->attach(public_path() . '/download/2017_Provisional_to_Full_Status_Letter.pdf');
                                $message->attach(public_path() . '/download/Provisional_Status_Information_Sheet.pdf');
                        }
                    }
                );
            }

			// Send a request to Volution API to update user experience
			$volution_data = new \stdClass();
			$volution_data->membership_number = str_replace('reps', '', $user->trainer->reps_id);
			$volution_data->membership_categories = implode(',', $userData['registration_category_id']);
			$volution_data->status_id = $new_status_id;
			$volution_data->old_status_id = $old_status_id;

			$this->update_volution_experience($volution_data);

            return Redirect::action('UsersController@userFormWorkExperience', $id)->with('message', 'Trainer record has been updated.');
        }
    }

    /*
     * Save User and updates user group
     * Created By Kevin @Cranium Creations
     */
    public function save()
    {
        $id = Input::get('id');

        $file_data = Input::file('photo');
        $form_data = Input::get();

        if (!empty($id)) {

            $errors_list = new MessageBag();

            $validator = Validator::make(Input::get(), array(
                    'first_name'=>'required|min:3',
                    'last_name'=>'required|min:3',
                    'email'=>'required|email|unique:users,email,'.$id
                )
            );

            $form_data['trainer']['photo'] =  $file_data;
            $form_data['trainer']['id'] =  $id;

            $pErrors = Trainer::validatePersonalDetails($form_data['trainer']);

            if ($pErrors['status']) {
                $errors_list->merge($pErrors['messageBag']);
            }
            if ($validator->fails()) {
                $errors_list->merge($validator->messages());
            }

            if ($validator->fails() || $pErrors['status']) {

                return Redirect::to('admin/users/update/'.$id)->withErrors($errors_list)->withInput();
            } else {

                $groups = Input::get('groups');

                $user = Sentry::findUserById($id); //find the user

                $user->first_name = Input::get('first_name');
                $user->last_name = Input::get('last_name');
                $user->email = Input::get('email');
                $user->save();

                $fn = Config::get('trainer.path') . "/$user->id/photo/" . $user->trainer->photo;

                if (Input::hasFile('photo')) {

                    if (is_file($fn)) {
                        unlink($fn);
                    }

                    $file_name = $file_data->getClientOriginalName();
                    $file_data->move(Config::get('trainer.path') . "/$user->id/photo",$file_name);
                }

                $updateList = array(
                    'email_address' => $user->email,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'old_status_id' => $user->trainer->status_id,
                    'new_status_id' => $form_data['trainer']['status_id'],
                    'old_status_nm' => Trainer::getStatusName($user->trainer->status_id),
                    'new_status_nm' => Trainer::getStatusName($form_data['trainer']['status_id'])
                );

                $user->trainer->nationality_id = $form_data['trainer']['nationality_id'];
                $user->trainer->dob = $form_data['trainer']['dob'];
                $user->trainer->gender = $form_data['trainer']['gender'];
                $user->trainer->city = $form_data['trainer']['city'];
                $user->trainer->mobile_phone = $form_data['trainer']['mobile_phone'];
                $user->trainer->work_email = $form_data['trainer']['work_email'];
                $user->trainer->status_id = $form_data['trainer']['status_id'];
                $user->trainer->expiry_date = $form_data['trainer']['expiry_date'];
                $user->trainer->avail_insurance = $form_data['trainer']['avail_insurance'];
                $user->trainer->disease = $form_data['trainer']['disease'];
                $user->trainer->criminal = $form_data['trainer']['criminal'];
                $user->trainer->negligence = $form_data['trainer']['negligence'];
                $user->trainer->insurer = $form_data['trainer']['insurer'];

                if ($updateList['old_status_id'] != $updateList['new_status_id'] && $updateList['old_status_id'] == 3) {
                    $user->trainer->expiry_date = date('Y-m-t',strtotime('+1 years'));
                }
                if (Input::hasFile('photo')) {
                    $user->trainer->photo = $file_name;
                }
                $user->trainer->forceSave();

                $userGroups = $user->groups->toArray();

                //remove all previous groups
                foreach ($userGroups as $ugroup) {
                    $userGroup = Sentry::findGroupById($ugroup['id']);
                    $user->removeGroup($userGroup);
                }

                $userGroup = Sentry::findGroupById(1);
                $user->addGroup($userGroup);

                if ($updateList['old_status_id'] != $updateList['new_status_id']) {

                    Mail::send('trainer.mail.statusUpdateNotify', $updateList, function($message) use($updateList) {
                        $message->to($updateList['email_address'])
                                ->subject('REPs - Your trainer status has been updated!');
                    });
                }

				// Send a request to Volution API to update user details
				$this->update_volution_trainer($user);

                return Redirect::to("admin/users/update/$id")->with('message', 'Trainer record has been updated.');
//                return Redirect::action('TrainerController@manage')->with('message', 'Trainer record has been updated.');
            }

        } else {
            $validator = Validator::make(
                array(
                        'email'=> Input::get('email'),
                        'first_name'=>Input::get('first_name'),
                        'last_name'=>Input::get('last_name'),
                        'password'=>Input::get('password'),
                        'groups'=>Input::get('groups')
                ),
                array(
                        'first_name'=>'required|min:3',
                        'last_name'=>'required|min:3',
                        'password'=>'required|min:8',
                        'email'=>'required|email|unique:users,email,'.$id,
                        'groups'=>'required'
                )
            );

            if ($validator->fails())
            {
                return Redirect::to('admin/users/add')->withErrors($validator)->withInput();
            }
            else
            {
                // Create the user
                $user = Sentry::createUser(array(
                    'email' => Input::get('email'),
                    'password' => Input::get('password'),
                    'first_name' => Input::get('first_name'),
                    'last_name' => Input::get('last_name'),
                    'activated' => true,
                ));

                //adding multiple groups for Users
                foreach (Input::get('groups') as $grp) {
                    $group = Sentry::findGroupById($grp);
                    $user->addGroup($group);
                }

                //redirect to manage page
                return Redirect::to('admin/users');
            }
        }
    }

	/**
	 * Send API to Volution to update user details on their end
	 *
	 * @param User $user
	 */
	public function update_volution_trainer($user)
	{

		$url = 'https://repsuae.volution.fit/api/v1/admin/trainer/'.str_replace('reps', '', $user->trainer->reps_id).'/update/';

		// A sample PHP Script to POST data using cURL
		// Data in JSON format

		$user_request_data = new \stdClass();
		$user_request_data->first_name = $user->first_name;
		$user_request_data->last_name = $user->last_name;
		$user_request_data->email = $user->email;
		$user_request_data->gender = $user->trainer->gender;
		$user_request_data->dob = $user->trainer->dob;
		$user_request_data->city = $user->trainer->city;
		$user_request_data->expiry_date = $user->trainer->expiry_date;

		// Prepare new cURL resource
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($user_request_data));

		// Set HTTP Header for POST request
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Content-Type: application/json',
		    'Content-Length: ' . strlen(json_encode($user_request_data)))
		);

		// Submit the POST request
		$result = curl_exec($ch);

		// Close cURL session handle
		curl_close($ch);

	}

	/**
	 * Send API to Volution to update user experience on their end
	 *
	 * @param User $user
	 */
	public function update_volution_experience($data)
	{
		$url = 'https://repsuae.volution.fit/api/v1/admin/trainer/'.$data->membership_number.'/experience/update/';

		// Prepare new cURL resource
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

		// Set HTTP Header for POST request
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Content-Type: application/json',
		    'Content-Length: ' . strlen(json_encode($data)))
		);

		// Submit the POST request
		$result = curl_exec($ch);

		// Close cURL session handle
		curl_close($ch);

	}

	/*
	 * delete User and updates user group
	 * Created By Kevin @ Cranium Creations
	 */
	public function delete($id=Null) {

		// Find the user using the user id
		if(isset($id)) {
			$user = Sentry::findUserById($id);
		} else {
			$user = Sentry::findUserById(Input::get('id'));
		}

//                echo "<pre>";
//                print_r($user->trainer->trainerMedia);
//                print_r($user->trainer->subscriptionPayment);
//                print_r($user->trainer->trainerQualifications);
//                print_r($user->trainer->trainerRegistrationCategories);
//                print_r($user->trainer->trainerWorkExperience);
//                print_r($user->trainer->trainerUpgradeStatus);
//                print_r($user->trainer->trainerUpgradeLevel);
//                print_r($user->trainer);
//                echo "</pre>";

                $user->email = "userid" . $user->id . "@deletedrepsuaedeleted.com";
                $user->save();

                $user->trainer->delete();
		$user->delete();

        //redirect to manage page
        //return Redirect::to('admin/users');
        return Redirect::action('TrainerController@manage');
	}

}
