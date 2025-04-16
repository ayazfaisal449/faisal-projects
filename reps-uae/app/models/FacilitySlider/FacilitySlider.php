<?php namespace Cranium\FacilitySlider\Models;

// use LaravelBook\Ardent\Ardent;
use Illuminate\Database\Eloquent\Model;
class FacilitySlider extends Model {

    protected $table = 'facility_slider';
    
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
