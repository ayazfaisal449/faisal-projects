@extends('layouts.primary')
@section('content')
    @include('include.subNav')
    <style>
        .field-icon {
  float: right;
  margin-right: 9px;
  margin-top: -42px;
  position: relative;
  z-index: 2;
}

.container{
  padding-top:50px;
  margin: auto;
}
    </style>
    <div class="row register_page_title">
        <div class="large-12 columns">
            <h1>Registration</h1>
            <p>Please complete the fields below. <b>Fields marked <i>*</i> are required.</b></p>
        </div>
    </div>
    <div class="formNumberWrapper">
        <div class="row">
            <div class="large-12 columns">
                @if (!empty($showme))
                    <img src="{!!Request::root()!!}/img/personal-details.png" alt="Step 1" />
                    <img src="{!!Request::root()!!}/img/2.png" alt="Step 2" />
                    <img src="{!!Request::root()!!}/img/3.png" alt="Step 3" />
                @endif
                <img src="{!!Request::root()!!}/img/personal-details.png" alt="Step 1" />
                <img src="{!!Request::root()!!}/img/2.png" alt="Step 2" />
                <img src="{!!Request::root()!!}/img/3.png" alt="Step 3" />
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
    {!!Form::open(array(
        'url' => Request::root().'/trainer/save',
        'files' => true, 
        'name' => 'addNewTrainer',
        'class' => 'registration'
    ))!!}
    <div class="row">
        <div class="large-6 columns">
        
            {!!Form::token()!!}
            {!!Form::hidden('form','Personal Details')!!}
            {!!Form::hidden('status_id',3)!!}
            <div class="inputWrapper">
                <div class="label">
                    {!!Form::label('first_name', 'First Name')!!}
                    <div class="error">
                        <span class="error">{!!$errors->first('first_name', ':message')!!}</span>
                        <span class="required">*</span>
                    </div>
                </div>
                {!!Form::text('first_name',request()->old('first_name'),   ['placeholder' => 'Enter your first name'])!!}
            </div>
            <div class="inputWrapper">
                <div class="label">
                    {!!Form::label('last_name', 'Last Name')!!}
                    <div class="error">
                        <span class="error">{!!$errors->first('last_name', ':message')!!}</span>
                        <span class="required">*</span>
                    </div>
                </div>
                {!!Form::text('last_name',request()->old('last_name'), ['placeholder' => 'Enter your last name'])!!}
            </div>
            <div class="inputWrapper">
                <div class="label">
                    {!!Form::label('dob', 'Date of Birth')!!}
                    <div class="error">
                        <span class="error">{!!$errors->first('dob', ':message')!!}</span>
                        <span class="required">*</span>
                    </div>
                </div>
                {!!Form::text('dob', request()->old('dob'), ['id' => 'date', 'autocomplete' => 'off', 'placeholder' => 'YYYY-MM-DD'])!!}
            </div>
            <div class="inputWrapper">
                <div class="label">
                    {!!Form::label('gender', 'Gender')!!}
                    <div class="error">
                        <span class="error">{!!$errors->first('gender', ':message')!!}</span>
                        <span class="required">*</span>
                    </div>
                </div>
                {!!Form::select('gender',$gender)!!}
            </div>
             {!!Form::hidden('membership',request()->old('membership'))!!}
        </div>
        <div class="large-6 columns">
        <div class="inputWrapper">
    <div class="label">
        {!! Form::label('city', 'City of Residence') !!}
        <div class="error">
            <span class="error">{!! $errors->first('city', ':message') !!}</span>
            <span class="required">*</span>
        </div>
       </div>
        {!! Form::select('city', ['' => 'Select any city'] + [
           'Abu Dhabi' => 'Abu Dhabi',
           'Ajman' => 'Ajman',
           'Dubai' => 'Dubai',
           'Fujairah' => 'Fujairah',
           'Sharjah' => 'Sharjah',
           'Ras Al Khaimah' => 'Ras Al Khaimah',
           'Umm Al Quwain' => 'Umm Al Quwain',
           'Others' => 'Others',
            ], request()->old('city')) !!}
         </div>
            @if (isset($showme))
                <div class="inputWrapper">
                    <div class="label">
                        {!!Form::label('passport_no', 'Passport No')!!}
                        <div class="error">
                            <span class="error">{!!$errors->first('passport_no', ':message')!!}</span>
                            <span class="required">*</span>
                        </div>
                    </div>
                    {!!Form::text('passport_no',request()->old('passport_no'))!!}
                </div>
            @endif
            <div class="inputWrapper">
                <div class="label">
                    {!!Form::label('mobile_phone', 'Mobile Phone')!!}
                    <div class="error">
                        <span class="error">{!!$errors->first('mobile_phone', ':message')!!}</span>
                        <span class="required">*</span>
                    </div>
                </div>
                {!! Form::text('mobile_phone', request()->old('mobile_phone'), ['id' => 'telephone', 'type' => 'tel', 'class' => 'numbersOnly']) !!}
            </div>
            <div class="inputWrapper">
    <div class="label">
        {!!Form::label('id_number', 'Emirates ID')!!}
    </div>
    {!!Form::text('emirates_id_no', request()->old('emirates_id_no'), ['id' => 'emirates-id-input', 'placeholder' => '784-1234-1234567-1'])!!}
