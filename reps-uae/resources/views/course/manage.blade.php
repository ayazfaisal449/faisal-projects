@extends('layouts.admin')

@section('content')
    <div class="tools">
        <h1>Course <a class="addNew" href="{{Request::root()}}/admin/{{$edit}}/add">Add New</a></h1>	

        <form name="search" method="post" action="{{Request::root()}}/admin/course/search" >
            <input type="text" name="course" placeholder="Search by Name" style="width: 370px;margin-right: 20px;float: left;"  />
            <input type="submit" value="Search" style="padding: 8px;width: 130px;" />
        </form>

        <div class="component">			
            @include('include.table')           
        </div>
    </div>
@stop