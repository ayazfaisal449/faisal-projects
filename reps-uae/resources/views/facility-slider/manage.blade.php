@extends('layouts.admin')

@section('content')
    <div class="tools">
        <h1>Registered Facilities Slider <a href="{{Request::root()}}/admin/facility-slider/add">Add New</a></h1>
        <div>
            @include('include.facility-slider')
        </div>
    </div> 
@stop
