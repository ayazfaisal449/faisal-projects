@extends('layouts.primary')

@section('content')

@include('include.subNav')

<div class="border-bottom">
    <div class="row">
        <div class="large-12 columns">
            <h1 class="color-green">Renew REPs Membership</h1>
            <?php
                    $today_dt = new DateTime(date("Y-m-d"));
                    
                    $allowed_renewal_dt = new DateTime(date("Y-m-d"));
                    $allowed_renewal_dt->modify('+29 day');
                    
                    $expire_dt = new DateTime($user->trainer->expiry_date);
                    
                    $expire_dt_wgp = new DateTime($user->trainer->expiry_date); //with grace period
                    $expire_dt_wgp->modify('+29 day');
                ?>
            @if ($expire_dt_wgp < $today_dt) <p style="color:red;">
                  Your membership has expired
                  on:&nbsp;&nbsp;<strong>{{ $expire_dt->format('d-m-Y') }}!</strong>&nbsp;&nbsp;
                   Renew now to continue your REPs membership!
                </p>
                <p style="color:red;">
                    Payment – Dhs 450 if any of the category(Include: Personal Trainer, Yoga Teacher, Pilates
                    Instructor)+ (VAT incl.) per year
                </p>
                <p style="color:red;">
                    Payment – Dhs 400 if any of the category(Exlude: Personal Trainer, Yoga Teacher, Pilates
                    Instructor)+ (VAT incl.) per year
                </p>
                @elseif ($expire_dt < $today_dt) <p style="color:red;">
                    Your membership has expired
                    on:&nbsp;&nbsp;<strong>{{ $expire_dt->format('d-m-Y') }}!</strong>&nbsp;&nbsp;
                    Renew now to continue your REPs membership!
                    </p>
                    <p style="color:red;">
                    Payment – Dhs 450 if any of the category(Include: Personal Trainer, Yoga Teacher, Pilates
                    Instructor)+ (VAT incl.) per year
                    </p>
                    <p style="color:red;">
                    Payment – Dhs 400 if any of the category(Exlude: Personal Trainer, Yoga Teacher, Pilates
                    Instructor)+ (VAT incl.) per year
                    </p>
                    @else
                    <p>
                    Your membership will expire
                    on:&nbsp;&nbsp;<strong>{{ $expire_dt->format('d-m-Y') }}</strong>.&nbsp;&nbsp;Renew now!
                    </p>
                    <p>
                    Payment – Dhs 450 if any of the category(Include: Personal Trainer, Yoga Teacher, Pilates
                    Instructor)+ (VAT incl.) per year
                    </p>
                    <p>
                    Payment – Dhs 400 if any of the category(Exlude: Personal Trainer, Yoga Teacher, Pilates
                    Instructor)+ (VAT incl.) per year
                    </p>
                    @endif
        </div>
    </div>
</div>

<div class="row">
    @if (Session::has('message'))
    <div class="subnotify" style="padding:15px;color:red;">
        <p style="font-family:'HelveticaLTStd-BoldCond';font-size:20px;">{{ Session::get('message') }}</p>
    </div>
    @endif
</div>

@if ($pending_renewal > 0)
<div class="continueBtnWrapper">
    <div class="row">
        <div class="small-12 columns end">
            <br />
            <h3 style="font-family: HelveticaNeueLTCom-Th;">Cannot renew. You currently have a pending renewal awaiting
                admin approval.</h3>
        </div>
    </div>
