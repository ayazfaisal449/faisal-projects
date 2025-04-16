<?php namespace Cranium\RegistrationCategory\Models;

use Cranium\RegistrationCategory\Models\RegistrationCategory;

class RegistrationCategoryProvider {

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
            ->orderBy('level', 'ASC')
            ->get();
    }
    
    /**
     * Creates a new registration category instance for querying.
     *
     * @return trainerRegistration model
     * @author Kevin @ Cranium Creations
     */
    private function createModel()
    {
        return new RegistrationCategory();		
    }

}