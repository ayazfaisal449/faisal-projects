<?php
Route::get('/temp-trainer', 'TrainerController@temp_trainer');
Route::get('test', function () {});

Route::get('/blog', 'PrimaryController@blog');
Route::get('/arabic', 'PrimaryController@arabic');
Route::post('/contact', 'PrimaryController@contactAjx');

//HomePage
Route::get('/', 'PrimaryController@index');

//new Home page
Route::get('/home', 'PrimaryController@home');

//Benefits Page
Route::get('/benefits', 'PrimaryController@benefits');

//Jobs Page
Route::get('/jobs', 'PrimaryController@jobs');

//Online Marketing Page
Route::get('/online-marketing', 'PrimaryController@onlineMarketing');

//Benefits Page
Route::get('/insurance', 'PrimaryController@insurance');

Route::post('/insurance', 'PrimaryController@insurancePost');

//Ethics Page
Route::get('/codeofethics', 'PrimaryController@ethics');

// Meet the Team Page
Route::get('/meet-the-team', 'PrimaryController@meetTheTeam');

// Marketing Page
Route::get('/marketing-resources', 'PrimaryController@marketingResources');

// Marketing Page
Route::get('/partners', 'PrimaryController@partners');

// About Page
Route::get('/about', 'PrimaryController@about');

// FAQ Page
Route::get('/faqs', 'PrimaryController@faqs');

// Global Registers Page
Route::get('/global-registers', 'PrimaryController@globalRegisters');

// Employer Page
Route::get('/employer', 'PrimaryController@employer');
Route::get('/survey', 'PrimaryController@survey');

// Standards Page
Route::get('/standards', 'PrimaryController@standard');

// Terms and Conditions Page
Route::get('/terms-and-conditions', 'PrimaryController@termsConditions');

Route::get('/privacy-policy', 'PrimaryController@privacyPolicy');

//payment
Route::get('complete-pay', 'TrainerController@complete_pay');
Route::post('complete-pay', 'TrainerController@complete_pay');

//Approved Training
Route::group(array('prefix' => 'training'), function () {
    Route::get('/', 'CourseController@approvedTraining');
    Route::get('/entry-qualifications', 'CourseController@entryQualifications');
    Route::get('/cpd-providers', 'CourseController@cpdCourseProviders');
    Route::get('/cpd-providers/{id?}', 'CourseController@cpdProviderCourses');
});

//Blog
Route::group(array('prefix' => 'blog'), function () {
    Route::get('/', 'BlogController@appBlogs');
});
Route::get('/post/{id?}', 'BlogController@single_blog');
Route::get('/category-post/{slug?}', 'BlogController@category_blogs');
//Gallery
Route::group(array('prefix' => 'gallery'), function () {

    Route::get('/', 'GalleryController@galleries');

    //Video Pages
    Route::get('/video/{slug}/{id?}', 'VideoController@video');

    //Gallery Pages
    Route::get('photo/{slug}/{id?}', 'GalleryController@gallery');
});

//default Admin route
Route::get('/login', 'AdminController@logIn');
Route::get('/logout', 'AdminController@logOut');

//authenticate users
Route::post('/authenticate', 'AdminController@authenticate');

