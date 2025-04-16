@extends('layouts.admin')
@section('content')
    <div class="tools">
        <h1>Manage Jobs Page <a href="{{Request::root()}}/admin/jobs/add">Add New</a></h1>
        <div>
            @include('include.jobs')
        </div>
    </div> 
@stop
