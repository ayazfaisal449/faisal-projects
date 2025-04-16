@extends('layouts.admin')

@section('content')

    <div class="tools">
		<h1>{{$update}}</h1>
        
        @include('include.updateForm')

        @include('include.deleteForm')	
		
	</div>
@stop

@section('customScripts') 
    $(function() {
        $("#date").datepicker({
            changeMonth: true,
            changeYear: true, 
            minDate: "-100Y",
            maxDate: "+0D",
            dateFormat:'yy-mm-dd',
            yearRange: "-100:+0D",
            showMonthAfterYear:true
        });
    });
@stop