// admin route group
Route::group(['prefix' => 'admin', 'middleware' => 'auth.admin'], function () {

    Route::get('/', 'AdminController@dashboard');

    Route::post('/sendTrainerMail', 'AdminController@sendTrainerEmail');

    //admin Trainer
    Route::group(array('prefix' => 'trainer'), function () {
        Route::get('/', 'TrainerController@manage');

        Route::get('/toggleActivation/{trainer_id?}', 'TrainerController@activateDeactivate');
        Route::get('/registration', 'AdminController@trainerPersonalDetailsForm');
        Route::get('/trainerWorkExperienceForm', 'AdminController@trainerWorkExperienceForm');
        Route::get('/trainerQualificationForm', 'AdminController@trainerQualificationForm');
        Route::get('/success', 'AdminController@success');
        Route::post('/save', 'AdminController@save');
        Route::get('/upgrade-status/{id}', 'AdminController@trainerUpgadeStatusForm');
        //updating status
        Route::post('/update-status', 'AdminController@trainerUpdateStatus');
        Route::get('/upgrade-level-category/{id}', 'AdminController@trainerUpgradeCategoryForm');
        //updating status
        Route::post('/update-level-category', 'AdminController@trainerUpdateCategory');
        Route::post('/search', 'TrainerController@trainerSearch');
        Route::get('/search', 'TrainerController@trainerSearch');
        //Route::post('/','TrainerController@manage');
    });

    //download user details as excel
    Route::get('downloadExcel', 'DownloadsController@downloadExel');
    Route::get('downloadTrainer', 'DownloadsController@downloadTrainer');

    // admin/user
    Route::group(array('prefix' => 'users'), function () {
        Route::get('/', 'UsersController@manage');
        Route::get('/add', 'UsersController@userForm');
        Route::get('/update/{id?}', 'UsersController@userForm');
        Route::get('/updateWorkExperience/{id?}', 'UsersController@userFormWorkExperience');
        Route::get('/updateQualifications/{id?}', 'UsersController@userFormQualifications');
        Route::get('/updateComments/{id?}', 'UsersController@userFormComments');
        Route::post('/saveComments', 'UsersController@saveComment');
        Route::get('/addNewQualifications/{id?}', 'UsersController@userFormNewQualifications');
        Route::get('/deleteQualification/{qualification_id?}', 'UsersController@deleteTrainerQualifications');
        Route::post('/save', 'UsersController@save');
        Route::post('/updateWorkExperience/{id?}', 'UsersController@save2');
        Route::post('/addNewQualifications/{id?}', 'UsersController@save3');
        Route::post('/delete', 'UsersController@delete');
        Route::get('/delete/{id?}', 'UsersController@delete');
        Route::get('/mailchimp/{id}', 'UsersController@mailchimpCheck');
        Route::get('/approvePayment/{payment_id?}', 'TrainerController@approvePayment');
    });

    // admin/groups
    Route::group(array('prefix' => 'group'), function () {
        Route::get('/', 'GroupController@manage');
        Route::get('/add', 'GroupController@groupForm');
        Route::get('/update/{id?}', 'GroupController@groupForm');
        Route::post('/save', 'GroupController@save');
        Route::post('/delete', 'GroupController@delete');
    });

    // admin/permissions
    Route::group(array('prefix' => 'permission'), function () {
        Route::get('/', 'PermissionController@manage');
        Route::get('/add', 'PermissionController@permissionForm');
        Route::get('/update/{id?}', 'PermissionController@permissionForm');
        Route::post('/save', 'PermissionController@save');
        Route::post('/delete', 'PermissionController@delete');
    });

    // admin/CourseProvider
    Route::group(array('prefix' => 'courseProvider'), function () {
        Route::get('/', 'CourseController@manageCourseProvider');
        Route::get('/add', 'CourseController@courseProviderForm');
        Route::get('/update/{id?}', 'CourseController@courseProviderForm');
        Route::post('/save', 'CourseController@saveCourseProvider');
        Route::get('/delete/{id}', 'CourseController@deleteCourseProvider');
        Route::get('/changeStatus/{id}/{status}', 'CourseController@changeCourseProviderStatus');

        Route::post('/search', 'CourseController@searchCourseProvider');
    });

    // admin/course
    Route::group(array('prefix' => 'course'), function () {
        Route::get('/', 'CourseController@manageCourse');
        Route::get('/add', 'CourseController@courseForm');
        Route::get('/update/{id?}', 'CourseController@courseForm');
        Route::post('/save', 'CourseController@saveCourse');
        Route::get('/delete/{id}', 'CourseController@deleteCourse');
        Route::get('/changeStatus/{id}/{status}', 'CourseController@changeCourseStatus');

        Route::post('/search', 'CourseController@adminSearchCourse');
        Route::get('/search', 'CourseController@adminSearchCourse');
    });

    //admin/video
    Route::group(array('prefix' => 'video'), function () {
        Route::get('/', 'VideoController@manage');
        Route::get('/add', 'VideoController@videoForm');
        Route::get('/update/{id?}', 'VideoController@videoForm');
        Route::post('/save', 'VideoController@save');
        Route::get('/delete/{id}', 'VideoController@delete');
        Route::post('/delete', 'VideoController@delete');
        Route::get('/changeStatus/{id}/{status}', 'VideoController@changeStatus');
    });

    //admin/gallery
    Route::group(array('prefix' => 'gallery'), function () {
        Route::get('/', 'GalleryController@manage');
        Route::get('/add', 'GalleryController@galleryForm');
        Route::get('/update/{id?}', 'GalleryController@galleryForm');
        Route::post('/save', 'GalleryController@save');
        Route::get('/delete/{id}', 'GalleryController@deletePhotoCategory');
        Route::post('/delete', 'GalleryController@deletePhotoCategory');
        Route::get('/changeStatus/{id}/{status}', 'GalleryController@changeStatus');
        Route::get('/deletePhoto/{photoCategory}/{fileName}/{id}', 'GalleryController@deletePhoto');
    });

    //admin/slider
    Route::group(array('prefix' => 'slider'), function () {
        Route::get('/', 'SliderController@manage');
        Route::get('/add', 'SliderController@create');
        Route::post('/save', 'SliderController@store');
        Route::get('/update/{id}', 'SliderController@edit');
        Route::get('/changeStatus/{id}/{status}', 'SliderController@changeStatus');
        Route::get('/delete/{id}', 'SliderController@destroy');

        Route::post('/save-marketing-thumb', 'SliderController@saveMarketing');
    });

    //admin/facility-slider
    Route::group(array('prefix' => 'facility-slider'), function () {
        Route::get('/', 'FacilitySliderController@manage');
        Route::get('/add', 'FacilitySliderController@create');
        Route::post('/save', 'FacilitySliderController@store');
        Route::get('/update/{id}', 'FacilitySliderController@edit');
        Route::get('/changeStatus/{id}/{status}', 'FacilitySliderController@changeStatus');
        Route::get('/delete/{id}', 'FacilitySliderController@destroy');
    });

    //admin/partner
    Route::group(array('prefix' => 'partner'), function () {
        Route::get('/', 'PartnerController@manage');
        Route::get('/add', 'PartnerController@create');
        Route::post('/save', 'PartnerController@store');
        Route::get('/update/{id}', 'PartnerController@edit');
        Route::get('/changeStatus/{id}/{status}', 'PartnerController@changeStatus');
        Route::get('/delete/{id}', 'PartnerController@destroy');
    });

    //admin/benefit
    Route::group(array('prefix' => 'benefit'), function () {
        Route::get('/', 'BenefitController@manage');
        Route::get('/add', 'BenefitController@create');
        Route::post('/save', 'BenefitController@store');
        Route::get('/update/{id}', 'BenefitController@edit');
        Route::get('/changeStatus/{id}/{status}', 'BenefitController@changeStatus');
        Route::get('/delete/{id}', 'BenefitController@destroy');
    });

    //admin/jobs
    Route::group(array('prefix' => 'jobs'), function () {
        Route::get('/', 'JobsController@manage');
        Route::get('/add', 'JobsController@create');
        Route::post('/save', 'JobsController@store');
        Route::get('/update/{id}', 'JobsController@edit');
        Route::get('/changeStatus/{id}/{status}', 'JobsController@changeStatus');
        Route::get('/delete/{id}', 'JobsController@destroy');
    });

    // App Blog Groups
    Route::group(array('prefix' => 'blog-category'), function () {
        Route::get('/', 'BlogCategoryController@manage');
        Route::get('/add', 'BlogCategoryController@create');
        Route::post('/save', 'BlogCategoryController@store');
        Route::get('/update/{id}', 'BlogCategoryController@edit');
        Route::get('/delete/{id}', 'BlogCategoryController@destroy');
    });

    // App Blog
    Route::group(array('prefix' => 'blog'), function () {
        Route::get('/', 'BlogController@manage');
        Route::get('/add', 'BlogController@create');
        Route::post('/save', 'BlogController@store');
        Route::get('/update/{id}', 'BlogController@edit');
        Route::get('/changeStatus/{id}/{status}', 'BlogController@changeStatus');
        Route::get('/delete/{id}', 'BlogController@destroy');
    });

    //admin/faq
    Route::group(array('prefix' => 'faq'), function () {
        Route::get('/', 'FAQController@manage');
        Route::get('/add', 'FAQController@create');
        Route::post('/save', 'FAQController@store');
        Route::get('/update/{id}', 'FAQController@edit');
        Route::get('/changeStatus/{id}/{status}', 'FAQController@changeStatus');
        Route::get('/delete/{id}', 'FAQController@destroy');
    });

    // Membership Approvals
    Route::group(array('prefix' => 'approval'), function () {
        Route::get('/', 'ApprovalController@index');
    });

    // footer
    Route::group(array('prefix' => 'footer'), function () {
        Route::get('/', 'FooterController@manage');
        Route::get('/add', 'FooterController@add');
        Route::post('/submit_footer', 'FooterController@store');
        Route::get('/manage', 'FooterController@manage');
        Route::get('/update/{id}', 'FooterController@edit');
        Route::get('/delete/{id}', 'FooterController@destroy');
    });

    // Meet the team page
    Route::group(array('prefix' => 'team'), function () {
        Route::get('/', 'MeetTeamController@manage');
        Route::get('/add', 'MeetTeamController@create');
        Route::post('/save', 'MeetTeamController@store');
        Route::get('/update/{id}', 'MeetTeamController@edit');
        Route::get('/destroy/{id}', 'MeetTeamController@destroy');
    });

    // Setting

    Route::group(array('prefix' => 'setting'), function () {
        Route::get('/', 'SettingController@manage');
        Route::get('/add', 'SettingController@create');
        Route::post('/save', 'SettingController@store');
        Route::get('/update/{id}', 'SettingController@edit');
        Route::get('/destroy/{id}', 'SettingController@destroy');
    });


    // Trainers
    Route::group(array('prefix' => 'app-trainers'), function () {
        Route::get('/{user_id}/edit', 'AppTrainersController@edit');
    });

    // App Courses
    Route::group(array('prefix' => 'app-courses'), function () {
        Route::get('/', 'AppCoursesController@index');
        Route::get('/create', 'AppCoursesController@create');
        Route::get('/{id}/edit', 'AppCoursesController@edit');
    });
});

