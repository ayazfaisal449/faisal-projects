<?php namespace Cranium\VideoGallery\Models;

use Cranium\VideoGallery\Models\Video;
use LaravelBook\Ardent\Ardent;

class VideoCategory extends Ardent {

	protected $table = 'video_category';		
	public $timestamps = true;	
	protected $softDelete = true;	
    protected $guarded = array();
    protected $hidden = array();
	
    /**
     * Sets up the many to one relationship with videos.
     *
     * @return hasMany
     * @author Chris @ Cranium Creations
     */
    public function videos()
    {
        return $this->hasMany('Cranium\VideoGallery\Models\Video',
            'category_id');
    }

    /**
     * Adds a video to a category.
     *
     * @param array
     * @return Video
     * @author Chris @ Cranium Creations
     */
    public function addVideo($videoData)
    {   
        return $this->videos()->create($videoData);
    }

    /**
     * Changes the status of a video category.
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