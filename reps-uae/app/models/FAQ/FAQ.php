<?php namespace Cranium\FAQ\Models;

// use LaravelBook\Ardent\Ardent;
use Illuminate\Database\Eloquent\Model;
class FAQ extends Model {

    protected $table = 'faq';
    
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
