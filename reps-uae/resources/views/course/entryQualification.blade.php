@extends('layouts.user')

@section('content')
@include('include.subNav')
	<div class="tools">
		<h1>Course </h1>																									
		<div class="component">			
			@include('include.courseTable')           
		</div> 
		  
	</div>
				
		 		
	 
@stop