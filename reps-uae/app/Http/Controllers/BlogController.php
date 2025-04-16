<?php
namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog\Blog;
use App\Models\BlogCategory\BlogCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class BlogController extends BaseController {
    /*
     * home page
     * Created By Kevin @ Cranium Creations
     */

    public function manage() {
        $data['blogs'] = DB::table('blog')
                ->LeftJoin('blogcategory', 'blogcategory.id', '=', 'blog.category_id')
                ->select(DB::raw('blogcategory.title as category_title, blog.title as title, blog.id as id,  blog.publish_status as publish_status'))
                ->get();
        return View::make('blog.manage', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $data['category'] = DB::table('blogcategory')->get();
        return View::make('blog.add', $data);
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
            $blog_id = $id;
            $rules = array(
                'title' => 'required',
                'slug' => 'required|unique:blog,slug,' . $blog_id,
                'date' => 'required',
                'category' => 'required',
            );
            $validator = Validator::make(request()->all(), $rules);

            if ($validator->fails()) {
                return Redirect::to('/admin/blog/update/' . $id)->withErrors($validator)->withInput();
            }
            if ($_FILES['thumbnail']['name'] != '') {
                $image_path1 = public_path(request()->get('old_thumbnail'));
                if (File::exists($image_path1)) {
                    File::delete($image_path1);
                }
                $img_name = request()->file('thumbnail')->getClientOriginalName();
                File::delete(Config::get('images/blog'), $img_name);
                request()->file('thumbnail')->move(public_path('images/blog'), $img_name);
                $thumbnail_location = 'images/blog' . '/' . $img_name;
            } else {
                $thumbnail_location = request()->get('old_thumbnail');
            }
            if ($_FILES['photo']['name'] != '') {
                $image_path2 = public_path(request()->get('old_photo'));
                if (File::exists($image_path2)) {
                    File::delete($image_path2);
                }
                $photo = request()->file('photo')->getClientOriginalName();
                File::delete(Config::get('images/blog'), $photo);
                request()->file('photo')->move(public_path('images/blog'), $photo);
                $photo_location = 'images/blog' . '/' . $photo;
            } else {
                $photo_location = request()->get('old_photo');
            }

            $publish_status = request()->get('publish_status');
            if ($publish_status == '') {
                $publish_status = 0;
            } else {
                $publish_status = request()->get('publish_status');
            }
            $result = DB::table('blog')
                    ->where('id', $id)
                    ->update([
                'title' => request()->get('title'),
                'slug' => request()->get('slug'),
                'thumbnail' => $thumbnail_location,
                'image' => $photo_location,
                'date' => request()->get('date'),
                'description' => request()->get('description'),
                'category_id' => request()->get('category'),
                'publish_status' => $publish_status
            ]);
            return Redirect::to('/admin/blog');
        } else {

            $rules = array(
                'title' => 'required',
                'slug' => 'required|alpha_dash|unique:blog,slug',
                'thumbnail' => 'required',
                'photo' => 'required',
                'date' => 'required',
                'category' => 'required',
            );

            $validator = Validator::make(request()->all(), $rules);

            if ($validator->fails()) {

                return Redirect::to('/admin/blog/add')->withErrors($validator)->withInput();
            }
            $img_name = request()->file('thumbnail')->getClientOriginalName();
            File::delete(Config::get('images/blog'), $img_name);
            request()->file('thumbnail')->move(public_path('images/blog'), $img_name);
            $thumbnail_location = 'images/blog' . '/' . $img_name;

            $photo = request()->file('photo')->getClientOriginalName();
            File::delete(Config::get('images/blog'), $photo);
            request()->file('photo')->move(public_path('images/blog'), $photo);
            $photo_location = 'images/blog' . '/' . $photo;
            $publish_status = request()->get('publish_status');
            if ($publish_status == '') {
                $publish_status = 0;
            } else {
                $publish_status = request()->get('publish_status');
            }
            $values = array(
                'title' => request()->get('title'),
                'slug' => request()->get('slug'),
                'thumbnail' => $thumbnail_location,
                'image' => $photo_location,
                'date' => request()->get('date'),
                'description' => request()->get('description'),
                'category_id' => request()->get('category'),
                'publish_status' => $publish_status,
            );
            DB::table('blog')->insert($values);

            return Redirect::to('/admin/blog');
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
        $data['blog'] = DB::table('blog')->where('id', '=', $id)->first();
        $data['category'] = DB::table('blogcategory')->get();
//        print_r($data); die();
        return View::make('blog.update', $data);
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
    public function destroy($id) {
        $data = DB::table('blog')->where('id', '=', $id)->first();
        $image_path1 = public_path($data->thumbnail);
        $image_path2 = public_path($data->image);
        if (File::exists($image_path1)) {
            File::delete($image_path1);
        }
        if (File::exists($image_path2)) {
            File::delete($image_path2);
        }
        DB::table('blog')->where('id', $id)->delete();
        return Redirect::to('/admin/blog');
    }

    public function changeStatus($id, $status) {
        $result = DB::table('blog')
                ->where('id', $id)
                ->update([
            'publish_status' => $status,
        ]);
        return Redirect::to('/admin/blog');
    }

    public function appBlogs() {
//         $data['blogs'] = DB::table('blog')->paginate(15);
        $data['blogs'] = DB::table('blog')->where('publish_status', '=', 1)->orderBy('date','desc')->get();
        $paginatedData = $this->paginator($data['blogs'], 9);
//        $abc = $paginatedData->links();
        $data = array(
            'data' => $paginatedData['data'],
            'paginator' => $paginatedData['links']
        );
//        echo '<pre>';        print_r($abc); die();
        return View::make('blog.app_blogs', $data);
    }

    public function single_blog($slug) {
        $data['blog'] = DB::table('blog')->where('slug', '=', $slug)->first();
        if ($data['blog'] != '') {
            $data['category_blog'] = DB::table('blog')->where('category_id', '=', $data['blog']->category_id)->where('publish_status', '=', 1)->get();
        } else {
            $data['category_blog'] = '';
        }
//        print_r($data['category_blog']); die();
        return View::make('blog.app_blog_detail', $data);
    }

    public function category_blogs($slug) {
        $category_data = DB::table('blogcategory')->where('slug', '=', $slug)->first();
        if ($category_data != '') {
            $data['data'] = DB::table('blog')->where('category_id', '=', $category_data->id)->where('publish_status', '=', 1)->get();
        } else {
            $data['data'] = '';
        }
        return View::make('blog.category_blogs', $data);
    }

}