</div>
@else
<div class="continueBtnWrapper">
    <div class="row">
        <div class="small-12 columns end">
            <br />
            <h3 style="font-family: HelveticaNeueLTCom-Th;">Please select payment option:</h3>
        </div>
    </div>
    <div class="row">
        {!!Form::open(array(
                    'action' => 'TrainerController@processRenewal',
                    'files' => true, 
                    'name' => 'addRenewalFile',
                    'class' => 'frmPayz'
                ))!!}
        <div class="medium-4 columns">
            <p class="payType">
                <a class="payTypeO" href="#"><img style="border: 3px solid #10984b;"
                        src="{{Request::root()}}/img/paytype-online.png" class="onpy" /></a><br />
            </p>
            <p style="font-size:16px;">
                <span style="color:#008FBE;font-family:'HelveticaLTStd-BoldCond';">PAY ONLINE.</span>
                Renew your membership online in two easy steps!
            <ul class="paySteps">
                <li>
                    <span style="font-family:'HelveticaLTStd-BoldCond';">Step 1:</span>
                    Upload a scanned image of any courses or events you have attended in the past 12 months
                    <br /><br />
                    <span style="font-size:11px;">
                        <strong>Press control</strong> while clicking to select multiple files.
                        JPG, JPEG, PNG, GIF, PDF, DOC files only, <strong>Maximum of 4 files</strong>.
                        Maximum file size for each file is <strong>8mb</strong>.
                    </span>
                    @if (Session::has('message2'))
                    <br />
                    <div class="subnotify"
                        style="padding:15px 15px 0px 15px;color:red;font-family:'HelveticaLTStd-BoldCond';">
                        <p style="padding:0px;margin:0px;">{{ Session::get('message2') }}</p>
                    </div>
                    @endif
                    <br /><br />
                    {!!Form::file('photo[]',array('id'=>'photo','multiple'=>'multiple','class'=>'payupl'))!!}
                </li>
                <li style="margin-top:12px;">
                    <span style="font-family:'HelveticaLTStd-BoldCond';">Step 2:</span>
                    @if ($expire_dt_wgp > $today_dt)
                    <p> Pay the Dhs472.5 if any of the category(Include: Personal Trainer, Yoga Teacher, Pilates
                        Instructor)+ (VAT incl.) membership fee.</p>
                    <p> Pay the Dhs420 (Exlude: Personal Trainer, Yoga Teacher, Pilates Instructor)+ (VAT incl.)
                        membership fee</p>

                    <!-- Pay the Dhs577.5 (VAT incl.) membership fee. -->
                    @else
                    <p> Payment – Dhs 577.5 if any of the category(Include: Personal Trainer, Yoga Teacher, Pilates
                        Instructor)+ (VAT incl.) membership fee</p>
                    <p> Payment – Dhs 525 (Exlude: Personal Trainer, Yoga Teacher, Pilates Instructor)+ (VAT incl.)
                        membership fee</p>
                    @endif
                    <br /><br />

                </li>
                <li class="">
                    {{-- <span style="font-family:'HelveticaLTStd-BoldCond';">Step 3 (Optional):</span>
                                Avail member insurance benefit from REPs for an additional Dhs708.75 (VAT incl.)
                                <br /><br />
                                <p>Membership benefit includes Professional Insurance:</p>
                                <ul class="openSans">
                                    <li>A maximum indemnity of USD5,000,000 any one occurrence</li>
                                    <li>Claims arising in respect of third party bodily injury and property damage</li>
                                    <li>Protection against Medical Malpractice</li>
                                    <li>Protection against Errors and Ommissions incidents</li>
                                </ul>
                                <br />
                                <div class="inputWrapper" >
                                    <label>
                                        <input type="checkbox" name="avail_insurance"> 
                                        Avail member insurance benefit from REPs
                                    </label>
                                </div>
                                <br /><br /> --}}
                    <div class="continueBtnWrapper">
                        <input class="submitBtn payBtnz" type="button" value="Pay Online" name="register" />
                    </div>
                </li>
            </ul>
            </p>
        </div>
        {!!Form::close()!!}
        <div class="medium-4 columns end">
            <p class="payType">
                <a class="payTypeC" href="#"><img src="{{Request::root()}}/img/paytype-cash.png"
                        class="cashpy" /></a><br />
            </p>
            <p style="font-size:16px;">
                <span style="color:#32A543;font-family:'HelveticaLTStd-BoldCond';">PAY CASH.</span> Please bring to the
                REPs office AED @if ($expire_dt_wgp > $today_dt) 472.5 if any of the category(Include: Personal Trainer,
                Yoga Teacher, Pilates Instructor)+ (VAT incl.) @else 577.5 if any of the category(Include: Personal
                Trainer, Yoga Teacher, Pilates Instructor)+ (VAT incl.) membership fee plus any certificates from any
                courses or events you have attended in the past 12 months.@endif
            </p>
            <p style="font-size:16px;">
                <span style="color:#32A543;font-family:'HelveticaLTStd-BoldCond';">PAY CASH.</span> Please bring to the
                REPs office AED @if ($expire_dt_wgp > $today_dt) 420 if any of the category(Exclude: Personal Trainer,
                Yoga Teacher, Pilates Instructor)+ (VAT incl.) @else 525 if any of the category(Exclude: Personal
                Trainer, Yoga Teacher, Pilates Instructor)+ (VAT incl.) membership fee plus any certificates from any
                courses or events you have attended in the past 12 months.@endif
            </p>
        </div>
    </div>
</div>
<div id="dlgOnlinePay" title="Online Payment" style="display:none;">
    <p>
        In order for us to process your online payment, please follow steps 1 and 2 on the instructions provided.
    </p>
</div>
<div id="dlgCashPay" title="Cash Payment" style="display:none;">
    <p>
        Please bring to the REPs office AED @if ($expire_dt_wgp > $today_dt) 472.5 if any of the category(Include:
        Personal Trainer, Yoga Teacher, Pilates Instructor)+ (VAT incl.) @else 577.5 if any of the category(Include:
        Personal Trainer, Yoga Teacher, Pilates Instructor)+ (VAT incl.) membership fee plus any certificates from any
        courses or events you have attended in the past 12 months.@endif
    </p>
    <p>
        Please bring to the REPs office AED @if ($expire_dt_wgp > $today_dt) 420 if any of the category(Exclude:
        Personal Trainer, Yoga Teacher, Pilates Instructor)+ (VAT incl.) @else 525 if any of the category(Exclude:
        Personal Trainer, Yoga Teacher, Pilates Instructor)+ (VAT incl.) membership fee plus any certificates from any
        courses or events you have attended in the past 12 months.@endif
    </p>
</div>
@endif

@include('include.subFooter')
@stop

@section('customScripts')
$(document).ready(function(){
        $('.payBtnz').click(function () {
            $(this).attr('disabled','disabled');
            $('.frmPayz').submit();
        });
        $("input[type=file]").change(function() { 
            $('.filename.' + $(this).attr('id')).empty();
            var files = $(this)[0].files;
            for (var i = 0; i < files.length; i++) {
                var $p = $("<p></p>").text(files[i].name).appendTo('.filename.' + $(this).attr('id'));
            }
        });
    });
    $('.payType a.payTypeC').click(function() {
    $("#dlgCashPay").dialog({
    resizable: false,
    height:230,
    width:"auto",
    modal: true,
    fluid: true,
    create: function( event, ui ) {
    $(this).css("maxWidth", "460px");
    },
    buttons: {
    Ok: function() {
    $( this ).dialog("close");
    }
    }
    });
    return false;
    });
    $('.payType a.payTypeO').click(function() {
    $("#dlgOnlinePay").dialog({
    resizable: false,
    height:230,
    width:"auto",
    modal: true,
    fluid: true,
    create: function( event, ui ) {
    $(this).css("maxWidth", "460px");
    },
    buttons: {
    Ok: function() {
    $( this ).dialog("close");
    }
    }
    });
    return false;
    });
    @stop