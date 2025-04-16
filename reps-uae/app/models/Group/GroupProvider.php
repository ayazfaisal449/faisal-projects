<?php namespace Models\Group;

use Models\Group\Group;

class GroupProvider{
	
	/*
	* reference the modal
	* Created By Kevin @ Cranium Creations
	*/	
	private function createModel(){
		return new Group();		
	}
	
	/*
	 * get all groups
	 * Created By Kevin @ Cranium Creations
	 */
	 public function getAll() {
		$group = $this->createModel();
		return $group::all();
	 }
	 
	 /*
	  * create new group
	  * Created By Kevin @ Cranium Creations
	  */
	 public function create($data) {
		$group = $this->createModel();
		$group->name = $data['name'];
		$group->title = $data['title'];
		return $group->save();
	 }
	 
	/*
	 * get group by Id
	 * Created By Kevin @ Cranium Creations
	 */
	 public function getById($id) {
		$group = $this->createModel();
		return $group::find($id);
	 }
}