<?php
namespace App\Http\Controllers;
class DownloadsController extends BaseController {

    /*
     * Gets all Users and export to exel
     * Created By Raj @ Cranium Creations
     */
    public function downloadExel () 
    {
                    $objPHPExcel = new PHPExcel();

                    $users = Users::getAllUsers(1);

                    $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A1', 'Sl No.')
                                ->setCellValue('B1', 'Name');
                    
                    $i = 2;
                    $j = 1;
                    
                    foreach($users as $user)
                    {
                        $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$i ,$j)
                                    ->setCellValue('B'.$i,$user->first_name." ".$user->last_name);						
                        $i++;
                        $j++;
                    }

                    //Clean-up buffer
                    ob_end_clean();		

                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="user_list.xls"');
                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                    $objWriter->save('php://output');
                    exit;
    }
        
    /*
     * Gets all Trainers and export to exel
     * Created By Jahir @ Cranium Creations
     */
    public function downloadTrainerOld () 
    {
        $objPHPExcel = new PHPExcel();

        $group = Sentry::findGroupByName('trainer');
        $trainers = Sentry::findAllUsersInGroup($group);

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Sl No.')
                    ->setCellValue('B1', 'First Name')
                    ->setCellValue('C1', 'Last Name')
                    ->setCellValue('D1', 'Gender')
                    ->setCellValue('E1', 'DOB')
                    ->setCellValue('F1', 'City')
                    ->setCellValue('G1', 'Nationality')
                    ->setCellValue('H1', 'Status')
                    ->setCellValue('I1', 'Email')
                    // ->setCellValue('J1', 'Work Email')
                    ->setCellValue('K1', 'Phone No')
                    ->setCellValue('L1', 'Expiry Date')
                    ->setCellValue('M1', 'Level');

        $i = 2;
        $j = 1;

        foreach($trainers as $trainer)
        {	
            $nationality = DB::table('nationality')->where('id', $trainer->trainer->nationality_id)->first();

            $x = Trainer::getTrainer($trainer->id);
            $levelOfRegCats = array();

            foreach ($x->trainer->trainerRegistrationCategories as $itm) {
                $levelOfRegCats[] = strstr($itm->registrationCategory->level, ':', true);
            }

            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A'.$i ,$j)
                        ->setCellValue('B'.$i, "(" . $trainer->trainer->reps_id . ")  " . $trainer->first_name)
                        ->setCellValue('C'.$i, $trainer->last_name)
                        ->setCellValue('D'.$i, ($trainer->trainer->gender == 0 ? 'Male' : 'Female'))
                        ->setCellValue('E'.$i, $trainer->trainer->dob)
                        ->setCellValue('F'.$i ,$trainer->trainer->city)
                        ->setCellValue('G'.$i, $nationality->name)
                        ->setCellValue('H'.$i, Trainer::getStatusName($trainer->trainer->status_id))
                        ->setCellValue('I'.$i, $trainer->email)
                        // ->setCellValue('J'.$i, $trainer->work_email)
                        ->setCellValue('K'.$i, $trainer->trainer->mobile_phone)
                        ->setCellValue('L'.$i, $trainer->trainer->expiry_date)
                        ->setCellValue('M'.$i, implode(", ", $levelOfRegCats));

            $i++;
            $j++;
        }

        //Clean-up buffer
        if (ob_get_contents()) {
            ob_end_clean();
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="trainers_list.xls"');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }
	
	/*
     * Gets all Trainers and export to exel
     * Created By Jahir @ Cranium Creations
     */
    public function downloadTrainer () 
    {
		ini_set('memory_limit', '-1');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Sl No.')
                    ->setCellValue('B1', 'First Name')
                    ->setCellValue('C1', 'Last Name')
                    ->setCellValue('D1', 'Gender')
                    ->setCellValue('E1', 'DOB')
                    ->setCellValue('F1', 'City')
                    ->setCellValue('G1', 'Nationality')
                    ->setCellValue('H1', 'Status')
                    ->setCellValue('I1', 'Email')
                    // ->setCellValue('J1', 'Work Email')
                    ->setCellValue('K1', 'Phone No')
                    ->setCellValue('L1', 'Expiry Date')
                    ->setCellValue('M1', 'Level')
					->setCellValue('N1', 'Work Place');

        $i = 2;
        $j = 1;
		
		$data = Input::get();

		if(isset($data) && !empty($data)) {
            $trainers = Trainer::adminSearchTrainers($data);
   
            foreach ($trainers as $trainer) {
                $x = Trainer::getTrainer($trainer->id);
                $levelOfRegCats = array();
                $user = Sentry::findUserById($trainer->id);
                $trainerWE = $user->trainer->trainerWorkExperience;
				
				$work_place = json_decode($trainerWE->work_place);
				if($work_place){
				  $work_place = implode(", ", $work_place);
				  $work_place = trim($work_place, ", ");
				}
				
                foreach ($x->trainer->trainerRegistrationCategories as $itm) {
                    $levelOfRegCats[] = strstr($itm->registrationCategory->level, ':', true);
                }
				
				$nationality = DB::table('nationality')->where('id', $trainer->nationality_id)->first();
				

				 
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i ,$j)
							->setCellValue('B'.$i, "(" . $trainer->reps_id . ")  " . $trainer->first_name)
							->setCellValue('C'.$i, $trainer->last_name)
							->setCellValue('D'.$i, ($trainer->gender == 0 ? 'Male' : 'Female'))
							->setCellValue('E'.$i, $trainer->dob)
							->setCellValue('F'.$i ,$trainer->city)
							->setCellValue('G'.$i, $nationality->name)
							->setCellValue('H'.$i, Trainer::getStatusName($trainer->status_id))
							->setCellValue('I'.$i, $trainer->email)
							// ->setCellValue('J'.$i, $trainer->work_email)
							->setCellValue('K'.$i, $trainer->mobile_phone)
							->setCellValue('L'.$i, $trainer->expiry_date)
							->setCellValue('M'.$i, implode(", ", $levelOfRegCats))
							->setCellValue('N'.$i, $work_place);
	
				$i++;
				$j++;
            }
        } else {

			$group = Sentry::findGroupByName('trainer');
			$trainers = Sentry::findAllUsersInGroup($group);
			
			foreach($trainers as $trainer)
			{	
				$nationality = DB::table('nationality')->where('id', $trainer->trainer->nationality_id)->first();
                $user = Sentry::findUserById($trainer->id);
                $trainerWE = $user->trainer->trainerWorkExperience;
				$x = Trainer::getTrainer($trainer->id);
				$levelOfRegCats = array();
	
				foreach ($x->trainer->trainerRegistrationCategories as $itm) {
					$levelOfRegCats[] = strstr($itm->registrationCategory->level, ':', true);
				}
				$work_place = json_decode($trainerWE->work_place);
				$work_place = implode(", ", $work_place);
				$work_place = trim($work_place, ", ");
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i ,$j)
							->setCellValue('B'.$i, "(" . $trainer->trainer->reps_id . ")  " . $trainer->first_name)
							->setCellValue('C'.$i, $trainer->last_name)
							->setCellValue('D'.$i, ($trainer->trainer->gender == 0 ? 'Male' : 'Female'))
							->setCellValue('E'.$i, $trainer->trainer->dob)
							->setCellValue('F'.$i ,$trainer->trainer->city)
							->setCellValue('G'.$i, $nationality->name)
							->setCellValue('H'.$i, Trainer::getStatusName($trainer->trainer->status_id))
							->setCellValue('I'.$i, $trainer->email)
							// ->setCellValue('J'.$i, $trainer->work_email)
							->setCellValue('K'.$i, $trainer->trainer->mobile_phone)
							->setCellValue('L'.$i, $trainer->trainer->expiry_date)
							->setCellValue('M'.$i, implode(", ", $levelOfRegCats))
							->setCellValue('N'.$i, $work_place);
	
				$i++;
				$j++;
			}
		}

        //Clean-up buffer
        if (ob_get_contents()) {
            ob_end_clean();
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="trainers_list.xls"');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }
}