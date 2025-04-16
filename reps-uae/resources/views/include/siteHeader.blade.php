<header class="normal siteHeader">
    <div class="broad-border-black row">
        <div class="large-3 medium-3 small-2 columns">
            <a class="logo" href="{{Request::root()}}"><img alt="logo alqasba" src="{{Request::root()}}//img/logo.png" /></a>
        </div>
        <div class="large-6 medium-6 small-6 columns">
            <div class="socialMedia">
                <ul>
                    <li>
                        <img src="{{Request::root()}}/img/fb-icon.png" alt="Facebook Share" />
                        <span style="cursor:pointer;" onclick="window.open('https://www.facebook.com/REPSUAE')" title="Connect with us on Facebook" alt="Connect with us on Facebook">Connect with us on Facebook</span>
                    </li>
                    <li>
                        <a href="{{ URL::action('PrimaryController@arabic') }}" class="">Arabic Website</a>
                    </li>
                    <li>
                        <img src="{{Request::root()}}/img/sign-icon.png" alt="Facebook Share" />
                            @if( !Sentry:: getUser() && !Sentry::check() )
                                <a href="{{ action('TrainerController@logIn') }}">Sign In</a>
                            @else
                                <a href="{{ action('TrainerController@dashboard') }}">My Dashboard</a>
                            @endif
                    </li>
                </ul>
            </div>
        </div>
        <div class="large-2 medium-2 small-2 large-offset1 columns">
            
                <img src="{{Request::root()}}/img/dubai-sports.png">
            
        </div>
    </div>
</header>

<nav class="normal">
    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <a class="nav-btn-green" href="{{ action('TrainerController@registerInfo') }}">
                <img src="{{Request::root()}}/img/reg.png" alt="Register With Reps" title="Register With Reps" />
                <span>Register With REPs</span>
            </a>
            <a class="nav-btn-red" href="{{ action('TrainerController@renewRegistration') }}">
                <img src="{{Request::root()}}/img/renew.png" alt="Renew Registration" title="Renew Registration" />
                <span>Renew Registration</span>
            </a>
            <a class="nav-btn-green" href="{{ action('TrainerController@trainerSearchUserIndex') }}">
                <img src="{{Request::root()}}/img/trainer.png" alt="Register With Reps" title="Search Trainer"/>
                <span>Search Trainer</span>
            </a>
            <a class="nav-btn-red" href="{{ action('CourseController@approvedTraining') }}">
                <img src="{{Request::root()}}/img/approved.png" alt="Register With Reps" title="Approved Training"/>
                <span>Approved Training</span>
            </a>
            <a class="nav-btn-green" href="{{ action('PrimaryController@employer') }}">
                <img src="{{Request::root()}}/img/employers.png" alt="Register With Reps" title="Employers"/>
                <span>Employers</span>
            </a>
        </div>
    </div>
</nav>

<header class="mobile">

    <div class="row">
    
        <div class="medium-12 small-12 columns">
            <a href="#" class="left-nav">
                <img src="{{Request::root()}}/img/nav.png" alt="Navigation" />
            </a>
            <ul class="mobileNav">
                @if(!Sentry:: getUser() && !Sentry::check())
                    <li><a href="{{ action('TrainerController@logIn') }}">Sign In</a></li>
                    <li><a href="{{ action('TrainerController@registerInfo') }}">Register With Reps</a></li>
                @else
                    <li><a href="{{ action('TrainerController@dashboard') }}">My Dashboard</a></li>
                    <li><a href="{{ action('TrainerController@renewRegistration') }}">Renew Registration</a></li>
                @endif
                <li><a href="{{ action('TrainerController@trainerSearchUserIndex') }}">Search Your Trainer</a></li>
                <li><a href="{{ action('CourseController@approvedTraining') }}">Approved Training</a></li>
                <li><a href="{{ action('PrimaryController@employer') }}">Employer</a></li>
                <li><a href="{{ action('PrimaryController@ethics') }}">Code of Ethics</a></li>
                <li><a href="{{ action('PrimaryController@standard') }}">Standards</a></li>
                <li><a href="{{ action('PrimaryController@benefits') }}">Benefits</a></li>
                <li><a href="{{ action('PrimaryController@onlineMarketing') }}">Online Marketing</a></li>
                <li><a href="{{ action('PrimaryController@insurance') }}">Insurance</a></li>
                <li><a href="{{ action('PrimaryController@marketingResources') }}">Marketing Resources</a></li>
                <li><a href="#" class="btnComingSoon">Application Policies</a></li>
                <li><a href="https://fitawardsme.com/" target="_blank">FIT Awards</a></li>
                <li><a href="{{ action('PrimaryController@about') }}">About Reps</a></li>
                <li><a href="{{ action('PrimaryController@meetTheTeam') }}">Meet the Team</a></li>
                <li><a href="{{ action('PrimaryController@globalRegisters') }}" >Global Registers</a></li>
                <li><a href="{{ action('PrimaryController@faqs') }}" >FAQ</a></li>
            </ul>
            
            <div class="logo">
                <a href="{{Request::root()}}">
                    <img alt="logo" src="{{Request::root()}}//img/logo.png" />
                </a>
            </div>
        </div>
        
    </div>

</header>
