@extends('layouts.primary')

@section('content')
    
     @include('include.subNav')
    
    <div class="row">
        <div class="large-12 columns">
            <h1>Trainer Qualification</h1>
            <p>Please complete the fields below. <b>Fields marked * are required.</b></p>
        </div>
    </div>
    
    <div class="formNumberWrapper">
        <div class="row">
            <div class="large-12 columns">
                @if (!empty($showme))
                    <a href="{{Request::root()}}/trainer/registration"><img src="{{Request::root()}}/img/1.png" alt="Step 1" /></a>
                    <a href="{{Request::root()}}/trainer/trainerWorkExperienceForm"><img src="{{Request::root()}}/img/2.png" alt="Step 2" /></a>
                    <img src="{{Request::root()}}/img/qualification.png" alt="Step 3" />
                @endif
                <img src="{{Request::root()}}/img/1.png" alt="Step 1" />
                <img src="{{Request::root()}}/img/2.png" alt="Step 2" />
                <img src="{{Request::root()}}/img/qualification.png" alt="Step 3" />
            </div>
        </div>
    </div>
    
    {{Form::open(array(
        'url' => Request::root().'/trainer/save',
        'files' => true, 
        'class' => 'registration'
    ))}}
    
     <div class="trainerSubTitle">
        <div class="row">
            <div class="large-12 columns">
                <h3>Qualifications</h3>
            </div>
        </div>
    </div>
          
    <div class="row">

            {{Form::token();}}
            {{Form::hidden('form','Qualifications')}}
            {{Form::hidden('email',$email)}}
            <div class="qualification">
            
                 <div class="large-6 columns">
                 
                     <div class="inputWrapper">
                        <div class="label">
                            {{Form::label('course_name', 'Name of Course ')}}
                            <div class="error">
                                @if(isset($errors[0][0]['course_name']))
                                    <span class="error">{{$errors[0][0]['course_name'][0]}}</span>
                                @endif
                            </div>
                        </div>
                        {{Form::text('course_name[]',(isset($oldData[0]['course_name'])?$oldData[0]['course_name']:''))}}
                    </div>
                    
                    <div class="inputWrapper">
                        <div class="label">
                        {{Form::label('course_provider', 'Name of Institution')}}
                            <div class="error">
                                 @if(isset($errors[0][0]['course_provider']))
                                    <span class="error">{{$errors[0][0]['course_provider'][0]}}</span>
                                 @endif
                             </div>
                         </div>
                         {{Form::text('course_provider[]',(isset($oldData[0]['course_provider'])?$oldData[0]['course_provider']:''))}}
                    </div>
                    
                    <div class="inputWrapper">
                        <div class="label">
                        {{Form::label('date_completed', 'Date Completed')}}
                            <div class="error">
                                @if(isset($errors[0][0]['date_completed']))
                                    <span class="error">{{$errors[0][0]['date_completed'][0]}}</span>
                                 @endif
                            </div>
                         </div>
                         {{Form::text('date_completed[]',(isset($oldData[0]['date_completed'])?$oldData[0]['date_completed']:''),array('class'=>'dateC'))}}
                    </div>

                    
                
                </div>
                
                 <div class="large-6 columns">
                 
                    <div class="qualificationCertificate trainerSubTitle">
                        <div class="row">
                            <div class="large-12 columns">
                                <div class="errorWrapper">
                                    <h3>Upload Certificates</h3>
                                    <span class="error">* 
                                        @if(isset($errors[0][0]['certificate']))
                                            {{$errors[0][0]['certificate'][0]}}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <i>Maximum of 5 Certificates only, </i><br>
                    <i>Recommended file types: png, jpg, jpeg</i><br>
                    <i>Limit size to 2MB for each file</i>
                    <label for="certificates0">
                        <div class="upload"></div>
                    </label>
                    {{Form::file('certificates0[]',array('class'=>'certificates','id'=>'certificates0','multiple'=>'multiple'))}}
                    <div class="filename"></div>

                </div>
                
            </div>  
    </div>
    
    <div class="moreQualification">
        
        @if(isset($errors))
        
            @for($i=1; $i<count($errors); $i++)
                
                <div class="row">
            
                    <div class="qualification">
                    
                        <div class="large-6 columns">
                        
                            <div class="inputWrapper">
                                 <div class="label">
                                    {{Form::label('course_name', 'Name of Course ')}}
                                    <div class="error">
                                        @if(isset($errors[$i][0]['course_name']))
                                            <span class="error">{{$errors[$i][0]['course_name'][0]}}</span>
                                        @endif
                                    </div>
                                </div>
                                {{Form::text('course_name[]',(isset($oldData[$i]['course_name'])?$oldData[$i]['course_name']:''))}}
                            </div>
                            
                            <div class="inputWrapper">
                                <div class="label">
                                    {{Form::label('course_provider', 'Name of Institution')}}
                                    <div class="error">
                                         @if(isset($errors[$i][0]['course_provider']))
                                            <span class="error">{{$errors[$i][0]['course_provider'][0]}}</span>
                                         @endif
                                     </div>
                                 </div>
                                 {{Form::text('course_provider[]',(isset($oldData[$i]['course_provider'])?$oldData[$i]['course_provider']:''))}}
                            </div>
                            
                            <div class="inputWrapper">
                                <div class="label">
                                    {{Form::label('date_completed', 'Date Completed')}}
                                    <div class="error">
                                        @if(isset($errors[$i][0]['date_completed']))
                                            <span class="error">{{$errors[$i][0]['date_completed'][0]}}</span>
                                         @endif
                                     </div>
                                 </div>
                                 {{Form::text('date_completed[]',(isset($oldData[$i]['date_completed'])?$oldData[$i]['date_completed']:''),array('class'=>'dateC'))}}
                            </div>
                        
                        </div>
                        
                        <div class="large-6 columns">
                 
                            <div class="qualificationCertificate trainerSubTitle">
                                <div class="row">
                                    <div class="large-12 columns">
                                        <div class="errorWrapper">
                                            <h3>Upload Certificates</h3>
                                            <span class="error">* 
                                                 @if(isset($errors[$i][0]['certificate']))
                                                    {{$errors[$i][0]['certificate'][0]}}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <i>Maximum of 5 Certificates only</i><br>
                            <i>Recommended file types: png, jpg, jpeg</i><br>
                            <i>Limit size to 4MB</i>
                            <label for="certificates0">
                                <div class="upload"></div>
                            </label>
                            {{Form::file('certificates0[]',array('class'=>'certificates','id'=>'certificates0','multiple'=>'multiple'))}}
                            <div class="filename"></div>
                        </div>
                        
                    </div>
                    
                </div>
                
            @endfor
        @endif
            
    </div>

    
    
    <div class="addMoreLink">
        <div class="row">
            <div class="large-12 columns">
                <a id="more">
                    <img src="{{Request::root()}}/img/plus.png">
                    <span>Add Qualification</span>
                </a>
            </div>
        </div>
    </div>
    
    <div class="hide" style="margin-bottom: 0; margin-top: 0;">
        <div class="trainerSubTitle">
            <div class="row">
                <div class="large-12 columns">
                    <h3>Insurance Cover</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <p>Membership benefit includes Professional Insurance:</p>
                <ul class="openSans">
                    <li>A maximum indemnity of USD5,000,000 any one occurrence</li>
                    <li>Claims arising in respect of third party bodily injury and property damage</li>
                    <li>Protection against Medical Malpractice</li>
                    <li>Protection against Errors and Ommissions incidents</li>
                </ul>
                <div class="inputWrapper" >
                    <label>
                        <input type="checkbox" name="avail_insurance"> 
                        Avail member insurance benefit from REPs for an additional Dhs708.75 (VAT incl.)
                    </label>
                </div>
            </div>
        </div>
        <div class="row" id="insurance-form" style="display: none;">
            <div class="large-12 columns">
                <table>
                    <tr>
                        <td width="80%">Do you suffer from any disabilities, transmittable diseases (e.g. Hepatitis, HIV, etc.) or other impediment which may affect the performance of your professional duties as a fitness trainer?</td>
                        <td>
                            <input type="radio" name="disease" value="yes"> Yes &nbsp;
                            <input type="radio" name="disease" value="no" checked="checked"> No
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Have you been the subject of or convicted of any criminal offence (other than minor traffic offences), professional disciplinary proceedings, or inquiries?</td>
                        <td>
                            <input type="radio" name="criminal" value="yes"> Yes &nbsp;
                            <input type="radio" name="criminal" value="no" checked="checked"> No
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Have any claims for injury or professional negligence been made against you during the last 3 years?</td>
                        <td>
                            <input type="radio" name="negligence" value="yes"> Yes &nbsp;
                            <input type="radio" name="negligence" value="no" checked="checked"> No
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Has any insurer previously declined to accept, cancelled, refused to continue or agreed to continue only on special terms, in respect of this type of insurance?</td>
                        <td>
                            <input type="radio" name="insurer" value="yes"> Yes &nbsp;
                            <input type="radio" name="insurer" value="no" checked="checked"> No
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="continueBtnWrapper">
        <div class="row">
            <div class="medium-8 medium-offset-2 columns">
                <br />
                <div class="termsz">
                    <p>I wish to apply for REPs registration and agree <strong>(please read carefully):</strong></p>
                    <ul class="openSans">
                        <li>To follow the REPs Code of Ethical Practice (a copy can be downloaded) and to be bound by any REPs complaints process.</li>
                        <li>That all information provided on this form is accurate and true.</li>
                        <li>That REPs has permission to contact any third party to verify any details of my registration application. To also allow to pass on any contact details to third parties that provide services, and for them to contact me.</li>
                        <li>To undertake any audits or reviews REPs may undertake to verify my level of registration and/or competencies.</li>
                        <li>To allow REPs to disclose to third parties my registration status, and any reasons for non-registration.</li>
                        <li>To undertake any identified training or assessment at my own cost, which REPs recommends as needed to gain entry on to REPs Register.</li>
                        <li>To make payment of the registration fee to REPs, payment is for application, not acceptance. Refunds are not given for unsuccessful registrations.</li>
                        <li>That all online forms completed in my name that correctly provide my date of birth and email address will be binding.</li>
                        <li>To undertake sufficient ongoing education (Continuing Professional Development). Currently 10 CPD Points are required each registration year.</li>
                        <li>To maintain a current email address at all times, and receive all email communications from REPs.</li>
                        <li>All payments for registration are for 12 months from the date of certification, and refunds are not given for change of mind, unsuccessful registration, or failure to meet registration standards.</li>
                        <li>This agreement is between the applicant as detailed in section 1, and the UAE Register of Exercise Professionals limited.</li>
                    </ul>
                </div>
                
                <table class="table" style="width: 100%; margin-bottom: 0;">
                    <thead style="background-color: #32A443; color: #fff;">
                        <tr>
                            <th style="color: #fff;">Item</th>
                            <th style="width: 200px; color: #fff;">Amount</th>
                        </tr>
                    </thead>
                    <tr>
                        <td>12-Month Certification</td>
                        <td>400.00 AED</td>
                    </tr>
                    <tr>
                        <td>5% Value Added Tax (VAT)</td>
                        <td>20.00 AED</td>
                    </tr>
                    <tr>
                        <td><b>TOTAL</b></td>
                        <td><b>420.00 AED</b></td>
                    </tr>
                </table>
                <small>TLN: 100353361700003</small>
                <p style="margin-bottom:0px;font-size:13px; text-align: right;">{{ Form::checkbox('i_agree', '', false, array('class'=>'i_agree')); }} I agree with the <span class="showterms" style="color:#32A443;font-weight:800;">terms</span>.</p>
            </div>
            <div class="medium-4 large-offset-8 columns">
                
                <input type="hidden" name="register" value="Continue">
                <button type="submit" class="submitBtn" style="margin-top: 0;">Checkout</button>
                <!--<input class="submitBtn" type="submit" value="Continue" name="register" />-->
            </div>
        </div>
        <div class="row">
    </div>
    
    {{Form::close()}}
    
    @include('include.subFooter')
    
