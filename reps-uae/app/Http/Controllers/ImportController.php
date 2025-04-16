<?php
namespace App\Http\Controllers;
class ImportController extends BaseController {
    
    protected $sms;

    public function __construct(SmartcallSMS $sms) {
        $this->sms = $sms;
    }

    private function getImportDir() {
        return "c:/REPs/Files/";
    }
    
    private function getImportFileName() {
        return "../Cranium2.xls";
    }
    
    //gets profile data from reps_original database using mysql2 connection
    private function getProfile($username) {
        return DB::connection('mysql2')->select("select * from profile where username = ?", array($username));
    }
    
    //gets profile data from reps_original database using mysql2 connection
    private function getProfileByEmail($email) {
        return DB::connection('mysql2')->select("select * from profile where email = ?", array($email));
    }
    
    //load up excel file
    private function getExcelFile() {
        $test = new PHPExcel_Reader_Excel5;
        $excel = $test->load($this->getImportDir() . $this->getImportFileName());
        return $excel->getSheet(0);
    }
    
    //process excel data rows
    private function getExcelData() {
        $excel = $this->getExcelFile();
        $rows = $excel->getRowIterator();
        
        $data = array();
        foreach ($rows as $itmRow) {
            
            $cellIterator = $itmRow->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            
            $rowData = array();
            foreach ($cellIterator as $cell) {
                $value = $cell->getFormattedValue();
                $rowData[] = $value == null ? '' : $value;
            }
            
            $data[] = $rowData;
        }
        
        return $data;
    }
    
    //get processed excel data rows merged with their corresponding db data
    private function getImportedData() {
        $data = $this->getExcelData();
        $x = 0;
        
        foreach ($data as $itm) {
            
            $db_profile = $this->getProfile($itm[5]);
            
            $data[$x]['db_profile'] = $db_profile;
            
            $x++;
        }
        return $data;
    }
    
    
    //arrange data according to new table arrangement
    private function cleanUpArray($processedData) {
        
        $trainers = array();
        
        foreach ($processedData as $itm) {
            if (!empty($itm['db_profile'])) {
                
                $sitm = $itm['db_profile'][0];
                $trainer_registration_category = explode(",", empty($itm[6]) ? '1' : $itm[6]);

                $user = array(
                    'email' => $itm[4],
                    'password' => str_random(9),
                    'activated' => 1,
                    'first_name' => $itm[0],
                    'last_name' => $itm[1]
                );
                
                $old_date = date("m/d/y", strtotime($itm[8]));
                $old_date_timestamp = strtotime($old_date);
                $new_date = date('Y-m-d', $old_date_timestamp);   
                
                $trainer = array(
                    'nationality_id' => $itm[3],
                    'dob' => date("Y-m-d", strtotime($sitm->dob)),
                    'gender' => $itm[2],
                    'city' => (empty($sitm->city) ? 'N/A' : $sitm->city),
                    'mobile_phone' => preg_replace("/[^0-9]/","",$sitm->mobile),
                    'passport_no' => preg_replace("/[^0-9]/","",empty($sitm->passport_no) ? '000000000' : $sitm->passport_no),
                    'photo' => (empty($sitm->image) ? 'default.jpg' : $sitm->image),
                    'expiry_date' => $new_date,
                    'status_id' => (empty($itm[7]) ? '3' : $itm[7]),
                    'reps_id' => $sitm->username
                );
                $trainer_work_experience = array(
                    'work_place' => sprintf('["%s","",""]', empty($sitm->employer) ? "NA" : $sitm->employer),
                    'job_title' => (empty($sitm->job_title) ? 'NA' : $sitm->job_title),
                    'cv' => (empty($sitm->cv) ? '' : $sitm->cv),
                );

                $trainers[] = array(
                    'user'=>$user, 
                    'trainer'=>$trainer, 
                    'trainer_registration_category'=>$trainer_registration_category,
                    'trainer_work_experience'=>$trainer_work_experience
                );
            } else {
                $trainers[] = array('norec'=>$itm[0] . ' ' . $itm[1]);
            }
        }
        return $trainers;
    }
    
