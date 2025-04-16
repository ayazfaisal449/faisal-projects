<?php namespace Cranium\TrainerQualification\Models;
use Illuminate\Support\Facades\Validator;

use Cranium\TrainerQualification\Models\TrainerQualification;

class TrainerQualificationProvider {

    /**
     * Gets a qualification by id.
     *
     * @param id
     * @return Video
     * @author Kevin @ Cranium Creations
     */
    public function getById($id)
    {
        return $this->createModel()->newQuery()
            ->find($id);
    }
    
    public function getByTrainerId($trainer_id)
    {
        return $this->createModel()->newQuery()->where('trainer_id', '=', $trainer_id)->get();
    }

    /**
     * Gets all qualification.
     *
     * @param status
     * @author Kevin @ Cranium Creations
     */
    public function getAll()
    {
        return $this->createModel()->newQuery()
            ->get();
    }


    /**
     * Validates data from ardent
     *
     * @param array()
     * @return Collection of errors
     * @author Kevin @ Cranium Creations
     */
    public function validateQualification($data)
    {
        $errors = array();
        $errorCount = 0;
		$flag = 0;        
        foreach($data as $value) 
        {
            $count = 0;
            foreach($value['laravelCert'] as $qualification)
            { 
                $trainerQualification = $this->createModel()->fill(array (
                    'course_name' => $value['course_name'],
                    'course_provider' => $value['course_provider'],
                    'date_completed' => $value['date_completed'],
                    'certificate' => $qualification
                ));
            
                // $trainerQualification->validate();
                $rules = TrainerQualification::getValidationRules();
                $validator = Validator::make($trainerQualification->toArray(), $rules);

				
				// custom validate files to avoid doc mimetype error
				if(isset($qualification)) {
					$filename = $qualification->getClientOriginalName();
					$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
					$allowed =  array('pdf', 'png', 'jpg', 'jpeg', 'gif');
					if(!in_array($ext, $allowed) ) {	
						$trainerQualification->errors()->add('certificate', 'The certificate must be a file of type: pdf, png, jpg, jpeg, gif.');
					} 
				} 
                ////////////
				
                // if(count($trainerQualification->errors()->all()) == 0) 
                // {
                //     $errors['status'] = false;
                // } else 
                // {
                //     $errors['status'] = true;
                //     $errors['errors'][$errorCount][$count] = $trainerQualification->errors();
				// 	$flag++;
                // }
                if ($validator->fails()) {
                    $errors['status'] = true;
                    $errors['errors'][$errorCount][$count] = $validator->messages();
                    $flag++;
                }else {
                    $errors['status'] = false;
                }
                $count++;
            }
            $errorCount++;
            
        }
		if($flag > 0) {
			$errors['status'] = true;
		}
        
        return $errors;
    }
      
    /**
     * Creates a new video instance for querying.
     *
     * @return trainerQualification
     * @author Kevin @ Cranium Creations
     */
    public function createModel()
    {
        return new TrainerQualification();		
    }

}