@stop

@section('customScripts')
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#insurance-form').hide();
    });

    $('[name="avail_insurance"]').on('click', document.body, function() {
        if ($(this).is(':checked')) {
            $('#insurance-form').show();
        } else {
            $('#insurance-form').hide();
        }
    });

    var $count = {{isset($errors)?count($errors):1}},
        $clone = $('.qualification').clone();

    // add the remove button
    function removeQualification() {
    
        $('.moreQualification .qualification').each(function (index) {
            //remove button
            if ($(this).find('.remove').length == 0) {
                $('<div class="remove">X</div>').appendTo($(this));
                $(this).find('.remove').click(function () {
                
                    $(this).parent().remove();
                    $count--;
                    
                    //refresh counter
                    $('div.columns .certificates').each(function (index) {
                
                        $(this).attr('name','certificates'+index+'[]');
                        $(this).attr('id','certificates'+index);
                        $(this).prev().attr('for','certificates'+index);
                    });
                });
            }
            
        });
    }
    
    //clone the form to add more qualifications
    function addQualification() {
    
        if ($count < 10) {
        
            var $newDiv = $('<div class="row"></div>');
            $newDiv.append($clone.clone());
            $newDiv.appendTo('.moreQualification');
            
            $(".dateC").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat:'yy-mm-dd',
                showMonthAfterYear:true
            });
            
            $count++;
        }
    }

    $('document').ready(function () {
    
        $('.submitBtn').click(function() {
            var x = $('.i_agree').prop('checked');
            if (!x) {
                alert('You need to agree with the terms and conditions in order to proceed');
                return false;
            }
            var $blankCerts = false;
            var $errMsg = "";
            $('div.columns .certificates').each(function (index) {
            
                var filer = $(this).val();
                var itemNo = index + 1;
            
                if (filer == '') {
                    $blankCerts = true;
                    $errMsg += "Qualification " + itemNo + " does not have a certificate.\n";
                }
            });
            if ($blankCerts) {
                alert($errMsg);
                return false;
            }
        });
    
        $('#more').click(function() {
            
            if ($count < 10) {
            
                addQualification();
                removeQualification();

                $('.certificates').each(function (index) {
                
                    $(this).attr('name','certificates'+index+'[]');
                    $(this).attr('id','certificates'+index);
                    $(this).prev().attr('for','certificates'+index);
                });

            } else  {
                alert('you can add only 10 qualifications at a single time');
            }
        });
        
        $(".dateC").datepicker({
            changeMonth: true,
            changeYear: true, 
            minDate: "-100Y",
            maxDate: "+0D",
            dateFormat:'yy-mm-dd',
            yearRange: "-100:+0D",
            showMonthAfterYear:true
        });
        
        $(document).on('change', 'input[type=file]', function() {
            $(this).parent().find('.filename').html('');
            var files = $(this)[0].files;
            for (var i = 0; i < files.length; i++) {
                $("<p></p>").text(files[i].name).appendTo($(this).parent().find('.filename'));
            }
        });
    });
</script>
<script type="text/javascript">
@stop