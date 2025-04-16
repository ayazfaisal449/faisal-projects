<?php namespace Cranium\TrainerWorkExperience\Models;

use Cranium\TrainerWorkExperience\Models\TrainerWorkExperience;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class TrainerWorkExperienceProvider {   
    
    /**
     * reference the modal
     * Created By Jahir @ Cranium Creations
     */	
    public function createModel()
    {
        return new TrainerWorkExperience();		
    }
    
    /**
     * Validates data from ardent
     *
     * @param array()
     * @return Collection of errors
     * @author Kevin @ Cranium Creations
     */
    public function validateTrainerWorkExperience($data)
    {
        $trainerWorkExp = $this->createModel()->fill($data); 
        $rules = TrainerWorkExperience::getValidationRules();
        $validator = Validator::make($data, $rules);
        // $trainerWorkExp->validate(); 
        
        $messageBag = new MessageBag();
        $status = false;
        
        if (empty($data['registration_category_id']) || count($data['registration_category_id']) < 1) {
            $status = true;
            $messageBag->add('registration_category_id', 'Please select a Level of Registration');
        }
        if ($validator->fails()) {
            $status = true;
            $messageBag->merge($validator->messages());
        }
        // if (count($trainerWorkExp->errors()->all()) > 0) 
        // {
        //     $status = true;
        //     $messageBag->merge($trainerWorkExp->errors());
        // } 
        
        return array('status'=>$status,'messageBag'=>$messageBag);
    }
    
    /**
     * @param id
     * @return id
     * get trainer work by id
     * Created By Kevin @ Cranium Creations
     */
     public function getById($id)
     {
        $trainerWorkExp = $this->createModel();
        return $trainerWorkExp->find($id);
     }
}