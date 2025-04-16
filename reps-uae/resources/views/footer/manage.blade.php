@extends('layouts.admin')

@section('content')
    <div class="tools">
        <h1>Manage Footer Pages <!-- <a href="{{Request::root()}}/admin/footer/add">Add New</a> --> </h1>
        <div>
           @include('include.about_reps')
        </div>
    </div> 
@stop