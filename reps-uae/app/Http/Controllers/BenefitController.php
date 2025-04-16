<?php
namespace App\Http\Controllers;
use Cranium\Benefit\Models\Benefit;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;

class BenefitController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function manage()
    {
        $data['benefit']= Benefit::orderBy('sort_order', 'asc')->get(); 
       

       
        
        return View::make('benefit.manage',$data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
         return View::make('benefit.add');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $filename = '/public/images/benefit/';
        $id = request()->get('id'); 


        

        
            if($id){
                $rules = array(
                 
                
                'sort' => 'required | integer | max:10',

                );
               
                
                $validator = Validator::make(request()->all(), $rules);

                if ($validator->fails())
                {

                    return Redirect::to('/admin/benefit/add')->withErrors($validator)->withInput();

                }
                $updater= Benefit::where('id','=',$id)->first(); 
                $updater->text = request()->get('text'); 
                $updater->description = request()->get('description'); 
                $updater->url = request()->get('url'); 
                $updater->button_text = request()->get('button_text'); 
                $updater->sort_order = request()->get('sort');

                if (request()->hasFile('image'))
                {
                    $name = request()->file('image')->getClientOriginalName();

                    File::delete(Config::get('photo.benefit').'/'. $updater->location);
                
                    request()->file('image')->move(Config::get('photo.benefit').'/'.$id, $name);
                    $updater->location = 'images/benefit'.'/'.$id.'/'.$name;
                   
                }
                
                

                $updater->save(); 

                return Redirect::to('/admin/benefit');


            }else{
                $rules = array(
                 
                'sort' => 'required | integer | max:10',
                'image' => 'required | image',

                );
               
                
                $validator = Validator::make(request()->all(), $rules);

                if ($validator->fails())
                {

                    return Redirect::to('/admin/benefit/add')->withErrors($validator)->withInput();

                }

                $image = new Benefit;
                $image->text = request()->get('text'); 
                $image->description = request()->get('description'); 
                $image->url = request()->get('url'); 
                $image->button_text = request()->get('button_text'); 
                $image->sort_order = request()->get('sort');

                $image->save(); 
                $name = request()->file('image')->getClientOriginalName();
                


                    
                //moving the image but check if directory is existing
                FILE::makeDirectory(Config::get('photo.benefit').'/'.$image->id,755,true);
                request()->file('image')->move(Config::get('photo.benefit').'/'.$image->id, $name);

                $location = Benefit::where('id','=', $image->id)->first();

                $location->location = 'images/benefit'.'/'.$image->id.'/'.$name;
                $location->is_active=1;

                $location->save();
                return Redirect::to('/admin/benefit');
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
        $data['benefit']= Benefit::where('id','=',$id)->first(); 
       

       
        
        return View::make('benefit.update',$data);
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
        $data= Benefit::where('id','=',$id)->first(); 

        
        $data->delete();
        return Redirect::to('/admin/benefit');
    }
    public function changeStatus($id,$status)
    {

        $data= Benefit::where('id','=',$id)->first(); 

        $data->is_active = $status;
        $data->save();
        return Redirect::to('/admin/benefit');

    }


}
