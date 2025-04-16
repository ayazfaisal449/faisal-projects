@extends('layouts.primary')

@section('content')
@include('include.subNav')
    <div class="row">
         <div class="columns large-12 medium-12 small-12">
             <div class="title-div">
                 <h4>Training Courses</h4>
                 <p>Quality education and training for the UAE fitness industry<a class="activeMe right" href="">Training</a><i class="right fa fa-angle-right"></i> <a class="right" href="/">Home</a></p>
             </div>
        </div>
    </div>
    <div class="row top20 bottom20">
        <div class="columns large-12 small-12">
            <p>
                <b>
                    REPs works with a network of quality training providers who have been 
                    approved against international standards. </br>
                </b>
                 Here you can find all the courses recognised by REPs UAE to give entry to REPs, add an extra 
                 category to your profile or gain CPD points.
            </p>
        </div>
    </div>

    <div class="row training-tags">
        <div class="columns large-3 medium-6 small-12">
            <a class="active" href="{{Request::root()}}/training/entry-qualifications">Entry Qualifications</a>
        </div>
         <div class="columns large-4 medium-6 small-12 left">
            <a href="{{Request::root()}}/training/cpd-providers">Continuing Professional Development</a>
        </div>
    </div>   
   
    
    <div class="approvedTrainingCourses">
        <div class="row">
            <div class="large-4 columns">
                <a href="{{Request::root()}}/training/entry-qualifications">Entry Qualifications</a>
            </div>
            <div class="large-8 columns">
                <p>
                    Qualifications which are recognised by REPs UAE have been accredited 
                    by an international awarding body to ensure quality and standards.  
                    Click here to see a list of approved training providers and the qualifications 
                    they offer which give entry to REPs or can add an extra
                    category to your profile.
                </p>
            </div>
        </div>
    </div>
    
    <div class="approvedTrainingCourses">
        <div class="row">
            <div class="large-4 columns">
                <a href="{{Request::root()}}/training/cpd-providers">Continuing Professional Development</a>
            </div>
            <div class="large-8 columns">
                <p>
                    Continuing Professional Development, known as CPD, is vital 
                    for every exercise professional to further develop their knowledge and skills.  
                    REPs members have to gain 10 “CPD Points” every year.  Click here to 
                    see the approved training providers and then click through to see 
                    their lists of courses and other activities recognised for REPs UAE CPD Points.
                </p>
            </div>
        </div>
    </div>
    
    <div class="swril cpdProviders">
    </div>

    <div class="greenWrapperFooter">
        <div class="row">
            <div class="large-2 columns">
                <a class="btn" href="https://fitawardsme.com/" target="_blank">FIT Awards</a>
            </div>
            <div class="large-2 columns">
                <a href="{{ URL::to('latest-industry-news') }}" class="btn">Latest Industry News</a>
            </div>
            <div class="large-2 columns">
                <a href="{{ URL::action('GalleryController@galleries') }}" class="btn">Gallery</a>
            </div>
            <div class="large-2 columns end">
                <a href="{{ URL::action('PrimaryController@marketingResources') }}" class="btn">Marketing Resources</a>
            </div>
        </div>
    </div>
    
@stop

<!-- Adding the fancy box for the images -->
@section('customScripts')
    $(document).ready(function() {
    });
@stop