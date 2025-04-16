@extends('layouts.admin')

@section('content')
<style>
    span, div, h1, h2, h3, a, p, input, select {
        font-family: "OpenSans-Regular" !important;
    }
    div.tab_panel {
        margin-top:12px;
    }
    div.tab_panel .tab_label {
        background-color:#D4D4D4;
        color:white;
        border-top:1px solid #6B6B6B;
        margin-left:8px;
        padding:14px 40px;
        font-weight:normal;
        font-size:14px;
        display:inline-block;
        float:left;
    }
    div.tab_panel .tab_label:first-child {
        margin-left:30px;
    }
    div.tab_panel .tab_active {
        background-color:white;
        color:#878787;
        border-top:1px solid #D4D4D4;
        font-family:"OpenSans-Bold" !important;
    }
    div.the_form_content {
        background-color:white;
        padding:12px;
    }
    .the_form_content .inputWrapper .label,
    .the_form_content .inputWrapper .label label {
        padding-left:0px;
        padding-right:0px;
        color:#878787;
    }
    .the_form_content select {
        color:#878787;
    }
    .the_form_content form.registration .inputWrapper .label .error span.required {
        margin: 10px 6px;
        font-weight:bold;
        color:red;
    }
    .the_form_content input[type="text"], 
    .the_form_content input[type="password"], 
    .the_form_content input[type="date"], 
    .the_form_content input[type="datetime"], 
    .the_form_content input[type="datetime-local"], 
    .the_form_content input[type="month"], 
    .the_form_content input[type="week"], 
    .the_form_content input[type="email"], 
    .the_form_content input[type="number"], 
    .the_form_content input[type="search"], 
    .the_form_content input[type="tel"], 
    .the_form_content input[type="time"], 
    .the_form_content input[type="url"], 
    .the_form_content textarea,
    .the_form_content select {
        -webkit-border-radius:0 !important;
        -moz-border-radius:0 !important;
        border-radius:0 !important;
    }
    .the_form_content form.registration label .upload {
        background: url('/../img/upload3.png?1396939870') no-repeat;
    }
    .the_form_content .pnl-border-top {
        border-top:1px solid #EDEDED;
        padding-top:20px;
        margin-top:30px;
    }
    .the_form_content .admin-button {
        height:42px;
        border:1px solid #CCCCCC;
        background:transparent url('/../img/admin/btn-bg.png') repeat center center;
        padding-left:40px;
        padding-right:40px;
        font-size:16px;
        color:#525252;
    }
    .the_form_content form.registration .moreQualification .qualification .remove {
        font-size: 16px;
        top: 0;
        right: 14px;
    }
    
    //custom
    .the_form_content form.registration label .upload {
        background: url('/../img/upload3.png?1396939870') no-repeat;
    }
    .the_form_content form.registration .inputWrapper .xrr {
        padding-bottom:5px !important;
    }
    form.registration .addMoreLink {
         margin:0px; 
         padding:15px; 
    }
    .the_form_content form.registration .addMoreLink .row {
        border-top:0px;
    }
</style>
    <div class="tools">
        <h1>Add Trainer</h1>
        <div class="component" style="padding:0px 12px 12px;">		
            <p>Please complete the fields below. <b>Fields marked <i>*</i> are required.</b></p>
            <div class="clearfix"></div>
            <div class="tab_panel">
                <span class="tab_label">Personal Details</span>
                <span class="tab_label">Work Experience</span>
                <span class="tab_label tab_active">Qualifications</span>
            </div>
            <div class="clearfix"></div>
            <div class="the_form_content">
                {{Form::open(array(
                    'url' => Request::root().'/admin/trainer/save',
                    'files' => true, 
                    'class' => 'registration'
                ))}}

                <div class="row">
                        {{Form::token();}}
                        {{Form::hidden('form','Qualifications')}}

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
                                     {{Form::text('date_completed[]',(isset($oldData[0]['date_completed'])?$oldData[0]['date_completed']:''), array('class'=>'dateC'))}}
                                </div>

                            </div>

                             <div class="large-6 columns">
                                <div class="qualificationCertificate trainerSubTitle">
                                    <div class="row">
                                        <div class="large-12 columns">
                                            <div class="inputWrapper">
                                                <div class="label xrr">
                                                    {{Form::label('Upload Certificates')}}
                                                    <div class="error redText">
                                                        @if(isset($errors[0][0]['certificate']))
                                                            {{$errors[0][0]['certificate'][0]}}
                                                        @endif
														
                                                        <span class="required">*</span>
														
                                                    </div>
													
                                                </div>
												<i style="font-size: 12px;display: block;">Recommended file types: png, jpg, jpeg</i>
                                            </div>                        
                                        </div>
                                        <div class="large-12 columns">
                                            <label for="certificates0" style="padding-left:0px;padding-top:0px;">
                                                <div class="upload"></div>
                                            </label>
                                            {{ Form::file('certificates0[]',array('class'=>'certificates','id'=>'certificates0','multiple'=>'multiple')) }}
											<span class="filename certificates0"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                </div>

                <div class="moreQualification">

                    @if(isset($errors) && isset($oldData) && count($oldData) > 1)

                        @for($i=1; $i < count($oldData); $i++)

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
                                             {{Form::text('date_completed[]',(isset($oldData[$i]['date_completed'])?$oldData[$i]['date_completed']:''), array('class'=>'dateC'))}}
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
										<i>Recommended file types: png, jpg, jpeg</i>
                                         <label for="certificates{{$i}}">
                                            <div class="upload"></div>
                                        </label>
                                        {{Form::file('certificates'.$i.'[]',array('class'=>'certificates','id'=>'certificates'.$i,'multiple'=>'multiple'))}}

                                    </div>

                                </div>

                            </div>

                        @endfor
                    @endif

                </div>
                
                <div class="addMoreLink">
                    <div class="row">
                        <div class="large-12 columns" >
                            <div class="inputWrapper pnl-border-top" style="padding-top:0px;">
                                <div class="label" id="more">
                                    {{Form::label('Add Qualification')}}
                                </div>
                            </div>    
                            <div class="inputWrapper pnl-border-top" style="margin-top:0px;">
                                <input class="submitBtn1 float-right admin-button" type="submit" value="Create User" name="register" />
                            </div> 
                        </div>
                    </div>
                </div>

                {{Form::close()}}                
            </div>
        </div>
    </div>
@stop

@section('customScripts')

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
    function addQualification() {
    
        if ($count < 10) {
        
            var $newDiv = $('<div class="row"></div>');
            $newDiv.append($clone.clone());
            $newDiv.appendTo('.moreQualification');
                        
            $count++;
        }
    }

    $('document').ready(function () {
    
        $('#more').click(function() {
            
            if ($count < 10) {
                addQualification();
                removeQualification();

                $('.certificates').each(function (index) {
                    $(this).attr('name','certificates'+index+'[]');
                    $(this).attr('id','certificates'+index);
                    $(this).prev().attr('for','certificates'+index);
                });
				
				
            }
            else 
            {
                alert('you can add only 10 qualifications at a single time');
            }
        });
    });
	
	
    $(document).on('change', 'input[type=file]', function() {
        $(this).parent().find('.filename').html('');
        var files = $(this)[0].files;
        for (var i = 0; i < files.length; i++) {
            $("<p></p>").text(files[i].name).appendTo($(this).parent().find('.filename'));
        }
    });
@stop