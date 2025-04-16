@extends('layouts.admin')

@section('content')

	<div class="tools">
		<h1>Course Provider<a class="addNew" href="{{Request::root()}}/admin/{{$edit}}/add">Add New</a></h1>	
		<div class="component">			
			@include('include.table')                 
		</div>
	</div>
	 
@stop