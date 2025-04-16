@extends('layouts.primary')

@section('content')
<style>
	.slider-home iframe {
		background: #000;
		height: 660px;
		width: 100%;
	}
	.row-top {
    top: -45px;
}
.img-manwoman {
    position: absolute;
    top: -267px;
}
.video-wrap video {
    object-fit: contain !important;
}

@media (min-width: 1025px) {
	h1.subtitle-green.clearfix {
    display: none;
}
.img-manwoman {
    position: absolute;
    top: -100px;
}
.img-manwoman img {
    max-width: 70%;
    object-fit: cover !important;
}
.news-container.clearfix.cardbg1 {
    z-index: 9;
    position: relative;
}
.overlapper-slide {
    padding-top: 50px;
}
.row-top {
    top: 0;
}
}
@media (max-width: 1024px) {
	.overlapper-slide {
    padding-top: 80px;
}

.slider-home + .row-container {
    position: relative;
    min-height: 100px;
}
}
</style>
	<div>
	@include('include.subNav')
	</div>
	<div class="slider-home">
		@foreach($slider as $key => $value)  
			@if($value['is_active']==1)
			@if($value['type']=='image')
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
			@elseif($value['type']=='video')
			<div>
				<div class="video-wrap" style="width:100%;">
					<video style="object-fit: fill;" width="100%" height="100%"  autoplay loop muted playsinline>
						<source src="{{Request::root()}}/{{$value['location']}}" type="video/mp4">
					</video>
				</div>
			</div>

			@endif
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
	<div class="news-container clearfix cardbg1">
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
		<div class="large-12 columns imager-bg-xx kambg">
		<style>
.kambg {
    background: #F8F8F8;
}
.kambg .hoverGreen {
    background: #F4F4F4;
	padding-top: 44px;
	margin-bottom: -7px;
	width: 97.4%;
}
  .kambg .img-news .pic-title {
  
    color: #333333;
}
.kambg .img-news {
    margin: 0 !important;
}
.kambg .line {
    width: 18%;
    height: 4px;
    margin: 0 auto;
    background: #32A543;
    color: white;
	margin-bottom: 44px;
    margin-top: 0px;
}
.kambg .hoverGreen img {
    height: 219px !important;
   
    max-height: 219px !important;
    width: 100%;
}
.news-container .img-news .pic-title {
    font-size: 26px;
    font-weight: bold;
	margin-bottom: 15px;
	font-family: 'Raleway';
}
section.brandsliderbr {
    padding: 25px 0 38px; 
	position: relative;
    z-index: 9;
	background: #fff;
}
.row-container{
	min-height: 390px;
    margin-bottom: 0px;
}
section.brandsliderbr .container {
    background: #fff;
}
.cardbg1 {
    background-color: #f8f8f8;
}
/* @media only screen and (min-width: 64.0625em){
.colgap1{
    width: 49.4%;
} */
}

@media (min-width:992px){
	.slider-register .slick-prev {
    right: -77px;
    top: 36%;
    left: auto;
}

.slider-register .slick-next {
    right: -77px;
    top: 0%;
}
.slider-register i.fa.fa-angle-right {
    background: #F4F4F4;
    padding: 0px 15px;
}
.slider-register i.fa.fa-angle-left {
    background: #F4F4F4;
    padding: 0 15px;
	margin-top: 6px;
}
.kambg .hoverGreen {
    width: 97.4% !important;
}

}
@media (max-width:800px){
	.registered-texts {
padding: 0 10px;
}
}

