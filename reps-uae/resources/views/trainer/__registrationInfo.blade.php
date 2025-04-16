@extends('layouts.primary')


@section('content')
<span class="bg-cont"></span>
<style>
    a.btn {
    padding: 12px 0;
    }
</style>
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
                        You may wish to read the <a href="{{Request::root()}}/application-policies">Application Policies</a> to see how 
                        REPs UAE assess fitness education certificates.
                    </p>
               
            </div>
            
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

        <div class="row">
        <div class="columns large-12 medium-12 small-12">
             <div class="corner-fix">
                <h1 class="info-important"><i class="fa fa-info-circle"></i> IMPORTANT – PLEASE READ THIS BEFORE YOU START!</h1>
                <p class="red-me">
                    To successfully complete your application, you MUST HAVE the following before  you start. Any missing parts will delay the processing of your application.
                </p>
                <h3 class="top20 title-reg">
                    <i class="fa fa-check"></i>Fitness Education Certificate
                </h3>
                <p>Entry level and most relevant certificate & degree transcript (if applicable) to be submitted. You can also submit your current fitness industry specific CV which will help with the application process.</p>
                <p>By submitting your application, you affirm that any discovery of fake or fraudulent fitness education certificates will result in the denial of your registration with REPs UAE. Additionally, your registration fee will not be subject to refund, and you will be permanently ineligible for future membership with REPs UAE. Furthermore, your details will be forwarded to the Dubai Sports Council for their awareness and appropriate action.</p>
                <!-- <p>
                    Entry level and most relevant certificate &amp; degree transcript (if applicable) to  be  submitted. You can also submit  your current fitness industry specific CV which will help with the application process.
                </p> -->
                <h3 class="top20 title-reg">
                    <i class="fa fa-check"></i>First Aid / CPR Certificate
                </h3>
                <p>
                    Up to date First Aid/CPR Certificate is required.
                </p>
                <h3 class="top20 title-reg">
                    <i class="fa fa-check"></i>Passport Size    Photo
                </h3>
                <p>
                    Required for ID Card.
                </p>
                <h3 class="top20 title-reg">
                    <i class="fa fa-check"></i>Payment – Dhs420 (VAT incl.) per year
                </h3>
                <p>
                    Before REPs can complete your application, payment must be made. (cash, cheque or debit/credit card)
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
                <p><a href="{{Request::root()}}/download/REPs_UAE_App_Form.pdf">Download</a> (REPs UAE - Registration Form)</p>
            </div>
            {{ HTML::linkAction('TrainerController@trainerPersonalDetailsForm','Register Now',array(),array('id' => 'registerInfoContinue', 'class' => 'btn')) }}
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
    <div class="clearfix"></div>
    <br />
    <br />
    
    @include('include.subFooter')

    <script type="text/javascript" src="{{Request::root()}}/js/custom.js"></script>
@stop
