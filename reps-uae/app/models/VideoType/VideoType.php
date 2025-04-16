<?php namespace Cranium\VideoGallery\Models;


use Illuminate\Database\Eloquent\Model;
class VideoType extends Model {

	protected $table = 'video_type';
	public $timestamps = true;
	protected $softDelete = true;
    protected $guarded = array();
    protected $hidden = array();
	
    /**
     * Video has many relationship
     *
     * @return hasMany 
     * @author Chris @ Cranium Creations
     */
    public function videos()
    {
        return $this->hasMany('Cranium\VideoGallery\Models\Video',
            'type_id');
    }
}