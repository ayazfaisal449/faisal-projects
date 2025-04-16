<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;

class AppTrainersController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('app-trainers.index');
    }

    /**
     * Show edit page
     *
     */
    public function edit($user_id)
    {
        return View::make('app-trainers.edit', compact('user_id'));
    }
}
