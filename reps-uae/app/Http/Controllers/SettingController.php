<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
// use App\models\Footer\Footer;
use DB as DBS;


class SettingController extends Controller {

   
   
    public function manage()
   
      {
      $data =  DBS::table('setting')->get();
      // dd($data);
      
       return View::make('setting.manage',compact('data'));
      }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        
         return View::make('setting.add');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
            $id = request()->get('id'); 

      

       if($id){

                /*if ($_FILES['photo']['name'] != '') {
				$image_path2 = public_path(request()->get('old_photo'));
				if (File::exists($image_path2)) {
					File::delete($image_path2);
				}
				$photo = request()->file('photo')->getClientOriginalName();
				File::delete(Config::get('images/setting'), $photo);
				request()->file('photo')->move(public_path('images/setting'), $photo);
				$photo_location = 'images/setting' . '/' . $photo;
				} else {
					$photo_location = request()->get('old_photo');
				}*/    
         
                $opening_hours = request()->get('opening_hours'); 
                $ramadan_timing = request()->get('ramadan_timing'); 
                $location = request()->get('location'); 
                $mobile = request()->get('mobile'); 
                $information = request()->get('information'); 
                //$image = request()->get('image');

            
                   
                 DBS::table('setting')->where('id',$id)->update([
                 'opening_hours'=>$opening_hours,
                 'ramadan_timing'=>$ramadan_timing,
                 'location'=>$location,
                 'mobile'=>$mobile,
                 'information'=>$information,
				 //'image'=>$photo_location
             ]);
              

       }

       else{
      
                $opening_hours = request()->get('opening_hours'); 
                // dd($name);
                $ramadan_timing = request()->get('ramadan_timing'); 
                $location = request()->get('location'); 
                $mobile = request()->get('mobile'); 
                $information = request()->get('information'); 
                //$image = request()->get('image'); 

            
                   
                 DBS::table('setting')->insert([
                 'opening_hours'=>$opening_hours,
                 'ramadan_timing'=>$ramadan_timing,
                 'location'=>$location,
                 'mobile'=>$mobile,
                 'information'=>$information,
				 //'image'=>$photo_location,
             ]);
              

          }

                
                

               return Redirect::to('/admin/setting/update/1');

                

 }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $data = DBS::table('setting')->where('id','=',$id)->first(); 
       
        return View::make('setting.update',compact('data'));
    }


    


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //DBS::table('team')->where('id',$id)->delete();
        DB::delete('delete from setting where id = ?',[$id]);
    
        return Redirect::to('/admin/setting');
    }

    public function changeStatus($id,$status)
    {

        $data= Partner::where('id','=',$id)->first(); 

        $data->is_active = $status;
        $data->save();
        return Redirect::to('/admin/partner');

    }


}
