<?php 
namespace App\Models\Nationality;

use Illuminate\Database\Eloquent\Model; 
class Nationality extends Model {
	
	/*
	 *Created By Jahir @ Cranium Creations 
	 *Table name for Trainer
	 */
	 protected $table = 'nationality';
	 /**
		 * get All nationality
		 * Created By jahir @ Cranium Creations
	 */
	public static function getAll()
	{
		return parent::orderBy('name')->get();
	}
}