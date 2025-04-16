<?php namespace Models\Permission;

use Models\Permission\Permission;

class PermissionProvider{
	
	/*
	* reference the modal
	* Created By Kevin @ Cranium Creations
	*/	
	private function createModel(){
		return new Permission();		
	}
	
	/*
	 * get all permission
	 * Created By Kevin @ Cranium Creations
	 */
	 public function getAll() {
		$permission = $this->createModel();
		return $permission::all();
	 }
	 
	 /*
	  * create new permission
	  * Created By Kevin @ Cranium Creations
	  */
	 public function create($data) {
		$permission = $this->createModel();
		$permission->name = $data['name'];
		$permission->title = $data['title'];
		return $permission->save();
	 }
	 
	/*
	 * get all permission
	 * Created By Kevin @ Cranium Creations
	 */
	 public function getById($id) {
		$permission = $this->createModel();
		return $permission::find($id);
	 }
}