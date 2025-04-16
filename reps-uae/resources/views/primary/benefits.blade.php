@extends('layouts.primary')

@section('content')
    
    @include('include.subNav')
     
    <div class="border-bottom">
        <div class="row">
            <div class="large-12 columns">
                <h1 class="color-green">Benefits</h1>
            </div>
        </div>
    </div>
    
     <div class="benefits-wrapper">
        @foreach($benefits as $benefit)
        <div class="row">
            <div class="teamMember clearfix" style="width: 100%;">
                <div class="teamMemberPic">
                    <a href="{{ $benefit->url }}" alt=""><img style="max-height: 150px;" src="/{{ $benefit->location }}"></a>
                </div>
                <div class="teamMemberDesc">
                    {!! $benefit->description !!}
                </div>
            </div>
        </div>
        @endforeach
     </div>

    
    

    

   
    
   

    

   

  
    
    <!-- -->
    

    <!-- -->
    

    <!-- -->
    


    
    
    

    
    
    

    @include('include.subFooter')

@stop

<!-- Adding the fancy box for the images -->
@section('customScripts')
	$(document).ready(function() {
		
      	var $elements = $('.carousel').find('.elements').children().length,
			children = $elements,
			$slide =0;
		
		$('.carousel a.left').click(function() {
			if($elements-1 != 1) {
				$slide = $slide + 195;
				$('.elements').animate({
					'left':'-'+$slide+'px'
				},'easeOutBounce');	  
				$elements = $elements-1;
			}
           
		});
		
		$('.carousel a.right').click(function() {
			if($elements != children) {
				$slide = $slide - 195;
				$('.elements').animate({
					'left':'-'+$slide+'px'
				},'easeOutBounce');	 
				
				$elements = $elements+1;
			} else {
				$('.elements').animate({
					'left':0
				},'easeOutBounce');	
			}
		});        
       
	});
@stop
