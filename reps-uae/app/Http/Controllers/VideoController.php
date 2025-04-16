<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Video;
use DB as DBS;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
class VideoController extends BaseController {
    
    /*
	 * Gets all videos
	 * Created By Kevin @ Cranium Creations
	 */
	public function manage () {
    
        $videos = Video::getVideoProvider(); 

       
        $default = array();
        
        foreach ($videos->getAll() as $value) {
            $default[$this->getSlug($value->title)][] = $value->title;
            $default[$this->getSlug($value->title)][] = $value->id;
            $default[$this->getSlug($value->title)][] = $value->is_active;
        }
        
        $paginatedData = $this->paginator($default,10);
        
        $data = array(
            'data' =>  $paginatedData['data'],
            'required'=> array('Title', 'Action'),
            'edit' => 'video',
            'paginator' =>  $paginatedData['links']
        );
        
        return View::make('video.manage',$data);
		
	}
    
    /*
	 * Video Form
	 * @param id (int) user id for update
	 * Created By Kevin @Cranium Creations
	 */
	public function videoForm($id=Null) 
    {
    
        //get All video types
        $videoTypes = Video::getVideoTypeProvider();
        $types = $videoTypes->getALl();
        
        $default = array();
        foreach($types as $type) 
        {        
            $default[$type->id] = $type->name;
        }
        $types = $default;
        
        
		if(!empty($id)) 
        {
            $videos = Video::getVideoProvider();
			$video = $videos->getById($id);
            
            $input = array(
                0=>array('id','hidden','Id',$video->id),
				1=>array('cateogryId','hidden',
                         'Id',$video->category_id),
                2=>array('typeId','select',
                          'Video Type',$video->type_id, $default),
                3=>array('title','text','Video Title',$video->title),
                4=>array('description','textarea',
                          'Video Description',$video->description),
                5=>array('code','text',
                          'Video Code',$video->code),      
                6 => array('image','file','Video Image', $video->image),    
			);
            
            $data = array(
                'input' => $input,
                'update' => 'Video',
                'data' => $video,
                'form' => 'video'
            );
            
			return View::make('video.update',$data);
		} else {
        
            $data = array(
                'types'=> $types,
            );
        
			return View::make('video.add',$data);
		}
		
	}
    
    /*
	 * Saves Video
	 * Created By Kevin @ Cranium Creations
	 */
	public function save() 
    {
        $id = request()->get('id');

        if(!empty($id)) 
        {  
            
               $errors = Video::saveVideo(request()->get('title'),request()->get('description'), 1, request()->get('typeId'),
                request()->get('code'), request()->get('id')); 
                
                $location = '';
                if (request()->hasFile('image'))
                {
                    $name = request()->file('image')->getClientOriginalName();

                    request()->file('image')->move(public_path('images/video'), $name);
               
                    $location = 'images/video'.'/'.$name;
                    
                    DBS::table('video')
                    ->where('id', $id) 
                    ->update([
                        'image' => $location, // Assuming $location holds the new image value
                    ]);
                  
                }

                
            if(!$errors['status'] && $errors['update'])
            {
                return Redirect::to('admin/video/');  
            }
            else 
            {
                return Redirect::to('admin/video/update/'.$id)->withErrors($errors['messageBag'])->withInput();
            }
        }
		else 
        {
            $errors = Video::saveVideo(request()->get('title'),
                request()->get('description'), 1, request()->get('typeId'),
                request()->get('code'));   
                
                $location = '';
                if (request()->hasFile('image'))
                {
                    $name = request()->file('image')->getClientOriginalName();

                    request()->file('image')->move(public_path('images/video'), $name);
                    $id = DBS::table('video')->max('id');
                    $location = 'images/video'.'/'.$name;
                    DBS::table('video')
                    ->where('id', $id) // Assuming $id holds the ID of the record you want to update
                    ->update([
                        'image' => $location, // Assuming $location holds the new image value
                    ]);
                  
                }
                   
            
            if(!$errors['status'] && $errors['add'])
            {
                return Redirect::to('admin/video/');  
            }
            else 
            {
                return Redirect::to('admin/video/update/'.$id)->withErrors($errors['messageBag'])->withInput();
            }
        }        
	}
	
	/*
	 * @param id (int) 
	 * Delete Video
	 * Created By Kevin @ Cranium Creations
	 */
    public function delete($id=Null) 
    {
        if($id !=Null) 
        {
            Video::deleteVideo($id);
			return Redirect::to('admin/video');
        }
        else 
        {
            Video::deleteVideo(request()->get('id'));
        }
    }
    
    /**
     * @param $slug (text), $id (int)
     * Show video
     * Created By Kevin @ Cranium Creations
     */
    public function video($slug, $id)
    {
        $video = Video::getVideoProvider();
        
        $data = array (
            'video' => $video->getById($id)
        );
        
        return View::make('video.video',$data);
    }
	
	/* 
	 * change status of a gallery
	 * @prams id (int) and status (int)
	 * 
	 */
	public function changeStatus($id,$status)
	{
		
		Video::changeVideoStatus($id);
		return Redirect::to('admin/video');
	}
    
}