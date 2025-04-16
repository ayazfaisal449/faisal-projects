<?php namespace Cranium\Benefit\Models;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model {

    protected $table = 'benefit';
    
    protected $guarded = array();


    /**
     * Gets all slider Photos.
     *
     * @return Collection
     * @author pat @ Cranium Creations
     */
    public function getAll()
    {
        return $this->createModel()->newQuery()
            ->get();
    }

}
