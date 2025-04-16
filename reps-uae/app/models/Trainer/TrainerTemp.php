<?php namespace Cranium\Trainer\Models;
use Illuminate\Database\Eloquent\Model;

class TrainerTemp extends Model {
	
    protected $table = 'trainer_temp_table';
    protected $softDelete = false;
    protected $guarded = array();
}