</div>
            <div class="inputWrapper">
                <div class="label">
                    {!!Form::label('nationality_id', 'Nationality')!!}
                    <div class="error">
                        <span class="error">{!!$errors->first('nationality_id', ':message')!!}</span>
                        <span class="required">*</span>
                    </div>
                </div>
                {!!Form::select('nationality_id',$nationality,request()->old('nationality_id'))!!}
            </div>
    </div>

    <div class="large-12 columns">
    <div class="trainerSubTitle">
        <div class="row">
            <div class="large-12 columns">
                <div class="errorWrapper">
                    <h3>Emirates ID Photo</h3>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="large-12 columns">
    <div class="row">
        <div class="large-12 columns">
            <i>Recommended file types:  Images only (PNG, JPG, JPEG, GIF)</i>
            <label for="image">
                <div class="upload"></div>
            </label>
            {!!Form::file('image',array('id'=>'image','accept'=>'image/*'))!!}  
            <span class="filename image"></span>
        </div>
    </div>
    </div>
    
    <div class="large-12 columns">
    <div class="trainerSubTitle">
        <div class="row">
            <div class="large-12 columns">
                <div class="errorWrapper">
                    <h3>Photo Upload</h3>
                    <span class="error">* {!!$errors->first('photo', ':message')!!}</span>
                    <!-- <span class="error">* {!!$errors->first('photo', ':message').$errors->first('photo_dimensions', ':message')!!}</span> -->
                </div>
            </div>
        </div>
    </div>
    </div>
    
    <div class="large-12 columns">
    <div class="row">
        <div class="large-12 columns">
            <!-- <i>Recommended size: Passport size (130px by 170px)</i><br /> -->
            <i>Accepted file types:  Images only (PNG, JPG, JPEG, GIF)</i>
            <label for="photo">
                <div class="upload"></div>
            </label>
            {!!Form::file('photo',array('id'=>'photo','accept'=>'image/*'))!!}
            <span class="filename photo"></span>
        </div>
    </div>
    </div>

    <div class="large-12 columns">
    <div class="trainerSubTitle">
        <div class="row">
            <div class="large-12 columns">
                <h3>Login Details</h3>
            </div>
        </div>
    </div>
    </div>

        <div class="large-12 columns">
            <i>An email address and password of your choice is required to enable you to login to REPs.</i>
        </div>

        <div class="large-6 columns">
            <div class="inputWrapper">
                <div class="label">
                    {!!Form::label('email', 'Email Address')!!}
                    <div class="error">
                        <span class="error">{!!$errors->first('email', ':message')!!}</span>
                        <span class="required">*</span>
                    </div>
                </div>
                {!!Form::email('email',request()->old('email'))!!}
            </div>
        </div>
        <div class="large-12 columns">
          <div class="row">

        <div class="large-6 columns">  
            <div class="inputWrapper">
                <div class="label">
                {!!Form::label('password', 'Password')!!}
                    <div class="error">
                        <span class="error">{!!$errors->first('password', ':message')!!}</span>
                        <span class="required">*</span>
                    </div>
                </div>
                {!!Form::password('password',array('id'=>'password'))!!}
                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
        </div>

  <div class="large-6 columns">
     <div class="inputWrapper">
         <!-- Confirm Password Field -->
         <div class="label">
             {!! Form::label('confirm_password', 'Confirm Password') !!}
         </div>
         <div class="password-container">
             {!! Form::password('confirm_password', ['class' => 'password-input', 'id' => 'confirm_password']) !!}
             <span toggle="#confirm_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
         </div>
     </div>
 </div>

    </div>
    </div>
    <div class="large-12 columns">
    <div class="continueBtnWrapper">
        <div class="row">
            <div class="large-2 large-offset-10 columns">
                <input class="submitBtn" type="submit" value="Continue" name="register" />
            </div>
        </div>
    </div>
    </div>
    {!!Form::close()!!}
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


    jQuery('.numbersOnly').keyup(function () {
    // Remove all non-numeric characters and limit the input to 15 digits
    this.value = this.value.replace(/[^0-9]/g, '').substring(0, 15);
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

    $('#image').change(
    function() {
        var file = this.files[0],
            img;
            var fileExtension = ['png', 'jpeg', 'jpg', 'gif'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert('The uploaded file must be in one of the following formats: .png, .jpg, .jpeg, or .gif.');
            this.value = ''; // Clean field
            return false;
        }
    });
    $('#photo').change(
    function() {
        var file = this.files[0],
            img;
            var fileExtension = ['png', 'jpeg', 'jpg', 'gif'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert('The uploaded file must be in one of the following formats: .png, .jpg, .jpeg, or .gif.');
            this.value = ''; // Clean field
            return false;
        }
    });

    $('#emirates-id-input').inputmask("999-9999-9999999-9");



   $(document).ready(function() {
      
    let phoneInput = $("#telephone").intlTelInput({
    // options here
    hiddenInput: "full_phone",
    allowDropdown:true,
    autoInsertDialCode:true,
    autoPlaceholder:"polite",
    customPlaceholder:null,
    dropdownContainer:null,
    excludeCountries: [],
    formatOnDisplay:true,
    geoIpLookup:null,
    placeholderNumberType:"MOBILE",
    preferredCountries: ["ae","gb" ],
    showFlags:true,
    separateDialCode:false,
    utilsScript:"https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js"
  })
   });

   $(document).ready(function () {
    $(".toggle-password").click(function() {

$(this).toggleClass("fa-eye fa-eye-slash");
var input = $($(this).attr("toggle"));
if (input.attr("type") == "password") {
  input.attr("type", "text");
} else {
  input.attr("type", "password");
}
});
});

@stop
