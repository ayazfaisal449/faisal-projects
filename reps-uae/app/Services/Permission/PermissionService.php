<?php namespace Services\Permission;

use Models\Permission\Permission;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class PermissionService{

	protected $permissionProvider;

	/*
	* initialise provider
	* Created By Kevin @ Cranium Creations
	*/
	public function __construct($permissionProvider){
		$this->permissionProvider = $permissionProvider;			
	}

	/*
	* @param (int)
	* get all users
	* Created By Kevin @ Cranium Creations
	*/
	public function getAllPermissions() {
		return $this->permissionProvider->getAll();
	}

	/*
	* @param (array)
	* save Permission
	* Created By Kevin @ Cranium Creations 
	*/
	public function save($data) {
		return $this->permissionProvider->create($data);
	}
	
		
	/*
	 * @param id (int)
	 * get Permission By Id
	 * Created By Kevin @ Cranium Creations
	 */
	public function getById($id) {
		return $this->permissionProvider->getById($id);
	}
	
	/*
	 * @param id (int), groups (array)
	 * delete Permission
	 * Created By Kevin @ Cranium Creations
	 */
	public function delete($id) {
	
		//get the permission 
		$permission = $this->permissionProvider->getById($id);
		$groups = Sentry::findAllGroups();
		//remove the permission from the group
		foreach($groups as $group) {
			foreach($group->permissions as $key=>$value) {
			
				if($permission->name == $key) {
					$group->permissions = array(
						$key => 0
					);
					$group->save();
				}
			}
		}
		
		$permission->delete();
		
	}
	
	/*
	 * @param (id)
	 * update Permission
	 * Created By Kevin @ Cranium Creations
	 */
	public function update($id,$data) {
	
		$permission = $this->permissionProvider->getById($id);
		$permission->name=$data['name'];
		$permission->title=$data['title'];
		
		return $permission->save();
		
	}
}