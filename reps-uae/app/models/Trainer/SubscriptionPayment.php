<?php namespace Cranium\Trainer\Models;

use Illuminate\Database\Eloquent\Model;
class SubscriptionPayment extends Model {
    
    protected $table = 'subscription_payment';
    protected $softDelete = false;
    protected $guarded = array();
    
    public function trainer()
    {
        return $this->belongTo('Cranium\Trainer\Models\Trainer', 'trainer_id');
    }
}