<?php
namespace App\Http\Controllers;
class PermissionController extends BaseController {

    /*
	 * Gets all permission
	 * Created By Kevin @ Cranium Creations
	 */
	public function manage () {
	
		$permissions = array();
		foreach (Permission::getAllPermissions() as $value) {
			$permissions[$value->name][] = $value->title;
			$permissions[$value->name][] = $value->id;
		}

        $paginatedData = $this->paginator($permissions,10);
		 
        $data = array(
            'data' =>  $paginatedData['data'],
            'required'=> array('Name', 'Action'),
            'edit' => 'permission',
            'paginator' =>  $paginatedData['links']
        );
        
        return View::make('permission.manage',$data);
	}
	
	/*
	 * Permission Form
	 * @param id (int) user id for update
	 * Created By Kevin @Cranium Creations
	 */
	public function permissionForm($id=Null) {
		
		if(!empty($id)) {
			$permission = Permission::getById($id);
            
             $input = array(
                0=>array('id','hidden','Id',$permission->id),
				1=>array('name','text','Permission Name',$permission->name),
                2=>array('title','text','Permission Title',$permission->title),
			);
            
            $data = array(
                'input' => $input,
                'update' => 'Permission',
                'data' => $permission,
                'form' => 'permission'
            );
            
			return View::make('permission.update',$data);
		} else {
			return View::make('permission.add');
		}
		
	}
	
	/*
	 * Saves Permission
	 * Created By Kevin @ Cranium Creations
	 */
	public function save() {
	
		$id = Input::get('id');
        
        $data = array(
				'name'     => Input::get('name'),
				'title'	   => Input::get('title')
			);
		
		// Update an existing permission
		if(isset($id)) {
			$permission = Permission::update($id,$data);
		} // Create new permission
		else {
			$permission = Permission::save($data);
		}
			
	}
	
	/*
	 * @param id (int) 
	 * Delete Permission
	 * Created By Kevin @ Cranium Creations
	 */
	 public function delete() {
		return Permission::delete(Input::get('id'));
	 }

}