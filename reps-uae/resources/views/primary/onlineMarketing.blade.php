@extends('layouts.primary')

@section('content')
@include('include.subNav')
    <div class="row">
         <div class="columns large-12 medium-12 small-12">
             <div class="title-div">
                 <h4>Reps APP for Personal trainer</h4>
                 <p>INTELLIGENT SOCIAL MEDIA MARKETING FOR REPS MEMBERS<a class="activeMe right" href="">Reps APP</a><i class="right fa fa-angle-right"></i> <a class="right" href="">Home</a></p>
             </div>
             <img src="{{Request::root()}}/images/repsapp.gif" width="100%" alt="" title="" />
             <div class="row">
                 <div class="columns large-9 medium-9 small-12">
                    <div class="content-div">
                        <h4>The ultimate coaching solution for Personal Trainers!</h4>
                        <p>
                            Wouldn't it be great to have one place to gather all your clients' information, progress, goals, workouts and meal plans? 
                        </p>
                        <p>
                            And wouldn't itbe great to fill some of those empty hours during the day with helping more clients and building your business further? 
                        </p>
                        <p>
                           That's what REPs UAE's app does!   
                        </p>
                        <p>
                        In partnership with PureLifeStyle, REPs have launched an online platform with mobile apps to help PT's make more out of their extensive knowledge!
                        </p>
                        <h5>Features you'll love:</h5>
                        <ul>
                            <li>
                               <p style="margin:0;"> Extensive exercise diary and workout library</p>
                            </li>
                            <li>
                               <p style="margin:0;">Meal plans; create one for your client or use one of our nutritionist-created plans </p>
                            </li>
                            <li>
                                <p style="margin:0;">Ability to customize content (workouts and meal plans) and assign to individual clients</p>
                            </li>
                            <li>
                                <p style="margin:0;">Set any health goals for your client and track their performance</p>
                            </li>
                            <li>
                               <p style="margin:0;">PayPal mechanism</p>
                            </li>
                            <li>
                                <p style="margin:0;">Create a personal online shop – upsell health and fitness products</p>
                            </li>
                            <li>
                                <p style="margin:0;">Ability to work remotely - follow up with clients outside of face-to-face appointments </p>
                            </li>
                            <li>
                             <p style="margin:0;">Library of health articles </p>
                            </li>
                             <li>
                             <p style="margin:0;">And many more features… sign up for a free trial to see for yourself!</p>
                            </li>
                        </ul>
                        <img src="{{Request::root()}}/images/iphone_cut.png">
                    </div>
                 </div>
                  <div class="columns large-3 medium-3 small-12">
                      <div class="know-more">
                           <h4>This sounds great!</h4> 
                          <img src="{{Request::root()}}/images/iphones.png">
                          <a href="http://purelifestyle.co.uk/reps-uae/" target="_blank">
                             I'd like a free trial and to know more! 
                          </a>
                      </div>  
                 </div>
             </div>
         </div>

    </div>
    
     
   

@stop

<!-- Adding the fancy box for the images -->
@section('customScripts')
	$(document).ready(function() {
        $(".insbg").backstretch("{{Request::root()}}/img/iactive_bg.jpg");
		
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
