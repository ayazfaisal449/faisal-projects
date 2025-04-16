<?php namespace Models\Permission;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {
	
	/*
	 * Table name for permission
	 */
	 protected $table = 'permission';
	 
	 public function something() {
		return 'something';
	 }
	 
}