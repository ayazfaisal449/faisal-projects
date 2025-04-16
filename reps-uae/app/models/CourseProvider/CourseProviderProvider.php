<?php namespace Cranium\CourseProvider\Models;

use Illuminate\Pagination;
use Cranium\CourseProvider\Models\CourseProvider;
use Cranium\Course\Models\Course;
use Illuminate\Support\Facades\Validator;
class CourseProviderProvider {
	
	/*
	 * reference the modal
	 * Created By Raj @ Cranium Creations
	 */	
	private function createModel()
	{
		return new CourseProvider();		
	}
	
	/*	
	 * @param status (int)
	 * get all CourseProviders
	 * Created By Raj @ Cranium Craetions
	 */
	public function getAll($status=NULL)
	{
		$courseProvider = $this->createModel();
		if($status==NULL)
			return $courseProvider::orderBy('created_at','desc')->get();
		else
			return $courseProvider::where('status','=',$status)->orderBy('created_at','desc')->get();
	}
	 
	 /*
	  * get courseProvider by id
	  * param id (int)
	  * @return object
	  * Created By Raj @ Cranium Craetions
	  */
	 public function getById($id)
	 {
		
		$courseProvider = $this->createModel();
		return $courseProvider::find($id);		
	 }
	
	 
	 /*
	  * get all courses of a courseProvider
	  * @param id (int)
	  * @return object array
	  * Created By Raj @ Cranium Craetions
	  */


	 public function getAllCourseProviderCourses($id)  
	 {
		 
		$courseProvider = $this->createModel();
		$courseProvider_object =  $courseProvider::find($id);		
		return $courseProvider_object->course;	
	 }
	 
	/*
	 * create courseProvider
	 * @param date (array)	
	 * @return  boolean
	 * Created By Raj @ Cranium Craetions
	 */
	 public function create($data=array())
	 {
		 
		$courseProvider = $this->createModel();
		$courseProvider->fill($data)->save();
		return $courseProvider->id;
	 }
	 
	/*
	 * get courseProvider by Name
	 * @param name (string)	
	 * @return  object array
	 * Created By Raj @ Cranium Craetions
	 */
	 public function getCourseProviderByName($name)
	 {
		 
		$courseProvider = $this->createModel();
		return $courseProvider::where('name','LIKE','%'.$name.'%')->get();
	 }
	 
	  /**
     * Validates data from ardent
     *
     * @param array()
     * @return Collection of errors
     * @author Kevin @ Cranium Creations
     */
    public function validate( $id = null,$data)
    {
		$rules = array (
			'name'=> 'required',
			// 'category'=> 'required',
			'description'=> 'required',
			'website' => 'required',	
			'logo' => 'required|image'
			//'logo' => 'required|mimes:png,jpg,jpeg,gif'
		);
		$validator = Validator::make($data, $rules);

		if ($validator->fails()) {
			return [
				'status' => true,
				'messageBag' => $validator->errors()
			];
		}
		if ($id) {
			// Update existing record
			$courseProvider = $this->getById($id);
			$courseProvider->fill($data);
		} else {
			// Create new record
			$courseProvider = $this->createModel()->fill($data);
		}
        // if ($id)
        // {
        //     $courseProvider = $this->getById($id);
        //     $courseProvider->fill($data);
        //     $courseProvider->validateUniques();
        // }
        // else
        // {
        //     $courseProvider = $this->createModel()->fill($data);
        //     $courseProvider->validate();
        // }
        
        // if(count($courseProvider->errors()->all()) == 0) 
        // {
        //     return array('status'=>false);
        // } else 
        // {
        //     return array('status'=>true,'messageBag'=>$courseProvider->errors());
        // }
		return ['status' => false];
    }
    
    /*
     * get all EntryQualificationCourses	
     * @return  object array
     * Created By Jahir @ Cranium Creations
     */
	public function getEntryQualificationCourses()
	{		 
        $courseProvider = $this->createModel()
        	->where('course_provider.status', '=', '1')
        	->orderBy('course_provider.category','ASC')
        	->orderBy('course_provider.name','ASC')
        	->get();

        //get all the course providers 
//        $courseProvider = $courseProvider::all();

        //set up an array
        $default = array();
        foreach($courseProvider as $cp)
        {
            $default[] = array(
                'courseProvider' => $cp->name,
                'courseProviderCategory' => $cp->category,
                'courseProviderWebsite' => $cp->website,
                'courseProviderLogo' => $cp->id.'/'.$cp->logo,
                'courses' => $cp->course()->where('course_type','=',0)->get()->toArray()
            );
        }
        
        return $default;
	}
        
    public function getAllCpdProviders()
    {
        $courseProviders = $this->createModel();
        return $courseProviders
            ->join('course','course.course_provider_id','=','course_provider.id')
            ->where('course.course_type','=',1)
            ->where('course_provider.status', '=', '1')
            ->orderBy('course_provider.name','ASC')
            ->groupBy('course_provider.id')
            ->get(array('course_provider.*'))
            ->toArray();
    }

     /*
	 * get course by category
	 * @param id (int)	
	 * @return  object	
	 * Created By Pat @ Cranium Creations
	 */	  
	 public function getByCategory($id=NULL) 
	 {	

		$course = $this->createModel();
		return $course->join('course','course.course_provider_id','=','course_provider.id')
            ->where('course.category','=',$id)
            ->where('course_provider.status', '=', '1')
            ->orderBy('course_provider.name','ASC')
            ->groupBy('course_provider.id')
            ->with('course')
            ->get(array('course_provider.*'));		
	 }
	 
}