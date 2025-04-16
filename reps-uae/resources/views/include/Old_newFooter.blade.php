<div class="new-footer">
	<div class="row">
		<div class="columns large-3 medium-6 small-12">
			<div class="contact-forms">
				<h5 class="bold-p">Opening Hours :</h5>
				<p class="border-b">Sunday - Thursday | 10:00am - 5:00pm</p>
				<h5 class="bold-p">Ramadan Timings :</h5>
				<p class="border-b">Sunday - Thursday 10:00am - 4:00pm</p>
				<div class="row ">
					<div class="columns large-2 medium-1 small-1 top10">
						<i class="fa fa-map-marker"></i>
					</div>
					<div class="columns large-10 medium-11 small-11 top10">
						<p class="normal-p">Gold and Diamond Park, <br>
						Building 7 Office 208<br>
						Al Quoz Industrial Area, <br>
						P.O.Box 643590 Dubai, U.A.E.</p>
					</div>
				</div>

				<div class="row ">
					<div class="columns large-2 medium-1 small-1 top10">
						<i class="fa fa-phone"></i>
					</div>
					<div class="columns large-10 medium-11 small-11 top10">
						<p class="normal-p"><a href="tel:+97143213388">+971 4 321 3388</a></p>
					</div>
				</div>

				<div class="row ">
					<div class="columns large-2 medium-1 small-1 top10">
						<i class="fa fa-globe"></i>
					</div>
					<div class="columns large-10 medium-11 small-11 top10 bottom20">
						<p class="normal-p"><a href="mailto:faisal.ayaz@sigmads.com"> faisal.ayaz@sigmads.com</a></p>
					</div>
				</div>
			</div>
		</div>
		<div class="columns large-3 medium-6 small-12 contact-mobile">
			<div class="contact-forms">
				{{ Form::open(array('action'=>'PrimaryController@contactAjx','id'=>'contactForm','class'=>'msgrepss')) }}
                <div class="row">
                    <div class="large-12 small-12 columns">
                        {{ Form::text('firstname', '', array('style'=>'display:none;')) }}
                        {{ Form::text('name', '', array('placeholder'=>'Name')) }}
                        {{ Form::text('email', '', array('placeholder'=>'Email')) }}
                    </div>
                    <div class="large-12 small-12 columns">
                        {{ Form::textarea('message', '', array('placeholder'=>'Message', 'rows'=>'10', 'cols'=>'15')) }}
                    </div>
                </div>
                {{ Form::Submit('Send Message', array('class'=>'submitBtn float-right sndmsg')) }}
                {{ Form::close() }}
			</div>
		</div>
		<div class="columns large-2 medium-6 small-6">
			<div class="bg-diff">
				<h1 class="subtitle-green">SITE MAP</h1>
				<a class="top10" href="{{ action('PrimaryController@about') }}">About Reps</a>
				<a href="{{ action('PrimaryController@meetTheTeam') }}">Meet The Team</a>
				<a href="{{ action('PrimaryController@partners')}}">Partners</a>
				<a href="{{ action('PrimaryController@globalRegisters') }}">Global Partners</a>
				<a href="{{ action('PrimaryController@privacyPolicy') }}">Privacy Policy</a>
				<a href="{{ action('TrainerController@dashboard') }}">Application Policies</a>
				
				<a href="{{ action('PrimaryController@termsConditions') }}">Terms &amp; Condiitons</a>

			</div>
			
		</div>
		<div class="columns large-2 medium-6 small-6">
			<h1 class="subtitle-green">FOLLOW US</h1>
			<div class="follow-reps clearfix">
				 <a class="fb-link" href="https://www.facebook.com/REPSUAE/" target="_blank"><i class="fa fa-facebook-official"></i></a>
				 <a class="insta-link" href="https://www.instagram.com/repsuae/" target="_blank"><i class="fa fa-instagram"></i></a>
				 {{-- <a class="tw-link" href="https://twitter.com/repsuae" target="_blank"><i class="fa fa-twitter-square"></i></a> --}}
			</div>
			<div class="block-image">
				<img src="{{Request::root()}}/img/dsc.png" />
			</div>
			<div class="block-image">
				<img src="{{Request::root()}}/img/sarjah.png" />
			</div>
			<div class="block-image payment-methods">
				<img src="https://sassme.ecwid.com/static/v1/icons/mastercard.svg" />
				<img src="https://sassme.ecwid.com/static/v1/icons/visa.svg" />
			</div>
<style>
.payment-methods {
	max-width: 152px;
}
	.payment-methods img {
		width: 70px;
margin: 1px;
float: left;
	background: #fff;
	}
</style>
			
		</div>
	</div>
</div>
<div class="rights-reserve">
	<p><a href="http://craniumcreations.com" target="_blank">Dubai Development Company. </a>All Rights Reserved. REPS UAE</p>
</div>
<script type="text/javascript">
		var dif=$('.new-footer').height();
		$(document).ready(function(){
			$('.bg-diff').css('height', dif+'px');
		});


</script>
