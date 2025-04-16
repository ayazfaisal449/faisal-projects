<?php

namespace Cranium\TrainerUpgradeLevel\Models;

use Cranium\TrainerUpgrade\Models\TrainerUpgrade;
use Illuminate\Support\Facades\Validator;

class TrainerUpgradeLevelProvider
{

    /**
     * reference the modal
     * Created By Kevin @ Cranium Creations
     */
    public function createModel()
    {
        return new TrainerUpgradeLevel();
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
        // $trainerUpgrade = $this->createModel()->fill($data);
        // $trainerUpgrade->validate();
        $rules = TrainerUpgradeLevel::getValidationRules();
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return array('status' => true, 'messageBag' => $validator->errors());
        } else {
            return array('status' => false);
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
            ->where('trainer_id', '=', $trainer_id)
            ->where('is_processed', '=', 0)
            ->first();
    }

    public function getNotProcessed()
    {
        return $this->createModel()->newQuery()->where('is_processed', '=', 0)->get();
    }
}
