<?php

namespace Services\Course;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Cranium\Course\Models\Course;
use Cranium\CourseProvider\Models\CourseProvider;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class CourseService {

    protected $courseProvider;
    protected $courseProviderProvider;

//        protected $course;

    /*
     * initialise provider
     * Created By Raj @ Cranium Creations
     */
    public function __construct($courseProvider, $courseProviderProvider, $registrationCategoryProvider) {
        $this->courseProvider = $courseProvider;
        $this->courseProviderProvider = $courseProviderProvider;
        $this->registrationCategoryProvider = $registrationCategoryProvider;
//        $this->course = $course;
    }

    /*
     * create CourseProvider 
     * @param data (array)		
     * Created By Raj @ Cranium Creations
     */

    public function saveCourseProvider($id, $data, $file_array) {
        $imagePath = Config::get('courseProvider.imagePath');

        if ($file_array) {
            $file = $file_array['file'];
            $image = $file_array['name'] . '.' . $file_array['extension'];
        } else {
            $file = null;
        }

        if ($file) {
            if (!FILE::isDirectory($imagePath)) {
                FILE::makeDirectory($imagePath, 0755, true);
            }

            $data['logo'] = $file;
        }

        //check validation 
        $errors = $this->courseProviderProvider->validate($id, $data);

        if ($id) {
            if (!empty($errors['messageBag'])) {
                $errmsgs = $errors['messageBag']->getMessages();
            } else {
                $errmsgs = array();
            }
            if (!$file_array && count($errmsgs) == 1 && !empty($errmsgs['logo']) && $errmsgs['logo']['0'] == 'The logo must be an image.') {
                $errors = null;
            }

            $photo = $this->courseProviderProvider->getById($id);

            //check errors before update
            if ($errors['status']) {
                return array(
                    'status' => $errors['status'],
                    'messageBag' => $errors['messageBag']
                );
            } else {
                $courseProvider = $this->courseProviderProvider->getById($id);
                $courseProvider->name = $data['name'];
                $courseProvider->description = $data['description'];
                $courseProvider->website = $data['website'];
                $courseProvider->category = $data['category'];

                if ($file) {
                    if (!FILE::isDirectory($imagePath . $id . '/' . $courseProvider->logo)) {
                        File::delete($imagePath . $id . '/' . $courseProvider->logo);
                    }

                    $file->move($imagePath . $id, $image);
                    $data['logo'] = $image;
                    $courseProvider->logo = $data['logo'];
                }

//                $courseProvider->fill($data);
//                $status = $courseProvider->updateUniques();

                $status = $courseProvider->save();

                return array(
                    'status' => $errors['status'],
                    'update' => $status
                );
            }
        } else {
            //check errors before create
            if ($errors['status']) {
                return array(
                    'errors' => array(
                        'status' => $errors['status'],
                        'update' => false,
                        'messageBag' => $errors['messageBag']
                    )
                );
            } else {
                $data['logo'] = $image;
                $cpd_id = $this->courseProviderProvider->create($data);

                $file->move($imagePath . '/' . $cpd_id, $image);

                return array(
                    'errors' => array(
                        'status' => $errors['status'],
                        'update' => true,
                    ),
                    'category' => $cpd_id
                );
            }
        }

        return $status;
    }

    /*
     * create course 
     * @param id (int)	and date (array)
     * Created By Raj @ Cranium Creations
     */

    public function saveCourse($id = null, $data) {
        //check validation 
        $errors = $this->courseProvider
                ->validate($id, $data);

        if ($id) {
            //check errors before update
            if ($errors['status']) {
                return array(
                    'status' => $errors['status'],
                    'messageBag' => $errors['messageBag']
                );
            } else {
                $course = $this->findCourseById($id);
                $course->fill($data)->save();
                $status = $course->updateUniques();

                return array(
                    'status' => $errors['status'],
                    'update' => $status
                );
            }
        } else {
            //check errors before create
            if ($errors['status']) {
                return array(
                    'errors' => array(
                        'status' => $errors['status'],
                        'update' => false,
                        'messageBag' => $errors['messageBag']
                    )
                );
            } else {
                $courseProvider = $this->courseProviderProvider->getById($data['course_provider_id']);

                $course = $courseProvider->addCourse($data);
                return array(
                    'errors' => array(
                        'status' => $errors['status'],
                        'update' => true,
                    ),
                    'category' => $course
                );
            }
        }

        return $status;
    }

    /*
     * @param (id) and (status)
     * Return boolean
     * Created By Raj @ Cranium Craetions
     */

    public function changeCourseStatus($id, $status) {
        $course = $this->courseProvider->getById($id);
        $course->status = $status;
        return $course->changeStatus();
    }

    /*
     * change status
     * @param (id) and (status)	 
     * @return boolean	 
     * Created By Raj @ Cranium Craetions
     */

    public function changeCourseProviderStatus($id, $status) {
        $courseProvider = $this->courseProviderProvider->getById($id);
        $courseProvider->status = $status;
        return $courseProvider->changeStatus();
    }

    /* 		
     * get all EntryQualificationCourse 
     * @return object array
     * Created By Jahir @ Cranium Creations
     * Modified By Kevin @ Cranium Creations
     */

    public function getEntryQualificationCourse() {
        $entryQualifications = $this->courseProviderProvider->
                getEntryQualificationCourses();
    //echo '<pre>';    print_r($entryQualifications); die();
        //get the registration level name
        foreach ($entryQualifications as &$value) {
            foreach ($value['courses'] as &$regCat) {
                $level = $this->registrationCategoryProvider->
                                getById($regCat['registration_category_id'])->toArray();

                $regCat['level'] = $level['level'];
            }
        }

        $category_levels = $this->registrationCategoryProvider->getAll()->toArray();
        $course_data = [];
            foreach ($category_levels as $value) {
//            $categ_levelid=1;
                $categ_levelid = $value['id'];
//             $this->course->courseById()->toArray();
//            DB::table('course')->where(['menu_type'=>'leftmenu', menu_publish'=>1])->orderBy('menu_sort', 'ASC')->get();
//            $course_data = Course::all();
//              $course_data = Course::where("course_type", 0)->get();
                
                $course_data[$categ_levelid]['category_level'] = $value;
                $course_data[$categ_levelid]['course_data'] = Course::select('*', 'course.id AS cource_id', 'course.name AS cource_name','course_provider.category AS course_category')
                ->join('course_provider', 'course_provider.id', '=', 'course.course_provider_id')
//                $course_data[$categ_levelid]['course_data'] = Course::select('*')
                        ->where('course_type', 0)
                        ->where('course_provider.category', 1)
                        ->where('course_provider.deleted_at', '=', NULL)
                        ->orderBy('course_provider.name','ASC')
                        ->where('registration_category_id', $categ_levelid)
                        ->get();
            }
        //die();
        //echo '<pre>';  print_r($course_data);  exit();
        return $course_data;
        //return $entryQualifications;
    }
    
    public function getEntryQualificationCourse1() {
        $entryQualifications = $this->courseProviderProvider->
                getEntryQualificationCourses();
        //echo '<pre>';    print_r($entryQualifications); die();
        //get the registration level name
        foreach ($entryQualifications as &$value) {
            foreach ($value['courses'] as &$regCat) {
                $level = $this->registrationCategoryProvider->
                                getById($regCat['registration_category_id'])->toArray();

                $regCat['level'] = $level['level'];
            }
        }

        $category_levels = $this->registrationCategoryProvider->getAll()->toArray();
        $course_data = [];
            foreach ($category_levels as $value) {
        //$categ_levelid=1;
                $categ_levelid = $value['id'];
                $course_data[$categ_levelid]['category_level'] = $value;
                $course_data[$categ_levelid]['course_data'] = Course::select('*', 'course.id AS cource_id', 'course.name AS cource_name','course_provider.category AS course_category')
                ->join('course_provider', 'course_provider.id', '=', 'course.course_provider_id')
                        ->where('course_type', 0)
                        ->where('course_provider.category', 2)
                        ->where('course_provider.deleted_at', '=', NULL)
                        ->orderBy('course_provider.name','ASC')
                        ->where('registration_category_id', $categ_levelid)
                        ->get();
            }
        return $course_data;
//        return $entryQualifications;
    }

        /* 		
         * get all EntryQualificationCourse 
         * @return object array
         * Created By Jahir @ Cranium Creations
         * Modified By Kevin @ Cranium Creations
         */

    public function getCpdCourseProviders() {
        return $this->courseProviderProvider
                        ->getAllCpdProviders();
    }

        /*
         * get all the cpd courses for the course provider
         * @param course provider id
         * @return collection of courses for a course provider
         * Created by Kevin @ Cranium Creations
         * modifier Pat @ Cranium Creation
          $courseProvider = $this->courseProviderProvider
          ->getById($id)->toArray();

          $courseProvider['courses'] = $this->courseProvider
          ->getCoursesForProvider($courseProvider['id'],1);
         */

    public function getCpdCourseProviderCourses($id) {
        $course = $this->courseProviderProvider
                        ->getByCategory($id)->toArray();
        $items = [];

        foreach ($course as $key => $value) {
            
        }
        
        return $course;
    }
    
    
        public function getCpdCourseBYCategory($id){
            $cpd_courses = Course::select('*', 'course.id AS cource_id', 'course.category AS cpd_category', 'course.description AS cpd_d', 'course.name AS cource_name','course_provider.category AS course_category')
                ->join('course_provider', 'course_provider.id', '=', 'course.course_provider_id')
//                $course_data[$categ_levelid]['course_data'] = Course::select('*')
                        ->where('course_type', 1)
                        ->where('course_provider.deleted_at', '=', NULL)
                        ->orderBy('cource_name','ASC')
//                        ->where('course_provider.category', 2)
                        ->where('course.category', $id)
                        ->get()->toArray();
            return $cpd_courses;
        }

    /* 		
     * get all CpdProvider 
     * @return object array
     * Created By Jahir @ Cranium Craetions

      public function getCpdProvider()
      {

      return $this->courseProvider->getCpdProvider();
      }
      /*
     * get all CpdProvider 
     * @return object array
     * Created By Jahir @ Cranium Craetions
      public function getCpdCourse($id)
      {
      return $this->courseProvider->getCoursesForProvider($id) ;
      }
     */

    /* 		
     * get all courses 
     * @param status (int)
     * @return object array
     * Created By Raj @ Cranium Craetions
     */

    public function getAllCourses($status) {
        return $this->courseProvider->getAll($status);
    }

    /* 		
     * get courses by id
     * @param id (int)
     * @return object
     * Created By Raj @ Cranium Craetions
     */

    public function findCourseById($id) {
        return $this->courseProvider->getById($id);
    }

    /* 		
     * get all courseProviders 
     * @param status (int)
     * @return object array
     * Created By Raj @ Cranium Craetions
     */

    public function getAllCourseProviders($status) {
        return $this->courseProviderProvider->getAll($status);
    }

    /* 		
     * get CourseProvider by id
     * @param id (int)
     * @return object
     * Created By Raj @ Cranium Craetions
     */

    public function findCourseProviderById($id) {
        return $this->courseProviderProvider->getById($id);
    }

    /* 		
     * get CourseProvider offered courses
     * @param id (int)
     * @return object
     * Created By Raj @ Cranium Craetions
     */

    public function getCourseProviderOfferedCourses($courseProvider_id) {
        return $this->courseProviderProvider->getAllCourseProviderCourses($courseProvider_id);
    }

    /* 		
     * get courseProvider for courses
     * @param id (int)
     * @return object
     * Created By Raj @ Cranium Craetions
     */

    public function getCourseProviderForOfferedCourses($course_id) {
        return $this->courseProvider->getCourseProviderForCourse($course_id);
    }

    /*
     * get all CpdName 
     * @return object array
     * Created By Anildev @ Cranium Craetions
     */

    public function getCpdProviderCourse() {

        return $this->courseProvider->getCpdProviderCourse();
    }

    //sebin
    public function adminSearchCourse($data) {
        return $this->courseProvider
                        ->adminSearchCourse($data);
    }

}
