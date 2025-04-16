@extends('layouts.primary')

@section('content')
@include('include.subNav')
<div class="row">
     <div class="columns large-12 medium-12 small-12">
         <div class="title-div title-last">
             <h4 class="left">Coming Soon</h4>
         </div>
    </div>
</div> 
<div style="min-height: 300px;"></div>
{{ Form::open(array('action'=>'PrimaryController@insurancePost')) }}
    {{--
    <div class="row">
         <div class="columns large-12 medium-12 small-12">
             <div class="title-div title-last">
                 <h4 class="left">Professional Liability Insurance</h4>
                <p class="right"><a class="activeMe right" href="">Insurance</a><i class="right fa fa-angle-right"></i> <a class="right" href="">Home</a></p>
             </div>
        </div>
    </div> 
    
    
    <div class="row">
        <div class="columns large-12 medium-12 small-12">
            <img src="{{ asset('img//insurance-img.png') }}" />
        </div>
    </div>
    <div class="row top20 bottom20">
        <div class="columns large-12 small-12">
            <p>
                You've worked hard to establish yourself as a qualified Fitness professional, but it only takes one incident to put all of that in jeopardy.    </br></br>
                Your clients trust you with their wellbeing and safety while they are in your care, protecting yourself with professional liability insurance is an essential part of good risk management, providing protection in the case of claims due to an accident or injury, giving you confidence knowing that you are prepared.
    
                    <br /><br />
                At Dhs708.75 (VAT incl.) per year, This REPs UAE insurance scheme has been specifically designed for fitness industry professionals who are REPs registered operating in a gym, studio, fitness facility, client's homes or outdoors and complying with local legal requirements. 
                 
            </p>
        </div>
    </div>

    <div class="row">
       <div class="columns large-12 small-12">
           <div class="insurance-cover">
                <div class="title-area">
                    <h1 class="insure green-text">*Coverage Includes:</h1>
                </div>
                <div class="covers">
                    <ul>
                        <li>
                            <i class="fa fa-check-circle"></i>  Public Liability to a maximum indemnity of $5,000,000 any one occurrence/unlimited 
                        </li>
                        <li>
                            <i class="fa fa-check-circle"></i>  Medical malpractice to a maximum indemnity of $250,000 any one claim and in the aggregate including defense costs per member.
                        </li>
                        <li>
                            <i class="fa fa-check-circle"></i> Professional Liability/Errors or Omissions/Breach of Professional Duty to a maximum indemnity of $250,000 any one claim and in the aggregate including defense costs per member.
                        </li>
                        <li>
                            <i class="fa fa-check-circle"></i> Claims arising in respect of third party bodily injury and property damage
                        </li>
                        <li>
                            <i class="fa fa-check-circle"></i> Protection against Medical Malpractice
                        </li>
                        <li>
                            <i class="fa fa-check-circle"></i> Protection against Errors and Omissions incidents.
                        </li>
                    </ul>
                </div>
            </div>  
            
       </div>
   </div>

   <div class="row">
         <div class="columns large-12 medium-12 small-12">
             <div class="title-details clearfix">
                 <span>Information Required</span>
             </div>
        </div>
    </div> 

    <div class="row">
        <div class="columns large-12 medium-12 small-12">
            <h1 class="info-required">Please complete every section below to avoid delay in processing.</h1>
            <div class="row form-newDes ">  
                <div class="columns large-12 medium-12 small-12">
                    <div class="row  margin-top0">
                        <div class="columns large-2 medium-3 small-12">
                            <label>Reps Membership No.</label>
                        </div>
                        <div class="columns large-4 medium-5 small-12 left">
                            <span class="textErr right">{{ $errors->first('membership_number',':message') }}</span>
                             @if (Session::get('alert')) <span class="textErr right">{{Session::get('alert')}}</span> @endif
                            <input placeholder="Ex : reps1234" type="text" name="membership_number" id="" value="{{ Input::old('membership_number')}}">
                        </div>
                    </div>

                   <div class="row  margin-top10 new-form">
                        <div class="columns large-2 medium-3 small-12">
                            <label>Email</label>
                        </div>
                        <div class="columns large-4 medium-5 small-12 left">
                            <span class="textErr right">{{ $errors->first('email',':message') }}</span>
                            <input type="email" name="email" id="" value="{{ Input::old('email')}}">
                        </div>
                    </div>

                    <div class="row  margin-top10 new-form">
                        <div class="columns large-2 medium-3 small-12">
                            <label>Full Name</label>
                        </div>
                        <div class="columns large-4 medium-5 small-12 left">
                            <span class="textErr right">{{ $errors->first('name',':message') }}</span>
                            <input type="text" name="name" id="" value="{{ Input::old('name')}}">
                        </div>
                    </div>

                    <div class="row  margin-top10 new-form">
                        <div class="columns large-2 medium-3 small-12">
                            <label>Date of Birth</label>
                        </div>
                        <div class="columns large-4 medium-5 small-12 left">
                            <span class="textErr right">{{ $errors->first('birthdate',':message') }}</span>
                            <input type="text" name="birthdate" value="{{ Input::old('birthdate')}}" id="date">
                        </div>
                    </div>

                    <div class="row  margin-top10 new-form">
                        <div class="columns large-2 medium-3 small-12">
                            <label>Mobile Number</label>
                        </div>
                        <div class="columns large-4 medium-5 small-12 left">
                            <span class="textErr right">{{ $errors->first('mobile_number',':message') }}</span>
                            <input type="number" name="mobile_number" id="" value="{{ Input::old('mobile_number')}}">
                        </div>
                    </div>
                    
                </div>
            </div>    
            
        </div> 
    </div>

    <div class="row">
        <div class="columns large-12 medium-12 small-12">
            <h1 class="info-required"><span>1.)</span>Type of Qualifications(s) / Year Qualified / Country Qualification?</h1>
            <div class="row form-newDes ">  
                <div class="columns large-12 medium-12 small-12">
                    <div class="row  margin-top0">
                        <div class="columns large-2 medium-3 small-12">
                            <label>Type of Qualification (s)</label>
                        </div>
                        <div class="columns large-4 medium-5 small-12 left">
                            <span class="textErr right">{{ $errors->first('quality_type',':message') }}</span>
                            <input type="text" name="quality_type" id="" value="{{ Input::old('quality_type')}}">
                        </div>
                    </div>
                </div>
            </div>    
            <div class="row form-newDes "> 
                <div class="columns large-12 medium-12 small-12">
                    <div class="row new-form ">
                        <div class="columns large-2 medium-3 small-12">
                            <label>Year Qualified</label>
                        </div>
                        <div class="columns large-4 medium-5 small-12 left">
                            <span class="textErr right">{{ $errors->first('year_qualified',':message') }}</span>
                            <input type="text" name="year_qualified" id="" value="{{ Input::old('year_qualified')}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-newDes "> 
                <div class="columns large-12 medium-12 small-12">
                    <div class="row new-form ">
                        <div class="columns large-2 medium-3 small-12">
                            <label>Country Qualification</label>
                        </div>
                        <div class="columns large-4 medium-5 small-12 left">
                            <span class="textErr right">{{ $errors->first('country_qualified',':message') }}</span>
                            <input type="text" name="country_qualified" id="" value="{{ Input::old('country_qualified')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <div class="row">
        <div class="columns large-12 medium-12 small-12">
            <h1 class="info-required"><span>2.)</span>Address Details</h1>
            <div class="row form-newDes ">  
                <div class="columns large-12 medium-12 small-12">
                    <div class="row  margin-top0">
                        <div class="columns large-2 medium-3 small-12">
                            <label>Address</label>
                        </div>
                        <div class="columns large-4 medium-5 small-12 left">
                            <span class="textErr right">{{ $errors->first('address',':message') }}</span>
                            <input type="text" name="address" id="" value="{{ Input::old('address')}}">
                        </div>
                    </div>
                </div>
            </div>    
            <div class="row form-newDes "> 
                <div class="columns large-12 medium-12 small-12">
                    <div class="row new-form ">
                        <div class="columns large-2 medium-3 small-12">
                            <label>Emirates</label>
                        </div>
                        <div class="columns large-4 medium-5 small-12 left">
                            <span class="textErr right">{{ $errors->first('emirates',':message') }}</span>
                            <input type="text" name="emirates" id="" value="{{ Input::old('emirates')}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-newDes "> 
                <div class="columns large-12 medium-12 small-12">
                    <div class="row new-form ">
                        <div class="columns large-2 medium-3 small-12">
                            <label>P.O Box</label>
                        </div>
                        <div class="columns large-4 medium-5 small-12 left">
                            <span class="textErr right">{{ $errors->first('po_box',':message') }}</span>
                            <input type="text" name="po_box" id="" value="{{ Input::old('po_box')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <div class="row yes_no">
        <div class="columns large-7 medium-7 small-12">
            
            <h1 class="info-required"><span>3.)</span> Do you suffer from any disabilities, transmittable diseases (e.g. hepatitis, HIV, etc.)  or other impediment which may affect the performance of your professional duties as a fitness trainer?</h1>
        </div>
        <div class="columns large-1 medium-1 small-5 small-offset-1">
            <span class="textErr2 right" style="top:0;">{{ $errors->first('number_three',':message') }}</span>
            <label for="is_disable-1">
            <input type="radio" name="number_three" id="is_disable-1" value="yes" @if(Input::old('number_three')== 'yes') checked="checked" @endif>
            Yes
            </label>
        </div>
        <div class="columns large-1 medium-1 small-6 left">

          <label for="is_disable-2">
            <input type="radio" name="number_three" id="is_disable-2" value="no" @if(Input::old('number_three')== 'no') checked="checked" @endif>
            No
        </label>
        </div>
    </div> 

    <div class="row yes_no">
        <div class="columns large-7 medium-7 small-12">
            
            <h1 class="info-required margin-top0"><span>4.)</span>Have you been the subject of or convicted of any criminal offence (other than minor traffic offences), professional disciplinary proceedings, or inquiries?</h1>
        </div>
        <div class="columns large-1 medium-1 small-5 small-offset-1">
            <span class="textErr2 right">{{ $errors->first('number_four',':message') }}</span>
            <label for="is_criminal-1" class="margin-top0">
            <input type="radio" name="number_four" id="is_criminal-1" value="yes" @if(Input::old('number_four')== 'yes') checked="checked" @endif >
            Yes
            </label>
        </div>
        <div class="columns large-1 medium-1 small-6 left">
          <label for="is_criminal-2" class="margin-top0">
            <input type="radio" name="number_four" id="is_criminal-2 " value="no" @if(Input::old('number_four')== 'no') checked="checked" @endif>
            No
        </label>
        </div>
    </div> 

    <div class="row yes_no">
        <div class="columns large-7 medium-7 small-12">

            <h1 class="info-required margin-top0"><span>5.)</span> Have any claims for injury or professional negligence been made against you during the last 3 years?</h1>
        </div>
        <div class="columns large-1 medium-1 small-5 small-offset-1">
            <span class="textErr2 right">{{ $errors->first('number_five',':message') }}</span>
            <label for="is_injury-1" class="margin-top0">
            <input type="radio" name="number_five" id="is_injury-1" value="yes" @if(Input::old('number_five')== 'yes') checked="checked" @endif>
            Yes
            </label>
        </div>
        <div class="columns large-1 medium-1 small-6 left">
          <label for="is_injury-2" class="margin-top0">
            <input type="radio" name="number_five" id="is_injury-2" value="no" @if(Input::old('number_five')== 'no') checked="checked" @endif>
            No
        </label>
        </div>
    </div>     

    <div class="row yes_no">
        <div class="columns large-7 medium-7 small-12">
            <h1 class="info-required margin-top0"><span>6.)</span> Has any insurer previously declined to accept, cancelled, refused to continue or agreed to continue only on special terms, in respect of this type of insurance?</h1>
        </div>
        <div class="columns large-1 medium-1 small-5 small-offset-1">
            <span class="textErr2 right">{{ $errors->first('number_six',':message') }}</span>
            <label for="is_insurer-1" class="margin-top0">
            <input type="radio" name="number_six" id="is_insurer-1" value="yes" @if(Input::old('number_six')== 'yes') checked="checked" @endif>
            Yes
            </label>
        </div>
        <div class="columns large-1 medium-1 small-6 left">
          <label for="is_insurer-2" class="margin-top0">
            <input type="radio" name="number_six" id="is_insurer-2" value="no" @if(Input::old('number_six')== 'no') checked="checked" @endif>
            No
        </label>
        </div>
    </div>     

    <div class="row">
         <div class="columns large-12 medium-12 small-12">
             <div class="title-details clearfix">
                 <span>Declaration of Applicant</span>
             </div>
             <p class="normal-p top20">
                 I hereby declare that the above statements and facts are true and that no material facts have been suppressed or misstated. I understand that the completion of this form does not bind coverage. The company’s acceptance of this proposal and payment is required before cover is valid and the policy issued.
             </p>
        </div>
    </div> 
    <div class="row bottom20">
        <div class="columns large-12 medium-12 small-12">
            <h6 class="green-text">Insurance arranged in association with</h6>
        </div>
            
        </div>
    </div>
    <div class="row  bottom20 insurer">
        <div class="columns large-3 medium-4 small-12">
            <img src="{{ asset('images/insurance2/csltd.png') }}" style=" width: 130px;" />
        </div>
        <div class="columns large-3 medium-4 small-12">
            <img src="{{ asset('images/insurance2/arc.jpg') }}" style=" width: 200px;"/>
        </div>
        <div class="columns large-3 medium-4 small-12 left">
            <img src="{{ asset('images/insurance2/alain.jpg') }}" />
        </div>
    </div>
    <div class="row contact-forms bottom30">
        <div class="columns large-2 medium-4 small-12">
            <input type="submit" value="SUBMIT" class="submitBtn ">
        </div>
    </div>
    --}}
 {{ Form::close() }}
    
   
@stop

<!-- Adding the fancy box for the images -->
@section('customScripts')
    $(document).ready(function() {
        
        var $elements = $('.carousel').find('.elements').children().length,
            children = $elements,
            $slide =0;
        
        $('.carousel a.left').click(function() {
            if($elements-1 != 1) {
                $slide = $slide + 195;
                $('.elements').animate({
                    'left':'-'+$slide+'px'
                },'easeOutBounce');   
                $elements = $elements-1;
            }
           
        });
        
        $('.carousel a.right').click(function() {
            if($elements != children) {
                $slide = $slide - 195;
                $('.elements').animate({
                    'left':'-'+$slide+'px'
                },'easeOutBounce');  
                
                $elements = $elements+1;
            } else {
                $('.elements').animate({
                    'left':0
                },'easeOutBounce'); 
            }
        });        
        
        $("#date").datepicker({
            changeMonth: true,
            changeYear: true, 
            minDate: "-100Y",
            maxDate: "+0D",
            dateFormat:'yy-mm-dd',
            yearRange: "-100:+0D",
            showMonthAfterYear:true
        });
    });
@stop
