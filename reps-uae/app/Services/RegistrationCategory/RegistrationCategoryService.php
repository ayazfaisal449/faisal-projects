<?php namespace Cranium\RegistrationCategory\Services;

use Cranium\RegistrationCategory\Models\RegistrationCategory;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class RegistrationCategoryService 
{

	protected $registrationCateogryProvider;

	/*
	* initialise provider
	* Created By Kevin @ Cranium Creations
	*/
	public function __construct($registrationCategoryProvider)
    {
		$this->registrationCateogryProvider = $registrationCategoryProvider;			
	}

	/*
	* @param (int)
	* get all users
	* Created By Kevin @ Cranium Creations
	*/
	public function getAll() 
    {
		return $this->registrationCateogryProvider->getAll();
	}
		
	/*
	 * @param id (int)
	 * get Permission By Id
	 * Created By Kevin @ Cranium Creations
	 */
	public function getById($id) 
    {
		return $this->registrationCateogryProvider->getById($id);
	}

}