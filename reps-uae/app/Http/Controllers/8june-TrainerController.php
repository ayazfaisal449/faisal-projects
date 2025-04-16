<?php

namespace App\Http\Controllers;

require_once('../vendor/2checkout/2checkout-php/lib/Twocheckout.php');

use Carbon\Carbon;
use Cranium\Country\Models\Country;
use Illuminate\Support\Facades\Session;
use DB as DBS;
use Illuminate\Support\Facades\Log;


class TrainerController extends BaseController
{

    /*
     * logs a trainer in
     * Created By Jahir @ Cranium Creations
     */
    public function logIn()
    {
        $viewData = array(
            'generalMessage' => Session::get('message')

        );
        $data['setting'] = DBS::table('setting')->get();

        return View::make(
            'trainer.login',
            $data,
            $viewData
        );
    }

    /*
     * get forgot Password view
     * Created By Jahir @ Cranium Creations
     */
    public function forgotPassword()
    {
        $viewData = array(
            'message' => Session::get('message')
        );
        $data['setting'] = DBS::table('setting')->get();

        return View::make(
            'trainer.change_pass.forgotPass',
            $viewData,
            $data
        );
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        // $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public function processRenewal()
    {
        // dd('here');
        Log::channel('renew_registration')->info('renewal started');
        $data1['setting'] = DBS::table('setting')->get();
        $user = Sentry::getUser();
        Log::info('renew user ' . $user . date('Y-m-d H:i:s'));

        if ($user->trainer->status_id == 1) {

            return Redirect::action('TrainerController@dashboard');
        }

        ini_set('max_execution_time', 300);

        $photos = Input::file('photo');
        if (!Input::hasFile('photo')) {
            return Redirect::action('TrainerController@renewRegistration')
                ->with('message2', 'Invalid Certificate.  You need at least 1 certificate with a valid PNG, JPG, JPEG or GIF file extension in order to proceed with online payment.');
        } else {


            foreach ($photos as $test) {

                $filename = $test->getClientOriginalName();
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                if ($ext != 'doc') {
                    $validatorF = Validator::make(array('certificates' => $test), array(
                        'certificates' => 'required|mimes:png,jpg,jpeg,gif,pdf,doc|max:8192'
                    ));
                    if ($validatorF->fails()) {

                        $errors = $validatorF->messages()->toArray();

                        $err = array();

                        foreach ($errors as $error) {
                            $err[] = $error[0];
                        }
                        //print_r($err);
                        return Redirect::action('TrainerController@renewRegistration')
                            ->with('message2', 'Invalid Certificate. ' . implode(", ", $err));
                    }
                }
            }
        }

        $location = Config::get('tmp.tmpPath') . '/renewals/' . $user->id;

        $files_list = array();

        if (!is_dir($location)) {
            File::makeDirectory($location, 0755, true);
        }

        $totalFileSize = 0;

        foreach (Input::file('photo') as $test) {


            $totalFileSize += $test->getSize();

            $new_filename = uniqid() . '.' . $test->getClientOriginalExtension();
            $test->move($location, $new_filename);

            $files_list[] = $new_filename;
        }

        date_default_timezone_set('Asia/Dubai');
        $writeData = PHP_EOL . PHP_EOL . PHP_EOL . "----------------";
        $writeData .= PHP_EOL . "Date: " . date("Y-m-d h:i:s a");
        $writeData .= PHP_EOL . "UserId: " . $user->id;
        $writeData .= PHP_EOL . "Total Uploaded Size: " . $this->formatBytes($totalFileSize);
        $writeData .= PHP_EOL . "Files: " . implode(", ", $files_list);

        file_put_contents(Config::get('tmp.tmpPath') . '/record.txt', $writeData, FILE_APPEND | LOCK_EX);

        Session::put('renewalData', array(
            'user_id' => $user->id,
            'files' => json_encode($files_list)
        ));

        $product_id = Config::get('subscriptionPayment.product_id');
        if ($this->trainerIsExpired($user->trainer->expiry_date)) {
            $product_id = Config::get('subscriptionPayment.product_id_penalty');
        }
        /*
        $link = Twocheckout_Charge::link(array(
            'sid'=>Config::get('subscriptionPayment.seller_id'),
            'product_id'=>$product_id,
            'fixed'=>Config::get('subscriptionPayment.fixed'),
            'quantity'=>1,
            'trainer_id'=>$user->trainer->id
        ));

        return Redirect::away($link);
        */
        // Initialize payfort data to be submitted
        $sha_in = Config::get('payfort.SHA_IN');

        Session::put('checkout_trainer_id', $user->trainer->id);
        $ab = Session::put('payment_type', 'renew');
        // dd($ab );

        if ($this->trainerIsExpired($user->trainer->expiry_date)) {
            $amount = (525 * 100);
        } else {
            $amount = (420 * 100);
        }

        $post_data = Input::all();


        if (isset($post_data['avail_insurance'])) {
            $insurance_data = [
                // 'disease' => $post_data['disease'],
                // 'criminal' => $post_data['criminal'],
                // 'negligence' => $post_data['negligence'],
                // 'insurer' => $post_data['insurer'],
                'disease' => 'no',
                'criminal' => 'no',
                'negligence' => 'no',
                'insurer' => 'no',
            ];

            Session::put('insurance_data', $insurance_data);
            $amount += (708.75 * 100);
        }

        $currency = Config::get('payfort.CURRENCY');
        $language = Config::get('payfort.LANGUAGE');
        $order_id = date('mdYHms');
        $pspid = Config::get('payfort.PSPID');

        $email = $user->email;
        $phone = $user->trainer->mobile_phone;
        $comment = 'Customer email: ' . $email . ' Customer mobile: ' . $phone;

        if (Session::get('testmode')) {
            $amount = 100;
        }

        $str = '';
        $str .= 'AMOUNT=' . $amount . $sha_in;
        $str .= 'COM=' . $comment . $sha_in;
        $str .= 'CURRENCY=' . $currency . $sha_in;
        $str .= 'EMAIL=' . $email . $sha_in;
        $str .= 'LANGUAGE=' . $language . $sha_in;
        $str .= 'ORDERID=' . $order_id . $sha_in;
        $str .= 'OWNERTELNO=' . $phone . $sha_in;
        $str .= 'PSPID=' . $pspid . $sha_in;

        $shasign = strtoupper(sha1($str));

        $payfort_data = array(
            'AMOUNT' => $amount,
            'COM' => $comment,
            'CURRENCY' => $currency,
            'EMAIL' => $email,
            'LANGUAGE' => $language,
            'ORDERID' => $order_id,
            'OWNERTELNO' => $phone,
            'PSPID' => $pspid,
            'SHASIGN' => $shasign,
        );
        // dd('here');

        return View::make('payfort.process', $payfort_data, $data1);
    }

    /*
     * Resets Password
     * Created By Jahir @ Cranium Creations
     */
    public function resetPassword()
    {
        $data1['setting'] = DBS::table('setting')->get();
        $user_email = Input::get('email');

        if (Sentry::getUser() && empty($user_email)) {
            $user = Sentry::getUser();
        } else {
            $validator = Validator::make(array('email' => $user_email), array('email' => 'email|required'));
            if ($validator->fails()) {
                return Redirect::to('trainer/forgot-password')->withErrors($validator)->withInput();
            }

            try {
                $user = Sentry::findUserByLogin($user_email);
            } catch (Exception $e) {

                return Redirect::to('trainer/forgot-password')
                    ->with('message', array(
                        'status' => 'error',
                        'text' => $e->getMessage()
                    ))->withInput();
            }
        }

        $resetCode = Trainer::getResetCode($user);

        Mail::send(
            'trainer.mail.changePassword',
            array(
                'resetcode' => $resetCode,
                'firstname' => $user->first_name
            ),
            function ($message) use ($user) {
                $message->to($user->email, $user->first_name)
                    ->subject('Your REPs UAE Reset Password Instructions');
            }
        );

        $data['mail_id'] = $user->email;
        return View::make('trainer.change_pass.changePasswordMessage', $data, $data1);
    }

    /*
     * Resets Password
     * Created By Raj @ Cranium Creations
     */
    public function resetPasswordLink($code)
    {
        $data1['setting'] = DBS::table('setting')->get();
        try {
            $user = Sentry::findUserByResetPasswordCode($code);
        } catch (Exception $e) {
            return Redirect::action('TrainerController@forgotPassword')
                ->with('message', array(
                    'status' => 'error',
                    'text' => 'Password reset code is invalid.
                        Please try resetting your password again.'
                ));
        }
        $data['code'] = $code;

        return View::make('trainer.change_pass.changePassword', $data, $data1);
    }

    /*
     * Change Password
     * Created By Jahir @ Cranium Creations
     */
    public function changePassword()
    {
        $code = Input::get('reset_code');
        $validator = Validator::make(
            array(
                'reset_code' => $code,
                'new_password' => Input::get('new_password')
            ),
            array(
                'reset_code' => 'required',
                'new_password' => 'required|min:8'
            )
        );

        if ($validator->fails()) {
            return Redirect::action('TrainerController@resetPasswordLink', array($code))
                ->withErrors($validator)->withInput();
        } else {
            $resetcode = Input::get('reset_code');
            $new_password = Input::get('new_password');
            try {
                $user = Sentry::findUserByResetPasswordCode($resetcode);
                if ($user->checkResetPasswordCode($resetcode)) {
                    if ($user->attemptResetPassword($resetcode, $new_password)) {

                        // Always log user out if they are reset their password
                        Sentry::logout();
                        $user->password = $new_password;
                        $user->save();

                        return Redirect::action('TrainerController@logIn')
                            ->with('message', array(
                                'status' => 'success',
                                'text' => 'Password has been changed successfully.'
                            ));
                    } else {
                        return Redirect::action('TrainerController@forgotPassword')
                            ->with('message', array(
                                'status' => 'error',
                                'text' => 'Password reset failed. Please try again.'
                            ));
                    }
                } else {
                    return Redirect::action('TrainerController@forgotPassword')
                        ->with('message', array(
                            'status' => 'error',
                            'text' => 'Password reset code is invalid'
                        ));
                }
            } catch (Exception $e) {
                return Redirect::action('TrainerController@forgotPassword')
                    ->with('message', array(
                        'status' => 'error',
                        'text' => 'Password reset code is invalid'
                    ));
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
    public function manage1()
    {
        //get All Trainers
        $trainers = Trainer::getAllTrainers(1);

        $default = array();
        foreach ($trainers as $value) {
            $default[$value->first_name][] = $value->first_name;
            $default[$value->first_name][] = $value->id;
        }

        $paginatedData = $this->paginator($default, 10);

        $data = array(
            'data' =>  $paginatedData['data'],
            'required' => array('Name', 'Action'),
            'edit' => 'users',
            'paginator' =>  $paginatedData['links'],
            'levels' => Trainer::getRegistrationCategory()
        );


        return View::make('trainer.manage', $data);
    }

    /*
     * Manage Trainer page in Admin
     * Created By Sebin @ Cranium Creations
     */
    public function manage()
    {
        return $this->manage_optimized();

        // KEEP THIS FOR NOW
        $expiring_now = Trainer::getExpiringTrainers();
        $expiring_nxt = Trainer::getExpiringTrainersNextMonth();
        $on_process = Trainer::getTrainersByStatusId(3);
        $active = Trainer::getTrainersByStatusIdNotExpired("1,2");

        $default = array();
        $trainerStatus = array(
            '1' => 'Provisional',
            '2' => 'Full',
            '3' => 'Not Allocated'
        );

        //get All Trainers
        $trainers = Trainer::getAllTrainers(1);

        foreach ($trainers as $trainer) {

            // $x = Trainer::getTrainer($trainer->id);
            $levelOfRegCats = array();

            // foreach ($x->trainer->trainerRegistrationCategories as $itm) {
            foreach ($trainer->trainer->trainerRegistrationCategories as $itm) {
                $levelOfRegCats[] = strstr($itm->registrationCategory->level, ':', true);
            }

            $default[] = array(
                'id' => $trainer->id,
                'first_name' => $trainer->first_name,
                'last_name' => $trainer->last_name,
                'expiry_date' => $trainer->trainer->expiry_date,
                'status_id' => $trainerStatus[$trainer->trainer->status_id],
                'levelOfCats' => $levelOfRegCats,
                // 'active' => $x->activated,
                'active' => $trainer->activated,
                'reps_id' => $trainer->trainer->reps_id
            );
        }
        $trainers = [];
        $paginatedData = $this->paginator($default, 15);

        $data = array(
            'data' => $paginatedData['data'],
            'paginator' => $paginatedData['links'],
            'edit' => 'users',
            'levels' => Trainer::getRegistrationCategory(),
            'expiring_now' => $expiring_now->count(),
            'expiring_nxt' => $expiring_nxt->count(),
            'on_process' => $on_process->count(),
            'active' => $active->count(),
            'queryString' => ''
        );

        return View::make('trainer.manage', $data);
    }

    /**
     * By Leo
     */
    public function manage_optimized()
    {
        $expiring_now = 0;
        $expiring_nxt = 0;
        $on_process   = 0;
        $active       = 0;

        $default       = array();
        $trainerStatus = array(
            '1' => 'Provisional',
            '2' => 'Full',
            '3' => 'Not Allocated',
        );
        //Cache::forget('trainers_cache_tmp');
        // if (Cache::has('trainers_cache_tmp')) {
        // $default = Cache::get('trainers_cache_tmp')['default'];
        // } else {
        /* = Trainer::getAllTrainers(1);

            foreach ($trainers as $trainer) {
                $levelOfRegCats = array();

                foreach ($trainer->trainer->trainerRegistrationCategories as $itm) {
                    $levelOfRegCats[] = strstr($itm->registrationCategory->level, ':', true);
                }

                $default[] = array(
                    'id'          => $trainer->id,
                    'first_name'  => $trainer->first_name,
                    'last_name'   => $trainer->last_name,
                    'expiry_date' => $trainer->trainer->expiry_date,
                    'status_id'   => $trainerStatus[$trainer->trainer->status_id],
                    'levelOfCats' => $levelOfRegCats,
                    'active'      => $trainer->activated,
                    'reps_id'     => $trainer->trainer->reps_id,
                );
                $expiry_date = $trainer->trainer->expiry_date;

                if ($trainer->trainer->status_id == 3) {
                    $on_process++;
                } else {
                    if ($expiry_date >= date('Y-m-d')) {
                        $active++;
                    }
                }

                if (date('Ym', strtotime('now')) == date('Ym', strtotime($expiry_date))) {
                    $expiring_now++;
                }
                if (date('Ym', strtotime('first day of +1 month')) == date('Ym', strtotime($expiry_date))) {
                    $expiring_nxt++;
                }
            }*/
        $trainers = [];

        // Cache::put('trainers_cache_tmp', [
        //     'default' => $default,
        //     'on_process' => $on_process,
        //     'active' => $active,
        //     'expiring_now' => $expiring_now,
        //     'expiring_nxt' => $expiring_nxt,
        // ], 60);
        // }

        $paginatedData = $this->paginator($default, 15);

        $data = array(
            'data'         => $paginatedData['data'],
            'paginator'    => $paginatedData['links'],
            'edit'         => 'users',
            'levels'       => Trainer::getRegistrationCategory(),
            // 'expiring_now' => Cache::get('trainers_cache_tmp')['expiring_now'],
            // 'expiring_nxt' => Cache::get('trainers_cache_tmp')['expiring_nxt'],
            // 'on_process'   => Cache::get('trainers_cache_tmp')['on_process'],
            // 'active'       => Cache::get('trainers_cache_tmp')['active'],
            'expiring_now' => Trainer::getExpiringTrainers()->count(),
            'expiring_nxt' => Trainer::getExpiringTrainersNextMonth()->count(),
            'on_process' => Trainer::getTrainersByStatusId(3)->count(),
            'active' => Trainer::getTrainersByStatusIdNotExpired("1,2")->count(),


            'queryString'  => '',
        );

        return View::make('trainer.manage', $data);
    }

    public function refresh()
    {
        Cache::flush();
        return Redirect::back();
    }

    public function encache()
    {
        // manage page encached
        echo "Manage Page Cached<br>";
        $this->manage_optimized();

        // search page encached
        $query_templates = [
            ['expire' => '-1'],
            ['expire' => '0'],
            ['expire' => '1'],
            ['gender' => '0'],
            ['gender' => '1'],
            ['upgradeRequest' => 'level'],
            ['upgradeRequest' => 'status'],
            ['registrationCategory' => '1'],
            ['registrationCategory' => '2'],
            ['registrationCategory' => '3'],
            ['registrationCategory' => '4'],
            ['registrationCategory' => '5'],
            ['registrationCategory' => '6'],
            ['registrationCategory' => '7'],
            ['registrationCategory' => '8'],
            ['trainerStatus' => '1'],
            ['trainerStatus' => '2'],
            ['trainerStatus' => '3'],
            ['trainerAge' => '1'],
            ['trainerAge' => '2'],
            ['trainerAge' => '3'],
            ['trainerAge' => '4'],
            ['trainerAge' => '5'],
            ['trainerAge' => '6'],
        ];
        foreach ($query_templates as $query_template) {
            foreach ($query_template as $key => $query) {
                $url = 'http://www.repsuae.com/encache-search?' . $key . '=' . $query;

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url,
                    CURLOPT_USERAGENT => 'REPS Caching CRON'
                ));

                $resp = curl_exec($curl);

                curl_close($curl);

                echo 'Cached: ' . $url . '<br>';
            }
        }
    }

    public function encache_search()
    {
        return $this->trainerSearch();
    }

    /*
     * Search trainers in Admin
     * Created By Sebin @ Cranium Creations
     */
    public function trainerSearch()
    {
        $data = Input::get();

        $query = array();

        if (isset($data['trainer']) && $data['trainer'] != "") {
            $query['trainer'] = trim($data['trainer']);
        }

        if (isset($data['gender']) && $data['gender'] != "") {
            $query['gender'] = $data['gender'];
        }

        if (isset($data['upgradeRequest']) && $data['upgradeRequest'] != "") {
            $query['upgradeRequest'] = $data['upgradeRequest'];
        }

        if (isset($data['registrationCategory']) && $data['registrationCategory'] != "") {
            $query['registrationCategory'] = $data['registrationCategory'];
        }

        if (isset($data['trainerStatus']) && $data['trainerStatus'] != "") {
            $query['trainerStatus'] = $data['trainerStatus'];
        }

        if (isset($data['trainerAge']) && $data['trainerAge'] != "") {
            $query['trainerAge'] = $data['trainerAge'];
        }

        if (isset($data['trainerType']) && $data['trainerType'] != "") {
            $query['trainerType'] = $data['trainerType'];
        }

        if (isset($data['expire']) && $data['expire'] != "") {
            $query['expire'] = $data['expire'];
        }

        $queryString = '';
        foreach ($query as $k => $v) {
            $queryString .= "$k=$v&";
        }
        if ($queryString != "") {
            $queryString = "?" . $queryString;
        }

        $default = array();
        $trainerStatus = array(
            '1' => 'Provisional',
            '2' => 'Full',
            '3' => 'Not Allocated'
        );

        if (isset($data) && !empty($data)) {
            $cache_key = implode('-', $query);
            if (Cache::has($cache_key)) {
                $default = Cache::get($cache_key);
            } else {

                $trainers = Trainer::adminSearchTrainers($data);
                foreach ($trainers as $trainer) {
                    $x = Trainer::getTrainer($trainer->id);
                    $levelOfRegCats = array();

                    foreach ($x->trainer->trainerRegistrationCategories as $itm) {
                        $levelOfRegCats[] = strstr($itm->registrationCategory->level, ':', true);
                    }

                    $default[] = array(
                        'id' => $trainer->id,
                        'first_name' => $trainer->first_name,
                        'last_name' => $trainer->last_name,
                        'expiry_date' => $trainer->expiry_date,
                        'status_id' => $trainerStatus[$trainer->status_id],
                        'levelOfCats' => $levelOfRegCats,
                        'active' => $x->activated,
                        'reps_id' => $x->trainer->reps_id
                    );
                }

                Cache::put($cache_key, $default, 60);
            }
        }

        $paginatedData = $this->paginator($default, 15, $query);

        $expiring_now = Trainer::getExpiringTrainers();
        $expiring_nxt = Trainer::getExpiringTrainersNextMonth();
        $on_process = Trainer::getTrainersByStatusId(3);
        $active = Trainer::getTrainersByStatusIdNotExpired("1,2");

        $params = array(
            'data' =>  $paginatedData['data'],
            'paginator' =>  $paginatedData['links'],
            'edit' => 'users',
            'levels' => Trainer::getRegistrationCategory(),
            'expiring_now' => $expiring_now->count(),
            'expiring_nxt' => $expiring_nxt->count(),
            'on_process' => $on_process->count(),
            'active' => $active->count(),
            'q' => $query,
            'queryString' => $queryString
        );

        return View::make('trainer.manage', $params);
    }

    /**
     * trainer Personal Details form
     * Created By Jahir @Cranium Creations
     * Modified By Kevin @ Cranium Creations
     */
    public function trainerPersonalDetailsForm()
    {

        $data1['setting'] = DBS::table('setting')->get();
        //added to ensure no current trainer is logged
        //in during registration to avoid errors
        Sentry::logout();

        //Get all nationalities
        $default = Nationality::getAll();
        $nationality = array();
        foreach ($default as $value) {
            $nationality[$value->id] = $value->name;
        }

        $data =  array(
            'nationality' => $nationality,
            'mediaTypes' =>  MediaType::getAll(),
            'gender' => array(
                'Male',
                'Female',
            ),
            'options' => array(
                'something',
                'something',
                'something'
            )
        );

        return View::make('trainer.addPersonalDetails', $data, $data1);
    }

    /**
     * trainer Work Experience form
     * Created By Kevin @Cranium Creations
     */
    public function trainerWorkExperienceForm()
    {
        $data1['setting'] = DBS::table('setting')->get();
        $errors = Session::get('workExpErrors');
        $data = array(
            'countries' => Country::lists('name', 'id'),
            'regCategory' => Trainer::getRegistrationCategory(),
            'work_place' => $errors['work_place'],
            'errors' => (isset($errors['errors']['messageBag']) ?
                $errors['errors']['messageBag'] : '')
        );

        //forget the old input
        Session::forget('_old_input.work_place');

        return View::make('trainer.addWorkExperience', $data, $data1)
            ->withErrors($data['errors']);
    }

    /**
     * trainer Qualifications form
     * Created By Kevin @Cranium Creations
     */
    public function trainerQualificationForm()
    {
        $data1['setting'] = DBS::table('setting')->get();
        $errors = Session::get('qualificationErrors');
        $oldData = Session::get('oldData');

        $data = array(
            'errors' => $errors,
            'oldData' => $oldData
        );

        //forget the old input
        Session::forget('_old_input');

        return View::make('trainer.addQualification', $data, $data1);
    }

    /**
     * registration/update success api back form
     * Created By Kevin @ Cranium Creations
     */
    public function success()
    {
        $data['setting'] = DBS::table('setting')->get();
        return View::make('trainer.success', $data);
    }

    /**
     * registration/update success api back form
     * Created By Raj @ Cranium Creations
     */
    public function renewed()
    {
        $data['setting'] = DBS::table('setting')->get();
        return View::make('trainer.renewed', $data);
    }

    private function validateUserData($data)
    {

        $validator = Validator::make(
            array(
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'password' => isset($data['password']) ? $data['password'] : '',
                'email' => isset($data['email']) ? $data['email'] : '',
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

                return array('status' => false);
            }
        }
    }

    /**
     * save trainer Details
     * Created By Kevin @Cranium Creations
     */
    public function save()
    {

        Log::channel('renew_registration')->info('save trainer Details');

        $data1['setting'] = DBS::table('setting')->get();
        switch (Input::get('form')) {
            //catch the Personal Details form

            case 'Personal Details':

                $data = Input::get();
                // dd($data);

                $data['photo'] = Input::file('photo');
                $data['image'] = Input::file('image');
                // $data['e_certificate'] = Input::file('e_certificate');
                // dd( $data['image']);

                //validate trainer personal details fields
                $errors = Trainer::validatePersonalDetails($data);


                //validate user details
                //$userErrors = $this->validateUser($data);
                $userErrors = $this->validateUserData($data);

                //check if there are no errors
                if ($errors['status']) {
                    //check if there are userErrors
                    if ($userErrors['status']) {
                        //merge error Messages
                        $errors['messageBag'] = $errors['messageBag']->merge($userErrors['messageBag']->getMessages());
                    }


                    $userErrors = null;

                    return Redirect::to('trainer/registration')->withInput()->withErrors($errors['messageBag']);
                }

                if ($userErrors['status']) {
                    return Redirect::to('trainer/registration')->withInput()->withErrors($userErrors['messageBag']);
                }

                //$data['passport'] = $this->getTmpFiles($_FILES['passport']);
                $data['photo'] = $this->getTmpFiles($_FILES['photo']);
                $data['image'] = $this->getTmpFiles($_FILES['image']);
                // $data['e_certificate'] = $this->getTmpFiles($_FILES['e_certificate']);

                //save the data in the session
                Session::put('trainerDetails', $data);


                //create tmp folder with files
                //$result = $this->createTmpFiles($data['passport'],'passport');
                $result = $this->createTmpFiles($data['photo'], 'photo');
                $this->createTmpFiles($data['image'], 'image');
                // $this->createTmpFiles($data['e_certificate'],'e_certificate');

                if ($result) {
                    return Redirect::action('TrainerController@trainerWorkExperienceForm');
                } else {
                    return Redirect::action('TrainerController@trainerPersonalDetailsForm');
                }

                break;

            //catch the Work Experience Form
            case 'Work Experience':

                $data = Input::get();
                $data['cv'] = Input::file('cv');

                //validate trainer work experience fields
                $errorsWorkExp = Trainer::validateWorkExperience($data);

                //check multiple text box field for work_place
                $workPlaceErrors = array(
                    'empty' => $this->validateMulipleTextBox($data['work_place']),
                    'validData' => $this->validateAlplaSpaces($data['work_place'])
                );

                //validate trainer registration category fields
                if (isset($data['registration_category_id'])) {
                    $errorsRegCat = Trainer::validateRegistationCategory($data['registration_category_id']);
                } else {
                    $errorsRegCat = Trainer::validateRegistationCategory(array());
                }

                //prepare errors to send to the view
                if (
                    $errorsWorkExp['status'] || $workPlaceErrors['empty']['status'] ||
                    $workPlaceErrors['validData']['status']
                ) {
                    $errors = array();
                    if ($errorsWorkExp['status'] && $errorsRegCat['status']) {
                        $errors['status'] = $errorsWorkExp['status'];
                        $errors['messageBag'] = $errorsWorkExp['messageBag']
                            ->merge($errorsRegCat['messageBag']->getMessages());
                    } else if ($errorsRegCat['status']) {
                        $errors['status'] = $errorsRegCat['status'];
                        $errors['messageBag'] = $errorsRegCat['messageBag'];
                    } else if ($errorsWorkExp['status']) {
                        $errors['messageBag'] = $errorsWorkExp['messageBag'];
                    }

                    $errorData = array(
                        'work_place' => $workPlaceErrors,
                        'errors' => $errors
                    );

                    Session::flash('workExpErrors', $errorData);

                    return Redirect::action('TrainerController@trainerWorkExperienceForm');
                } else {
                    //get session data
                    $userData = Session::get('trainerDetails');

                    $userData['work_place'] = $data['work_place'];
                    $userData['cv'] = $this->getTmpFiles($_FILES['cv']);
                    $userData['registration_cateogry_id'] = $data['registration_category_id'];
                    $userData['job_title'] = $data['job_title'];
                    $userData['country_id'] = $data['country_id'];

                    //save the data in the session
                    Session::put('trainerDetails', $userData);

                    //create tmp folder with files
                    $result = $this->createTmpFiles($userData['cv'], 'cv');

                    if ($result) {
                        return Redirect::action('TrainerController@trainerQualificationForm');
                    } else {
                        return Redirect::action('TrainerController@trainerWorkExperienceForm');
                    }
                }

                break;

            //catch the Qualifications Form
            case 'Qualifications':

                $post_data = Input::all();

                $insurance_fee = 0;

                if (isset($post_data['avail_insurance'])) {
                    // dd($post_data['avail_insurance']);
                    $insurance_data = [
                        'disease' => $post_data['disease'],
                        'criminal' => $post_data['criminal'],
                        'negligence' => $post_data['negligence'],
                        'insurer' => $post_data['insurer'],
                    ];

                    Session::put('insurance_data', $insurance_data);
                    $insurance_fee = 708.75;
                }

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
                for ($i = 0; $i < count($courseName); $i++) {
                    $data[$i] = array(
                        'course_name' => $courseName[$i],
                        'course_provider' => $courseProvider[$i],
                        'date_completed' => $dateCompleted[$i],
                        'certificates' => $this->getTmpFiles($_FILES['certificates' . $i]),
                        'laravelCert' => $certificates[$i],
                    );
                }

                //get all errors for the form

                $errors = Trainer::validateQualifications($data);

                //check all errors
                $default = array();
                if ($errors['status']) {
                    //save Errors in session data
                    Session::flash('qualificationErrors', $errors['errors']);

                    //unset files
                    foreach ($data as &$value) {
                        unset($value['laravelCert']);
                    }

                    //save the old data
                    Session::flash('oldData', $data);

                    //redirect
                    return Redirect::action('TrainerController@trainerQualificationForm');
                } else {
                    //unset files
                    foreach ($data as &$value) {
                        unset($value['laravelCert']);
                    }

                    $userData['qualifications'] = $data;

                    //save the data in the session
                    Session::put('trainerDetails', $userData);

                    //create tmp folder with files
                    for ($i = 0; $i < count($data); $i++) {
                        for ($j = 0; $j < count($data[$i]['certificates']); $j++) {
                            $result = $this->createTmpFiles($data[$i]['certificates'][$j], 'certificate');
                        }
                    }
                }

                $trainer = Session::get('trainerDetails');

                if (empty($trainer)) {
                    Log::info('No trainer data' . date('Y-m-d H:i:s'));
                    return Redirect::to('trainer/registration-info')->withErrors(['msg' => 'Something went wrong, Please try again.']);
                }
                //                Trainer::save();
                //                return Redirect::action('TrainerController@success');
                $checkTempTrainer = Trainer::getTempTrainerByEmail($trainer['email']);
                if (!empty($checkTempTrainer)) {
                    //                    $checkTempTrainer->delete();
                    Trainer::deleteTempTrainerByEmail($trainer['email']);
                }

                Trainer::createTempTrainer(array(
                    'email'     => $trainer['email'],
                    'json_data' => json_encode($trainer)
                ));

                file_put_contents(
                    Config::get('tmp.tmpPath') . '/record.txt',
                    PHP_EOL . json_encode($trainer) . PHP_EOL,
                    FILE_APPEND | LOCK_EX
                );

                $email = $trainer['email'];
                $phone = $trainer['mobile_phone'];

                $comment = 'Customer email: ' . $email;
                $comment .= ' Customer mobile: ' . $phone;
                $comment .= $insurance_fee != 0 ? ' (Insurance availed)' : '';


                /*
                $args = array(
                    'sid'=>Config::get('subscriptionPayment.seller_id'),
                    'product_id'=>Config::get('subscriptionPayment.product_id'),
                    'fixed'=>Config::get('subscriptionPayment.fixed'),
                    'quantity'=>1,
                    'user_email'=>$trainer['email']
                );

                $link = Twocheckout_Charge::link($args);

                return Redirect::away($link);
                */

                // initialize payfort data
                $sha_in = Config::get('payfort.SHA_IN');

                Session::put('checkout_email', $trainer['email']);
                Session::put('payment_type', 'new');

                // $amount = (420 * 100) + ($insurance_fee * 100); // amount 420 for new registration
                $amount = ((420 + $insurance_fee) * 100);
                if ($insurance_fee != 0) {
                    // $amount = 113000;
                    $amount = 112875;
                } else {
                    $amount = 42000;
                }
                if (Session::get('testmode')) {
                    $amount = 100;
                }
                //$amount = 100;
                // echo $amount; die();
                // $amount = (401 * 100);
                // echo $amount; die();
                $currency = Config::get('payfort.CURRENCY');
                $language = Config::get('payfort.LANGUAGE');
                $order_id = date('mdYHms');
                $pspid = Config::get('payfort.PSPID');

                $str = '';
                $str .= 'AMOUNT=' . $amount . $sha_in;
                $str .= 'COM=' . $comment . $sha_in;
                $str .= 'CURRENCY=' . $currency . $sha_in;
                $str .= 'EMAIL=' . $email . $sha_in;
                $str .= 'LANGUAGE=' . $language . $sha_in;
                $str .= 'ORDERID=' . $order_id . $sha_in;
                $str .= 'OWNERTELNO=' . $phone . $sha_in;
                $str .= 'PSPID=' . $pspid . $sha_in;

                $shasign = strtoupper(sha1($str));

                $payfort_data = array(
                    'AMOUNT' => $amount,
                    'COM' => $comment,
                    'CURRENCY' => $currency,
                    'EMAIL' => $email,
                    'LANGUAGE' => $language,
                    'ORDERID' => $order_id,
                    'OWNERTELNO' => $phone,
                    'PSPID' => $pspid,
                    'SHASIGN' => $shasign,

                );

                // dd($payfort_data);

                return View::make('payfort.process', $payfort_data, $data1);

                break;

            //catch payment Completion
            case 'Payment Completed':

                Log::info('payment completed' . date('Y-m-d H:i:s'));
                //save all Trainer details from session
                $result = Trainer::save();

                return Redirect::action('TrainerController@success');

                break;

            default:
                //no case true
                echo "Saving failed";
                break;
        }
    }

    // payfort response callback
    public function paymentResponse($response)
    {


        // if (Session::get('testmode') == 'leo') {
        return $this->paymentResponse2($response);
        // }

        //dd($_REQUEST);
        if ($response == 'success') {

            // Verify response data
            $response = Input::all();
            $sha_out = Config::get('payfort.SHA_IN');
            uksort($response, 'strcasecmp');

            $shasign = '';
            foreach ($response as $key => $value) {
                if ($value == '') continue;
                if ($key == 'SHASIGN') {
                    continue;
                }
                $str = strtoupper($key) . '=' . $value . $sha_out;
                $shasign .= $str;
            }
            // Digest must match the response shasign
            $shasign = strtoupper(sha1($shasign));

            // if($shasign == Input::get('SHASIGN')) {
            if (Input::get('SHASIGN')) {

                $input = array(
                    'sid'         => Input::get('SHASIGN'),
                    'total'       => Input::get('amount'),
                    'order_number' => Input::get('orderID'),
                    'key'         => Input::get('SHASIGN'),
                    'email'       => Session::get('checkout_email'),
                    'invoice_id'  => Input::get('PAYID')
                );

                $payment_type = Session::get('payment_type');

                if ($payment_type == 'new') {

                    $input['user_email'] = Session::get('checkout_email');

                    $trainerTemp = Trainer::getTempTrainerByEmail(Session::get('checkout_email'));

                    if (empty($trainerTemp)) {
                        $msg = "The data corresponding to the registration mail you used is missing.  Please contact REPs UAE (faisal.ayaz@sigmads.com) immediately.";
                        return View::make('trainer.paymenterror')->with('message', $msg);
                    } else {

                        $tempData = json_decode($trainerTemp->json_data, true);
                        Session::put('trainerDetails', $tempData);
                        Trainer::deleteTempTrainerByEmail(Session::get('checkout_email'));
                    }

                    Trainer::save();

                    $trainer = Session::get('trainerDetails');
                    $user = Sentry::findUserByLogin(Session::get('checkout_email'));

                    $user->trainer->expiry_date = date('Y-m-t', strtotime('+1 year', strtotime($user->trainer->created_at)));
                    $user->trainer->save();

                    $input['trainer_id'] = $user->trainer->id;
                    $input['order_number'] = Input::get('orderID');

                    $r = $input;
                    $r['processStatus'] = 1;

                    $this->addPayment($user->trainer, $r);

                    $this->notifyAdminPayment($user, $input);
                    $this->notifyTrainerRegistrationSuccess($user, $input);

                    $head = 'Payment done';
                    $message = 'Your transaction has been successful! Your registration will be reviewed for approval.';
                } else if ($payment_type == 'renew') {
                    //dd($trainer->users->email);

                    $trainer_id = Session::get('checkout_trainer_id');
                    $trainer = Users::getTrainerById($trainer_id);

                    if (empty($trainer)) {
                        return View::make('trainer.paymenterror')->with('message', 'Trainer Id is invalid.');
                    }

                    $renewalData = Session::get('renewalData');

                    date_default_timezone_set('Asia/Dubai');
                    $writeData = PHP_EOL . PHP_EOL . PHP_EOL . "----------------";
                    $writeData .= PHP_EOL . "Date: " . date("Y-m-d h:i:s a");
                    $writeData .= PHP_EOL . "UserId: " . $trainer->users->id;

                    if (!empty($renewalData) && !empty($renewalData['files'])) {
                        $certificates = json_decode($renewalData['files']);
                        $writeData .= PHP_EOL . "Certificates: " . $renewalData['files'];
                    } else {
                        $certificates = "";
                        $writeData .= PHP_EOL . "Certificates: None found.";
                    }

                    file_put_contents(Config::get('tmp.tmpPath') . '/record.txt', $writeData, FILE_APPEND | LOCK_EX);

                    $input['trainer_id'] = $trainer_id;
                    $input['user_email'] = $trainer->users->email;

                    $user = Sentry::findUserById($trainer->users->email);

                    // $user->trainer->expiry_date = $this->extendExpiry($user->trainer);
                    // $user->trainer->save();

                    $this->addPayment($user->trainer, $input, $certificates);

                    $this->notifyAdminPayment($user, $input, true);

                    Session::forget('renewalData');


                    $insurance_data = Session::get('insurance_data');
                    if (isset($insurance_data['disease'])) {
                        if ($insurance_data['disease'] != '') {
                            // $trainer_data->avail_insurance = 1;
                            // $trainer_data->disease = $insurance_data['disease'];
                            // $trainer_data->criminal = $insurance_data['criminal'];
                            // $trainer_data->negligence = $insurance_data['negligence'];
                            // $trainer_data->insurer = $insurance_data['insurer'];

                            \DB::table('trainer')->where('id', '=', $trainer_id)->update([
                                'avail_insurance' => 1,
                                'disease' => $insurance_data['disease'],
                                'criminal' => $insurance_data['criminal'],
                                'negligence' => $insurance_data['negligence'],
                                'insurer' => $insurance_data['insurer'],
                            ]);
                        }
                    } else {
                        \DB::table('trainer')->where('id', '=', $trainer_id)->update([
                            'avail_insurance' => 0,
                        ]);
                    }
                    Session::put('insurance_data', []);

                    // $msgdd = 'Success!&nbsp;&nbsp;Your payment has been noted and is awaiting review from a REPs administrator.  Please wait 2 to 3 days for processing.';
                    // return Redirect::action('TrainerController@renewRegistration')->with('message',$msgdd);
                    $head = 'Renewal is on Process';
                    $message = 'Your payment has been noted and is awaiting review from a REPs administrator. Please wait 2 to 3 days for processing.';
                } else if ($payment_type == 'insurance') {
                    // no necessary actions on this
                    $head = 'Insurance Registration is on Process';
                    $message = 'Your payment has been noted and is awaiting review from a REPs administrator. Please wait 2 to 3 days for processing.';
                } else {
                    $msg = Config::get('subscriptionPayment.msg_fail');
                    return View::make('trainer.paymenterror')->with('message', $msg);
                }
            } else {
                $head = 'Invalid Response';
                $message = 'The transaction response from the payment gateway is invalid.';
            }
        } else if ($response == 'decline') {
            $head = 'Payment declined';
            $message = 'Your transaction has been declined!';
        } else if ($response == 'cancel') {
            $head = 'Payment canceled';
            $message = 'Your transaction has been canceled!';
        } else {
            $head = 'Payment error';
            $message = 'An error has occurred during the process!';
        }


        return Redirect::action('TrainerController@response_page', [$head, $message]);
    }

    // payfort response callback
    public function paymentResponse2($response)
    {
        //Log data
        date_default_timezone_set('Asia/Dubai');
        $writeData = PHP_EOL . PHP_EOL . PHP_EOL . "----------------";
        $writeData .= json_encode(Session::all());
        //$writeData .= PHP_EOL . "Session: " . json_encode($_SESSION);
        file_put_contents(Config::get('tmp.tmpPath') . '/sessiontracelogs.txt', $writeData, FILE_APPEND | LOCK_EX);


        if (Input::get('order_description') != 'REPS Membership') {
            return View::make('payfort.redirect-away', [
                'response' => Input::all(),
            ]);
        }

        //dd($_REQUEST);
        if ($response == 'success') {
            // Verify response data
            $response = Input::all();
            $sha_out = Config::get('payfort.SHA_IN');
            uksort($response, 'strcasecmp');

            $shasign = '';
            foreach ($response as $key => $value) {
                if ($value == '') continue;
                if ($key == 'SHASIGN') {
                    continue;
                }
                $str = strtoupper($key) . '=' . $value . $sha_out;
                $shasign .= $str;
            }
            // Digest must match the response shasign
            $shasign = strtoupper(sha1($shasign));

            // if($shasign == Input::get('SHASIGN')) {
            if (Input::get('signature')) {

                $input = array(
                    'sid'         => Input::get('signature'),
                    'total'       => Input::get('amount'),
                    'order_number' => Input::get('merchant_reference'),
                    'key'         => Input::get('signature'),
                    'email'       => Session::get('customer_email'),
                    'invoice_id'  => Input::get('fort_id')
                );

                $payment_type = Session::get('payment_type');

                if ($payment_type == 'new') {

                    $input['user_email'] = Session::get('checkout_email');

                    $trainerTemp = Trainer::getTempTrainerByEmail(Session::get('checkout_email'));

                    if (empty($trainerTemp)) {
                        $msg = "The data corresponding to the registration mail you used is missing.  Please contact REPs UAE (faisal.ayaz@sigmads.com) immediately.";
                        return View::make('trainer.paymenterror')->with('message', $msg);
                    } else {

                        $tempData = json_decode($trainerTemp->json_data, true);
                        Session::put('trainerDetails', $tempData);
                        Trainer::deleteTempTrainerByEmail(Session::get('checkout_email'));
                    }

                    Trainer::save();

                    $trainer = Session::get('trainerDetails');
                    $user = Sentry::findUserByLogin(Session::get('checkout_email'));

                    $user->trainer->expiry_date = date('Y-m-t', strtotime('+1 year', strtotime($user->trainer->created_at)));
                    $user->trainer->save();

                    $input['trainer_id'] = $user->trainer->id;
                    // $input['order_number'] = Input::get('orderID');
                    $input['order_number'] = Input::get('merchant_reference');

                    $r = $input;
                    $r['processStatus'] = 1;

                    $this->addPayment($user->trainer, $r);

                    $this->notifyAdminPayment($user, $input);
                    $this->notifyTrainerRegistrationSuccess($user, $input);

                    $head = 'Payment done';
                    $message = 'Your transaction has been successful! Your registration will be reviewed for approval.';
                } else if ($payment_type == 'renew') {
                    // dd('here');

                    $trainer_id = Session::get('checkout_trainer_id');
                    $trainer = Users::getTrainerById($trainer_id);

                    if (empty($trainer)) {
                        return View::make('trainer.paymenterror')->with('message', 'Trainer Id is invalid.');
                    }

                    $renewalData = Session::get('renewalData');

                    date_default_timezone_set('Asia/Dubai');
                    $writeData = PHP_EOL . PHP_EOL . PHP_EOL . "----------------";
                    $writeData .= PHP_EOL . "Date: " . date("Y-m-d h:i:s a");
                    $writeData .= PHP_EOL . "UserId: " . $trainer->users->id;

                    if (!empty($renewalData) && !empty($renewalData['files'])) {
                        $certificates = json_decode($renewalData['files']);
                        $writeData .= PHP_EOL . "Certificates: " . $renewalData['files'];
                    } else {
                        $certificates = "";
                        $writeData .= PHP_EOL . "Certificates: None found.";
                    }

                    file_put_contents(Config::get('tmp.tmpPath') . '/record.txt', $writeData, FILE_APPEND | LOCK_EX);

                    $input['trainer_id'] = $trainer_id;
                    $input['user_email'] = $trainer->users->email;

                    $user = Sentry::findUserByLogin($trainer->users->email);

                    // $user->trainer->expiry_date = $this->extendExpiry($user->trainer);
                    // $user->trainer->save();

                    $this->addPayment($user->trainer, $input, $certificates);

                    $this->notifyAdminPayment($user, $input, true);

                    Session::forget('renewalData');


                    $insurance_data = Session::get('insurance_data');
                    if (isset($insurance_data['disease'])) {
                        if ($insurance_data['disease'] != '') {
                            // $trainer_data->avail_insurance = 1;
                            // $trainer_data->disease = $insurance_data['disease'];
                            // $trainer_data->criminal = $insurance_data['criminal'];
                            // $trainer_data->negligence = $insurance_data['negligence'];
                            // $trainer_data->insurer = $insurance_data['insurer'];

                            \DB::table('trainer')->where('id', '=', $trainer_id)->update([
                                'avail_insurance' => 1,
                                'disease' => $insurance_data['disease'],
                                'criminal' => $insurance_data['criminal'],
                                'negligence' => $insurance_data['negligence'],
                                'insurer' => $insurance_data['insurer'],
                            ]);
                        }
                    } else {
                        \DB::table('trainer')->where('id', '=', $trainer_id)->update([
                            'avail_insurance' => 0,
                        ]);
                    }
                    Session::put('insurance_data', []);

                    // $msgdd = 'Success!&nbsp;&nbsp;Your payment has been noted and is awaiting review from a REPs administrator.  Please wait 2 to 3 days for processing.';
                    // return Redirect::action('TrainerController@renewRegistration')->with('message',$msgdd);
                    $head = 'Renewal is on Process';
                    $message = 'Your payment has been noted and is awaiting review from a REPs administrator. Please wait 2 to 3 days for processing.';
                } else if ($payment_type == 'insurance') {
                    // no necessary actions on this
                    $head = 'Insurance Registration is on Process';
                    $message = 'Your payment has been noted and is awaiting review from a REPs administrator. Please wait 2 to 3 days for processing.';
                } else {
                    $msg = Config::get('subscriptionPayment.msg_fail');
                    return View::make('trainer.paymenterror')->with('message', $msg);
                }
            } else {
                $head = 'Invalid Response';
                $message = 'The transaction response from the payment gateway is invalid.';
            }
        } else if ($response == 'decline') {
            $head = 'Payment declined';
            $message = 'Your transaction has been declined!';
        } else if ($response == 'cancel') {
            $head = 'Payment canceled';
            $message = 'Your transaction has been canceled!';
        } else {
            $head = 'Payment error';
            $message = 'An error has occurred during the process!';
        }


        return Redirect::action('TrainerController@response_page', [$head, $message]);
    }

    public function response_page($head, $message)
    {

        $data = array(
            'head' => $head,
            'message' => $message,
        );
        $data1['setting'] = DBS::table('setting')->get();

        return View::make('payfort.response', $data, $data1);
    }

    public function complete_pay()
    {

        $input = array(
            'sid'         => Input::get('sid'),
            'total'       => Input::get('total'),
            'order_number' => Input::get('order_number'),
            'key'         => Input::get('key'),
            'email'       => Input::get('email'),
            'invoice_id'  => Input::get('invoice_id')
        );
        $data1['setting'] = DBS::table('setting')->get();

        $validator = Validator::make(
            $input,
            array(
                'sid' => 'required',
                'total' => 'required',
                'order_number' => 'required',
                'key' => 'required',
            )
        );

        if ($validator->fails()) {
            $msg = Config::get('subscriptionPayment.msg_baddata');
            return View::make('trainer.paymenterror')->with('message', $msg, $data1);
        }

        $order_num = Input::get('order_number');

        //        if (Input::get('demo') == 'Y') { // REMOVE DURING ACTUAL DEPLOYMENT. THIS IS FOR USE IN DEMO ONLY!!!
        //            $order_num = '1';
        //        }

        $input['order_number'] = $order_num;

        $secret_key = Config::get('subscriptionPayment.2o_secret_key');
        $ok_response = Config::get('subscriptionPayment.response_ok');

        $passback = Twocheckout_Return::check($input, $secret_key, 'array');

        if (!empty($passback['response_code']) && $passback['response_code'] === $ok_response) {

            $allInput = Input::all();

            Trainer::createPaymentTrace(json_encode($allInput));

            //check payment history if passed params are already existing.
            $chk = Trainer::getSubscriptionPaymentByInvoiceId($order_num);

            if ($chk->count() > 0) {
                $msg = Config::get('subscriptionPayment.msg_copy');
                return View::make('trainer.paymenterror')->with('message', $msg);
            }

            $user_email = Input::get('user_email'); //for registration payment
            $trainer_id = Input::get('trainer_id'); //for trainer subscription renewal
            $renewal_success = false;

            if (!empty($user_email)) {

                $trainerTemp = Trainer::getTempTrainerByEmail($user_email);

                if (empty($trainerTemp)) {
                    $msg = "The data corresponding to the registration mail you used is missing.  Please contact REPs UAE (faisal.ayaz@sigmads.com) immediately.";
                    return View::make('trainer.paymenterror')->with('message', $msg);
                } else {

                    $tempData = json_decode($trainerTemp->json_data, true);
                    Session::put('trainerDetails', $tempData);
                    //                    $trainerTemp->delete();
                    Trainer::deleteTempTrainerByEmail($user_email);
                }

                Trainer::save();
                $input['user_email'] = $user_email;

                $trainer = Session::get('trainerDetails');
                $user = Sentry::findUserByLogin($trainer['email']);

                $user->trainer->expiry_date = date('Y-m-t', strtotime('+1 year', strtotime($user->trainer->created_at)));
                $user->trainer->save();

                $input['trainer_id'] = $user->trainer->id;

                $r = $input;
                $r['processStatus'] = 1;

                $this->addPayment($user->trainer, $r);

                $this->notifyAdminPayment($user, $input);
                $this->notifyTrainerRegistrationSuccess($user, $input);

                return Redirect::action('TrainerController@success');
            } else if (!empty($trainer_id)) {

                $trainer = Users::getTrainerById($trainer_id);

                if (empty($trainer)) {
                    return View::make('trainer.paymenterror', $data1)->with('message', 'Trainer Id is invalid.');
                }

                $renewalData = Session::get('renewalData');

                date_default_timezone_set('Asia/Dubai');
                $writeData = PHP_EOL . PHP_EOL . PHP_EOL . "----------------";
                $writeData .= PHP_EOL . "Date: " . date("Y-m-d h:i:s a");
                $writeData .= PHP_EOL . "UserId: " . $trainer->users->id;

                if (!empty($renewalData) && !empty($renewalData['files'])) {
                    $certificates = json_decode($renewalData['files']);
                    $writeData .= PHP_EOL . "Certificates: " . $renewalData['files'];
                } else {
                    $certificates = "";
                    $writeData .= PHP_EOL . "Certificates: None found.";
                }

                file_put_contents(Config::get('tmp.tmpPath') . '/record.txt', $writeData, FILE_APPEND | LOCK_EX);

                $input['trainer_id'] = $trainer_id;
                $input['user_email'] = $trainer->users->email;

                $user = Sentry::findUserByLogin($trainer->users->email);

                //                $user->trainer->expiry_date = $this->extendExpiry($user->trainer);
                //                $user->trainer->save();

                $this->addPayment($user->trainer, $input, $certificates);

                $this->notifyAdminPayment($user, $input, true);

                Session::forget('renewalData');

                $msgdd = 'Success!&nbsp;&nbsp;Your payment has been noted and is awaiting review from a REPs administrator.  Please wait 2 to 3 days for processing.';
                return Redirect::action('TrainerController@renewRegistration')->with('message', $msgdd);
            }
        } else {
            $msg = Config::get('subscriptionPayment.msg_fail');
            return View::make('trainer.paymenterror')->with('message', $msg);
        }
    }

    private function notifyTrainerRegistrationSuccess($user, $input)
    {
        $data = array(
            'name' => $user->first_name . ' ' . $user->last_name,
            'email' => $user->email,
            'invoice_id' => $input['invoice_id'],
            'trainer_id' => $input['trainer_id']
        );

        Mail::send(
            'emails.registrationNotification',
            $data,
            function ($message) use ($user) {
                $message->to($user->email, $user->first_name + ' ' + $user->last_name)
                    ->subject('Thank you for Registering with REPs UAE.');
            }
        );
    }

    private function notifyAdminPayment($user, $input, $renew = false)
    {

        $data = array(
            'name' => $user->first_name . ' ' . $user->last_name,
            'email' => $user->email,
            'order_number' => $input['order_number'],
            'trainer_id' => $user->trainer->reps_id
        );

        if ($renew) {
            $data['title'] = 'Trainer Registration Payment - Renewal';
            Mail::send(
                'emails.paymentNotification',
                $data,
                function ($message) {
                    $message->to(Config::get('contact.emailContactFrom'), 'REPS Admin 2')
                        ->subject('Trainer Registration Payment - Renewal​');
                }
            );
        } else {
            $data['title'] = 'Trainer Registration Payment';
            Mail::send(
                'emails.paymentNotification',
                $data,
                function ($message) {
                    $message->to(Config::get('contact.emailContactFrom'), 'REPS Admin 2')
                        ->subject('Trainer Registration Payment');
                }
            );
        }
    }

    private function extendExpiry($trainer)
    {

        //        if (strtotime($trainer->expiry_date) < time()) {
        //            return date('Y-m-t', strtotime('+1 year', time()));
        //        }
        return date('Y-m-t', strtotime('+1 year', strtotime($trainer->expiry_date)));
    }

    public function approvePayment($payment_id = '')
    {

        if (empty($payment_id)) {
            return Redirect::action('AdminController@dashboard')->with('message', 'Invalid payment ID.');
        }

        $payment = Trainer::getSubscriptionPaymentById($payment_id);

        if ($payment->count() <= 0) {
            return Redirect::action('AdminController@dashboard')->with('message', 'Invalid payment ID.');
        }

        if ($payment->processStatus == 0) {

            $user = Users::getTrainerById($payment->trainer_id);

            $details = json_decode($payment->details);
            $certificates = $details->certificates;

            $renewalDirectory = public_path() . "/tmp/renewals/" . $user->users->id . "/";
            $moveDirectory = public_path() . "/trainer/" . $user->users->id . "/renewals/";

            if (isset($certificates)) {
                if (is_array($certificates)) {
                    foreach ($certificates as $certificate) {

                        $oldfile = $renewalDirectory . $certificate;
                        $newfile = $moveDirectory . $payment->id . "-" . $certificate;

                        if (!File::isDirectory($moveDirectory)) {
                            File::makeDirectory($moveDirectory, 0775, true);
                        }

                        File::copy($oldfile, $newfile);
                    }
                }
            }

            $payment->processStatus = 1;
            $payment->save();

            $user->expiry_date = $this->extendExpiry($user);
            $user->save();

            $data = array(
                'name' => $user->users->first_name . ' ' . $user->users->last_name,
                'expiry_date' => $user->expiry_date,
            );

            // Send a request to Volution API to save the trainer within the app
            $this->sync_trainer_to_app($user);

            // approve duplicates
            DB::table('subscription_payment')->where('email', '=', $user->users->email)->update(['processStatus' => 1]);

            Mail::send(
                'emails.paymentApprovalNotification',
                $data,
                function ($message) use ($user) {
                    $message->to($user->users->email, $user->users->first_name . ' ' . $user->users->last_name)
                        ->bcc('admin@repsuae.com', 'REPs Admin')
                        ->subject('Your REPs renewal has been approved.');
                }
            );

            return Redirect::action('AdminController@dashboard')->with('message', 'Online Payment has been approved.');
        }

        return Redirect::action('AdminController@dashboard')->with('message', 'Unable to approve.  This has already been approved previously.');
    }

    /**
     * Send API to Volution to add this trainer within the app now they are approved.
     *
     * @param $user
     */
    private function sync_trainer_to_app($user)
    {
        $trainer = $user;
        $user = $user->users;

        $membership_categories = [];

        // Build membership categories
        foreach ($trainer->trainerRegistrationCategories as $category) {
            array_push($membership_categories, $category->registration_category_id);
        }

        // Build data request
        $data = new \stdClass();

        $data->user_id = $user->id;
        $data->first_name = $user->first_name;
        $data->last_name = $user->last_name;
        $data->email = $user->email;
        $data->password = $user->password;

        $data->status_id = $trainer->status_id;
        $data->dob = $trainer->dob;
        $data->gender = $trainer->gender;
        $data->city = $trainer->city;
        $data->phone = $trainer->mobile_phone;
        $data->expiry_date = $trainer->expiry_date;
        $data->reps_id = $trainer->reps_id;
        $data->photo = $trainer->photo;
        $data->passport_number = $trainer->passport_no;
        $data->membership_categories = $membership_categories;

        $url = 'https://repsuae.volution.fit/api/v1/admin/trainer/create/';

        // Prepare new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // Set HTTP Header for POST request
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen(json_encode($data))
            )
        );

        // Submit the POST request
        //  $result = curl_exec($ch);

        // Close cURL session handle
        curl_close($ch);
    }

