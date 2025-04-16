<?php
namespace App\Http\Controllers;
class GroupController extends BaseController {

    /*
	 * Gets all Groups
	 * Created By Kevin @ Cranium Creations
	 */
	public function manage () 
    {    
        $groups = array();
        foreach ( Sentry::findAllGroups() as $value ) 
        {
            $groups[$value->name][] = $value->name;
			$groups[$value->name][] = $value->id;
        }
		
        $paginatedData = $this->paginator($groups,5);
		 
        $data = array(
            'data' =>  $paginatedData['data'],
            'required'=> array('Name', 'Action'),
            'edit' => 'group',
            'paginator' =>  $paginatedData['links']
        );
		 
		 return View::make('group.manage', $data);
	}
	
	/*
	 * Group Form
	 * @param id (int) user id for update
	 * Created By Kevin @Cranium Creations
	 */
	public function groupForm($id=Null) {
		
		$permissions = Permission::getAllPermissions();
		
		if(!empty($id)) 
        {
            
            //find the group
            $group = Sentry::findGroupById($id);

            $input = array(
                0=>array('id','hidden','Id',$group->id),
                1=>array('name','text','Group Name',$group->name)
            );
            
            //finding all inputs for subForm
            $subForm = array();
           
            foreach($permissions as $permission) {

                $subForm[] = array(
                    'permissions['.$permission->name.']',
                    'checkbox',
                    $permission->title,
                    $permission->name,
                    1,
                    isset($group->permissions[$permission->name])?1:0,
                );
            }
            
            $data = array(
                'update' => 'Group',
                'form' => 'group',
                'subForm' => $subForm,
                'input' => $input,
                'data' => $group,
                'subFormTitle' => 'Permissions'
            );
			
			return View::make('group.update',$data);
		} 
        else 
        {
            
            $data =array(
                'permissions' => $permissions
            );
        
			return View::make('group.add',$data);
		}
		
	}
	
	/*
	 * Save User
	 * Created By Kevin @Cranium Creations
	 */
	public function save() 
    {
		$id = Input::get('id');
		
        $validator = Validator::make(
            array(
                'name'=> Input::get('name'),
                'permissions'=>Input::get('permissions')
            ),
            array(
                'name'=>'required|min:3',
                'permissions'=>'required'
            )
        );
        
		if(isset($id)) {
            if ($validator->fails()) 
            {
				return Redirect::to('admin/group/update/'.$id)->withErrors($validator)->withInput();
			}
            else 
            {
                //update group
                Group::updateGroupName($id,Input::get('name'));
                Group::updateGroupPermissions($id,Input::get('permissions'));
                
                //redirect to manage page
                return Redirect::to('admin/group');
            }
		}
		else 
        {
            if ($validator->fails()) 
            {
				return Redirect::to('admin/group/add/')->withErrors($validator)->withInput();
			}
            else 
            {
                // Create group
                $permissions = Input::get('permissions');
                
                if(!empty($permissions)) {
                    $group = Sentry::createGroup(array(
                        'name' => Input::get('name'),
                        'permissions' => Input::get('permissions')
                    ));
                } else {
                    $group = Sentry::createGroup(array(
                        'name' => Input::get('name')
                    ));
                }
                
                //redirect to manage page
                return Redirect::to('admin/group');
			}
		}
	}
	
	/* 
	 * Delete a Group
	 * Created By Kevin @ Cranium Creations
	 */
	public function delete() 
    {
		Group::delete(Input::get('id'));
	}

}