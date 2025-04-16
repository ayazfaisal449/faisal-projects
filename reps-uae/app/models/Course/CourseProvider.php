<?php namespace Cranium\Course\Models;

use Illuminate\Pagination;
use Cranium\Course\Models\Course;

use Illuminate\Support\Facades\Validator;
class CourseProvider {
	
	/*
	 * reference the modal
	 * Created By Raj @ Cranium Creations
	 */	
	private function createModel()
	{
		return new Course();		
	}
	
	/*
	 * get all courses
	 * @param status (int)	
	 * @return  object array
	 * Created By Raj @ Cranium Creations
	 */
	public function getAll($status=NULL)
	{		 
		$course = $this->createModel();
        
		if($status==NULL)
        {
			return $course->orderBy('created_at','desc')->get();
        }
		else
        {
			return $this->createModel()->newQuery()
                ->where('status','=',$status)
                ->orderBy('created_at','desc')->get();
        }
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
		return $course::where('category', '=', $id)->with('courseProvider')->get();		
	 }
	 
	/*
	 * get course by id
	 * @param id (int)	
	 * @return  object	
	 * Created By Raj @ Cranium Creations
	 */	  
	 public function getById($id=NULL) 
	 {		 
		$course = $this->createModel();
		return $course::find($id);		
	 }

	
	 
	 /*
	  * get courseProvider for course by id
	  * @param course id (int)
	  * @return  object	array		 
	  * Created By Raj @ Cranium Creations
	  */
	 public function getCourseProviderForCourse($course_id=NULL) 
	 {		 
		$course = $this->createModel();
		$course_object =  $course::find($course_id);		
		return $course_object->courseProvider;	
	 }

	 /*	 
	  * get cpd course for courseProvider by id
	  * @param course id (int)
	  * @return  object	array		 
	  * Created By Vineeth @ Cranium Creations
	  */
	public function getCoursesForProvider($id,$type)
	{
		$course = $this->createModel(); 
        $where = 'course_type=? and status=? and course_provider_id=?';
		return  $course::whereRaw($where,array($type,1,$id))
            ->get()->toArray();
	}

	 	 
	 /**
     * Validates data from ardent
     *
     * @param array()
     * @return Collection of errors
     * @author Raj @ Cranium Creations
     */
    public function validate( $id = null,$data)
    {  
		$rules = [
			'name' => 'required',
			// 'category' => 'required',
			'description' => 'required',
			'website' => 'required',
			'logo' => 'required|image' // Ensures the logo is an image file
		];
		$validator = Validator::make($data, $rules);
		if ($validator->fails()) {
			return [
				'status' => true,
				'messageBag' => $validator->errors()
			];
		}
		if ($id) {
			
			$courseProvider = $this->getById($id);
			$courseProvider->fill($data);
		} else {
		
			$courseProvider = $this->createModel()->fill($data);
		}
        // if ($id)
        // {
        //     $course = $this->getById($id);
        //     $course->fill($data);
        //     $course->validateUniques();
        // }
        // else
        // {	
        //     $course = $this->createModel()->fill($data);
        //     $course->validate();
        // }
      
        // if(count($course->errors()->all()) == 0) 
        // {
        //     return array('status'=>false);
        // } else 
        // {
        //     return array('status'=>true,'messageBag'=>$course->errors());
        // }

		return ['status' => false];
    }
    /*
	 * get all Cpd Name	
	 * @return  object array
	 * Created By Anildev @ Cranium Creations
	 
	public function getCpdProviderCourse()
	{		 
		$course = $this->createModel();
		
		return $course::where('course_type','=',1)->get();
	}*/
	
	
	public function adminSearchCourse($data)
    {
    
        $default = array();

        $course = $this->createModel()->newQuery();
     
        $course->join('course_provider',
            'course_provider.id','=','course.course_provider_id');

        //check if the name is set
        if($data != '')
        {
			$course->where(function ($query) use ($data)
			{
				$query->where('course.name','LIKE','%' . $data . '%')
					->orWhere('course_provider.name','LIKE','%' . $data. '%');
			}); 
        }
        
        return $course->get(array(
            'course.name',
            'course.id',
            'course.status'
        ));		
     }
	 
}