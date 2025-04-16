@extends('layouts.admin')

@section('content')
    <div class="tools">
        <h1>Manage Benefits Page <a href="{{Request::root()}}/admin/benefit/add">Add New</a></h1>
        <div>
            @include('include.benefit')
        </div>
    </div> 
@stop
