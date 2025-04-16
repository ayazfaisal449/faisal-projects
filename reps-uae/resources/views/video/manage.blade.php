@extends('layouts.admin')

@section('content')
	<div class="tools">
		<h1>Videos <a href="{{Request::root()}}/admin/video/add">Add New</a></h1>
		<div class="component">
			@include('include.table')
		</div>
	</div> 
@stop