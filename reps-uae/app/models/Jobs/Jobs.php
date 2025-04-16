<?php namespace Cranium\Jobs\Models;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model {

    protected $table = 'jobs';
    
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
