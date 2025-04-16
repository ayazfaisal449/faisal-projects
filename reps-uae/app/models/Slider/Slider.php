<?php namespace Cranium\Slider\Models;

// use LaravelBook\Ardent\Ardent;
use Illuminate\Database\Eloquent\Model;
class Slider extends Model {

    protected $table = 'slider';
    protected $guarded = array();

    public function getAll()
    {
        return $this->createModel()->newQuery()->get();
    }
}