<?php
namespace App\Http\Controllers;
use Cranium\Slider\Models\Slider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class SliderController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function manage()
	{
		$data['slider']= Slider::orderBy('sort_order', 'asc')->get();
        return View::make('slider.manage',$data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data = array(
			'types' => array(
				'image' => 'Image',
				'video' => 'Video'
			)
		);
		 return View::make('slider.add',$data);
	}

	/**
	 * Save Marketing thumb on homepage
	 */
	public function saveMarketing(Request $request)
	{
		if ($request->hasFile('image')) {
		    $name = $request->file('image')->getClientOriginalName();
		    $ext  = $request->file('image')->getClientOriginalExtension();

			$request->file('image')->move(
				public_path() . '/images', 
				'marketing-thumb.jpg'
			);

			return Redirect::to('/admin/slider')->with('message', 'Image thumb is set successfully!');
		}
		return Redirect::to('/admin/slider')->with('error_message', 'Image thumb is set successfully!');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$filename = '/public/images/slider/';
		$id = $request->get('id');	

	        if($id){
	        	$rules = array(
	            
	            'sort' => 'required | integer | max:10',

	            );

		      	$validator = Validator::make($request->all(), $rules);

		       	if ($validator->fails())
		        {

		            return Redirect::to('/admin/slider/add')->withErrors($validator)->withInput();

		        }
	        	$updater= Slider::where('id','=',$id)->first(); 
	        	$updater->text = $request->get('text'); 
				$updater->description = $request->get('description'); 
				$updater->url = $request->get('url'); 
				$updater->button_text = $request->get('button_text'); 
				$updater->sort_order = $request->get('sort');
				$updater->type = $request->get('type');
                

				if ($request->hasFile('image'))
				{
				    $name = $request->file('image')->getClientOriginalName();

					File::delete(Config::get('photo.slider').'/'. $updater->location);
	            
	                $request->file('image')->move(Config::get('photo.slider').'/'.$id, $name);
	                $updater->location = 'images/slider'.'/'.$id.'/'.$name;
	               
				}

				if ($request->hasFile('video_url'))
				{
				    $name = $request->file('video_url')->getClientOriginalName();

					File::delete(Config::get('photo.slider').'/'. $updater->location);
					
					$newname = time().$name;
	                $request->file('video_url')->move(Config::get('photo.slider').'/'.$id, $newname);
	                $updater->location = 'images/slider'.'/'.$id.'/'.$newname;
	               
				}
				
				

				$updater->save(); 

				return Redirect::to('/admin/slider');


	        }else{

				$all_inputs = $request->all();
	        	$rules = array(
       		     
	            'sort' => 'required | integer | max:10',
	            

	            );

				if($all_inputs['type']=='image'){

					$rules['image'] = 'required | image';
				}
	           
				
		      	$validator = Validator::make($request->all(), $rules);

		       	if ($validator->fails())
		        {

		            return Redirect::to('/admin/slider/add')->withErrors($validator)->withInput();

		        }

	        	$image = new Slider;
				$image->text = $request->get('text'); 
				$image->description = $request->get('description'); 
				$image->url = $request->get('url'); 
				$image->button_text = $request->get('button_text'); 
				$image->sort_order = $request->get('sort');
				$image->type = $request->get('type'); 

				$image->save(); 
				if ($request->hasFile('image'))
				{
					$name = $request->file('image')->getClientOriginalName();
					
					//moving the image but check if directory is existing
					FILE::makeDirectory(Config::get('photo.slider').'/'.$image->id,0775,true);
					$request->file('image')->move(Config::get('photo.slider').'/'.$image->id, $name);

					$location = Slider::where('id','=', $image->id)->first();

					$location->location = 'images/slider'.'/'.$image->id.'/'.$name;
					$location->is_active=1;
					$location->save();
				}

				if ($request->hasFile('video_url'))
				{
					$vname = $request->file('video_url')->getClientOriginalName();

					//moving the image but check if directory is existing
					FILE::makeDirectory(Config::get('photo.slider').'/'.$image->id,0775,true);
					$request->file('video_url')->move(Config::get('photo.slider').'/'.$image->id, $vname);

					$location = Slider::where('id','=', $image->id)->first();

					$location->location = 'images/slider'.'/'.$image->id.'/'.$vname;
					$location->is_active=1;
					$location->save();
				}
				return Redirect::to('/admin/slider');
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

		$data['types'] = array(
			'image' => 'Image',
			'video' => 'Video'
		);
		$data['slider']= Slider::where('id','=',$id)->first(); 
       

       
        
        return View::make('slider.update',$data);
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
		$data = Slider::where('id','=',$id)->first();
    	$data->delete();
    	$path ='images/slider'.'/'.$id;
        File::deleteDirectory(public_path($path));
    	return Redirect::to('/admin/slider');
	}
	
	public function changeStatus($id,$status)
    {

    	$data = Slider::where('id','=',$id)->first();
    	$data->is_active = $status;
    	$data->save();
    	return Redirect::to('/admin/slider');

    }
}