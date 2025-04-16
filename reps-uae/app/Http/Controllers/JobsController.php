<?php
namespace App\Http\Controllers;
use Cranium\Jobs\Models\Jobs;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
// use DB as DBS;
class JobsController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
     public function manage()
     {
           
         $data['jobs']= Jobs::orderBy('id', 'desc')->get();
         return View::make('jobs.manage',$data);
     }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
         return View::make('jobs.add');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $filename = '/public/images/jobs/';
        $id = request()->get('id'); 

            if($id){
                $rules = array(
                //'sort' => 'required | integer | max:10',
                'job_role' => 'required',
                'branch' => 'required',
                'email' => 'required|email',
                'description' => 'required',
                );              
                $validator = Validator::make(request()->all(), $rules);

                if ($validator->fails())
                {
                    return Redirect::to('/admin/jobs/update/'.$id.'')->withErrors($validator)->withInput();
                }
                $updater= Jobs::where('id','=',$id)->first(); 
                $updater->email = request()->get('email'); 
                $updater->description = request()->get('description'); 
                $updater->job_role = request()->get('job_role'); 
                $updater->branch = request()->get('branch'); 
                //$updater->sort_order = request()->get('sort');
                if (request()->hasFile('image'))
                {
                    $name = request()->file('image')->getClientOriginalName();
                    File::delete(Config::get('photo.jobs').'/'. $updater->location);
                    request()->file('image')->move(Config::get('photo.jobs').'/'.$id, $name);
                    $updater->location = 'images/jobs'.'/'.$id.'/'.$name;
                }

                $updater->save(); 
                return Redirect::to('/admin/jobs');
            } else {
    
                $rules = array(
                //'sort' => 'required | integer | max:10',
                'image' => 'required | image',
                'job_role' => 'required',
                'branch' => 'required',
                'email' => 'required|email',
                'description' => 'required',
                );
                $validator = Validator::make(request()->all(), $rules);
                // echo '<pre>'; print_r($validator); exit;
                if ($validator->fails())
                {
                    return Redirect::to('/admin/jobs/add')->withErrors($validator)->withInput();

                }
                $image = new Jobs;
                $image->email = request()->get('email'); 
                $image->description = request()->get('description'); 
                $image->job_role = request()->get('job_role'); 
                $image->branch = request()->get('branch'); 
                //$image->sort_order = request()->get('sort');
                $image->save(); 
                $name = request()->file('image')->getClientOriginalName();
                FILE::makeDirectory(Config::get('photo.jobs').'/'.$image->id,755,true);
                request()->file('image')->move(Config::get('photo.jobs').'/'.$image->id, $name);
                $location = Jobs::where('id','=', $image->id)->first();
                $location->location = 'images/jobs'.'/'.$image->id.'/'.$name;
                $location->is_active=1;
                $location->save();
                return Redirect::to('/admin/jobs');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data['jobs']= Jobs::where('id','=',$id)->first(); 
    //    echo '<pre>'; print_r($data['jobs']);
        return View::make('jobs.update',$data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $data= Jobs::where('id','=',$id)->first(); 

        
        $data->delete();
        return Redirect::to('/admin/jobs');
    }
    public function changeStatus($id,$status)
    {
        $data= Jobs::where('id','=',$id)->first(); 
        $data->is_active = $status;
        $data->save();
        return Redirect::to('/admin/jobs');

    }
}