@media (max-width:600px){
	.kambg .hoverGreen {
   
    margin-bottom: 20px;
}

.kambg .hoverGreen {
     width: 100%;
}
.subtitle-green {
        font-size: 21px;
}

}
</style>
			<div class="row" style="display: none;">
				<div class="columns large-12">
					<div class="img-news">
						<div class="row">
							<div class="columns large-8 medium-8 small-12">
								
						
								<div class="row">
									<div class="columns large-6 medium-6 small-12">

									<a href="https://www.repsuae.com/awards/" target="_blank">
										<div class="hoverGreen" style="text-align: center;">
										<h1 class="pic-title">REPs INDUSTRY AWARDS </h1>
										<div class="line"></div>
										    <img style="max-height: 100px;" src="{{Request::root()}}/img/REPsIndustryAwards.png?v=3"  alt="Pic"/>
										    
										        
										   
										</div>
									</a>
									</div>
									<div class="columns large-6 medium-6 small-12 ">
										<a href="{{Request::root()}}/blog">
											<div class="hoverGreen" style="text-align: center;">
											<h1 class="pic-title">FITNESS NEWS </h1>
											<div class="line"></div>
											    <img src="../img/fitnews.png"  alt="Pic" style="height: 100px;"/>
											   
											        
											 
											</div>
									</a>
									</div>
								</div>
								
							</div>
							<div class="columns large-4 medium-4 small-12 colgap1">
								
								<!-- <a href="{{ action('PrimaryController@marketingResources') }}"> -->
								<!-- /REPs_UAE_Working_in_Fitness_Survey_2019_-_Executive_Summary.pdf -->
								<!-- <a href="/survey" id="servey"> -->
								<!-- /download/REPs_UAE_Working_in_Fitness_Survey_2019_-_Executive_Summary.pdf -->
								<!-- target="_blank" onclick="window.open('/survey');" -->
                                <a href=" /survey"  >
									<div class="hoverGreen" style="text-align: center;" >
									<h1 class="pic-title">FITNESS SURVEY</h1>
									<div class="line"></div>
									    <!-- <img src="{{ file_exists(public_path() . '/images/marketing-thumb.jpg') ? '/img/survey-thumb.jpg' : '/img/sept2016.png' }}"  alt="Pic" style="min-height: 271px;"/> -->
											<img src="/img/fitsurvy.png"  alt="Pic" style="height: 100px;"/>
									        
									  
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

	<section class="brandsliderbr">
		<div class="container">
			<div class="row">
				<div class="columns large-3 medium-4 small-12">
					<div class="registered-texts">
						<h2 class="subtitle-green">PARTNER FACILITIES</h1>
							<p>
								These establishments ensure that all exercise professionals are REPs registered.
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
		</div>
	</section>

	<section class="ru-categories">
        <div class="cat-container">
        	<div class="row">
            <div class="rucat-heading">
                <h2>REPs UAE Categories</h2>
                <p>When applying to REPs UAE you can apply to be recognised against the following disciplines.
                </p>
            </div>

            <div class="rucat-main">
				@if(count($registration_category))
                    @foreach($registration_category as $rcategory)

				
					<div class="rucat-box">
						<a href="{{ url('/trainer/registration-info') }}">
						<div class="rucat-img">
							<img src="{{ asset('images/category_images/'.$rcategory->image) }}" alt="REP's UAE">
							<div class="rucat-content">
								<h4>{{ $rcategory->level }}</h4>
<!-- 								<div class="rucat-hover">
									<a href="{{ url('/trainer/registration-info') }}" class="ru-regiser">register</a>
								</div> -->
							</div>
						</div>
						</a>
					</div>
				

					@endforeach
                @endif

            </div>
         </div>   

        </div>
    </section>
	<section class="brandsliderbr">
		
	<!--<div id="" style="width: 100%; height: 250px;">-->
         <iframe id="frame" src="https://www.google.com/maps/d/u/0/embed?mid=1VLUiIalTUbjMt7AcqcuV8iD7HLk1248I&z=19"width="100%" height="250px"></iframe>
	<!--</div>-->
	<div class="remodal video" data-remodal-id="video" style="padding:0;height: 360px !important;">
	  <div class="vidUrl" style="height:500px;">
			<div id="ytplayer"></div>
		</div>
	</div>

	
<!-- // start footer -->


<!-- // end footer -->



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


		$('#servey').click(function(e) {
		
		 window.open('https://www.repsuae.com/download/REPs_UAE_Working_in_Fitness_Survey_2019_-_Executive_Summary.pdf', '_blank');
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
	$('.slider-register').find('.slick-prev').html('<i class="fa fa-angle-left"></i>');
	$('.slider-register').find('.slick-next').html('<i class="fa fa-angle-right"></i>');

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