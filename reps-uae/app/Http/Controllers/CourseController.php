<?php
namespace App\Http\Controllers;
use Course;
use DB as DBS;
use Illuminate\Support\Facades\View;
use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use RegistrationCategory;
use Illuminate\Http\Request;
// add redirrect
use Illuminate\Support\Facades\Redirect;


class CourseController extends BaseController {
    /*
     * Gets all courseProvider
     * Created By Raj @ Cranium Creations
     */

    public function manageCourseProvider() {

        $status = NULL;

        $courseProviders = array();
        foreach (Course::getAllCourseProviders($status) as $value) {
            $courseProviders[$value->name][] = $value->name;
            $courseProviders[$value->name][] = $value->id;
            $courseProviders[$value->name][] = $value->status;
        }

        $paginatedData = $this->paginator($courseProviders, 15);

        $data = array(
            'required' => array('Name', 'Action'),
            'edit' => 'courseProvider',
            'data' => $paginatedData['data'],
            'paginator' => $paginatedData['links']
        );
        return View::make('courseProvider.manage', $data);
    }

    /*
     * Display ManageCourse for logged in admin/Course for User
     * Created By Raj @ Cranium Creations
     * Modified By Vineeth @ Cranium Creations
     * Modified By Sebin @ Cranium Creations
     */

    public function manageCourse() {
        if (Sentry::getUser()) {
            $admin = Sentry::findGroupByName('Admin');
            $user = \Models\Users\Users::find(Sentry::getUser()->id);
            if ($user->inGroup($admin)) {
                $status = NULL;
                $courses = array();
                foreach (Course::getAllCourses($status) as $value) {
                    /* $courses[$value->name][] = $value->name;
                      $courses[$value->name][] = $value->id;
                      $courses[$value->name][] = $value->status; */

                    $courses[$value->id][] = $value->name;
                    $courses[$value->id][] = $value->id;
                    $courses[$value->id][] = $value->status;
                }
                $paginatedData = $this->paginator($courses, 15);
                $data = array(
                    'required' => array('Name', 'Action'),
                    'edit' => 'course',
                    'data' => $paginatedData['data'],
                    'courseProviders' => Course::getAllCourseProviders($status),
                    'paginator' => $paginatedData['links']
                );

                return View::make('course.manage', $data);
            } else {
                //return View::make('course.course');
            }
        } else {
            //return View::make('course.course');
        }
    }

    /*
     * Gets all courseProvider
     * Created By Jahir @ Cranium Creations
     * Modified by Vineeth @ Cranium Creations
     */

    public function cpdProviderGet() {
        if (sizeof(Course::getCpdProvider()) == 0) {
            return Redirect::to('/course')->with('message', 'No 	CPD providers yet');
        } else {
            foreach (Course::getCpdProvider() as $value) {
                $courses[$value->name][0] = $value->courseProvider->logo;
                $courses[$value->name][1] = $value->courseProvider->name;
                $courses[$value->name][2] = $value->courseProvider->description;
                $courses[$value->name][3] = Str::slug($value->courseProvider->name);
                $courses[$value->name][4] = $value->courseProvider->id;
            }
            $paginatedData = $this->paginator($courses, 15);
            $data = array(
                'required' => array('Logo', 'Name', 'Description'),
                'edit' => 'course',
                'data' => $paginatedData['data'],
                'paginator' => $paginatedData['links'],
            );

            return View::make('course.cpd', $data);
        }
    }

    /*
     * Group course
     * @param id (int) ,slug (string) 
     * @returns cpd courses for a provider
     * Created By Vineeth @Cranium Creations
     */

    public function cpdCourseGet($slug, $id) {

        foreach (Course::getCpdCourse($id) as $key => $value) {

            $courses[$value->name][0] = $value->name;
            $courses[$value->name][1] = $value->description;
        }

        $paginatedData = $this->paginator($courses, 15);

        $data = array(
            'required' => array('Name', 'Description'),
            'edit' => 'course',
            'data' => $paginatedData['data'],
            'paginator' => $paginatedData['links']
        );

        return View::make('course.providerCpd', $data);
    }

    /*
     * Group courseProvider
     * @param id (int) user id for update
     * @returns courseProvider form
     * Created By Raj @Cranium Creations
     */

