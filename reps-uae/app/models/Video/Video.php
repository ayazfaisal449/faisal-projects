<?php namespace Cranium\VideoGallery\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model {

	protected $table = 'video';
	public $timestamps = true;
	protected $softDelete = true;
    protected $guarded = array();
    protected $hidden = array();
    
    /**
     * Ardent Validation 
     */
    public static $rules = array (
        'title' => 'required',
        'code' => 'required',
        'type_id' => 'required',
    );
    
    /**
     * Inverse category relationship
     *
     * @return belongsTo 
     * @author Chris @ Cranium Creations
     */
    public function category()
    {
        return $this->belongsTo('Cranium\VideoGallery\Models\VideoCategory',
            'category_id');
    }

    /**
     * Inverse type relationship
     *
     * @return belongsTo 
     * @author Chris @ Cranium Creations
     */
    public function type()
    {
        return $this->belongsTo('Cranium\VideoGallery\Models\VideoType',
            'type_id');
    }

    /**
     * Changes the status of a video.
     *
     * @return Boolean
     * @author Chris @ Cranium Creations
     */
    public function changeStatus()
    {
        $this->is_active = $this->is_active ? false : true;

        return $this->save();
    }

    /**
     * Generates the embed html.
     *
     * @param Int
     * @param Int
     * @return String
     * @author Chris @ Cranium Creations
     */
    public function getEmbedHTML($width, $height)
    {
        $html = $this->type->html_code;

        return sprintf($html,$width,$height,$this->code);
    }
}