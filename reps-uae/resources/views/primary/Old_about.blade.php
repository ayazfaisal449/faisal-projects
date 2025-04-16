@extends('layouts.primary')

@section('content')
    
 
    
    <div class="row">
         <div class="columns large-12 medium-12 small-12">
             <div class="title-div">
                 <h4>About Reps</h4>
                 <p><a class="activeMe right" href="">About</a><i class="right fa fa-angle-right"></i> <a class="right" href="{{Request::root()}}">Home</a></p>
             </div>
            <div class="row ">
                 <div class="columns large-12 medium-12 small-12">
                    <img class="bottom20" src="{{Request::root()}}/img/bannertwo.png">
                 </div>
            </div>
        </div>
    </div> 

    <div class="row">
        <div class="small-12 columns">
            <p>
                Launched in 2013, REPs is an independent, public register which recognises 
                the qualifications and expertise of fitness professionals in the UAE. REPs 
                provides a system of regulation for instructors and trainers to ensure that
                they meet the health and fitness industry’s agreed UAE Fitness Occupational
                Standards.  
            </p>
            <p>
                REPs serves to protect people who take part in exercise and physical activity
                and provides assurance and confidence to the public and employers that all 
                professionals on the Register are appropriately qualified and have the knowledge, 
                competence and skills to perform their role effectively.
            </p>
            <p>
                REPs covers all the main disciplines in fitness including group fitness, personal 
                training, Pilates and Yoga and works with a wide range of employers, training 
                providers and public bodies who support it’s mission. 
            </p>
            <p>
                The register was initiated and established by Dubai Sports Council and is part of 
                a global network of fitness registers now operating around the world.  REPs UAE 
                is a member of ICREPs the global confederation for fitness registers.
            <p>
            <div class="row ">
                 <div class="columns large-3 medium-3 small-12">
                 <a href="http://www.icreps.org/" target="_blank">
                     <img class="bottom20" src="{{Request::root()}}/img/icreps.jpg">
                 </a>
                    
                 </div>
            </div>
             <div id="aboutDownloads" class="clearfix">
                @if (isset($showme))
                <p class="greenDownload aboutDownload">
                    {{ HTML::linkAction('PrimaryController@index','Download',array(),array()) }} (REPs UAE - Leaflets)
                <p class="greenDownload aboutDownload">
                    {{ HTML::linkAction('PrimaryController@index','Download',array(),array()) }} (Technical Manual)
                </p> 
                @endif
                <p class="greenDownload aboutDownload">
                    <a href="{{Request::root()}}/download/REPs_UAE_Technical_Manual_2014.pdf">Download</a> (Technical Manual)
                </p> 
             </div>
             <p id="workWith">
                <b>
                    REPs UAE will work collectively with the fitness industry in
                    the United Arab Emirates to achieve a shared vision for the sector including:
                </b>
             </p>
             <ul id="aboutList" class="clearfix">
                 <li>Raise standards and professionalism in the industry.</li>
                 <li>Play a roll in combating obesity and other diseases.</li>
                 <li>Recognition of the sector.</li>
                 <li>Gain trust and respect of health professions.</li>
                 <li>Grow the industry (business performance, member retention, training sector).</li>
                 <li>Clarity for employers, public, Government, media.</li>
                 <li>Promote physical activity and fitness from an early age.</li>
                 <li>Leader in global fitness industry.</li>
             </ul>
             <div id="aboutEnd">
                 <p>
                    Ensuring the qualifications and competence of the fitness instructors in the industry 
                    will protect the public and contribute to the safety and securitiy of 
                    the country's citizens - as well as promoting their health and well being.
                 </p>
                 <p>
                    REPs UAE has established a system of standards, qualifications and training 
                    that is truly world class and meets international standards from around the globe.
                 </p>
                 <p>
                    REPs UAE will increase the trust, confidence and credibility of the fitness industry 
                    and will ensure fitness services are offered in a high quality, healthy, safe and ethical environment.
                 </p>
             </div>
        </div>
    </div>

    
@stop

@section('customScripts')
@stop