    public function CourseProviderForm($id = NULL) {
        $data[] = NULL;
        $data['src'] = "images/courseProvider/";
        if ($id != NULL) {
            $data['courseProvider'] = Course::findCourseProviderById($id);
            return View::make('courseProvider.edit', $data);
        } else {
            return View::make('courseProvider.add', $data);
        }
    }

    /*
     * Group course
     * @param id (int) user id for update
     * @returns course form
     * Created By Raj @ Cranium Creations
     * Modified By Kevin @ Cranium Creations
     */

    public function CourseForm($id = NULL) {
        $status = 1;
        $data[] = NULL;

        //get all Course Providers
        $courseProviders = Course::getAllCourseProviders($status);
        $courseProvider = Course::getAllCourseProviders($status);
        $courseProviderArray = array('' => 'Select Course Provider');
        foreach ($courseProviders as $courseProvider) {
            $courseProviderArray[$courseProvider->id] = $courseProvider->name;
        }
        
        $courseProviderArr =[];
        foreach ($courseProviders as $key => $coursePr) {
            $courseProviderArr[$key]['id'] = $coursePr->id; 
            $courseProviderArr[$key]['name'] = $coursePr->name;
        }

        //get all Registration Categories
        $registrationCategories = RegistrationCategory::getAll();
        $registrationCategoriesArray = array();
        foreach ($registrationCategories as $rg) {
            $registrationCategoriesArray[$rg->id] = $rg->level;
        }

        //set all data
        $data = array(
            'courseProviders' => $courseProviderArray,
            'c_providers'    => $courseProviderArr,
            'registrationCategory' => $registrationCategoriesArray,
            'courseTypes' => array(
                'Entry Qualifications', 'CPD Continuing Professional Development'
            )
        );


        if ($id != NULL) {
            $data['course'] = Course::findCourseById($id);
            return View::make('course.edit', $data);
        } else {
            return View::make('course.add', $data);
        }
    }

    /*
     * Save courseProvider
     * Created By Raj @Cranium Creations
     */

    public function saveCourseProvider(Request $request) {

        $file = $request->file('file');

        $file_array = array();
        if ($file) {
            $image_name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $name = explode('.' . $extension, $image_name);
            $image = $this->getSlug($name[0]);

            $file_array = array(
                'file' => $file,
                'name' => $image,
                'extension' => $extension
            );
        }
        $id = $request->get('id');

        $input = array(
            'user_id' => Sentry::getUser()->id,
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'website' => $request->get('website'),
            'category' => $request->get('category'),
        );

        if (isset($id)) {

            $errors = Course::saveCourseProvider($id, $input, $file_array);

            //validate
            //if(!$errors['status'] && $errors['update'])
            if (!isset($errors['messageBag'])) {
                return Redirect::to('admin/courseProvider/');
            } else {
                //print_r($errors); exit;
                return Redirect::to('admin/courseProvider/update/' . $id)
                                ->withErrors($errors['messageBag'])->withInput();
            }
        } else {
            //create the photo courseProvider
            $courseProvider = Course::saveCourseProvider($id, $input, $file_array);

            //validate
            if (!$courseProvider['errors']['status'] && $courseProvider['errors']['update']) {
                return Redirect::to('admin/courseProvider/');
            } else {
                // echo "<pre>"; dd($courseProvider['errors']['messageBag']);
                return Redirect::to('admin/courseProvider/update/' . $id)
                                ->withErrors($courseProvider['errors']['messageBag'])->withInput();
            }
        }
    }

    /*
     * Save Course
     * Created By Raj @Cranium Creations
     */

    public function saveCourse(Request $request) {
        $id = $request->get('id');
        $pre_approved=0;
         if($request->get('pre_approved')!=''){
             $pre_approved = $request->get('pre_approved');
         }
        $input = array(
            'user_id' => Sentry::getUser()->id,
            'course_provider_id' => $request->get('courseProvider'),
            'category' => $request->get('category'),
            'course_type' => $request->get('courseType'),
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'registration_category_id' => $request->get('registration_category_id'),
            'awardingorganization' => $request->get('awardingorganization'),
            'pre_approved' => $pre_approved
        );

        if (isset($id)) {
            //create the photo category 	
            $errors = Course::saveCourse($id, $input);

            //validate
            if (!$errors['status'] && $errors['update']) {

                return Redirect::to('admin/course');
            } else {
                return Redirect::to('admin/course/update/' . $id)
                                ->withErrors($errors['messageBag'])->withInput();
            }
        } else {
            $course = Course::saveCourse($id, $input);

            //validate
            if (!$course['errors']['status'] && $course['errors']['update']) {

                return Redirect::to('admin/course/');
            } else {
                return Redirect::to('admin/course/add')
                                ->withErrors($course['errors']['messageBag'])->withInput();
            }
        }
    }

