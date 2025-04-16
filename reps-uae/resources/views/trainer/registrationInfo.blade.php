@extends('layouts.primary')
@section('content')
<span class="bg-cont"></span>
@include('include.subNav')
<div class="pageTitle">
    <div class="row">
        <div class="large-12 columns">
            @if($errors->any())
            <h4 style="color:red">{{$errors->first()}}</h4>
            @endif
            <h1>Registration</h1>
            <p>
                Please read the following page before starting registration.
                You may wish to read the <a href="{{Request::root()}}/application-policies">Application Policies</a> to
                see how
                REPs UAE assess fitness education certificates.
            </p>
        </div>
    </div>
</div>
<div class="row">
    <div class="columns large-12 medium-12 small-12">
        <div class="corner-fix">
            <h1 class="info-important"><i class="fa fa-info-circle"></i> IMPORTANT – PLEASE READ THIS BEFORE YOU START!
            </h1>
            <p class="red-me">
                To successfully complete your application, you MUST HAVE the following before you start. Any missing
                parts will delay the processing of your application.
            </p>
            <h3 class="top20 title-reg">
                <i class="fa fa-check"></i>Fitness Education Certificate
            </h3>
            <p class="rep_uae_m_l">
                Entry level and most relevant certificate & degree transcript (if applicable) to be submitted.
            </p>
            <p class="rep_uae_m_l">
                By submitting your application, you affirm that any discovery of fake or fraudulent fitness education
                certificates will result in the denial of your registration
                with REPs UAE. Additionally, your registration fee will not be subject to refund, and you will be
                permanently ineligible for future membership with REPs UAE.
                Furthermore, your details will be forwarded to the relevant government authorities for their awareness
                and appropriate action.
            </p>

            <h3 class="top20 title-reg">
                <i class="fa fa-check"></i>Your Current Fitness Industry Specific CV
            </h3>
            <p class="rep_uae_m_l">
                This will help with the application process.
            </p>
            <h3 class="top20 title-reg">
                <i class="fa fa-check"></i>First Aid / CPR Certificate
            </h3>
            <p class="rep_uae_m_l">
                Up to date First Aid/CPR Certificate is required.
            </p>
            <h3 class="top20 title-reg">
                <i class="fa fa-check"></i>Passport Size Photo
            </h3>
            <p class="rep_uae_m_l">
                Required for ID Card.
            </p>
            <h3 class="top20 title-reg">
                <i class="fa fa-check"></i>
                Payment- Gym Instructor, Personal Trainer, Pilates and Yoga Instructor- AED450 per year. <br>
                <h3 class="h31" style="max-width: 78%;margin: 0 auto;">Group Fitness and Aqua Instructor -
                    AED400 per year.</h3>

            </h3>
            <p class="rep_uae_m_l">
                Before REPs can complete your application, payment must be made. (cash or debit/credit card)
            </p>
            <h3 class="top20 title-reg">
                Registration Period:
            </h3>
            <p>
                Registration period is for 12 months and expires on the last day of the month.
            </p>
        </div>
    </div>
</div>
<div class="cat_list">
    <h3 style="text-align: center;">Categories</h3>
    <br>
    <ul>
        <?php
            foreach ($registrationCategories as $value) {
                echo '<li>'.$value->level .'</li>';
            }
        ?>
    </ul>
</div>
<div class="row top30 bottom30">
    <div class="small-12 columns">
        <div id="registerInfoDownload">
            <p><a href="{{Request::root()}}/download/2024_Registration_Form.pdf">Download</a> (REPs UAE - Registration
                Form)
            </p>
        </div>
        <a href="{{ action('TrainerController@trainerPersonalDetailsForm') }}" id="registerInfoContinue" class="btn">
            Register Now
        </a>
        
        {{-- 
            <a href="" id="registerInfoContinue" class="btn">Register Now</a>
            <script>
                $('.btn').on('click', function(event) {
                    event.preventDefault();
                    alert('Registration is under maintenance');
                });
            </script>
             --}}
    </div>
</div>
<section class="ruc-toggles">
    <div class="cat-container">
        <div class="row">
            <div class="ruct-heading">
                <h2>REPs UAE Categories</h2>
                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Porttitor urna, et ultricies mi laoreet. </p> -->
                <div class="rux-tgl">
                    <?php
                foreach ($registrationCategories as $value) {?>
                    <div class="tb-toggle toggle-fancy">
                        <button class="trigger">
                            <span>+</span><?php echo $value->level;?></button>
                        <div class="box">
                            <?php echo $value->description;?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
</section>
<div class="clearfix"></div>
<br />
<br />
@include('include.subFooter')
<script type="text/javascript" src="{{Request::root()}}/js/custom.js"></script>
@stop