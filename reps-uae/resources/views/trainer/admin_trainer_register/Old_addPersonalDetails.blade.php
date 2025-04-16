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
        background: url('/../img/upload2.png?1396939870');
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
</style>
    <div class="tools">
        <h1>Add Trainer</h1>
        <div class="component" style="padding:0px 12px 12px;">		
            <p>Please complete the fields below. <b>Fields marked <i>*</i> are required.</b></p>
            <div class="clearfix"></div>
            <div class="tab_panel">
                <span class="tab_label tab_active">Personal Details</span>
                <span class="tab_label">Work Experience</span>
                <span class="tab_label">Qualifications</span>
            </div>
            <div class="clearfix"></div>
            <div class="the_form_content">
                {{Form::open(array(
                    'url' => Request::root().'/admin/trainer/save',
                    'files' => true, 
                    'name' => 'addNewTrainer',
                    'class' => 'registration'
                ))}}
                <div class="row">
                    <div class="large-6 columns">
                        {{Form::token();}}
                        {{Form::hidden('form','Personal Details')}}
                        {{Form::hidden('status_id',3)}}
                        <div class="inputWrapper">
                            <div class="label">
                                {{Form::label('first_name', 'First Name')}}
                                <div class="error">
                                    <span class="error">{{$errors->first('first_name', ':message')}}</span>
                                    <span class="required">*</span>
                                </div>
                            </div>
                            {{Form::text('first_name',Input::old('first_name'))}}
                        </div>

                        <div class="inputWrapper">
                            <div class="label">
                                {{Form::label('last_name', 'Last Name')}}
                                <div class="error">
                                    <span class="error">{{$errors->first('last_name', ':message')}}</span>
                                    <span class="required">*</span>
                                </div>
                            </div>
                            {{Form::text('last_name',Input::old('last_name'))}}
                        </div>
                        
                        <div class="inputWrapper">
                            <div class="label">
                                {{Form::label('gender', 'Gender')}}
                                <div class="error">
                                    <span class="error">{{$errors->first('gender', ':message')}}</span>
                                    <span class="required">*</span>
                                </div>
                            </div>
                            {{Form::select('gender',$gender)}}
                        </div>

                        <div class="inputWrapper">
                            <div class="label">
                                {{Form::label('dob', 'Date of Birth')}}
                                <div class="error">
                                    <span class="error">{{$errors->first('dob', ':message')}}</span>
                                    <span class="required">*</span>
                                </div>
                            </div>
                            {{Form::text('dob',Input::old('dob'),array('id'=>'date'))}}
                        </div>
                    </div>

                    <div class="large-6 columns">
                        
                        <div class="inputWrapper">
                            <div class="label">
                                {{Form::label('nationality_id', 'Nationality')}}
                                <div class="error">
                                    <span class="error">{{$errors->first('nationality_id', ':message')}}</span>
                                    <span class="required">*</span>
                                </div>
                            </div>
                            {{Form::select('nationality_id',$nationality,Input::old('nationality_id'))}}
                        </div>

                        <div class="inputWrapper">
                            <div class="label">
                                {{Form::label('mobile_phone', 'Mobile Phone')}}
                                <div class="error">
                                    <span class="error">{{$errors->first('mobile_phone', ':message')}}</span>
                                    <span class="required">*</span>
                                </div>
                            </div>
                            {{Form::text('mobile_phone',Input::old('mobile_phone'))}}
                        </div>
                        
                        @if (isset($showme))
                            <div class="inputWrapper">
                                <div class="label">
                                    {{Form::label('status_id', 'Status')}}
                                    <div class="error">
                                        <span class="error">{{$errors->first('status_id', ':message')}}</span>
                                    </div>
                                </div>
                                {{Form::select('status_id',array('1'=>'Provisional','2'=>'Full','3'=>'Not Allocated'),Input::old('status_id'))}}
                            </div>

                        
                            <div class="inputWrapper">
                                <div class="label">
                                    {{Form::label('passport_no', 'Passport No')}}
                                    <div class="error">
                                        <span class="error">{{$errors->first('passport_no', ':message')}}</span>
                                    </div>
                                </div>
                                {{Form::text('passport_no',Input::old('passport_no'))}}
                            </div>
                        @endif
                        
                        <div class="inputWrapper">
                            <div class="label">
                                {{Form::label('work_email', 'Work Email')}}
                                <div class="error">
                                    <span class="error">{{$errors->first('work_email', ':message')}}</span>
                                </div>
                            </div>
                            {{Form::text('work_email',Input::old('work_email'))}}
                        </div>

                        <div class="inputWrapper">
                            <div class="label">
                                {{Form::label('city', 'City of Residence')}}
                                <div class="error">
                                    <span class="error">{{$errors->first('city', ':message')}}</span>
                                    <span class="required">*</span>
                                </div>
                            </div>
                            {{Form::text('city',Input::old('city'))}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="large-12 columns">
                        <div class="inputWrapper pnl-border-top">
                            <div class="label">
                                {{Form::label('Upload Photo')}}
                                <div class="error">
                                    <span class="error">{{$errors->first('photo', ':message').$errors->first('photo_dimensions', ':message')}}</span>
                                    <span class="required">*</span>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="large-12 columns">

                        <i>Recommended size: Passport size (130px by 170px)</i><br />
                        <i>Accepted file types:  Images only (PNG, JPG, GIF)</i>

                        <label for="photo" style="padding-left:0px;">
                            <div class="upload"></div>
                        </label>
                        {{Form::file('photo',array('id'=>'photo'))}}
						<span class="filename photo"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="large-12 columns">
                        <div class="inputWrapper pnl-border-top">
                            <div class="label">
                                {{Form::label('Login Details')}}
                            </div>
                        </div>                        
                    </div>
                    <div class="large-6 columns">
                        <div class="inputWrapper">
                            <div class="label">
                                {{Form::label('email', 'Email Address')}}
                                <div class="error">
                                    <span class="error">{{$errors->first('email', ':message')}}</span>
                                    <span class="required">*</span>
                                </div>
                            </div>
                            {{Form::email('email',Input::old('email'))}}
                        </div>
                    </div>
                    <div class="large-6 columns">  
                        <div class="inputWrapper">
                            <div class="label">
                                {{Form::label('password', 'Password')}}
                                <div class="error">
                                    <span class="error">{{$errors->first('password', ':message')}}</span>
                                    <span class="required">*</span>
                                </div>
                            </div>
                            {{Form::password('password')}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="large-12 columns">
                        <div class="inputWrapper pnl-border-top">
                            <input class="submitBtn1 float-right admin-button" type="submit" value="Continue" name="register" />
                        </div>   
                    </div>
                </div>

                {{Form::close()}}
            </div>
        </div>
    </div>
@stop


@section('customScripts') 
    $(function() {
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
	$(document).ready(function(){
		$("input[type=file]").change(function() { 
			$('.filename.' + $(this).attr('id')).empty();
			var files = $(this)[0].files;
			for (var i = 0; i < files.length; i++) {
				var $p = $("<p></p>").text(files[i].name).appendTo('.filename.' + $(this).attr('id'));
			}
		});
	});
@stop