<?php namespace Cranium\TrainerMedia\Models;

use LaravelBook\Ardent\Ardent;
use Cranium\Trainer\Models\Trainer;

class TrainerMedia extends Ardent {
	
	/**
	 * Created By Jahir @ Cranium Creations 
	 * Table name for TrainerMedia
	 */
    protected $table = 'trainer_media';
	
    /**
     * soft guarded is enabled
	 */
    protected $guarded = array();
	
    /**
     * soft delete is enabled
	 */
    protected $softDelete = true;
	 
    /**
     * relation with trainer
     * Created by Jahir @itmarkerz
     * Modified by Kevin @ Cranium Creaitons
     */
	public function trainer()
	{
		return $this->belongTo('Cranium\Trainer\Models\Trainer',
            'trainer_id');
	}
	 
}