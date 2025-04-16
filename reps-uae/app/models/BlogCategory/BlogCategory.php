<?php 
//namespace 
//Cranium\BlogCategory\Models;
//use LaravelBook\Ardent\Ardent;
use Illuminate\Database\Eloquent\Model;
class BlogCategory extends Ardent {

    protected $table = 'blogcategory';
    
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
