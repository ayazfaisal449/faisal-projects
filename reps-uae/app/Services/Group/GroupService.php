<?php namespace Services\Group;

use Models\Group\Group;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class GroupService{

	protected $groupProvider;

	/*
	* initialise provider
	* Created By Kevin @ Cranium Creations
	*/
	public function __construct($groupProvider){
		$this->permissionProvider = $groupProvider;			
	}
	
	/*
	 * @param id (int)
	 * delete Group
	 * Created By Kevin @ Cranium Creations
	 */
	public function delete($id) {
	
		//get the group 
		$group = Sentry::findGroupById($id);
		$group->delete();
		
	}
	
	/*
	 * @param (id)
	 * update Group Name
	 * Created By Kevin @ Cranium Creations
	 */
	public function updateGroupName($id,$name) {
	
		//find the group
		$group = Sentry::findGroupById($id);
		$group->name = $name;
		$group->save();
		
	}
	
	/*
	 * @param groupId (int), permissions (array)
	 * update Group Name
	 * Created By Kevin @ Cranium Creations
	 */
	public function updateGroupPermissions($groupId,$permissions) {
	
		$groupPermissions = Sentry::findGroupById($groupId)->permissions;
		$perms = array();
        
        
       
			
		if(empty($permissions)) {
			foreach ($groupPermissions as $gpKey=>$gpValue) {
				$perms[$gpKey] = 0;
			}
		} else if(empty($groupPermissions)) {
			$perms = $permissions;
		} else {
			//revoke group permissions
			foreach($permissions as $key => $value) {
				foreach ($groupPermissions as $gpKey=>$gpValue) {
					if($gpKey == $key) {
						$perms[$key] = $value;
					} else {
						$perms[$gpKey] = 0;
					}
				}
			}
			//add new group permissions
			foreach($permissions as $key => $value) {
				foreach ($groupPermissions as $gpKey=>$gpValue) {
					if($gpKey != $key) {
						$perms[$key] = $value;
					}
				}
			}
		}
		
		$group = Sentry::findGroupById($groupId);
		$group->permissions = $perms;
		$group->save();
	}
}