@extends('layouts.admin')

@section('content')
	<div class="tools">
		<h1>Permissions <a href="{{Request::root()}}/admin/permission/add">Add Permission</a></h1>
		<div class="component">
			@include('include.table')
		</div>
	</div> 
	 
@stop