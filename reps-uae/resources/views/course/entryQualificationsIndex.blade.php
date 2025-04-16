@extends('layouts.primary')

@section('content')
@include('include.subNav')
<style>
    .entry-qualification .custom-accordion {
        border: 0;
        margin-bottom: 0;
    }

    span.bg-cont {
        width: 100%;
        background-position: center;
        height: 400px;
        background-size: cover;
        opacity: .1;
        position: absolute;
        top: 50px;
    }
    .custom-accordion .body-accordion a:hover {
        text-decoration: underline;
    }
    .custom-accordion .body-accordion a h5 {
        color: #32a543;
    }
</style>
<div class="row">

    <div class="columns large-12 medium-12 small-12">
        <div class="title-div">
            <h4>Training Courses</h4>
            <p>Quality education and training for the UAE fitness industry<a class="activeMe right" href="">Training</a><i class="right fa fa-angle-right"></i> <a class="right" href="/">Home</a></p>
        </div>
    </div>
</div>
<!--    <div class="row top20 bottom20">
        <div class="columns large-12 small-12">
            <p>
                REPs UAE works with a network of quality Training Providers whose courses have been approved against international standards. 
                Here you can find all of the courses which give entry to REPs UAE, add an extra category to your profile and/or award you CPD points.
            </p>
        </div>
    </div>-->

<div class="row training-tags">
    <div class="columns large-3 medium-6 small-12">
        <a class="active" href="{{Request::root()}}/training/entry-qualifications">Entry Qualifications</a>
    </div>
    <div class="columns large-4 medium-6 small-12 left">
        <a href="{{Request::root()}}/training/cpd-providers">Continuing Professional Development (CPD) </a>
    </div>
</div> 

<div class="row top20 bottom20">
    <div class="columns large-12 small-12 c-desc">
        <p>REPs UAE works with a network of quality Training Providers whose courses have been approved against
            international standards.</p>
        <p>Completing one (or more for multiple registration levels) of these qualifications offered by the Providers listed below, means an individual is eligible to register with REPs UAE.</p>
        <h6>Which qualification should I choose?</h6>
        <p>REPs UAE does not recommend one qualification provider over another. We do however suggest that before you make your decision, to do your own due diligence! Ask questions and ask around. Some suggestions are:</p>
        <ol>
            <li>Contacting the qualification provider directly to find out more about their qualification. This could include information on how they deliver their qualification, how they support their students, or how they undertake their assessments and exams.</li>
            <li>Talking to other students and graduates of the qualification. Ask the qualification provider for student references. Check out the qualification providers website and social media page.</li>
            <li>Do an online/Google search to find out more about the qualification provider<br>
                Please note: REPs is unable to provide any assurances as to the on-going financial viability of any qualification provider, so it is important that you do your own checks. 
            </li>
        </ol>
        <h6>Other important information about qualification recognition. </h6>
        <ol>
            <li> If your qualification was completed more than 10 years ago, evidence of working in the industry and proof of continued education will be required for verification purposes. Please apply for REPs registration in the normal way, and we will let you know if there are any further steps required.</li>
            <li>REPs UAE do not accept purely online qualifications, depending on which online qualification was completed, either an up-skill, or full course with one of the Providers listed below would be required.</li>

        </ol>
        <h6>Pre-approved Training Providers</h6>
        <ol>
            Training Providers which have been marked as pre-approved have been in operation in the UAE for less than one year, however they have met all of the criteria for approval by REPs UAE, including having all of their qualifications accredited by a recognised International Awarding Organisation. They are listed as pre-approved for a period of one year before they are listed alongside other approved and established providers. Accredited REPS entry qualifications from pre-approved providers have the same status as more established providers-their qualifications will give entry and full status on REPs UAE without any restriction. All graduates from pre-approved providers should apply and join REPs as normal.
        </ol>
    </div>
</div> 

