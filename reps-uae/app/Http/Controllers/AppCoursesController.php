<?php
namespace App\Http\Controllers;
use Cranium\Benefit\Models\Benefit;
use Illuminate\Support\Facades\File;
use \App\Models\CourseProvider\CourseProvider;
use Illuminate\Support\Facades\View;

class AppCoursesController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('app-courses.index');
    }

    /**
     * Show edit page
     *
     */
    public function edit($id)
    {
        // Get a list of course providers.
        $providers = \Cranium\CourseProvider\Models\CourseProvider::all();

        return View::make('app-courses.edit', compact('id', 'providers'));
    }

    /**
     * Show create page
     *
     */
    public function create()
    {
        // Get a list of course providers.
        $providers = \Cranium\CourseProvider\Models\CourseProvider::all();

        return View::make('app-courses.create', compact('providers'));
    }


}
