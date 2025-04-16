<?php
namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogCategory\BlogCategory;
use DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
class BlogCategoryController extends BaseController {
    /*
     * home page
     * Created By Kevin @ Cranium Creations
     */

    public function manage() {
        $data['category'] = DB::table('blogcategory')->get();
        return View::make('blog_category.manage', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('blog_category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {

        $filename = '/public/images/benefit/';
        $id = request()->get('id');

        if ($id) {
            $rules = array(
                'title' => 'required',
                'slug' => 'required|unique:blogcategory,slug,'.$id,
            );
            $validator = Validator::make(request()->all(), $rules);

            if ($validator->fails()) {

                return Redirect::to('/admin/blog-category/update/'.$id)->withErrors($validator)->withInput();
            }
            $result = DB::table('blogcategory')
                    ->where('id', $id)
                    ->update([
                'title' => request()->get('title'),
                'slug' => request()->get('slug'),
                'description' => request()->get('description'),
            ]);
            return Redirect::to('/admin/blog-category');
        } else {

            $rules = array(
                'title' => 'required',
                'slug' => 'required|alpha_dash|unique:blogcategory,slug',
            );

            $validator = Validator::make(request()->all(), $rules);

            if ($validator->fails()) {

                return Redirect::to('/admin/blog-category/add')->withErrors($validator)->withInput();
            }
            $values = array(
                'title' => request()->get('title'),
                'slug' => request()->get('slug'),
                'description' => request()->get('description'),
            );
            DB::table('blogcategory')->insert($values);

            return Redirect::to('/admin/blog-category');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $data['category'] = DB::table('blogcategory')->where('id', '=', $id)->first();
//        print_r($data); die();
        return View::make('blog_category.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
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
        DB::table('blogcategory')->where('id', $id)->delete();
        return Redirect::to('/admin/blog-category');
    }
}