<div class="row bottom30 entry-qualification">
    <div class="columns large-12 cat-box">
        <?php
        $tmp_cat = 0;

        //echo '<pre>'. print_r($qualifications,true).'</pre>';
        ?>

        <div class="border-cstm">
            <div  class="trainer-cat">PERSONAL TRAINER / GYM INSTRUCTOR / GROUP FITNESS INSTRUCTOR COURSES</div>
            <!--<div  class="trainer-cat">YOGA / PILATES COURSES</div>-->
            <div class="custom-accordion">
                <?php // echo '<pre>'; print_r($qualificats['main_catgeory']);?>
                <div class="body-accordion" data-body="" style="display: block;">
                    <?php
                    $qualiKey = '';
                    foreach ($qualifications_one as $qualific_key => $qualific) {
                        if (count($qualific['course_data']) > 0) {
                            ?>
                            <div class="row"> 
                                <div class="columns medium-12 small-12 topneg">
                                    <div class="row course-provider approved-provider">
                                        <div class="columns"> <h5><?php echo $qualific['category_level']['level']; ?></h5></div>
                                        <div class="columns"> 
                                            <a target="_blank" href="#" class=""></a>
                                        </div>
                                    </div>
                                    <div class="row course-provider">
                                        <div class="columns large-6"> <h7>Course Title</h7></div>
                                        <div class="columns large-3"> <h7>Training Provider</h7></div>
                                        <div class="columns large-3"> <h7>Awarding/ accrediting body</h7></div>
                                    </div>
                                    <!--                            <div class="row cat-type">
                                                                    <div class="columns"> <h6>Type</h6></div>
                                                                    <div class="columns"><h6>REPs Category</h6></div>
                                                                </div>-->
                                    <?php
                                    foreach ($qualific['course_data'] as $quali) {
                                        if ($quali['pre_approved'] == 0) {
                                            ?>
                                            <div class="row">
                                                <div class="columns large-6">
                                                    <h5 style="border-bottom: none;"><?php echo $quali['cource_name']; ?></h5>
                                                </div>
                                                <div class="columns large-3">
                                                    <?php
                                                    $parsed = parse_url($quali['website']);
                                                    if (empty($parsed['scheme'])) {
                                                        $quali['website'] = 'https://' . ltrim($quali['website'], '/');
                                                    }                                                    
                                                    ?>
                                                    <a target="_blank" href="<?php echo $quali['website']; ?>"><h5><?php echo $quali['name']; ?></h5></a>
                                                </div> 
                                                <div class="columns large-3 text-right">
                                                    <h5 style="border-bottom: none;"><?php echo $quali['awardingorganization']; ?></h5>
                                                </div> 
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    foreach ($qualific['course_data'] as $course_key => $quali) {
                                        if ($quali['pre_approved'] == 1) {
                                            if ($qualiKey != $qualific_key) {
                                                $qualiKey = $qualific_key;
                                                ?>
                                                <div class="row course-provider">
                                                    <div class="columns"> <h5>Pre-approved Training Providers</h5></div>
                                                    <div class="columns"> 
                                                        <a target="_blank" href="//courseProviderWebsite" class=""></a>
                                                    </div>
                                                </div>
                <?php } ?>
                                            <div class="row">
                                                <div class="columns large-6">
                                                    <h5 style="border-bottom: none;"><?php echo $quali['cource_name']; ?></h5>
                                                </div>
                                                <div class="columns large-3">
                                                <?php
                                                    $parsed = parse_url($quali['website']);
                                                    if (empty($parsed['scheme'])) {
                                                        $quali['website'] = 'https://' . ltrim($quali['website'], '/');
                                                    }                                                    
                                                ?>
                                                    <a target="_blank" href="<?php echo $quali['website']; ?>"><h5><?php echo $quali['name']; ?></h5></a>
                                                </div> 
                                                <div class="columns large-3 text-right">
                                                    <h5 style="border-bottom: none;"><?php echo $quali['awardingorganization']; ?></h5>
                                                </div> 
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
    <?php }
} ?>
                </div>
            </div>

            <div  class="trainer-cat">YOGA / PILATES COURSES</div>
            <div class="custom-accordion">
                <div class="body-accordion" data-body="" style="display: block;">
                    <?php
                    $qualiKeytwo = '';
                    foreach ($qualifications_two as $qualifictwo_key => $qualific) {
                        if (count($qualific['course_data']) > 0) {
                            ?>
                            <div class="row"> 
                                <div class="columns medium-12 small-12 topneg">
                                    <div class="row course-provider approved-provider">
                                        <div class="columns"> <h5><?php echo $qualific['category_level']['level']; ?></h5></div>
                                        <div class="columns"> 
                                            <a target="_blank" href="//courseProviderWebsite" class=""></a>
                                        </div>
                                    </div>
                                    <div class="row course-provider">
                                        <div class="columns large-6"> <h7>Course Title</h7></div>
                                        <div class="columns large-3"> <h7>Training Provider</h7></div>
                                        <div class="columns large-3"> <h7>Awarding/ accrediting body</h7></div>
                                    </div>
                                    <!--                            <div class="row cat-type">
                                                                    <div class="columns"> <h6>Type</h6></div>
                                                                    <div class="columns"><h6>REPs Category</h6></div>
                                                                </div>-->
                                    <?php
                                    foreach ($qualific['course_data'] as $quali) {
                                        if ($quali['pre_approved'] == 0) {
                                            ?>
                                            <div class="row">
                                                <div class="columns large-6">
                                                    <h5 style="border-bottom: none;"><?php echo $quali['cource_name']; ?></h5>
                                                </div>

                                                <div class="columns large-3">
                                                <?php
                                                    $parsed = parse_url($quali['website']);
                                                    if (empty($parsed['scheme'])) {
                                                        $quali['website'] = 'https://' . ltrim($quali['website'], '/');
                                                    }                                                    
                                                    ?>
                                                    <a target="_blank" href="<?php echo $quali['website']; ?>"><h5><?php echo $quali['name']; ?></h5></a>
                                                </div> 

                                                <div class="columns large-3 text-right">

                                                    <h5 style="border-bottom: none;"><?php echo $quali['awardingorganization']; ?></h5>
                                                </div> 
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    foreach ($qualific['course_data'] as $quali) {
                                        if ($quali['pre_approved'] == 1) {
                                            if ($qualiKeytwo != $qualifictwo_key) {
                                                $qualiKeytwo = $qualifictwo_key;
                                                ?>
                                                <div class="row course-provider">
                                                    <div class="columns"> <h5>Pre-approved Training Providers</h5></div>
                                                    <div class="columns"> 
                                                        <a target="_blank" href="//courseProviderWebsite" class=""></a>
                                                    </div>
                                                </div>
                <?php } ?>
                                            <div class="row">
                                                <div class="columns large-6">
                                                    <h5 style="border-bottom: none;"><?php echo $quali['cource_name']; ?></h5>
                                                </div>
                                                <div class="columns large-3">
                                                    <a target="_blank" href="<?php echo $quali['website']; ?>"><h5><?php echo $quali['name']; ?></h5></a>
                                                </div> 
                                                <div class="columns large-3 text-right">
                                                    <h5 style="border-bottom: none;"><?php echo $quali['awardingorganization']; ?></h5>
                                                </div> 
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
    <?php }
} ?>
                </div>
            </div>
        </div>

    </div>
</div>





@if (isset($showme))
<div class="row backbtn">
    <a href="{{ action('CourseController@approvedTraining') }}">Back</a>
</div>
@endif




@stop

<!-- Adding the fancy box for the images -->
@section('customScripts')
$(document).ready(function() {
$('.ui-accordion-header-icon').appen
});

$(function() {
$( "#accordion" ).accordion({
heightStyle: "fill"
});
});

$('.header-accordion').on('click',function(){
var num = $(this).data('head');
if($('.body-accordion[data-body='+num+']').hasClass('open')){
$('.body-accordion[data-body='+num+']').slideUp("fast").removeClass('open');
$('.header-accordion[data-head='+num+']').removeClass('activer');
}
else{

$('.body-accordion[data-body='+num+']').slideDown().addClass('open');
$('.header-accordion[data-head='+num+']').addClass('activer');
}

});




@stop