    public function import() {
        
        set_time_limit(700);
        
        $trainers = $this->cleanUpArray($this->getImportedData());
        
        $x = 1;
        
        echo "<style>table {border:1px solid #ccc;} "
                  . "table tr td { padding:8px 6px;font-size:12px;}"
                  . "table tr th { padding:8px 6px;font-size:12px;background-color:#ccc;border-bottom:1px solid #c0c0c0;}"
                  . "tr:nth-child(even) { background-color:#ccc;}</style>";
        echo "<table border='0' cellpadding='0' cellspacing='0'>";
        echo "<tr>";
        echo "<th>&nbsp;</th>";
        echo "<th>Email Address</th>";
        echo "<th>Password</th>";
        echo "<tr>";
        
        foreach ($trainers as $itm) {
            
            echo "<tr>";
            
            if (!empty($itm['norec'])) {
                echo "<td width='90'>" . $x . "</td><td width='280'>" . $itm['norec'] . "</td><td>No database data.</td>";
            } else {
                try {
                    $user = $this->createUser($itm['user']);
                    $group = Sentry::findGroupByName('Trainer');
                    $user->addGroup($group);
                    
                    $trainer = $this->createTrainer($user, $itm['trainer']);
                    
                    if (!empty($trainer->validationErrors)) {

                        $work_experience = $this->createTrainerWorkExperience($trainer, $itm['trainer_work_experience']);
                        
                        if (!empty($work_experience->validationErrors)) {

                            $trainer_qualifications = $this->createTrainerQualifications($trainer);
                            $trainer_qualifications->save();
                            
                            if (!empty($trainer_qualifications->validationErrors)) {
                                $this->createTrainerRegistrationCategories($trainer, $itm['trainer_registration_category']);
                                
                                echo "<td width='90'>" . $x . "</td><td width='280'>" . $itm['user']['email'] . '</td><td>' . $itm['user']['password'] . "</td>";
                            } else {
                                echo "<td width='90'>" . $x . "</td><td width='280'>" . $itm['user']['email'] . '</td><td>Trainer Qualification: ' . print_r($trainer_qualifications->validationErrors) . "</td>";
                            }
                        } else {
                            echo "<td width='90'>" . $x . "</td><td width='280'>" . $itm['user']['email'] . '</td><td>Work Experience: ' . print_r($work_experience->validationErrors) . "</td>";
                        }
                    } else {
                        echo "<td width='90'>" . $x . "</td><td width='280'>" . $itm['user']['email'] . '</td><td>Trainer: ' . print_r($trainer->validationErrors) . "</td>";
                    }
                } catch(Exception $ex) {
                    echo "<td width='90'>" . $x . "</td><td width='280'>" . $itm['user']['email'] . "</td><td>User: " . $ex->getMessage() . "</td>";
                }
            }
            
            echo "</tr>";
            
            $x++;
        }
        
        echo "</table>";
    }
    
    private function createUser($user) {
        
        $group = Sentry::findGroupByName('Trainer');
        
        $user = Sentry::createUser($user);
        $user->addGroup($group);
        
        $user_loc = Config::get('trainer.path').'/'.$user->id;
        
        File::makeDirectory($user_loc, 0755, true);
        File::makeDirectory($user_loc.'/certificate', 0755, true);
        File::makeDirectory($user_loc.'/cv', 0755, true);
        File::makeDirectory($user_loc.'/photo', 0755, true);
        File::makeDirectory($user_loc.'/status_upgrade', 0755, true);
        File::makeDirectory($user_loc.'/level_upgrade', 0755, true);
        
        return $user;
    }
    
    private function createTrainerRegistrationCategories($trainer, $trainer_registration_category) {
        $default = array();
        
        foreach ($trainer_registration_category as $itm)
        {
            $default[] = $trainer->addTrainerRegistrationCategory(array(
                'trainer_id' => $trainer->id,
                'registration_category_id' => intval($itm)
            ));
        }
        
        return $default;
    }
    
    private function createTrainerQualifications($trainer) {
        
        $user_loc = Config::get('trainer.path').'/'.$trainer->user_id.'/certificate/logo.png';
        
        File::copy($this->getImportDir() . "logo.png",$user_loc);
        
        return $trainer->addTrainerQualification(array(
            'trainer_id' => $trainer->id,
            'course_name' => "NA",
            'course_provider' => "NA",
            'date_completed' => date("Y-m-d", strtotime("2014/05/19")),
            'certificate' => json_encode(array("logo.png")),
        ));
    }
    
    private function createTrainerWorkExperience($trainer, $trainer_work_experience) {
        
        $trainer_work_experience['trainer_id'] = $trainer->id;
        
        $trainerWorkPlace = $trainer->addTrainerWorkExperience($trainer_work_experience);
        $trainerWorkPlace->save();
        
        $user_loc = Config::get('trainer.path').'/'.$trainer->user_id.'/cv/'.$trainer_work_experience['cv'];
        
        if (is_file($this->getImportDir() . $trainer_work_experience['cv'])) {
            File::copy($this->getImportDir() . $trainer_work_experience['cv'],$user_loc);
        }
//        else {
//            File::copy($this->getImportDir() . "default.doc",$user_loc);
//        }
        
        return $trainerWorkPlace;
    }
    
    private function createTrainer($user, $trainer) {
        
        ini_set('memory_limit', '128M');
        
        $trainer['user_id'] = $user->id;
        
        $trainer = $user->addTrainer($trainer);
        $trainer->save();
        
        $file_loc = Config::get('trainer.path').'/'.$user->id.'/photo/'.$trainer['photo'];
        
        try {
            $img = Image::make($this->getImportDir() . $trainer['photo']);
        } catch (Exception $ex) {
            $img = Image::make($this->getImportDir() . "default.jpg");
        }
        
        if ($img->height >= $img->width) {
            $img->resize(null, 170, true, true)
                ->resizeCanvas(130,170,null,false, "#ffffff")
                ->save($file_loc, 100);
        } else {
            $img->resize(130, null, true, true)
                ->resizeCanvas(130,170,null,false, "#ffffff")
                ->save($file_loc, 100);
        }
        
        return $trainer;
    }
    
