<?php namespace Cranium\TrainerUpgradeStatus\Models;

use Cranium\TrainerUpgradeStatus\Models\TrainerUpgrade;
// add validator facade
use Illuminate\Support\Facades\Validator;

class TrainerUpgradeStatusProvider {   
    
    /**
     * reference the modal
     * Created By Kevin @ Cranium Creations
     */	
    public function createModel()
    {
        return new TrainerUpgradeStatus();		
    }
    
    /**
     * Validates data from ardent
     *
     * @param array()
     * @return Collection of errors
     * @author Kevin @ Cranium Creations
     */
    public function validateTrainerUpgrade($data)
    {
        $rules = array (
            'course_name' => 'sometimes|alpha_spaces',
            'course_provider' => 'sometimes|alpha_spaces',
            'date_completed' => 'sometimes|date',
            'certificate' => 'required|mimes:pdf,doc,docx,png,jpg,gif,jpeg|max:256000',
        );
        
        
        $trainerUpgrade = $this->createModel()->fill($data); 
        // $trainerUpgrade->validate(); 
        $validator = \Validator::make($data, $rules);
        
        if($validator->fails()) 
        {
            return array('status'=>true,'messageBag'=>$validator->errors());
        }else
        {
            return array('status'=>false);
        }
        
        // if(count($trainerUpgrade->errors()->all()) == 0) 
        // {
        //     return array('status'=>false);
        // } else 
        // {
        //     return array('status'=>true,'messageBag'=>$trainerUpgrade->errors());
        // } 
    }
    
    /**
     * @param id
     * @return id
     * get trainer upgrade by id
     * Created By Kevin @ Cranium Creations
     */
     public function getById($id)
     {
        $trainerUpgrade = $this->createModel();
        return $trainerUpgrade->find($id);
     }
     
     public function getByTrainerIdAndNotProcessed($trainer_id)
     {    
        return $this->createModel()->newQuery()
                ->where('trainer_id','=',$trainer_id)
                ->where('is_processed','=',0)
                ->first();
     }
     
     public function getNotProcessed()
     {    
        return $this->createModel()->newQuery()->where('is_processed','=',0)->get();
     }
}