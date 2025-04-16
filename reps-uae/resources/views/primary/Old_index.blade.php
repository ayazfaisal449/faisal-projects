@extends('layouts.primary')

@section('content')
	<div>
	@include('include.subNav')
	</div>
	<div class="slider-home">
		@foreach($slider as $key => $value)  
			@if($value['is_active']==1)
			<div>
				<img src="{{Request::root()}}/{{$value['location']}}">
				<div class="text-slider">
					<div class="row">
						 <div class="columns large-12 medium-12 small-12">
						 	<h1>{{$value['text']}}</h1>
						 	<p style="font-size: 15px;">{{$value['description']}}</p>
						 	@if($value['button_text'] != null)
								<a class="" href="{{$value['url']}}">{{$value['button_text']}}</a>
						 	@endif
						 	
						 </div>
					</div>
				</div>
			</div>
			@endif
		@endforeach
	</div>
	<div class="row-container">
		<span class="bg-cont"></span>
		<div class="row row-top">
			<div class="large-12 medium-12 small-12 columns">
				<div class="overlapper-slide">  
				<h1 class="subtitle-green clearfix">&nbsp;</h1>
					<h1 class="subtitle-green paddingtop0">WHY REGISTER?</h1>
					<div class="row">
						<div class="columns large-6 medium-12 small-12">
							
							<div class="clearfix cont-slider-create">
							<div class="clearfix">
								
							
								<p class="bold-p "> Membership of REPs can provide more than just a badge to enhance an instructors professional image. It differentiates a qualified and committed instructor from someone with little or no training. Being a member of REPs means that Fitness Professionals will hold recognised and approved qualifications and be committed to ongoing professional development.</p>
								<a class="member-benefits" href="/about">MORE INFO HERE</a>
							</div>
						 	</div>
						 </div>
						<div class="columns large-6 medium-6 small-12">
							<div class="img-manwoman">
								<img src="../img/manwoman.png">
							</div>
							
						</div>
					</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<div class="news-container clearfix">
		{{-- <div class="large-4 columns blacker">
			<div class="row">
				<div class="columns large-5 medium-5">
					&nbsp;
				</div>
				<div class="columns large-7 medium-12">
					<div class="text-news">
						<h1>Download Our App</h1>
						<b style="color: #32A543;">REPS UAE Trainers</b>
						<div style="margin-bottom: 15px;">
							<a target="_blank" href="https://apps.apple.com/us/app/reps-uae-trainers/id1468469870?ls=1"><img style="max-height: 75px; margin-bottom: 5px;" src="{{Request::root()}}/img/apps/reps-uae-trainers-ios.png" /></a>
							<a target="_blank" href="https://play.google.com/store/apps/details?id=com.volutionfit.repsuaetrainers"><img style="max-height: 75px; margin-bottom: 5px;" src="{{Request::root()}}/img/apps/reps-uae-trainers-android.png" /></a>
						</div>
						<b style="color: #32A543;">GET FIT with REPS UAE</b>
						<div>
							<a target="_blank" href="https://apps.apple.com/us/app/get-fit-with-reps-uae/id1468468096?ls=1"><img style="max-height: 75px; margin-bottom: 5px;" src="{{Request::root()}}/img/apps/get-fit-ios.png" /></a>
							<a target="_blank" href="https://play.google.com/store/apps/details?id=com.volutionfit.repsuae"><img style="max-height: 75px; margin-bottom: 5px;" src="{{Request::root()}}/img/apps/get-fit-android.png" /></a>
						</div>
					</div>
				</div>
			</div>
			
		</div> --}}
		<div class="large-12 columns imager-bg-xx">
			<div class="row">
				<div class="columns large-12">
					<div class="img-news">
						<div class="row">
							<div class="columns large-8 medium-8 small-12">
								
						
								<div class="row">
									<div class="columns large-6 medium-6 small-12">

									<a href="https://fitawardsme.com/" target="_blank">
										<div class="hoverGreen" style="text-align: center;">
										    <img style="max-height: 100px;" src="{{Request::root()}}/img/fit-awards-new.png?v=1"  alt="Pic"/>
										    
										        <h1 class="pic-title">FIT AWARDS </h1>
										   
										</div>
									</a>
									</div>
									<div class="columns large-6 medium-6 small-12">
										<a href="{{Request::root()}}/blog">
											<div class="hoverGreen" style="text-align: center;">
											    <img src="../img/news4.png"  alt="Pic" style="height: 100px;"/>
											   
											        <h1 class="pic-title">FITNESS NEWS </h1>
											 
											</div>
									</a>
									</div>
								</div>
								
							</div>
							<div class="columns large-4 medium-4 small-12">
								
								<!-- <a href="{{ action('PrimaryController@marketingResources') }}"> -->
								<a href="/download/REPs_UAE_Working_in_Fitness_Survey_2019_-_Executive_Summary.pdf" download>
									<div class="hoverGreen" style="text-align: center;">

									    <!-- <img src="{{ file_exists(public_path() . '/images/marketing-thumb.jpg') ? '/img/survey-thumb.jpg' : '/img/sept2016.png' }}"  alt="Pic" style="min-height: 271px;"/> -->
											<img src="/img/survey-thumb.jpg"  alt="Pic" style="height: 100px;"/>
									        <h1 class="pic-title">FITNESS SURVEY</h1>
									  
									</div>
								</a>
							</div>
							<div class="columns large-4 medium-4 small-12">
								<!--
								<a href="{{ action('PrimaryController@onlineMarketing') }}">
									<div class="hoverGreen">
									    <img src="../img/news1.png" alt="Pic"/>
									    <h1 class="pic-title">&nbsp;&nbsp;REPs app for Personal Trainers&nbsp;&nbsp; </h1>
									</div>
								</a>
								-->
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="columns large-3 medium-4 small-12">
			<div class="registered-texts">
				<h1 class="subtitle-green">Registered Exercise
					Facilities</h1>
					<p>
						The following exercise facilities ensure that all of their Fitness Professionals are REPs registered.
					</p>
			</div>
		</div>
		<div class="columns large-8 medium-8 small-12 left">
			<div class="slider-register">
				@if(count($facility_slider))
                    @foreach($facility_slider as $slider)
                    <div><img src="/{{ $slider->location }}" style="max-height:100px;" /></div>
                    @endforeach
                @endif
			</div>
		</div>
	</div>
	<div id="map-canvas" style="width: 100%; height: 250px;">
		
	</div>
	<div class="remodal video" data-remodal-id="video" style="padding:0;height: 360px !important;">
	  <div class="vidUrl" style="height:500px;">
			<div id="ytplayer"></div>
		</div>
	</div>

