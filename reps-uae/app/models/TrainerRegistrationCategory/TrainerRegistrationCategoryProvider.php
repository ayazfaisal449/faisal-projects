<?php

namespace Cranium\TrainerRegistrationCategory\Models;
use Illuminate\Support\Facades\Validator;
use Cranium\TrainerRegistrationCategory\Models\TrainerRegistrationCategory;

class TrainerRegistrationCategoryProvider
{

    /**
     * Creates a new registration category.
     *
     * @param array
     * @return RegistrationCategory
     * @author Sebin @ Cranium Creations
     */
    public function create($data)
    {
        $category = $this->createModel();

        return $category->create($data);
    }

    /**
     * Gets a registration by id.
     *
     * @param id
     * @return Registration Category
     * @author Kevin @ Cranium Creations
     */
    public function getById($id)
    {
        return $this->createModel()->newQuery()
            ->find($id);
    }

    /**
     * Gets all registration.
     *
     * @param status
     * @return collection Reg Category
     * @author Kevin @ Cranium Creations
     */
    public function getAll($status = NULL)
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
    public function validateRegistartionCategory($data)
    {
        $trainerRegistrationCategory = $this->createModel()->fill(array('registration_category_id' => $data));

        $rules = TrainerRegistrationCategory::getValidationRules();
        $validator = Validator::make([$data], $rules);
        // $trainerRegistrationCategory->validate();

        // if(count($trainerRegistrationCategory->errors()->all()) == 0) 
        // {
        //     return array('status'=>false);
        // } else 
        // {
        //     return array('status'=>true,'messageBag'=> $trainerRegistrationCategory->errors());
        // }
        if ($validator->fails()) {
            return array('status' => true, 'messageBag' => $validator->errors());
        } else {
            return array('status' => false);
        }
    }

    /**
     * Creates a new registration category instance for querying.
     *
     * @return trainerRegistration model
     * @author Kevin @ Cranium Creations
     */
    private function createModel()
    {
        return new TrainerRegistrationCategory();
    }

    /**
     * @param (id) trainerId
     * @return trainer registration category
     * get trainer for user id
     * Created By Sebin @ Cranium Creations
     */
    public function getTrainerRegCategory($trainerId)
    {
        return $this->createModel()->newQuery()
            ->where('trainer_id', '=', $trainerId)
            ->get();
    }
}
