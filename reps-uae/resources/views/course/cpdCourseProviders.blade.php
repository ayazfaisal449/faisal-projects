@extends('layouts.primary')

@section('content')
    @include('include.subNav')
   <div class="row">
         <div class="columns large-12 medium-12 small-12">
             <div class="title-div">
                 <h4>Training Courses</h4>
                 <p>Quality education and training for the UAE fitness industry<a href="" class="right activeMe"> Continuing Professional Development</a><i class="right fa fa-angle-right"></i><a class=" right" href="">Training</a><i class="right fa fa-angle-right"></i> <a class="right" href="/">Home</a></p>
             </div>
        </div>
    </div>
    <div class="row top20 bottom20">
        <div class="columns large-12 small-12">
            {{-- <p>
                CPD is a way for exercise professionals to demonstrate that they continue to learn and develop throughout their careers, to keep their skills and knowledge up to date and are able to work safely, legally and effectively.   </br>
                As a Registered Exercise Professional, you are required to obtain 10 Continuing Professional Development points (CPD) every year.
    
                <b><br />
                You can view and select REPs approved CPD courses under the relevant category below.
                 </b>
            </p> --}}
            <p>CPD is a way for exercise professionals to demonstrate that they continue to learn and develop throughout their careers, to keep their skills and knowledge up to date and are able to work safely, legally and effectively.</p>


            <p>As a Registered Exercise Professional, you are required to obtain 20 Continuing Professional Development points (CPD) every  two years. If more than 20 points have been achieved in two years, 6 of the points can be rolled over into the next two year period.</p>
             

            <p>Those who have just completed an entry level qualification will not have to complete any on-going education for 2 years.</p>


            <p><b>You can view and select REPs approved CPD courses under the relevant category below.</b></p>
        </div>
    </div>

    <div class="row training-tags">
        <div class="columns large-3 medium-6 small-12">
            <a href="{{Request::root()}}/training/entry-qualifications">Entry Qualifications</a>
        </div>
         <div class="columns large-4 medium-6 small-12 left">
            <a class="active" href="{{Request::root()}}/training/cpd-providers">Continuing Professional Development (CPD)</a>
        </div>
    </div> 

    
    <div class="row top20">
        <div class="columns large-12 medium-12 small-12">
            <p class='bold-p'>Select from our categories below</p>
        </div>
    </div>

    <div class="row categories">
        <div class="columns large-3 medium-6 small-12">
            <a href="{{Request::root()}}/training/cpd-providers/1" >
                <img src="{{Request::root()}}/img/1.jpg">
                <h3>Exercise Science</h3>
            </a>
        </div>
        <div class="columns large-3 medium-6 small-12">
            <a href="{{Request::root()}}/training/cpd-providers/2" >
                <img src="{{Request::root()}}/img/2.jpg">
                <h3>Group Fitness</h3>
            </a>    
        </div>
        <div class="columns large-3 medium-6 small-12">
            <a href="{{Request::root()}}/training/cpd-providers/3" >
                <img src="{{Request::root()}}/img/3.jpg">
                <h3>Nutrition</h3>
            </a>
        </div>
        <div class="columns large-3 medium-6 small-12">
            <a href="{{Request::root()}}/training/cpd-providers/4" >
                <img src="{{Request::root()}}/img/4.jpg">
                <h3>Mind &amp; Body</h3>
            <a href="" >
        </div>
    </div>

    <div class="row categories">
        <div class="columns large-3 medium-6 small-12">
            <a href="{{Request::root()}}/training/cpd-providers/5" >
                 <img src="{{Request::root()}}/img/5.jpg">
                  <h3>Rehab &amp; Special Populations</h3>
            </a>
        </div>
        <div class="columns large-3 medium-6 small-12">
            <a href="{{Request::root()}}/training/cpd-providers/6" >
                 <img src="{{Request::root()}}/img/6.jpg">
                 <h3>Workshops, Seminars &amp; Others</h3>
             </a>
        </div>
        <div class="columns large-3 medium-6 small-12 left">
            <a href="{{Request::root()}}/training/cpd-providers/7" >
               <img src="{{Request::root()}}/img/7.jpg">
                <h3>Online</h3>
             </a>   
        </div>

        <div class="columns large-3 medium-6 small-12 left">
            <a href="{{Request::root()}}/training/cpd-providers/8" >
               <img src="{{Request::root()}}/img/8.png">
                <h3>Equipment Based</h3>
             </a>   
        </div>
        
        
    </div>


    @if (isset($showme))
    <div class="row backbtn">
        <a href="{{ action('CourseController@approvedTraining') }}">Back</a>
    </div>
    @endif
    {{--
    <?php $counter = 1; ?>
    <div class="cpdProviders">
        <div class="row">
            <ul class="small-block-grid-2 medium-block-grid-4 large-block-grid-6 cpdList">
                @foreach($cpdCourseProviders as $provider)
                    <li>
                         <a href="{{Request::root()}}/training/cpd-providers/{{$provider['id']}}">
                            <img style="max-width: 180px;" src="{{Request::root()}}/images/courseProvider/{{$provider['id']}}/{{$provider['logo']}}" >
                        </a>
                    </li>
                    <?php $counter++; ?>
                @endforeach
            </ul>
        </div>
    </div>
    
    @include('include.subFooter')--}}

@stop

<!-- Adding the fancy box for the images -->
@section('customScripts')
	$(document).ready(function() {
		
	});
@stop
