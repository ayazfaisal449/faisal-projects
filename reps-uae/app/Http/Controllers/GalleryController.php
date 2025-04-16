<?php
namespace App\Http\Controllers;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\View;
use Video;
use Photo;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
class GalleryController extends BaseController { 
     
    /*
    * Gets all photos
    * Created By Kevin @ Cranium Creations
    */
	public function manage () {
    
        $photoCatagories = Photo::getPhotoCategoryProvider(); 
       
        $default = array();
        
        foreach ($photoCatagories->getAll() as $value) {
            $default[$this->getSlug($value->name)][] = $value->name;
            $default[$this->getSlug($value->name)][] = $value->id;
            $default[$this->getSlug($value->name)][] = $value->is_active;
        }
        
        $paginatedData = $this->paginator($default,10);
        
        $data = array(
            'data' =>  $paginatedData['data'],
            'required'=> array('Title', 'Action'),
            'edit' => 'gallery',
            'paginator' =>  $paginatedData['links']
        );
        
        return View::make('gallery.manage',$data);
		
	}
    
    /*
	 * Photo Gallery Form
	 * @param id (int) photo gallery id for update
	 * Created By Kevin @Cranium Creations
	 */
	public function galleryForm($id=Null) 
    {
                
		if( !empty($id) ) 
        {
            $photoCategory = Photo::getPhotoCategoryProvider();
			$photoCategory = $photoCategory->getById($id);
            $photos = $photoCategory->photos;
            
            $default = array();
            
            if( count($photos) >0 ) 
            {
                // paginating the photos 
                foreach($photos as $photo) 
                {
                    $default[$photo->filename][] = $photo->filename;
                    $default[$photo->filename][] = $photo->title;
                    $default[$photo->filename][] = $photo->id;
                }
                
                $paginatedData = $this->paginator($default,3);
            }
            
            $data = array(
                'photoCategory' => $photoCategory,
                'photos' => isset($paginatedData) ? $paginatedData['data'] : array(),
                'paginator' => isset($paginatedData) ? $paginatedData['links'] : array()
            );
            
			return View::make('gallery.update',$data);
            
		} else {
        
			return View::make('gallery.add');
            
		}
		
	}
	
	 /*
    * Photo Gallery save
    * @param id (int) photo gallery id for update
    * Created By Kevin @Cranium Creations
    */
    public function save() {
        
        $files  = Input::file('files');
        $id = Input::get('id');
        $name = Input::get('name');
        
        if( isset( $id ) ) 
        {
			$errors_list = new MessageBag();
                        $file_has_error = false;
                        
                        $validatorN = Validator::make(array('name'=>$name), array(
                            'name' => 'required'
                        ));
                        if ($validatorN->fails()) {
                            $errors_list = $errors_list->merge($validatorN->errors());
                            $file_has_error = true;
                        }
			
			foreach(Input::file('files') as $file) {
				$validatorF = Validator::make(array('files'=> $file), array(
					'files' => 'sometimes|image'
				));
				
				if ($validatorF->fails()) {
					$errors_list = $errors_list->merge($validatorF->errors());
					$file_has_error = true;
					break;
				}
			}
			
			if(!$file_has_error) {
				//create the photo category
				$errors = Photo::saveCategory(Input::get('name'), 
									Input::get('description'),$id); 
				 
				//validate
				if(!$errors['status'] && $errors['update'])
				{
					// upload photos for category
					if( isset($files[0]) )  
					{
					   // save the photos within the photo category
						foreach ($files as $file) {
							Photo::savePhoto($file->getClientOriginalName(), 
								$file->getClientOriginalName(), $id , $file);
						} 
					}
					return Redirect::to('admin/gallery/');  
				}
				else 
				{
					if(isset($errors['messageBag']))
						$errors_list = $errors_list->merge($errors['messageBag']);
					return Redirect::to('admin/gallery/update/'.$id)
							->withErrors($errors_list)->withInput();
				}
			} else {
				return Redirect::to('admin/gallery/update/'.$id)
							->withErrors($errors_list)->withInput();
			}
            
        }
        else 
        {
			$errors_list = new MessageBag();
			$file_has_error = false;
                        
                        $validatorN = Validator::make(array('name'=>$name), array(
                            'name' => 'required'
                        ));
                        if ($validatorN->fails()) {
                            $errors_list = $errors_list->merge($validatorN->errors());
                            $file_has_error = true;
                        }
                        
			foreach(Input::file('files') as $file) {	
				$validatorF = Validator::make(array('files'=> $file), array(
					'files' => 'required|image'
				));
				
				if ($validatorF->fails()) {
					$errors_list = $errors_list->merge($validatorF->errors());
					$file_has_error = true;
					break;
				}
			}
			
			if(!$file_has_error) {
				//create the photo category
				$photoCategory = Photo::saveCategory(Input::get('name'),Input::get('description')); 
					       
				 //validate
				if( !$photoCategory['errors']['status'] && $photoCategory['errors']['update'])
				{
					
					// upload photos for category
					if( isset($files[0]) )  
					{
						// save the photos within the photo category
						foreach ($files as $file) {
							Photo::savePhoto($file->getClientOriginalName(),
									$file->getClientOriginalName(),
									$photoCategory['category']->id , $file);
						}
					}
					
					return Redirect::to('admin/gallery/');
				}
				else
				{
					if(isset($photoCategory['errors']['messageBag']))
						$errors_list = $errors_list->merge($photoCategory['errors']['messageBag']);
					return Redirect::to('admin/gallery/update/'.$id)
							->withErrors($errors_list)->withInput();
				}
			} else {
				return Redirect::to('admin/gallery/update/'.$id)
							->withErrors($errors_list)->withInput();
			}
           
        }
        
    }
	
	
    
    /*
    * Delete a photo
    * @param $photoGallery $id (int), $filename (string), 
    * Created By Kevin @ Cranium creations
    */
    public function deletePhoto($photoGalery, $fileName, $id) {
    
        Photo::deletePhoto($photoGalery, $fileName, $id);
		return Redirect::to('admin/gallery/update/'.$photoGalery);
       
    }
    
    /*
    * Delete a photo category
    * @param $id (int), 
    * Created By Kevin @ Cranium creations
    */
    public function deletePhotoCategory($id) {
    
        Photo::deleteCategory($id);
		return Redirect::to('admin/gallery');
       
    }
    
    /**
     * Show all the galleries and videos
     * Created By Kevin @ Cranium Creations
     */
    public function galleries()
    {
        $videos = Video::getVideoProvider();
         
        $data = array(
            'galleries' => Photo::getAllGalleries(),
            'videos' => $videos->getAll()
            
        );
           
        return View::make('gallery.galleries',$data);
    }
    
    /**
     * @param $slug (text), $id (int)
     * Show gallery
     * Created By Kevin @ Cranium Creations
     */
    public function gallery($slug, $id)
    {
        $gallery = Photo::getPhotoProvider();
        $galleryCategory = Photo::getPhotoCategoryProvider();
        
        $data = array (
            'categoryId' => $id,
            'gallery' => $gallery->getByCategoryId($id),
            'galleryCategory' => $galleryCategory->getById($id)
        );
        
        return View::make('gallery.gallery',$data);
    }
    
    /* 
     * change status of a gallery
     * @prams id (int) and status (int)
     * 
     */
    public function changeStatus($id,$status)
    {
        Photo::changeCategoryStatus($id);
        return Redirect::to('admin/gallery');
    }
}