    public function importOldRepsId() {
        
        $trainers = Trainer::getAllTrainers();
        $x = 1;
        $no_data = array();
        
        foreach ($trainers as $user) {
            
            $trainer = $user->trainer;
            $dbdata = $this->getProfileByEmail(trim($user->email));
            
            if (!empty($dbdata)) {
                
                $trainer->reps_id = $dbdata[0]->username;
                $trainer->save();
                
                echo "<pre>";
                print_r($x . '. ' . $dbdata[0]->email . ' - ' . $dbdata[0]->username);
                echo "</pre>";
                
                $x++;
                
            } else {
                $no_data[] = $user->email;
            }
        }
        
        echo "<h3>No Data</h3><pre>";
        print_r($no_data);
        echo "</pre>";
    }
    
    public function importNewExpiryDates() {
        echo date('Y-m-t', strtotime('+1 year', strtotime("2014/04/22")));
    }
    
    public function createAdminUser() {
        $user = Sentry::createUser(array(
            'email'     => '',
            'password'  => "membership",
            'activated' => true,
            'first_name' => 'Admin',
            'last_name' => 'Membership'
        ));
        $group = Sentry::findGroupByName('Admin');
        $user->addGroup($group);
    }
    
    public function notifyExpiry() {
        
        $check = Input::get('check');
        
        if (empty($check) || ($check != 'weekly' && $check != 'monthly')) {
            $this->sms->sendSMSs(['971564913506', '971544014019'], '[REPS Test SMS Check] If you received this message, the SMS notifications are working fine.');
            echo "Not yet time to execute.";
            exit;
        }
        
        ini_set('max_execution_time', 360);
        
        if($check == 'monthly') {
            if (Session::get('monthly_flag') == 'sent') {
                echo "Notification already sent. Duplicate notification prevented.";
                return false;
            }

            // Notify trainers whose accounts expire in a month
            $expiring_now = Trainer::getExpiringTrainersOneMonth();
            $data = array();

            $mobiles = array();

            
            if ($expiring_now->count() > 0) {
                
                $emails = array();
                
                foreach ($expiring_now as $itm) {
                    $trainer = array(
                        'reps_id'=>$itm->reps_id,
                        'expiry_date'=>$itm->expiry_date,
                        'email'=>$itm->users->email,
                        'name'=>trim($itm->users->first_name) . ' ' . trim($itm->users->last_name)
                    );
                    $data[] = $trainer;

                    try {
                        /*
                        Mail::send('trainer.mail.almostExpiring2', $trainer, function($message) use($trainer) {
                            $message->to($trainer['email'], $trainer['name']);
                            $message->subject('REPs re-registration reminder');
                        });
                        */
                    } catch (Exception $e) {
                        
                    }

                    $mobiles[] = $itm->mobile_phone;
                }
            }
            // Send SMS notifications for one month before expiry
            $this->sms->sendSMSs($mobiles, SmartcallSMS::ONE_MONTH_BEFORE);

            Session::put('monthly_flag', 'sent');
            echo "Notification run successful.";
        }

        if($check == 'weekly') {
            if (Session::get('weekly_flag') == 'sent') {
                echo "Notification already sent. Duplicate notification prevented.";
                return false;
            }

            // Notify Trainers who have accounts expired by a week
            $weekExpired = Trainer::getExpiredByAWeek();

            $mobiles = array();
            if ($weekExpired->count() > 0) {

                foreach ($weekExpired as $trainer) {
                    $mobiles[] = $trainer->mobile_phone;
                }
            }
            // Send SMS notifications for one month after expiry
            $this->sms->sendSMSs($mobiles, SmartcallSMS::ONE_WEEK_AFTER);

            Session::put('weekly_flag', 'sent');
            echo "Notification run successful.";
        }
        
        // Disable 2-month before notification, as specified by them..
        
        // Notify trainers whose accounts expire in two months
        // $expiring_nxt = Trainer::getExpiringTrainersTwoMonth();
        // $dataExNxt = array();
        
        // if ($expiring_nxt->count() > 0) {
            
        //     $emails = array();
            
        //     foreach ($expiring_nxt as $itm) {
        //         $trainer = array(
        //             'reps_id'=>$itm->reps_id,
        //             'expiry_date'=>$itm->expiry_date,
        //             'email'=>$itm->users->email,
        //             'name'=>trim($itm->users->first_name) . ' ' . trim($itm->users->last_name)
        //         );
        //         $dataExNxt[] = $trainer;
        //         Mail::send('trainer.mail.almostExpiring2', $trainer, function($message) use($trainer) {
        //             $message->to($trainer['email'], $trainer['name']);
        //             $message->subject('REPs re-registration reminder');
        //         });
        //     }
        // }
    }
}