@stop

@section('customScripts')
 		$('.slider-home')
	        .on('init', function(event, slick){
	            $('.slick-current').find('h1').addClass('animated fadeInLeft show');
	            $('.slick-current').find('a').addClass('animated fadeInUp show');
	            $('.slick-current').find('p').addClass('animated fadeInRight show');
	        })
	        .on('beforeChange', function(event, slick, currentSlide, nextSlide){
	            $('.slick-slider').find('h1').removeClass('animated fadeInLeft show');
	            $('.slick-current').find('a').removeClass('animated fadeInUp show');
	            $('.slick-current').find('p').addClass('animated fadeInRight show');
	        })
	        .on('afterChange', function(event, slick, currentSlide, nextSlide){
	            $('.slick-current').find('h1').addClass('animated fadeInLeft show');
	            $('.slick-current').find('a').addClass('animated fadeInUp show');
	            $('.slick-current').find('p').addClass('animated fadeInRight show');
	            
        });


	$('.slider-home').slick({
		dots: true,
		arrows: true,
		 autoplay: true,
  		 autoplaySpeed: 4000,
  		 speed: 2000
	});
	$('.slider-home').find('.slick-prev').html('<i class="fa fa-angle-left"></i>');
	$('.slider-home').find('.slick-next').html('<i class="fa fa-angle-right"></i>');

	$('.slider-benefits').slick({
		  dots: true,
		  infinite: true,
		  speed: 300,
		  slidesToShow: 3,
		  slidesToScroll: 3,
		  vertical: true,
		  nextArrow: '.slick-dots'
	});
	$('.slider-register').slick({
		  dots: false,
		  arrows: true,
		  infinite: true,
		  speed: 300,
		  slidesToShow: 3,
		  slidesToScroll: 3,
		  autoplay: true,
  		  autoplaySpeed: 3000,
  		  speed: 2000,
responsive: [
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow:1,
        slidesToScroll: 1
      }
    }
  ]
	});
	$('.slider-register').find('.slick-prev').html('<i class="fa fa-angle-double-left"></i>');
	$('.slider-register').find('.slick-next').html('<i class="fa fa-angle-double-right"></i>');

	//google map
	function initialize() {
	      var mapOptions = {
	        zoom: 13,
	        center: new google.maps.LatLng(25.125931, 55.209005)
	      }
	      var map = new google.maps.Map(document.getElementById('map-canvas'),
	                                    mapOptions);

	      var image = '../img/pinner.png';
	      var myLatLng = new google.maps.LatLng(25.125931, 55.209005);
	      var beachMarker = new google.maps.Marker({
	          position: myLatLng,
	          map: map,
	          icon: image
	      });
	    }
	 google.maps.event.addDomListener(window, 'load', initialize);

//Embedd on Youtube Video
//slider full widths
var winHeight = $(window).height() - 230;
var vidHeight = $(window).height() - 230;
$('.imageSlider img').css('height', winHeight + 'px');
$('.vidUrl').css('height', vidHeight + 'px');
// Load the IFrame Player API code asynchronously.
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/player_api";

var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// Replace the 'ytplayer' element with an <iframe> and
// YouTube player after the API code downloads.
var player;

function onYouTubePlayerAPIReady() {
    player = new YT.Player('ytplayer', {
        
        width: '100%',
        videoId: '8EqUlWS2gPM',
        playerVars: {
            'autoplay': 0,
            'controls': 1,
            'rel': 0
        }
    });
}

$(document).on('opened', '.remodal', function () {
  player.playVideo();
});
$(document).on('closing', '.remodal', function () {
 player.stopVideo();
});
		
@stop
