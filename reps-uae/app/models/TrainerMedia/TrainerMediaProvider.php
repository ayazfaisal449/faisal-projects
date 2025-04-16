<?php namespace Cranium\TrainerMedia\Models;

use Cranium\TrainerMedia\Models\TrainerMedia;

class TrainerMediaProvider{
	
    /*
	 * reference the modal
	 * Created By Jahir @ Cranium Creations
	 */	
	private function createModel()
	{
		return new TrainerMedia();		
	}
	
	/*
	 * get all TrainerMedia
	 * Created By Jahir @ Cranium Creations
	 */
	 public function getAll() 
	 {
		$media = $this->createModel();
		return $media::all();
	 }
	 
	/*
	 * get TrainerMedia by Id
	 * Created By Jahir @ Cranium Creations
	 */
	 public function getById($id) 
	 {
		$media = $this->createModel();
		return $media::find($id);
	 }
	 /*
	 * get TrainerMedia by type
	 * Created By Jahir @ Cranium Creations
	 */
	 public function getByType($type) 
	 {
		$media = $this->createModel();
		return $media::find($id);
	 }
}