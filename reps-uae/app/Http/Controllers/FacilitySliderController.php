<?php
namespace App\Http\Controllers;
use Cranium\FacilitySlider\Models\FacilitySlider as Slider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;


class FacilitySliderController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function manage()
    {
        $data['slider']= Slider::orderBy('sort_order', 'asc')->get(); 

       
        
        return View::make('facility-slider.manage',$data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
         return View::make('facility-slider.add');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $filename = '/public/images/slider/';
        $id = request()->get('id'); 


        

        
            if($id){
                $rules = array(
                 
                
                'sort' => 'required | integer | max:10',

                );
               
                
                $validator = Validator::make(request()->all(), $rules);

                if ($validator->fails())
                {

                    return Redirect::to('/admin/facility-slider/add')->withErrors($validator)->withInput();

                }
                $updater= Slider::where('id','=',$id)->first(); 
                $updater->text = request()->get('text'); 
                $updater->description = request()->get('description'); 
                $updater->url = request()->get('url'); 
                $updater->button_text = request()->get('button_text'); 
                $updater->sort_order = request()->get('sort');

                if (request()->hasFile('image'))
                {
                    $name = request()->file('image')->getClientOriginalName();

                    File::delete(Config::get('photo.facility-slider').'/'. $updater->location);
                
                    request()->file('image')->move(Config::get('photo.facility-slider').'/'.$id, $name);
                    $updater->location = 'images/facility-slider'.'/'.$id.'/'.$name;
                   
                }
                
                

                $updater->save(); 

                return Redirect::to('/admin/facility-slider');


            }else{
                $rules = array(
                 
                'sort' => 'required | integer | max:10',
                'image' => 'required | image',

                );
               
                
                $validator = Validator::make(request()->all(), $rules);

                if ($validator->fails())
                {

                    return Redirect::to('/admin/facility-slider/add')->withErrors($validator)->withInput();

                }

                $image = new Slider;
                $image->text = request()->get('text'); 
                $image->description = request()->get('description'); 
                $image->url = request()->get('url'); 
                $image->button_text = request()->get('button_text'); 
                $image->sort_order = request()->get('sort');

                $image->save(); 
                $name = request()->file('image')->getClientOriginalName();
                


                    
                //moving the image but check if directory is existing
                FILE::makeDirectory(Config::get('photo.facility-slider').'/'.$image->id,755,true);
                request()->file('image')->move(Config::get('photo.facility-slider').'/'.$image->id, $name);

                $location = Slider::where('id','=', $image->id)->first();

                $location->location = 'images/facility-slider'.'/'.$image->id.'/'.$name;
                $location->is_active=1;

                $location->save();
                return Redirect::to('/admin/facility-slider');
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
        $data['slider']= Slider::where('id','=',$id)->first(); 
       

       
        
        return View::make('facility-slider.update',$data);
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
        $data= Slider::where('id','=',$id)->first(); 

        
        $data->delete();
        return Redirect::to('/admin/facility-slider');
    }
    public function changeStatus($id,$status)
    {

        $data= Slider::where('id','=',$id)->first(); 

        $data->is_active = $status;
        $data->save();
        return Redirect::to('/admin/facility-slider');

    }


}
