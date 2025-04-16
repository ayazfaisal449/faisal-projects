<?php namespace Services\Slider;

use Models\Users\Users;
use Models\Slider\Slider;
use Cartalyst\Sentry\Users\Eloquent\User as Sentry;


class SliderService{

	protected $sliderProvider;
	
	/*
	 * initialise provider
	 * Created By Kevin @ Cranium Creations
	 */
	public function __construct($sliderProvider)
	{
		$this->sliderProvider = $sliderProvider;			
	}
	 /**
     * Gets the slider  provider for simple lookups.
     *
     * @return PhotoCategoryProvider
     * @author pat @ Cranium Creations
     */
    public function getSliderCategoryProvider()
    {
        return $this->sliderProvider; 
    }
    public function save($data){

    	$image = new Slider;
		$image->text = $data['text']; 
		$image->description = $data['description']; 
		$image->url = $data['url']; 
		$image->button_text = $data['button_text'];
		$image->sort_order = $data['sort'];

		$image->save();

		return $image;
    }
        
     
        
        
	/*
	 * @param (int)
	 * get all users
	 * Created By Kevin @ Cranium Creations
	 
	 public function getAllUsers($active=null) 
	 {
		
		return $this->usersProvider->getAll($active);
	 }

	 /*
	 * get all trainers
	 * @param int $acitve
	 * Created By Jahir @ Cranium Creations
	 */
	 
	
}