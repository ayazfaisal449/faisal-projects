<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
// use App\models\Footer\Footer;
use DB as DBS;


class MeetTeamController extends Controller {

   
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function manage()
   
      {
      $data =  DBS::table('team')->get();
      
       return View::make('team.manage',compact('data'));
      }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        
         return View::make('team.add');
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


         
                $name1 = request()->get('name'); 
                // dd($name);
                $designation = request()->get('designation'); 
                $description = request()->get('description'); 
           
                $location = '';
                if (request()->hasFile('image'))
                {
                    $name = request()->file('image')->getClientOriginalName();
                    File::delete(Config::get('images/team'),$name);
                    request()->file('image')->move(public_path('images/team'), $name);
                    $location = 'images/team'.'/'.$name;
                     DBS::table('team')->where('id',$id)->update([
                    'name'=>$name1,
                    'designation'=>$designation,
                    'image'=>$location,
                    'description'=>$description]);
                }else {
                   
                    DBS::table('team')->where('id',$id)->update([
                    'name'=>$name1,
                    'designation'=>$designation,
                    'description'=>$description]);
              }   

       }

       else{
       
                $name1 = request()->get('name'); 
                $designation = request()->get('designation'); 
                $description = request()->get('description'); 
           
                $location = '';
                if (request()->hasFile('image'))
                {
                    $name = request()->file('image')->getClientOriginalName();

                    request()->file('image')->move(public_path('images/team'), $name);
               
                    $location = 'images/team'.'/'.$name;
                  
                }
                   

                DBS::table('team')->insert([
                'name'=>$name1,
                'designation'=>$designation,
                'image'=>$location,
                'description'=>$description,
        ]);

          }

                
                

               return Redirect::to('/admin/team');

                

 }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data = DBS::table('team')->where('id','=',$id)->first(); 
       
        return View::make('team.update',compact('data'));
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
        //DBS::table('team')->where('id',$id)->delete();
        DBS::delete('delete from team where id = ?',[$id]);
    
        return Redirect::to('/admin/team');
    }

    public function changeStatus($id,$status)
    {

        $data= Partner::where('id','=',$id)->first(); 

        $data->is_active = $status;
        $data->save();
        return Redirect::to('/admin/partner');

    }


}
