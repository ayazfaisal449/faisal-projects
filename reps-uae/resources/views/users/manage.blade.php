@extends('layouts.admin')

@section('content')
	<div class="tools">
		<h1>Users <a class="addNew" href="{{Request::root()}}/admin/users/add">Add User</a><br/>
        {{ link_to('admin/downloadExcel', 'Download spreadsheet') }}</h1>        
		<div class="component">
			<?php  $message=Session::get('message');
			 if(!empty($message)){
				echo $message;
			} ?>
			@include('include.userTable')
		</div>
	</div> 
	 
@stop