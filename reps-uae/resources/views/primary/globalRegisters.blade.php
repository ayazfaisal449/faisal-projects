@extends('layouts.primary')

@section('content')
    
    @include('include.subNav')
    
    <div class="border-bottom">
        <div class="row">
            <div class="large-12 columns">
                @foreach($global as $dat)
                <h1 class="color-green">{!!$dat->text!!}</h1>
                {!!$dat->textarea1!!}
            </div>
        </div>
    </div>
    
   
    @endforeach
   @include('include.subFooter')
    
@stop

<!-- Adding the fancy box for the images -->
@section('customScripts')
	$(document).ready(function() {
		
          
       
	});
@stop