    /*
     * Delete a courseProvider
     * @prams id (int)
     * Created By Raj @ Cranium Creations
     */

    public function deleteCourseProvider($id) {

        $courseProvider = Course::findCourseProviderById($id);
        $destination = 'images/courseProvider/';
        $file = $courseProvider->logo;

        if ($file) {
            if (file_exists($destination . $file))
                unlink($destination . $file);
        }
        $courseProvider->delete();
        return Redirect::action('CourseController@manageCourseProvider');
    }

    /*
     * Delete a course
     * @prams id (int)
     * Created By Raj @ Cranium Creations
     */

    public function deleteCourse($id) {

        $course = Course::findCourseById($id);
        $course->delete();
        return Redirect::action('CourseController@manageCourse');
    }

    /*
     * change status of a courseProvider
     * @prams id (int) and status (int)
     * Created By Raj @ Cranium Creations
     */

    public function changeCourseProviderStatus($id, $status) {
        // For some reason, this is not working
        // Course::changeCourseProviderStatus($id,$status);
        // Tap into the model directly and save();
        $provider = \Cranium\CourseProvider\Models\CourseProvider::find($id);

        if ($provider->status == 1) {
            $provider->status = 0;
        } else {
            $provider->status = 1;
        }
        $provider->save();

        return Redirect::action('CourseController@manageCourseProvider');
    }

    /*
     * change status of a course
     * @prams id (int) and status (int)
     * Created By Raj @ Cranium Creations
     */

    public function changeCourseStatus($id, $status) {

        Course::changeCourseStatus($id, $status);
        return Redirect::action('CourseController@manageCourse');
    }

    /*
     * change status of a course
     * Created By Raj @ Cranium Creations

      public function searchCourse()
      {

      $status = 1;
      $courses = array();
      if(Input::get('course'))
      {

      $search_data = array(
      'course_provider_id'=>Input::get('courseProvider_id'),
      'course'=>Input::get('course'),
      );

      $search_result = Course::searchCourse($search_data);

      foreach ($search_result as $value)
      {
      $courses[$value->name][] = $value->name;
      $courses[$value->name][] = $value->id;
      $courses[$value->name][] = $value->status;
      }

      }
      $paginatedData = $this->paginator($courses,5);

      $data = array(
      'required'=> array('Name', 'Action'),
      'edit' => 'course',
      'data' =>  $paginatedData['data'],
      'courseProviders' =>  Course::getAllCourseProviders($status),
      'paginator' => $paginatedData['links']
      );


      if(Sentry::getUser())
      {

      $user = Sentry::getUser()->id;

      if($user == 1 )
      return View::make('course.manage',$data);
      else
      return View::make('course.course',$data);

      }
      else
      {
      return View::make('course.course',$data);
      }

      } */

    /*
     * change status of a course
     * Created By Raj @ Cranium Creations

      public function searchCourseProvider()
      {

      $status = 1;
      $courses = array();


      if($courseProvider = Input::get('courseProvider'))
      {
      $courseProvider_result = Course::getCourseProvidersByName($courseProvider);

      foreach($courseProvider_result as $value)
      {
      $courses[$value->name][] = $value->name;
      $courses[$value->name][] = $value->id;
      $courses[$value->name][] = $value->status;
      }
      }

      $paginatedData = $this->paginator($courses,5);

      $data = array(
      'required'=> array('Name', 'Action'),
      'edit' => 'course',
      'data' =>  $paginatedData['data'],
      'courseProviders' =>  Course::getAllCourseProviders($status),
      'paginator' => $paginatedData['links']
      );


      if(Sentry::getUser())
      {

      $user = Sentry::getUser()->id;

      if($user == 1 )
      return View::make('courseProvider.manage',$data);
      else
      return View::make('courseProvider.courseProvider',$data);

      }
      else
      {
      return View::make('courseProvider.courseProvider',$data);
      }

      } */