//course route group
Route::group(array('prefix' => 'course'), function () {
    Route::get('/', 'CourseController@manageCourse');
    Route::get('/entryQualifications', 'CourseController@entryQualificationCourseGet');
    Route::get('/cpdProviders', 'CourseController@cpdProviderGet');
    Route::get('cpd-courses/{slug}/{id}', 'CourseController@cpdCourseGet');
});

Route::get('searcht', 'TrainerController@trainerSearchUserIndex');
Route::get('searchtt', 'TrainerController@trainerSearchUsersIndex');
Route::post('searcht', 'TrainerController@trainerSearchUserIndex');

//Route::get('trainers','TrainerController@trainerSearch');



// payment routes
Route::get('/payment/{response}', 'TrainerController@paymentResponse');
Route::post('/payment/{response}', 'TrainerController@paymentResponse');

// trainer route group
Route::group(array('prefix' => 'trainer'), function () {

    //forgot password
    Route::get('/forgot-password', 'TrainerController@forgotPassword');
    Route::post('/resetPassword', 'TrainerController@resetPassword');
    Route::get('/reset-pass/{code}', 'TrainerController@resetPasswordLink');
    Route::post('/change-password', 'TrainerController@changePassword');

    //trainer registration & update pages
    Route::get('/registration-info', 'TrainerController@registerInfo');
    Route::get('/registration', 'TrainerController@trainerPersonalDetailsForm');
    Route::get('/trainerWorkExperienceForm', 'TrainerController@trainerWorkExperienceForm');
    Route::get('/trainerQualificationForm', 'TrainerController@trainerQualificationForm');
    Route::get('/payment', 'TrainerController@payment');
    Route::get('/success', 'TrainerController@success');
    Route::post('/process-renewal', 'TrainerController@processRenewal');
    Route::post('/save', 'TrainerController@save');

    //trainer login
    Route::get('/login', 'TrainerController@logIn');

    //authenticate trainer
    Route::post('/authenticate', 'TrainerController@authenticate');

    //Trainer Dashboard
    Route::group(['prefix' => 'dashboard', 'middleware' => 'auth.trainer'], function () {

        //trainer Dashboard
        Route::get('/', 'TrainerController@dashboard');

        Route::get('/success', 'TrainerController@renewed');

        //trainer logout
        Route::get('/logout', 'TrainerController@logOut');

        //renew registration
        Route::get('/renew-registration', 'TrainerController@renewRegistration');
        Route::post('/payment', 'TrainerController@payment');

        //reset/change password
        Route::get('/resetPassword', 'TrainerController@resetPassword');
        Route::get('/reset-pass/{code}', 'TrainerController@resetPasswordLink');
        Route::post('/change-password', 'TrainerController@changePassword');

        Route::group(['middleware' => 'check.expired'], function() {
            //trainer update personal details
            Route::get('/update-personal-details', 'TrainerController@updatePersonalDetails');
            Route::post('/update-personal-details', 'TrainerController@updatePersonalDetails');

            //trainer update work experience
            Route::get('/your-certifications', 'TrainerController@yourQualifications');
            Route::get('/e-certificate', 'TrainerController@E_certificate');

            //current employer
            Route::get('/current-employer', 'TrainerController@currentEmployer');
            Route::post('/updateCurrentEmployer', 'TrainerController@updateCurrentEmployer');

            //trainer update current employer
            Route::get('/currentEmployer', 'TrainerController@updateWorkExperience');

            Route::get('/trainerWorkExperienceForm', 'TrainerController@trainerWorkExperienceForm');

            Route::post('/updateTrainerWorkExperience', 'TrainerController@updateWorkExperience');

            //trainer apply to upgrade status
            Route::get('/upgrade-status', 'TrainerController@trainerUpgradeStatus');
            Route::post('/upgrade-status', 'TrainerController@trainerUpgradeStatus');

            //trainer apply to upgrade level category
            Route::get('/upgrade-level-category', 'TrainerController@trainerUpgradeLevel');
            Route::post('/upgrade-level-category', 'TrainerController@trainerUpgradeLevel');
        });
    });
});

