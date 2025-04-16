@extends('layouts.user')

@section('content')

	<div class="tools">
		<h1>Course </h1>
		<div class="component">
		<br/><br/><b><a  href="{{Request::root()}}/course/cpdProviders">Continuing Professional Development ( CPD ) Courses</a>
		<br/><br/><br/><a  href="{{Request::root()}}/course/entryQualifications">Entry Qualification Courses</a>		</b>	
		<?php  $message=Session::get('message');
                    if(!empty($message)){
                        echo $message;
                    }
                ?>			
		</div>        
	</div>
@stop