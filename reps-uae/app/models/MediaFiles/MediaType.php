<?php 
namespace App\Models\MediaFiles;
use Illuminate\Database\Eloquent\Model;
class MediaType extends Model {
	
	/*
	 *Created By Jahir @ Cranium Creations 
	 *Table name for media type
	 */
	 protected $table = 'media_type';
	 /**
		 * get All media types
		 * Created By jahir @ Cranium Creations
	 */
	public static function getAll()
	{
		return parent::all();
	}
}