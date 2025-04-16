<?php namespace Models\Users;

use Cartalyst\Sentry\Users\Eloquent\User as Sentry;
use Cranium\Trainer\Models\Trainer;

class Users extends Sentry {
	
     protected $table = 'users';
     protected $softDelete = true;

    /**
     * Setting up the relationship with trainer
     * Created By jahir @ Cranium Creations
     */
    public function trainer()
    {
        return $this->hasOne('Cranium\Trainer\Models\Trainer','user_id');
    }
    
    /**
     * @param array tranier Data
     * @return Object Trainer
     * Add a new trainer
     * Created By jahir @ Cranium Creations
     */
    public function addTrainer($trainerData)
    {
        return $this->trainer()->create($trainerData);
    }

    public function comments()
    {
        return $this->hasMany('Cranium\Models\Comment', 'user_id', 'id');
    }
}