    private function addPayment($trainer, $input, $certificates = '')
    {

        $input['certificates'] = '';
        if (!empty($certificates)) {
            $input['certificates'] = $certificates;
        }
        $processStatus = 0;
        if (!empty($input['processStatus'])) {
            $processStatus = $input['processStatus'];
        }

        $trainer->addSubscriptionPayment(array(
            'trainer_id' => $trainer->id,
            'invoice_id' => $input['order_number'],
            'email' => $input['user_email'],
            'details' => json_encode($input),
            'processStatus' => $processStatus
        ));
    }

    public function activateDeactivate($trainer_id = '')
    {

        $return_data = array();

        if (!empty($trainer_id)) {

            $trainer = Trainer::getTrainer($trainer_id);
            $trainer->activated = !$trainer->activated;
            $trainer->save();

            $return_data = array('trainer_status' => $trainer->activated);
        }

        if (Request::ajax()) {
            return Response::json($return_data);
        }
        return Redirect::action('TrainerController@manage');
    }

    /**
     * Trainer Dashboard
     * Created By Kevin @ Cranium Creations
     */
    public function dashboard()
    {
        $laravel = app();
        //$version = $laravel::VERSION;
        //        print_r($version);        die();
        $data1['setting'] = DBS::table('setting')->get();
        $user = Sentry::getUser();
        $upgrade_status = Trainer::getTrainerUpgradeStatusByTrainerIdAndNotProcessed($user->trainer->id);
        $upgrade_category_status = Trainer::getTrainerUpgradeCategoryStatusByTrainerIdAndNotProcessed($user->trainer->id);

        $unallocated = false;
        if ($user->trainer->status_id === 3) {
            $unallocated = true;
        }

        $renew = true;
        if ($user->trainer->status_id == 1) {
            $renew = false;
        }
        $setting['setting'] = DBS::table('setting')->get();
        $user = Sentry::getUser();

        $user_id = $user['id'];
        $e_certificate = DBS::table('trainer')->where('user_id', '=', $user_id)->get();
        //        echo '<pre>';        print_r($e_certificate); exit();
        $data = array(
            'user' => $user,
            'showRenewBtn' => $renew,
            'regCateogry' => Trainer::getRegCategory(),
            'trainerPersonalDetails' => Trainer::getTrainerPersonalDetails(),
            'trainerQualifications' => Trainer::getTrainerQualification(),
            'upgrade_status' => $upgrade_status,
            'upgrade_category_status' => $upgrade_category_status,
            'unallocated' => $unallocated
        );
        //compact('data', 'data1', 'user', 'e_certificate', 'setting')
        return View::make('trainer.dashboard', $data, $data1)->with('e_certificate', $e_certificate);
    }

