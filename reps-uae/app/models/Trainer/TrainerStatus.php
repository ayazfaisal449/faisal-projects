<?php namespace Cranium\Trainer\Models;

;

class TrainerStatus extends \Illuminate\Database\Eloquent\Model {
    
    protected $table = 'status';
    protected $softDelete = false;
    protected $guarded = array();
}