@extends('layouts.admin')

@section('content')
    <div class="tools">
        <h1>Manage FAQ Page <a href="{{Request::root()}}/admin/faq/add">Add New</a></h1>
        <div>
            @include('include.faq')
        </div>
    </div> 
@stop