Route::get('/import', 'ImportController@notifyExpiry');
Route::get('/payfort-reponse/{head}/{message}', 'TrainerController@response_page');

Route::get('show-expiry', function () {
    $expiring_one_month = Trainer::getExpiringTrainersOneMonth();
    $expired_by_week = Trainer::getExpiredByAWeek();

    echo "<pre>";
    echo "EXPIRING IN ONE MONTH<br>";
    echo "------------------------------";
    foreach ($expiring_one_month as $item) {
        echo $item->email . '<br>';
    }

    echo "<br><br>EXPIRED BY A WEEK<br>";
    echo "------------------------------";
    foreach ($expired_by_week as $item) {
        echo $item->email . '<br>';
    }
    echo "</pre>";
});
Route::get('/encache', 'TrainerController@encache');
Route::get('/encache-search', 'TrainerController@encache_search');
Route::get('/clear-cache', 'TrainerController@refresh');
// App::missing(function ($exception) {
//     return Response::view('primary.404', array(), 404);
// });

Route::get('/secret-reset-101010', function () {
    $user = Sentry::findUserByLogin('membership@repsuae.com');
    $resetCode = $user->getResetPasswordCode();
    $new_password = '2016Rep$';
    if ($user->attemptResetPassword($resetCode, $new_password)) {
        echo 'Success';
    } else {
        echo 'Fail';
    }
});

Route::get('repair-qualifications', 'AdminController@repairQualifications');
Route::get('time', function () {
    $mytime = \Carbon\Carbon::now();
    echo $mytime->toDateTimeString();
});

Route::get('testmode', function () {
    Session::put('testmode', \Request::get('testmode'));
});

Route::get('recover-user', function () {
    \Models\Users\Users::withTrashed()->find(\Request::get('id'))->restore();
});

Route::get('/awards_landing', function () {
    return File::get(public_path() . '/awards_landing/index.php');
});
