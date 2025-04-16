<?php
namespace App\Http\Controllers;
use Cranium\Partner\Models\Partner;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
class PartnerController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function manage()
    {
        $data['partner']= Partner::orderBy('sort_order', 'asc')->get(); 
       

       
        
        return View::make('partner.manage',$data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
         return View::make('partner.add');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $filename = '/public/images/partner/';
        $id = request()->get('id'); 


        

        
            if($id){
                $rules = array(
                 
                
                'sort' => 'required | integer | max:10',

                );
               
                
                $validator = Validator::make(request()->all(), $rules);

                if ($validator->fails())
                {

                    return Redirect::to('/admin/partner/add')->withErrors($validator)->withInput();

                }
                $updater= Partner::where('id','=',$id)->first(); 
                $updater->text = request()->get('text'); 
                $updater->description = request()->get('description'); 
                $updater->url = request()->get('url'); 
                $updater->button_text = request()->get('button_text'); 
                $updater->sort_order = request()->get('sort');

                if (request()->hasFile('image'))
                {
                    $name = request()->file('image')->getClientOriginalName();

                    File::delete(Config::get('photo.partner').'/'. $updater->location);
                
                    request()->file('image')->move(Config::get('photo.partner').'/'.$id, $name);
                    $updater->location = 'images/partner'.'/'.$id.'/'.$name;
                   
                }
                
                

                $updater->save(); 

                return Redirect::to('/admin/partner');


            }else{
                $rules = array(
                 
                'sort' => 'required | integer | max:10',
                'image' => 'required | image',

                );
               
                
                $validator = Validator::make(request()->all(), $rules);

                if ($validator->fails())
                {

                    return Redirect::to('/admin/partner/add')->withErrors($validator)->withInput();

                }

                $image = new Partner;
                $image->text = request()->get('text'); 
                $image->description = request()->get('description'); 
                $image->url = request()->get('url'); 
                $image->button_text = request()->get('button_text'); 
                $image->sort_order = request()->get('sort');

                $image->save(); 
                $name = request()->file('image')->getClientOriginalName();
                


                    
                //moving the image but check if directory is existing
                FILE::makeDirectory(Config::get('photo.partner').'/'.$image->id,755,true);
                request()->file('image')->move(Config::get('photo.partner').'/'.$image->id, $name);

                $location = Partner::where('id','=', $image->id)->first();

                $location->location = 'images/partner'.'/'.$image->id.'/'.$name;
                $location->is_active=1;

                $location->save();
                return Redirect::to('/admin/partner');
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
        $data['partner']= Partner::where('id','=',$id)->first(); 
       

       
        
        return View::make('partner.update',$data);
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
        $data= Partner::where('id','=',$id)->first(); 

        
        $data->delete();
        return Redirect::to('/admin/partner');
    }
    public function changeStatus($id,$status)
    {

        $data= Partner::where('id','=',$id)->first(); 

        $data->is_active = $status;
        $data->save();
        return Redirect::to('/admin/partner');

    }


}