    /**
     * Shows all the courses
     * Created By Kevin @ Cranium Creations
     */
    public function approvedTraining() {
        $data['setting'] = DBS::table('setting')->get();
        return View::make('course.index', $data);
    }

    /**
     * Shows all the entry qualification courses
     * Created By Kevin @ Cranium Creations
     */
    public function entryQualifications() {

        $data ['qualifications_one'] = Course::getEntryQualificationCourse();
        $data ['qualifications_two'] = Course::getEntryQualificationCourse1();
//        echo '<pre>'; print_r($data['qualifications_one']); exit();
//        $arrdata = array();
//        foreach ($dataCustom as $key) {
//            $arrdata[$key['courseProviderCategory']][] = $key;
//        }
        //echo json_encode($arrdata)."\n";

//        $data = array(
////            // 'qualifications' =>  Course::getEntryQualificationCourse()			
//            'qualifications' => $arrdata
//        );
        $data['setting'] = DBS::table('setting')->get();
//        echo '<pre>'; print_r($data); die();
        return View::make('course.entryQualificationsIndex', $data);
    }

    /**
     * Shows all the cpd courses
     * Created By Kevin @ Cranium Creations
     */
    public function cpdCourseProviders() {

        $data = array(
            'cpdCourseProviders' => Course::getCpdCourseProviders()
        );
        $data1['setting'] = DBS::table('setting')->get();

        return View::make('course.cpdCourseProviders', $data, $data1);
    }

    /**
     * @param id
     * shows all the courses for the Cpd Provider
     * Created By Kevin @ Cranium Creations
     */
    public function cpdProviderCourses($id) {
        $data1['setting'] = DBS::table('setting')->get();
        $category = '';
        if ($id == 1) {
            $category = 'Exercise Science';
        } else if ($id == 2) {
            $category = 'Group Fitness';
        } else if ($id == 3) {
            $category = 'Nutrition';
        } else if ($id == 4) {
            $category = 'Mind & Body';
        } else if ($id == 5) {
            $category = 'Rehab & Special Populations';
        } else if ($id == 6) {
            $category = 'Workshops & Seminar';
        } else if ($id == 7) {
            $category = 'Online';
        } else if ($id == 8) {
            $category = 'Equipment Based';
        }
       
        $getC_courses = Course::getCpdCourseBYCategory($id);
//        echo '<pre>'; print_r($getC_courses); die();
        $arrt_cour=[];
        foreach($getC_courses as $getC_c){
            $arrt_cour = $getC_c;
        }
        
        $data = array(
            'cpdCourseProvider' => Course::getCpdCourseProviderCourses($id),
            'cpdCourseByCategory' => $getC_courses,
            'id' => $id,
            'category' => $category
        );
        return View::make('course.cpdCourseProviderCourses', $data, $data1);
    }

    /**
     * Search cources 
     * Created By Sebin @ Cranium Creations
     */
    public function adminSearchCourse(Request $request) {
        //print_r(Input::get());exit;
        $status = 1;
        $courses = array();
        if ($request->get('course')) {

            $search_data = $request->get('course');

            $search_result = Course::adminSearchCourse($search_data);

            foreach ($search_result as $value) {
//				$courses[$value->name][] = $value->name;
//				$courses[$value->name][] = $value->id;
//				$courses[$value->name][] = $value->status;

                $courses[$value->id][] = $value->name;
                $courses[$value->id][] = $value->id;
                $courses[$value->id][] = $value->status;
            }

            $paginatedData = $this->paginator($courses, 15, array('course' => $search_data));

            $data = array(
                'required' => array('Name', 'Action'),
                'edit' => 'course',
                'data' => $paginatedData['data'],
                'courseProviders' => Course::getAllCourseProviders($status),
                'paginator' => $paginatedData['links']
            );


            if (Sentry::getUser()) {
                $admin = Sentry::findGroupByName('Admin');
                $user = \Models\Users\Users::find(Sentry::getUser()->id);
                if ($user->inGroup($admin)) {

                    return View::make('course.manage', $data);
                } else {
                    return View::make('course.course', $data);
                }
//                            $user = Sentry::getUser()->id;
//
//                            if($user == 1 )
//                                return View::make('course.manage',$data);
//                            else
//                                return View::make('course.course',$data);	
            } else {
                return View::make('course.course', $data);
            }
        } else {
            return Redirect::action('CourseController@manageCourse');
        }
    }

}
