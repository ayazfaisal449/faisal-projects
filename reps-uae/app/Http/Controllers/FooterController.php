<?php

namespace App\Http\Controllers;
// use Cranium\Footer\Models\Footer;
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



class FooterController extends Controller {

   public function add()
   {

   return View::make('footer.about_reps');
   }

   
  



    public function manage()
    {
      $data =  DBS::table('footer')->get();
     
        return View::make('footer.manage',compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
         return View::make('footer.about_reps');
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



                $description1 = request()->get('description1'); 
            
                $text = request()->get('text');

                $location = '';
                if (request()->hasFile('image')){
                    $name = request()->file('image')->getClientOriginalName();
                    File::delete(Config::get('images/partner'),$name);
                    request()->file('image')->move(public_path('images/partner'), $name);
                    $location = 'images/partner'.'/'.$name; 

                     DBS::table('footer')->where('id',$id)->update([
                    'textarea1'=>$description1,
                    'images'=>$location,
                    'text'=>$text,
                  
                
                ]);   

                }
                // else{
                //       $location = DBS::table('footer')->select('images')->where('id',$id)->get();
                //       $location->

                // }
                 
                 DBS::table('footer')->where('id',$id)->update([
                    'textarea1'=>$description1,
                    'text'=>$text,
                  
                
                ]);   
              
       }


       else{
          
 
                $description1 = request()->get('description1'); 
                $pages = request()->get('pages'); 
                $text = request()->get('text');

                $location = '';
                if (request()->hasFile('image')){
                    $name = request()->file('image')->getClientOriginalName();
                    request()->file('image')->move(public_path('images/partner'), $name);
                    $location = 'images/partner'.'/'.$name;        
                }

                 DBS::table('footer')->insert([
                    'textarea1'=>$description1,
                    'images'=>$location,
                    'text'=>$text,
                    'pages'=>$pages,
                
                ]); 
        }  

               return Redirect::to('/admin/footer');
       }
       


            
              
          
            
            
                







            


        
  


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
   
        $data = DBS::table('footer')->select('textarea1','images','text','id')->where('id','=',$id)->first(); 
        // dd($data);
       
        return View::make('footer.update',compact('data'));
    }


 public function destroy($id)
    {
        dd($id);
       DBS::table('footer')->where('id',$id)->delete();
        return Redirect::to('/admin/footer');
    }

    
}