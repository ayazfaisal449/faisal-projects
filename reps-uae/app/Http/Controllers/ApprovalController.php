<?php
namespace App\Http\Controllers;
use Cranium\Benefit\Models\Benefit;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
class ApprovalController extends BaseController {
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('approval.index');
    }

}
