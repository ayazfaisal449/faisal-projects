<div class="new-header ">
	<div class="row">
		<div class="columns large-12 medium-12 small-12">
			<a class="logo" href="{{Request::root()}}"><img alt="" src="{{Request::root()}}/img/logo.png" /></a>


<ul class="nav-header clearfix">
    <li>
        <a class="single-liner" href="{{ action('TrainerController@registerInfo') }}">Register<i class="fa fa-angle-double-down"></i></a>
    </li>
    <li>
        <a class="single-liner" href="{{ action('TrainerController@logIn') }}">Renew<i class="fa fa-angle-double-down"></i></a>
    </li>
    <li>
        <a href="{{ action('TrainerController@trainerSearchUserIndex') }}">Find Trainer<i class="fa fa-angle-double-down"></i></a>
    </li>
    <li class="adrp"> 
        <div class="dropdown"><a class="dropbtn">Get Qualified</a>
            <div class="dropdown-content" style="margin-top: -12px;">
                <a href="{{ action('CourseController@entryQualifications') }}">Entry Qualifications</a>
                <a href="{{Request::root()}}/training/cpd-providers">CPD Courses</a>
            </div>							  
        </div>
    </li>
    <li>  
        <a class="single-liner" href="{{ action('PrimaryController@survey') }}">Survey<i class="fa fa-angle-double-down"></i></a>
    </li>
    <li>  
        <a class="single-liner" href="/gallery">Gallery<i class="fa fa-angle-double-down"></i></a>
    </li>
	<li>  
		<a class="single-liner" href="/jobs">Jobs<i class="fa fa-angle-double-down"></i></a>
	</li>
    <!--<li>  
        <a href="{{ action('PrimaryController@employer') }}">CPR Course<i class="fa fa-angle-double-down"></i></a>
    </li> -->
	</ul>


			<div class="right-nav">
				<a class="arabic-text" href="{{ URL::action('PrimaryController@arabic') }}"><img alt="U.A.E Flag"src="{{Request::root()}}/images/flag.png"> Arabic</a>
				@if( !Sentry:: getUser() && !Sentry::check() )
						<a class="sign-text" href="{{ action('TrainerController@logIn') }}">Log In</a>
				@else
						<a class="sign-text" href="{{ action('TrainerController@dashboard') }}">Account</a>
        @endif
				
				<a style="cursor:pointer;" onclick="window.open('https://www.facebook.com/REPSUAE')"  class="fb-text" href=""><i class="fa fa-facebook"></i></a>
				<a style="cursor:pointer;" onclick="window.open('https://www.instagram.com/repsuae/')"  class="fb-text" href=""><i class="fa fa-instagram"></i></a>
				{{-- <a style="cursor:pointer;" onclick="window.open('https://twitter.com/repsuae')"  class="fb-text" href=""><i class="fa fa-twitter"></i></a> --}}

			</div>
<section class="buttonset">
            <div id="nav_list">Menu</div>
        </section>
			
		</div>
	</div>
</div>