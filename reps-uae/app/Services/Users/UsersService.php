<?php namespace Services\Users;

use Models\Users\Users;
use Cartalyst\Sentry\Users\Eloquent\User as Sentry;


class UsersService{

	protected $usersProvider;
	
	/*
	 * initialise provider
	 * Created By Kevin @ Cranium Creations
	 */
	public function __construct($usersProvider)
	{
		$this->usersProvider = $usersProvider;			
	}
        
        public function getTrainerById($trainer_id) {
            return $this->usersProvider->getTrainerById($trainer_id);
        }
        
        
	/*
	 * @param (int)
	 * get all users
	 * Created By Kevin @ Cranium Creations
	 */
	 public function getAllUsers($active=null) 
	 {
		
		return $this->usersProvider->getAll($active);
	 }
	 /*
	 * get all trainers
	 * @param int $acitve
	 * Created By Jahir @ Cranium Creations
	 */
	 public function getAllTrainers($active) 
	 {
		
		return $this->usersProvider->getAllTrainers($active);
	 }
	 /*
	 * add to mailchimp
	 * @param object_array $mailchimp
	 * @param int $id
	 * @param object_array $user
	 * Created By Jahir @ Cranium Creations
	 */
	public function subscribe($mailchimp, $id, $user) 
	{
		$listParams = array("filters" => null, "start" => 0, "limit" => 5, "sort_field" => 'created', "sort_dir" => 'DESC');
    	$lists = $mailchimp->call('lists/list', $listParams);
    	$id = $lists['data'][0]['id'];
    	$opts = array("start" => 0, "limit" => 5, "sort_field" => 'created', "sort_dir" => 'DESC'); 
   		$membersParams = array("id" => $id, "status" => 'subscribed', "opts" => $opts);
   		$members = $mailchimp->call('lists/members', $membersParams);
   		$n = $members['total'];
   		$flag = 0;
   		for ($i = 0; $i < $n ; $i++) 
   		{ 
   			if($members['data'][$i]['email']==$user->email)
   			{
   				$flag = 1;
   				$i = $n;
   			}
   		}
   		if($flag==0)
   		{
   			$euid = $members['data'][$n-1]['euid'];
    		$leid = $members['data'][$n-1]['leid'];
    		$email = array('email' => $user->email,'euid' => $euid ,'leid'=> $leid );
    		$subscribeParams = array("id" => $id, "email" => $email, "merge_vars" => null, "email_type" => 'html', "double_optin" => true, "update_existing" => false, "replace_interests" => true, "send_welcome" => false);
   			$mailchimp->call('lists/subscribe', $subscribeParams);
   			
   			return 1;
   		}
   		else
   		{
   			
   			return 0;
   		}
	}
}