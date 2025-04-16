@extends('layouts.admin')

@section('content')
    <div class="tools">
        <h1>Manage team Page <a href="{{Request::root()}}/admin/team/add">Add New</a></h1>
        <div>
         @include('include.team')

        </div>
    </div> 
@stop