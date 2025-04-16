@extends('layouts.admin')

@section('content')
    <div class="tools">
        <h1>Manage Partners Page <a href="{{Request::root()}}/admin/partner/add">Add New</a></h1>
        <div>
            @include('include.partner')
        </div>
    </div> 
@stop
