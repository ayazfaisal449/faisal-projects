<?php namespace Cranium\PhotoGallery\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
class PhotoCategory extends Model {

	protected $table = 'photo_category';		
	public $timestamps = true;	
	protected $softDelete = true;	
    protected $guarded = array();
    protected $hidden = array();
	
    /**
     * Ardent Validation 
     */
    public static $rules = array (
        'name' => 'required|unique:photo_category',
    );
    
    /**
     * Sets up the many to one relationship with photos.
     *
     * @return hasMany
     * @author Chris @ Cranium Creations
     */
    public function photos()
    {
        return $this->hasMany('Cranium\PhotoGallery\Models\Photo',
            'category_id');
    }

    /**
     * Adds a photo to a category.
     *
     * @return Photo
     * @author Chris @ Cranium Creations
     */
    public function addPhoto($photo)
    {
        return $this->photos()->create($photo);
    }

    /**
     * Changes the status of a photo category.
     *
     * @return Boolean
     * @author Chris @ Cranium Creations
     */
    public function changeStatus()
    {
        //$this->is_active = $this->is_active ? false : true;
		//return $this->save();
		return parent::save() ? true:false;
        
    }
}