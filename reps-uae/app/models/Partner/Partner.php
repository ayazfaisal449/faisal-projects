<?php namespace Cranium\Partner\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model {

    protected $table = 'partner';
    
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
