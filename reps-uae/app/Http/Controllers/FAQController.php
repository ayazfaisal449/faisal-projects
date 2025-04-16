<?php
namespace App\Http\Controllers;
use Cranium\FAQ\Models\FAQ;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;

class FAQController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function manage()
    {
        $data['faq']= FAQ::orderBy('sort_order', 'asc')->get(); 
       

       
        
        return View::make('faq.manage',$data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
         return View::make('faq.add');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $filename = '/public/images/faq/';
        $id = request()->get('id'); 


        

        
            if($id){
                $rules = array(
                 
                
                'sort' => 'required | integer | max:10',

                );
               
                
                $validator = Validator::make(request()->all(), $rules);

                if ($validator->fails())
                {

                    return Redirect::to('/admin/faq/add')->withErrors($validator)->withInput();

                }
                $updater= FAQ::where('id','=',$id)->first(); 
                $updater->title = request()->get('title'); 
                $updater->description = request()->get('description'); 
                // $updater->button_text = request()->get('button_text'); 
                $updater->sort_order = request()->get('sort');


                $updater->save(); 

                return Redirect::to('/admin/faq');


            }else{
                $rules = array(
                 
                'sort' => 'required | integer | max:10',

                );
               
                
                $validator = Validator::make(request()->all(), $rules);

                if ($validator->fails())
                {

                    return Redirect::to('/admin/faq/add')->withErrors($validator)->withInput();

                }

                $image = new FAQ;
                $image->title = request()->get('title'); 
                $image->description = request()->get('description'); 
                // $image->button_text = request()->get('button_text'); 
                $image->sort_order = request()->get('sort');

                $image->save(); 
                // $name = request()->file('image')->getClientOriginalName();
                


                    
                //moving the image but check if directory is existing
                // FILE::makeDirectory(Config::get('photo.faq').'/'.$image->id,755,true);
                // request()->file('image')->move(Config::get('photo.faq').'/'.$image->id, $name);

                // $location = FAQ::where('id','=', $image->id)->first();

                // $location->location = 'images/faq'.'/'.$image->id.'/'.$name;
                // $location->is_active=1;

                // $location->save();
                return Redirect::to('/admin/faq');
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
        $data['faq']= FAQ::where('id','=',$id)->first(); 
       

       
        
        return View::make('faq.update',$data);
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
        $data= FAQ::where('id','=',$id)->first(); 

        
        $data->delete();
        return Redirect::to('/admin/faq');
    }
    public function changeStatus($id,$status)
    {

        $data= FAQ::where('id','=',$id)->first(); 

        $data->is_active = $status;
        $data->save();
        return Redirect::to('/admin/faq');

    }


}
