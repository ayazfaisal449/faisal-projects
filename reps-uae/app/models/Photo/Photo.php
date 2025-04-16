<?php namespace Cranium\PhotoGallery\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model {

	protected $table = 'photo';
	public $timestamps = true;
	protected $softDelete = true;
    protected $guarded = array();
    protected $hidden = array();
	
    /**
     * Inverse category relationship
     *
     * @return belongsTo 
     * @author Chris @ Cranium Creations
     */
    public function category()
    {
        return $this->belongsTo('Cranium\PhotoGallery\Models\PhotoCategory',
            'category_id');
    }

    /**
     * Changes the status of a photo.
     *
     * @return Boolean
     * @author Chris @ Cranium Creations
     */
    public function changeStatus()
    {
        $this->is_active = $this->is_active ? false : true;
        return $this->save();
    }

}