@extends('layouts.primary')



@section('content')

     @include('include.subNav')
     
     <div class="border-bottom">
        <div class="row">
            <div class="large-12 columns">
                <h1 class="color-green">Member DashBoard</h1>
                <p class="dashboardPara">Hi, <strong>{{$user->first_name}} {{$user->last_name}}</strong>. Welcome to your dashBoard. Here you can edit and update your information as a trainer</p>
                <a href="{{ action('TrainerController@logOut') }}" class="trainerLogout">Logout</a>

            </div>
        </div>
    </div>
    @if ($unallocated === true)
        <div class="row almostExpireRow">
            <div class="large-12 columns">
                <p>Your account is awaiting approval from REPs admin.</p>
            </div>
        </div>
    @else
        <?php
            $today_dt = new DateTime(date("Y-m-d"));
            $expire_dt = new DateTime($user->trainer->expiry_date);
            $range_dt = new DateTime(date("Y-m-d", strtotime("+1 month")));
        ?>
        @if ($expire_dt < $today_dt)
            <div class="row expireRow">
                <div class="large-12 columns">
                    <p>
                        Your account has already expired!  
                    </p>
                </div>
            </div>
            
            <div class="row">
                @if ($showRenewBtn)
                    <div class="large-4 columns">
                         <a class="trainerDashboardWrapper" href="{{Request::root()}}/trainer/dashboard/renew-registration">
                            <img src="{{Request::root()}}/img/employer.png" alt="Current Employer" />
                            Renew Registration
                        </a>
                    </div>
                @else
                    <div class="large-12 columns" style="text-align:center;">
                        <h3 style="font-family:HelveticaNeueLTCom-Th;">Please contact REPs office at faisal.ayaz@sigmads.com or 04 321 3388 to renew</h3>
                    </div>
                @endif
            </div>
        @else
            @if ($expire_dt >= $today_dt && $expire_dt <= $range_dt)
                <div class="row almostExpireRow">
                    <div class="large-12 columns">
                        <p>
                            Warning!  Your membership is expiring on {{ $expire_dt->format('Y-m-d') }}.
                        </p>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="large-4 columns">
                    <a class="trainerDashboardWrapper" href="{{Request::root()}}/trainer/dashboard/update-personal-details">
                        <img src="{{Request::root()}}/img/employer.png" alt="Current Employer" />
                        Personal Details
                    </a>
                </div>

                <div class="large-4 columns">
                     <a class="trainerDashboardWrapper" href="{{Request::root()}}/trainer/dashboard/renew-registration">
                        <img src="{{Request::root()}}/img/employer.png" alt="Current Employer" />
                        Renew Registration
                    </a>
                </div>

                @if(isset($upgrade_category_status) && $upgrade_category_status->is_processed == 0)
                    <div class="large-4 columns">
                        <a class="trainerDashboardWrapper" href="#">
                            <img src="{{Request::root()}}/img/employer.png" alt="Current Employer" />
                             Apply for New Category <br>(Processing)
                        </a>
                    </div>
                @else
                    <div class="large-4 columns">
                        <a class="trainerDashboardWrapper" href="{{Request::root()}}/trainer/dashboard/upgrade-level-category">
                            <img src="{{Request::root()}}/img/employer.png" alt="Current Employer" />
                             Apply for New Category
                        </a>
                    </div>
                @endif

            </div>

            <div class="row">

                @if(isset($upgrade_status) && $upgrade_status->is_processed == 0)
                    <div class="large-4 columns">
                        <a class="trainerDashboardWrapper" href="#">
                            <img src="{{Request::root()}}/img/employer.png" alt="Current Employer" />
                             Convert Provisional to Full <br>(Processing)
                        </a>
                    </div>
                @else
                    <div class="large-4 columns">
                        <a class="trainerDashboardWrapper" href="{{Request::root()}}/trainer/dashboard/upgrade-status">
                            <img src="{{Request::root()}}/img/employer.png" alt="Current Employer" />
                             Convert Provisional to Full
                        </a>
                    </div>
                @endif

                <div class="large-4 columns">
                    <a class="trainerDashboardWrapper" href="{{Request::root()}}/trainer/dashboard/resetPassword">
                        <img src="{{Request::root()}}/img/employer.png" alt="Current Employer" />
                        Reset Password
                    </a>
                </div>

                <div class="large-4 columns">
                    <a class="trainerDashboardWrapper" href="{{Request::root()}}/trainer/dashboard/current-employer">
                        <img src="{{Request::root()}}/img/employer.png" alt="Current Employer" />
                        Current Employer
                    </a>
                </div>
            </div>

            <div class="row">

                <div class="large-4 columns">
                    <a class="trainerDashboardWrapper" href="{{Request::root()}}/trainer/dashboard/your-certifications">
                        <img src="{{Request::root()}}/img/employer.png" alt="Current Employer" />
                        Your Certifications
                    </a>
                </div>

                 <!--<div class="large-4 columns">
                    <a class="trainerDashboardWrapper" href="{{Request::root()}}/trainer/dashboard/e-certificate">
                        <img src="{{Request::root()}}/img/employer.png" alt="Current Employer" />
                       Download
                    </a>
                </div>-->


                {{-- <div class="large-4 columns">
                    <a class="trainerDashboardWrapper" href="{{ URL::action('PrimaryController@marketingResources') }}">
                        <img src="{{Request::root()}}/img/employer.png" alt="Current Employer" />
                        REPs Magazine
                    </a>
                </div> --}}

                <div class="large-4 columns" style="float:left">
                    <a class="trainerDashboardWrapper" href="{{Request::root()}}/training">
                        <img src="{{Request::root()}}/img/employer.png" alt="Current Employer" />
                        Approved Training
                    </a>
                </div>
            </div>
           <div class="yourCertifications">
            
