<?php namespace Cranium\Trainer\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentTrace extends Model {
    
    protected $table = 'payment_trace';
    protected $softDelete = false;
    protected $guarded = array();
}