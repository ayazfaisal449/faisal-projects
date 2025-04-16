@extends('layouts.admin')

@section('content')
    <div class="tools">
        <h1>Blog Category  Page <a href="{{Request::root()}}/admin/blog-category/add">Add New</a></h1>
        <div>
            @include('include.blog_category')
        </div>
    </div> 
@stop