<div class="row">
                @foreach($e_certificate as $e_certificates)

                <div class="custom-wrapper">
                    <div class="custom-row">
                        <?php
                        if($membercard){
                        ?>
                        <div class="col-md-4">
                            <a class="filecont" href="{{Request::root().'/trainer/'.$user->id.'/member_photo/'.$membercard}}" target="_blank">
                                <img width="140" src="{{Request::root().'/trainer/'.$user->id.'/member_photo/'.$membercard}}" />
                                <div> <button class="textsize"> Download REPs Membership Card</button> </div>
                            </a>
                        </div>
                        <?php
                        }
                        ?>
                        <?php $ext = pathinfo($e_certificates->e_certificate, PATHINFO_EXTENSION); ?>
                              @if ($e_certificates->e_certificate)
						<div class="col-md-4">
                            <a class="filecont" href="{{Request::root().'/trainer/'.$user->id.'/e_certificate/'.$e_certificates->e_certificate}}" target="_blank">
                              @if ($ext == 'doc' || $ext == 'docx')
                                    <img width="140" src="{{ Request::root() }}/img/docicon_doc.png" alt="{{ $e_certificates->e_certificate }}" title="{{ $e_certificates->e_certificate }}" />
                                    <div><button class="textsize"> Download E-Certificate</button></div>
                                @elseif ($ext == 'pdf')
                                    <img width="140" src="{{ Request::root() }}/img/docicon_pdf.png" alt="{{ $e_certificates->e_certificate }}" title="{{ $e_certificates->e_certificate }}" />
                                   <div><button class="textsize"> Download E-Certificate</button></div>
                                @else
                                    <img width="160" src="{{Request::root()}}/trainer/{{$user->id}}/e_certificate/{{$e_certificates->e_certificate}}" alt="{{ $e_certificates->e_certificate }}" title="{{ $e_certificates->e_certificate }}" />
                                   <div><button class="textsize">Download E-Certificate</button></div>
                                @endif
                              
                            </a> 
                        </div>
                        @endif 
                        <div class="col-md-4">
                             <a class="filecont" href="{{Request::root().'/download/Physical_Activity_Readiness_Questionnaire.pdf'}}" target="_blank">
                                <img width="140" src="{{ Request::root() }}/download/form.png" />
                               <div> <button class="textsize">Download Physical Activity Questionnaire</button></div>
                           </a>
                        </div>

                        <div class="col-md-4">
                              <a class="filecont" href="{{Request::root().'/download/REPs_member_logo_for_members_final.jpg'}}" target="_blank">
                                <img width="140" src="{{ Request::root() }}/download/REPs_member_logo_for_members_final.jpg" />
                              <div> <button class="textsize"> Download REPs UAE Logo</button> </div>
                           </a>
                        </div>


                    </div>
                </div>

                @endforeach
            </div> 
     </div>
        @endif
    @endif
    
    @include('include.subFooter')
    
@stop
<style>
    
    a.filecont:hover {
    color: black;
}
.large-4.columns {
    text-align: center;
}
.large-4.columns img {
    width: 170px;
    height: 170px;
    object-fit: contain;
}

.large-4.columns button.textsize {
    font-size: 13px;
}
</style>
<?php //    echo '<pre>'; print_r($e_certificate);?>