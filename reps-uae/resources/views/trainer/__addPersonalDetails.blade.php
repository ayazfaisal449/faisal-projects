@extends('layouts.primary')
@section('content')
    
    @include('include.subNav')
    
    <div class="row">
        <div class="large-12 columns">
            <h1>Registration</h1>
            <p>Please complete the fields below. <b>Fields marked <i>*</i> are required.</b></p>
        </div>
    </div>
    
    <div class="formNumberWrapper">
        <div class="row">
            <div class="large-12 columns">
                @if (!empty($showme))
                    <img src="{{Request::root()}}/img/personal-details.png" alt="Step 1" />
                    <img src="{{Request::root()}}/img/2.png" alt="Step 2" />
                    <img src="{{Request::root()}}/img/3.png" alt="Step 3" />
                @endif
                <img src="{{Request::root()}}/img/personal-details.png" alt="Step 1" />
                <img src="{{Request::root()}}/img/2.png" alt="Step 2" />
                <img src="{{Request::root()}}/img/3.png" alt="Step 3" />
            </div>
        </div>
    </div>
    
    <div class="trainerSubTitle">
        <div class="row">
            <div class="large-12 columns">
                <h3>Personal Details</h3>
            </div>
        </div>
    </div>
    
    {{Form::open(array(
        'url' => Request::root().'/trainer/save',
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
                    {{Form::label('dob', 'Date of Birth')}}
                    <div class="error">
                        <span class="error">{{$errors->first('dob', ':message')}}</span>
                        <span class="required">*</span>
                    </div>
                </div>
                {{Form::text('dob',Input::old('dob'),array('id'=>'date'))}}
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
                    {{Form::label('nationality_id', 'Nationality')}}
                    <div class="error">
                        <span class="error">{{$errors->first('nationality_id', ':message')}}</span>
                        <span class="required">*</span>
                    </div>
                </div>
                {{Form::select('nationality_id',$nationality,Input::old('nationality_id'))}}
            </div>

            
                {{Form::hidden('membership',Input::old('membership'))}}
            
        </div>
        
        <div class="large-6 columns">
        
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
            
            
            <div class="inputWrapper">
                <div class="label">
                    {{Form::label('po_box', 'P.O. Box')}}
                    <div class="error">
                        <span class="error">{{$errors->first('po_box', ':message')}}</span>
                        <span class="required">*</span>
                    </div>
                </div>
                {{Form::text('po_box',Input::old('po_box'))}}
            </div>
            
            @if (isset($showme))
                <div class="inputWrapper">
                    <div class="label">
                        {{Form::label('passport_no', 'Passport No')}}
                        <div class="error">
                            <span class="error">{{$errors->first('passport_no', ':message')}}</span>
                            <span class="required">*</span>
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
                    {{Form::label('mobile_phone', 'Mobile Phone')}}
                    <div class="error">
                        <span class="error">{{$errors->first('mobile_phone', ':message')}}</span>
                        <span class="required">*</span>
                    </div>
                </div>
                {{Form::text('mobile_phone',Input::old('mobile_phone'))}}
            </div>

            <div class="inputWrapper">
                <div class="label">
                    {{Form::label('id_number', 'Emirates ID')}}
                   <!--  <div class="error">
                        <span class="error">{{$errors->first('id_number', ':message')}}</span>
                        <span class="required">*</span>
                    </div> -->
                </div>
                {{Form::text('emirates_id_no',Input::old('emirates_id_no'))}}
            </div>
    </div>
    
    <div class="trainerSubTitle">
        <div class="row">
            <div class="large-12 columns">
                <div class="errorWrapper">
                    <h3>Emirates ID Photo</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <i>Recommended file types:  Images only (PNG, JPG, GIF)</i>
            <label for="image">
                <div class="upload"></div>
            </label>
            {{Form::file('image',array('id'=>'image'))}}  
            <span class="filename image"></span>
        </div>
    </div>

    <div class="trainerSubTitle">
        <div class="row">
            <div class="large-12 columns">
                <div class="errorWrapper">
                    <h3>Photo Upload</h3>
                    <span class="error">* {{$errors->first('photo', ':message').$errors->first('photo_dimensions', ':message')}}</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="large-12 columns">
            <i>Recommended size: Passport size (130px by 170px)</i><br />
            <i>Accepted file types:  Images only (PNG, JPG, GIF)</i>
            <label for="photo">
                <div class="upload"></div>
            </label>
            {{Form::file('photo',array('id'=>'photo'))}}
            <span class="filename photo"></span>
        </div>
    </div>
    
    <div class="trainerSubTitle">
        <div class="row">
            <div class="large-12 columns">
                <h3>Login Details</h3>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="large-12 columns">
            <i>An email address and password of your choice is required to enable you to login to REPs.</i>
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
    
    <div class="continueBtnWrapper">
        <div class="row">
            <div class="large-2 large-offset-10 columns">
                <input class="submitBtn" type="submit" value="Continue" name="register" />
            </div>
        </div>
    </div>
    
    {{Form::close()}}
    
    @include('include.subFooter')
    
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