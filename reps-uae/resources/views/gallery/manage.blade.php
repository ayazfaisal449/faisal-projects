@extends('layouts.admin')

@section('content')
    <div class="tools">
        <h1>Home Slider <a href="{{Request::root()}}/admin/gallery/add">Add New</a></h1>
        <div>
            @include('include.table')
        </div>
    </div> 
@stop