    /**
     * trainer authenticate
     * Created By Jahir @ Cranium Creations
     * Modified By Kevin @ Cranium Creations
     */
    public function authenticate()
    {
        try {

            // User credentials
            $credentials = array(
                'email'    => Input::get('email'),
                'password' => Input::get('password'),
            );

            // Find the user using the user id
            $user = Sentry::findUserByLogin($credentials['email']);

            // Check if the user is in the administrator group
            if ($user->hasAccess('trainer.dashboard')) {
                // Try to authenticate the user
                $user = Sentry::authenticate($credentials, false);
                return Redirect::action('TrainerController@dashboard');
            } else {
                return Redirect::action('TrainerController@logIn')->withErrors(['Invalid data.']);
            }
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            return Redirect::back()->withErrors(['Login Details are Required to proceed further']);
        } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            return Redirect::back()->withErrors(['User Not Active or your Registration has expired']);
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return Redirect::back()->withErrors(['User Not Found']);
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
    public function updateWorkExperience()
    {

        $userData['work_place'] = Input::get('work_place');
        $userData['cv'] = Input::file('cv');
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
        $data1['setting'] = DBS::table('setting')->get();
        $data = Input::get();
        $data['photo'] = Input::file('photo');
        $data['image'] = Input::file('image');

        //Get all nationalities
        $nations = Nationality::getAll();
        $nationality = array();
        foreach ($nations as $value) {
            $nationality[$value->id] = $value->name;
        }

        $default =  array(
            'nationality' => $nationality,
            'mediaTypes' =>  MediaType::getAll(),
            'gender' => array(
                'Male',
                'Female',
            ),
            'trainer' => Trainer::getTrainerPersonalDetails(),
            'user' => Sentry::getUser()
        );

        if (isset($data['user_id']) && $data['trainer_id']) {
            //validate trainer personal details fields
            $errors = Trainer::validatePersonalDetails($data);

            //validate user details
            $userErrors = $this->validateUser($data);

            //check if there are no errors
            if ($errors['status']) {
                //check if there are userErrors
                if ($userErrors['status']) {
                    //merge error Messages
                    $errors['messageBag'] = $errors['messageBag']
                        ->merge($userErrors['messageBag']->getMessages());
                }

                return View::make('trainer.updatePersonalDetails', $default, $data1)
                    ->withErrors($errors['messageBag']);
            } else if ($userErrors['status']) {
                return View::make('trainer.updatePersonalDetails', $default, $data1)
                    ->withErrors($userErrors['messageBag']);
            } else {

                if (isset($data['photo']) && count($data['photo']) > 0) {
                    $data['photo'] = $this->getTmpFiles($_FILES['photo']);
                }
                if (isset($data['image']) && count($data['image']) > 0) {
                    $data['image'] = $this->getTmpFiles($_FILES['image']);
                }

                $user = Sentry::getUser();
                $name = trim($user->first_name) . ' ' . trim($user->last_name);
                $email = trim($user->email);

                //update trainer details
                if (Trainer::updatePersonalDetails($data)) {
                    return Redirect::action('TrainerController@dashboard');
                }

                $userz = Sentry::getUser();
                $namechanged = trim($userz->first_name) . ' ' . trim($userz->last_name);
                $emailchanged = trim($userz->email);

                $emailData = array();

                if ($name != $namechanged) {
                    $emailData['name'] = $name;
                    $emailData['namechanged'] = $namechanged;
                }

                if ($email != $emailchanged) {
                    $emailData['email'] = $email;
                    $emailData['emailchanged'] = $emailchanged;
                }

                if (!empty($emailData)) {
                    $emailData['name'] = $name;
                    $emailData['reps_id'] = $user->trainer->reps_id;

                    Mail::send(
                        'trainer.mail.user_info_update',
                        $emailData,
                        function ($message) use ($emailData) {
                            $message->to(Config::get('contact.emailContactFrom'), 'Admin')
                                ->subject('Trainer ' . $emailData['name'] .  ' made a profile update!');
                        }
                    );
                }

                return Redirect::action('TrainerController@dashboard');
            }
        } else {
            //create the views
            return View::make('trainer.updatePersonalDetails', $default, $data1);
        }
    }

    /*
     * @param post data
     * gets the search results for trainer
     * Created By Kevin @ Cranium Creations

    public function trainerSearch()
    {
        $input = Input::get();

        $search = Trainer::searchTrainers($input);

        //Get all nationalities
        $nations = Nationality::getAll();
        $nationality = array();
        foreach($nations as $value)
        {
            $nationality[$value->id] = $value->name;
        }

        //create session search data
        Session::put('trainerSearch', $search);

        return Redirect::action('TrainerController@trainerSearchUserIndex');

    } */

    /*
     * @param
     * get index page for triner search for user side
     * Created By Raj @ Cranium Creations
     */
    public function trainerSearchUserIndex()
    {

        $data1['setting'] = DBS::table('setting')->get();

        // die('hihih');
        //nationality array
        $default = Nationality::getAll();
        $nationality = array();
        $nationality[0] = 'Select Nationality';
        foreach ($default as $value) {
            $nationality[$value->id] = $value->name;
        }

        $default = Trainer::getRegistrationCategory();
        $levels = array();
        $levels[0] = 'Registration Category';
        foreach ($default as $value) {
            $levels[$value->id] = $value->level;
        }

        $data = array(
            'nationality' => $nationality,
            'levels' => $levels,
            'gender' => array(
                '' => 'Both',
                '0' => 'Male',
                '1' => 'Female'
            )
        );

        $input = Input::get();



        if (isset($input) && count($input) > 0) {


            $search = Trainer::searchTrainers($input);




            //prepare data for pagiantor
            $paginator = array();
            foreach ($search as $trainer) {
                $x = Trainer::getTrainer($trainer['id']);

                $levelOfRegCats = array();
                foreach ($x->trainer->trainerRegistrationCategories as $itm) {
                    $levelOfRegCats[] = strstr($itm->registrationCategory->level, ':', true);
                    //                    $levelOfRegCats[] = $itm->registrationCategory->level;
                }

                $index = $this->getSlug($trainer['first_name'] . uniqid());

                $paginator[$index][] = $trainer['id'];
                $paginator[$index][] = $trainer['first_name'] . ' ' . $trainer['last_name'];
                $paginator[$index][] = $trainer['level'];
                $paginator[$index][] = $trainer['nationality'];
                $paginator[$index][] = $trainer['photo'];
                $paginator[$index][] = $trainer['name'];
                $paginator[$index][] = $trainer['expiry_date'];
                $paginator[$index][] = $levelOfRegCats;
                $paginator[$index][] = $x->trainer->reps_id;
                $paginator[$index][] = $trainer['city'];
            }


            unset($input['page']); //Fix for paging which show the same page no on all page links.

            $paginatedData = $this->paginator($paginator, 10, $input);

            $data['search'] = $paginatedData['data'];
            $data['paginator'] =  $paginatedData['links'];
            $data['record_count'] = count($search);

            return View::make('trainer.searchTrainer', $data, $data1);
        } else {
            return View::make('trainer.searchTrainer', $data, $data1);
        }
    }

    /**
     * your qualifications Trainer Qualificaations
     * Created By Kevin @ Cranium Creations
     */
    public function yourQualifications()
    {
        $data1['setting'] = DBS::table('setting')->get();
        $data = array(
            'user' => Sentry::getUser(),
            'qualifications' => Trainer::getTrainerQualification()
        );

        return View::make('trainer.updateQualifications', $data, $data1);
    }

    public function E_certificate()
    {

        $setting = DBS::table('setting')->get();
        $user = Sentry::getUser();

        $user_id = $user['id'];
        $e_certificate = DBS::table('trainer')->where('user_id', '=', $user_id)->get();

        return View::make('trainer.E_certificate', compact('user', 'e_certificate', 'setting'));
    }

    public function trainerSearchUsersIndex()
    {
        $input = Input::get();
        $term = Input::get('q');

        if (isset($input) && count($input) > 0) {


            $db = DBS::table('trainer')->join(
                'trainer_registration_category',
                'trainer_registration_category.trainer_id',
                '=',
                'trainer.id'
            )->join(
                'registration_category',
                'trainer_registration_category.registration_category_id',
                '=',
                'registration_category.id'
            )->join(
                'status',
                'status.id',
                '=',
                'trainer.status_id'
            )->leftJoin('trainer_work_experience', 'trainer_work_experience.trainer_id', '=', 'trainer.id')->join('users', 'users.id', '=', 'trainer.user_id')->join('nationality', 'trainer.nationality_id', '=', 'nationality.id')->where('users.first_name', 'LIKE', '%' . $term . '%')
                ->get();



            // ->where('first_name','LIKE','%' . $term . '%')->get();

            $response = array();
            foreach ($db as $autocomplete) {
                $response[] = array(
                    "city" => $autocomplete->city,
                    "label" => $autocomplete->first_name,
                    "label1" => $autocomplete->last_name,
                    "registration_category_id" => $autocomplete->registration_category_id,
                    "gender" => $autocomplete->gender,
                    "nationality_id" => $autocomplete->nationality_id,


                );
            }
            return $response;
        }
    }

    /**
     * renew  trainer  registration
     * Created By Raj @ Cranium Creations
     */
    /*    public function renewRegistration()
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
        $data1['setting'] = DBS::table('setting')->get();
        $workExp = Trainer::getTrainerWorkExperience();
        $workPlace = array();

        //check for errors if form is submitted
        $errors = Session::get('workExpErrors');

        if (isset($errors) && $errors['work_place']['validData']['status']) {
            $workPlace['validData'] = $errors['work_place']['validData'];
        }

        $workPlace['data'] = json_decode($workExp['work_place']);


        $data = array(
            'user' => Sentry::getUser(),
            'workExp' => $workExp,
            'work_place'  => $workPlace,
            'trainer' => Trainer::getTrainerByUserId(Sentry::getUser()->id),
            'errors' => (isset($errors['errors']['messageBag']) ?
                $errors['errors']['messageBag'] : '')
        );

        //forget the old input
        Session::forget('_old_input.work_place');

        return View::make('trainer.currentEmployer', $data, $data1)
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
        $workPlaceErrors = array(
            'empty' => $this->validateMulipleTextBox($data['work_place']),
            'validData' => $this->validateAlplaSpaces($data['work_place'])
        );

        //check if there is only the CV Required Error message
        if (($errorsWorkExp['messageBag']->first('registration_category_id') &&
            $errorsWorkExp['messageBag']->count() == 1 &&
            trim($errorsWorkExp['messageBag']->first('cv')) ==
            'The cv field is required.')) {

            $errorsWorkExp['status'] = false;
        }

        //prepare errors to send to the view
        if (($errorsWorkExp['status'] || $workPlaceErrors['empty']['status'] ||
            $workPlaceErrors['validData']['status']) && $errorsWorkExp['messageBag']->first('registration_category_id') != 'Please select a Level of Registration') {
            // echo 2; die();
            $errors = array();
            if ($errorsWorkExp['status']) {
                $errors['status'] = $errorsWorkExp['status'];
                $errors['messageBag'] = $errorsWorkExp['messageBag'];
            }

            $errorData = array(
                'work_place' => $workPlaceErrors,
                'errors' => $errors
            );

            Session::flash('workExpErrors', $errorData);

            return Redirect::action('TrainerController@currentEmployer');
        } else {
            // echo 1; die();
            $user = Sentry::getUser();
            $name = trim($user->first_name) . ' ' . trim($user->last_name);
            $email = trim($user->email);
            $jobtitle = $user->trainer->trainerWorkExperience->job_title;
            $workplace = $user->trainer->trainerWorkExperience->work_place;

            $x = Trainer::updateWorkExperience($data);
            $x->save();

            $userz = Sentry::getUser();
            $namechanged = trim($userz->first_name) . ' ' . trim($userz->last_name);
            $emailchanged = trim($userz->email);
            $jobtitlechanged = $data['job_title'];
            $workplacechanged = json_encode($data['work_place']);

            $emailData = array();

            if ($jobtitle != $jobtitlechanged) {
                $emailData['jobtitle'] = $jobtitle;
                $emailData['jobtitlechanged'] = $jobtitlechanged;
            }

            if ($workplace != $workplacechanged) {
                $emailData['workplace'] = json_decode($workplace);
                $emailData['workplacechanged'] = json_decode($workplacechanged);
            }

            if (!empty($emailData)) {
                $emailData['name'] = $name;
                $emailData['reps_id'] = $user->trainer->reps_id;

                Mail::send(
                    'trainer.mail.user_info_update',
                    $emailData,
                    function ($message) use ($emailData) {
                        $message->to(Config::get('contact.emailContactFrom'), 'Admin')
                            ->subject('Trainer ' . $emailData['name'] .  ' made a profile update!');
                    }
                );
            }

            return Redirect::action('TrainerController@currentEmployer');
        }
    }

    /**
     * apply to upgrade level
     * Created By Kevin @ Cranium Creations
     */
    public function trainerUpgradeLevel()
    {
        $data1['setting'] = DBS::table('setting')->get();
        $data = Input::get();

        $default = array(
            'regCategory' => Trainer::getRegistrationCategory(),
            'user' => Sentry::getUser(),
            'trainer' => Trainer::getTrainerByUserId(Sentry::getUser()->id),
            'trainerReg' => Trainer::getRegCategory()
        );

        if (isset($data) && !empty($data)) {
            $data['certificate'] = Input::file('certificate');
            if (isset($data['category'])) {
                $data['category'] = implode(",", $data['category']);
            }
            $errors = Trainer::validateTrainerUpgradeLevel($data);

            if ($errors['status']) {
                return View::make('trainer.trainerUpgradeLevel', $default, $data1)
                    ->withErrors($errors['messageBag']);
            } else {
                Trainer::trainerUpgradeLevel($data);

                $user = Sentry::getUser();
                $name = '(' . strtoupper($user->trainer->reps_id) . ') ' . $user->first_name;

                Mail::send(
                    'emails.upgradeNotificationLevel',
                    array(
                        'name' => $name
                    ),
                    function ($message) use ($name) {
                        $message->to(Config::get('contact.emailContactFrom'), 'Admin')
                            ->subject('Request for Level upgrade for Trainer ' . $name);
                    }
                );

                return Redirect::action('TrainerController@dashboard');
            }
        } else {
            return View::make('trainer.trainerUpgradeLevel', $default, $data1);
        }
    }

    /**
     * apply to upgrade status
     * Created By Kevin @ Cranium Creations
     */
    public function trainerUpgradeStatus()
    {
        $data1['setting'] = DBS::table('setting')->get();
        $data = Input::get();

        $default = array(
            'user' => Sentry::getUser(),
            'trainer' => Trainer::getTrainerByUserId(Sentry::getUser()->id),
        );

        if (isset($data) && !empty($data)) {
            $data['certificate'] = Input::file('certificate');

            //validate trainer personal details fields
            $errors = Trainer::validateTrainerUpgradeStatus($data);

            if ($errors['status']) {
                return View::make('trainer.trainerUpgradeStatus', $default, $data1)
                    ->withErrors($errors['messageBag']);
            } else {
                Trainer::trainerUpgradeStatus($data, $data1);

                $user = Sentry::getUser();
                $name = '(' . strtoupper($user->trainer->reps_id) . ') ' . $user->first_name;

                Mail::send(
                    'emails.upgradeNotificationStatus',
                    array(
                        'name' => $name
                    ),
                    function ($message) use ($name) {
                        $message->to(Config::get('contact.emailContactFrom'), 'Admin')
                            ->subject('Request for Status upgrade for Trainer ' . $name);
                    }
                );

                return Redirect::action('TrainerController@dashboard');
            }
        } else {
            return View::make('trainer.trainerUpgradeStatus', $default, $data1);
        }
    }

    private function trainerIsExpired($date)
    {
        $today_dt = new DateTime(date("Y-m-d"));
        $expire_dt = new DateTime($date);
        $expire_dt_wgp = new DateTime($date); //with grace period
        $expire_dt_wgp->modify('+29 day');

        return ($expire_dt_wgp < $today_dt);
    }

    /**
     * trainer renew registration
     * Created By Raj @ Cranium Creations
     */
    public function renewRegistration()
    {
        $data1['setting'] = DBS::table('setting')->get();
        $user = Sentry::getUser();

        if ($user->trainer->status_id == 1) {

            return Redirect::action('TrainerController@dashboard');
        }

        ini_set('max_execution_time', 300);

        $product_id = Config::get('subscriptionPayment.product_id');
        if ($this->trainerIsExpired($user->trainer->expiry_date)) {
            $product_id = Config::get('subscriptionPayment.product_id_penalty');
        }

        $check = Trainer::getSubscriptionPaymentByOwnerAndStatus($user->trainer->id, 0);

        $args = array(
            'sid' => Config::get('subscriptionPayment.seller_id'),
            'product_id' => $product_id,
            'fixed' => Config::get('subscriptionPayment.fixed'),
            'quantity' => 1,
            'trainer_id' => $user->trainer->id
        );
        $link = Twocheckout_Charge::link($args);

        $data['user_id'] = $user->id;
        $data['user'] = $user;
        $data['payment_link'] = $link;
        $data['has_pending_renewal'] = $check->count();
        $data['pending_renewal'] = $check->count();

        return View::make('trainer.renewRegistration', $data, $data1);
    }

    /**
     * payment api back form
     * Created By Kevin @ Cranium Creations
     */
    public function payment()
    {
        $params = Input::get();

        //echo "<pre>"; print_r( $params); echo "</pre>";

        return View::make('trainer.renewRegistration', $data);

        //Twocheckout_Return::check($params, "tango", 'array');
    }

    /**
     * Show the registeration information page.
     *
     * @author Chris @ Cranium Creations
     */
    public function registerInfo()
    {
        $data['setting'] = DBS::table('setting')->get();
        $data['registrationCategories'] = DBS::table('registration_category')->select('id', 'level')->orderby('level')->get();

        return View::make('trainer.registrationInfo', $data);
    }


    /* Test Payment */
    public function testPayment()
    {
        //dd($_REQUEST);
        $input = array(
            'sid'         => '00b2877b9ee0722b333c349f806c60fdc8101fca14e9232040158469ed3cc029',
            'total'       => '42000',
            'order_number' => '03012022100329',
            'key'         => '00b2877b9ee0722b333c349f806c60fdc8101fca14e9232040158469ed3cc029',
            'email'       => 'ilesbersan@gmail.com',
            'invoice_id'  => '2147483647',
        );

        $payment_type = 'new';

        if ($payment_type == 'new') {

            $input['user_email'] = 'ilesbersan@gmail.com';

            $trainerTemp = Trainer::getTempTrainerByEmail('ilesbersan@gmail.com');

            if (empty($trainerTemp)) {
                $msg = "The data corresponding to the registration mail you used is missing.  Please contact REPs UAE (faisal.ayaz@sigmads.com) immediately.";
                return View::make('trainer.paymenterror')->with('message', $msg);
            } else {

                $tempData = json_decode($trainerTemp->json_data, true);
                Session::put('trainerDetails', $tempData);
                Trainer::deleteTempTrainerByEmail(Session::get('checkout_email'));
            }

            Trainer::save();

            $trainer = Session::get('trainerDetails');
            $user = Sentry::findUserByLogin('ilesbersan@gmail.com');

            $user->trainer->expiry_date = date('Y-m-t', strtotime('+1 year', strtotime($user->trainer->created_at)));
            $user->trainer->save();

            $input['trainer_id'] = $user->trainer->id;
            // $input['order_number'] = Input::get('orderID');
            $input['order_number'] = '03012022100329';

            $r = $input;
            $r['processStatus'] = 1;

            $this->addPayment($user->trainer, $r);

            $this->notifyAdminPayment($user, $input);
            $this->notifyTrainerRegistrationSuccess($user, $input);

            $head = 'Payment done';
            $message = 'Your transaction has been successful! Your registration will be reviewed for approval.';
        }
    }

    public function temp_trainer()
    {

        $email = Input::get('customer_email');

        $trainerTemp = Trainer::getTempTrainerByEmail($email);
        if (empty($trainerTemp)) {
            echo 'No temp record found in our system.';
            exit;
        }
        $tempData = json_decode($trainerTemp->json_data, true);
        Session::put('trainerDetails', $tempData);
        //Trainer::deleteTempTrainerByEmail(Session::get('checkout_email'));
        //        $certificates = '';
        //        if(!empty($tempData['qualifications'][0]['certificates'])){
        //            $certificates = $tempData['qualifications'][0]['certificates'];
        //        }

        Trainer::save();
        $user = Sentry::findUserByLogin($email);
        $user->trainer->expiry_date = date('Y-m-d', strtotime('+1 year', strtotime($user->trainer->created_at)));
        $user->trainer->save();
        $input = array(
            'sid'         => Input::get('signature'),
            'total'       => Input::get('amount'),
            'order_number' => Input::get('merchant_reference'),
            'key'         => Input::get('signature'),
            'email'       => Input::get('customer_email'),
            'invoice_id'  => Input::get('fort_id')
        );
        $input['trainer_id'] = $user->trainer->id;
        $input['order_number'] = Input::get('merchant_reference');
        $input['user_email'] = $email;

        $r = $input;
        $r['processStatus'] = 1;

        //        foreach($certificates as $certificate){
        //           $mypublicPath = public_path();
        //            $savePath = $mypublicPath.$certificate['tmpNamePath'].'/';
        //            if (!file_exists($savePath)) {
        //                mkdir($savePath, 0777, true);
        //            }
        //            $path = $savePath.$certificate['name'];
        //            File::put($path , 'File not found');
        //        }


        $this->addPayment1($user->trainer, $r);
    }

    private function addPayment1($trainer, $input, $certificates = '')
    {

        if (isset($input['purchased_date']) && $input['purchased_date'] != '') {
            $purchased_date =  $input['purchased_date'];
        } else {
            $purchased_date = date('Y-m-d H:i:s');
        }
        $input['certificates'] = '';
        if (!empty($certificates)) {
            $input['certificates'] = $certificates;
        }
        $processStatus = 0;
        if (!empty($input['processStatus'])) {
            $processStatus = $input['processStatus'];
        }

        $trainer->addSubscriptionPayment(array(
            'trainer_id' => $trainer->id,
            'invoice_id' => $input['order_number'],
            'email' => $input['user_email'],
            'details' => json_encode($input),
            'processStatus' => $processStatus,
            'created_at' => $purchased_date
        ));
    }
}
