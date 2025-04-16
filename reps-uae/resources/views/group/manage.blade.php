@extends('layouts.admin')

@section('content')
	<div class="tools">
		<h1>Groups <a href="{{Request::root()}}/admin/group/add">Add Group</a></h1>
		<div class="component">
			@include('include.table')
		</div>
	</div> 
	 
@stop