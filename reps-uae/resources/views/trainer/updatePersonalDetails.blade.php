@extends('layouts.primary')
@section('content') 
    
    @include('include.subNav')
    
    <div class="row">
        <div class="large-6 columns">
            <h1>Personal Details</h1>
            <p>Update your Personal Details. <b>Fields marked <i>*</i> are required.</b></p>
        </div>
          <div class="large-6 columns">
          <img class="photograph" src="{!!Request::root()!!}/images/REPs member logo.jpg" alt="Trainer ID Photo"  width="110" height="200" style="position: relative;float: right;" />
      </div>
    </div>
  

    
    {!!Form::open(array(
        'url' => Request::root().'/trainer/dashboard/update-personal-details',
        'files' => true, 
        'name' => 'updateTrainerPersonalDetails',
        'class' => 'registration'
    ))!!}
            
    {!!Form::token()!!}
    {!!Form::hidden('form','Personal Details')!!}
    {!!Form::hidden('trainer_id',$trainer->id)!!}
    {!!Form::hidden('user_id',$user->id)!!}
            
    <div class="row">
        <div class="large-6 columns">
            
            <div class="inputWrapper">
                <div class="label">
                    {!!Form::label('first_name', 'First Name')!!}
                    <div class="error">
                        <span class="error">{!!$errors->first('first_name', ':message')!!}</span>
                        <span class="required">*</span>
                    </div>
                </div>
                {!!Form::text('first_name',$user->first_name)!!}
            </div>
            
            <div class="inputWrapper">
                <div class="label">
                    {!!Form::label('last_name', 'Last Name')!!}
                    <div class="error">
                        <span class="error">{!!$errors->first('last_name', ':message')!!}</span>
                        <span class="required">*</span>
                    </div>
                </div>
                {!!Form::text('last_name',$user->last_name)!!}
            </div>
            
            <div class="inputWrapper">
                <div class="label">
                    {!!Form::label('dob', 'Date of Birth')!!}
                    <div class="error">
                        <span class="error">{!!$errors->first('dob', ':message')!!}</span>
                        <span class="required">*</span>
                    </div>
                </div>
                {!!Form::text('dob',$trainer->dob,array('id'=>'date'))!!}
            </div>
            
            <div class="inputWrapper">
                <div class="label">
                    {!!Form::label('gender', 'Gender')!!}
                    <div class="error">
                        <span class="error">{!!$errors->first('gender', ':message')!!}</span>
                        <span class="required">*</span>
                    </div>
                </div>
                {!!Form::select('gender',$gender,$trainer->gender)!!}
            </div>
            
            <div class="inputWrapper">
                <div class="label">
                    {!!Form::label('nationality_id', 'Nationality')!!}
                    <div class="error">
                        <span class="error">{!!$errors->first('nationality_id', ':message')!!}</span>
                        <span class="required">*</span>
                    </div>
                </div>
                {!!Form::select('nationality_id',$nationality,$trainer->nationality_id)!!}
            </div>
            
        </div>
        
        <div class="large-6 columns">
        
             <div class="inputWrapper">
                <div class="label">
                    {!!Form::label('city', 'City of Residence')!!}
                    <div class="error">
                        <span class="error">{!!$errors->first('city', ':message')!!}</span>
                        <span class="required">*</span>
                    </div>
                </div>
                {!!Form::text('city',$trainer->city)!!}
            </div>
            
            <div class="inputWrapper">
                <div class="label">
                    {!!Form::label('mobile_phone', 'Mobile Phone')!!}
                    <div class="error">
                        <span class="error">{!!$errors->first('mobile_phone', ':message')!!}</span>
                        <span class="required">*</span>
                    </div>
                </div>
                {!!Form::text('mobile_phone',$trainer->mobile_phone)!!}
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
                    {!!Form::text('passport_no',$trainer->passport_no)!!}
                </div>
            @endif
            
             <div class="inputWrapper">
                <div class="label">
                    {!!Form::label('emirates_id_no', 'Emirates ID')!!}
                    <!-- <div class="error">
                        <span class="error">{!!$errors->first('emirates_id_no', ':message')!!}</span>
                        <span class="required">*</span>
                    </div> -->
                </div>
                {!!Form::text('emirates_id_no',$trainer->emirates_id_no, ['id' => 'emirates-id-input'])!!}
            </div>

              <div class="inputWrapper">
                <div class="label">
                    {!!Form::label('membership', 'Membership Number')!!}
                    <!-- <div class="error">
                        <span class="error">{!!$errors->first('emirates_id_no', ':message')!!}</span>
                        <span class="required">*</span>
                    </div> -->
                </div>
                {!!Form::text('membership',$trainer->membership,  ['readonly'])!!}
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
        <div class="large-6 columns">
            <i>Recommended file types:  Images only (PNG, JPG, JPEG, GIF)</i>
            <label for="image">
                <div class="upload"></div>
            </label>
            {!!Form::file('image',array('id'=>'image'))!!}
            <span class="filename image" style="margin-left: 20px;"></span>
        </div>
        <div class="large-6 columns">
            @if($trainer->image) 
                <img class="photograph" src="{!!Request::root()!!}/trainer/{!!$user->id!!}/image/{!!$trainer->image!!}" alt="Trainer ID Photo" />
            @endif
        </div>
    </div>
    
    <div class="trainerSubTitle">
        <div class="row">
            <div class="large-12 columns">
                <div class="errorWrapper">
                    <h3>Photo Upload</h3>
                    <span class="error">* {!!$errors->first('photo', ':message').$errors->first('photo_dimensions', ':message')!!}</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="large-6 columns">
            <i>Recommended size: Passport size (130px by 170px)</i><br />
            <i>Accepted file types:  Images only (PNG, JPG, JPEG, GIF)</i>
            <label for="photo">
                <div class="upload"></div>
            </label>
            {!!Form::file('photo',array('id'=>'photo'))!!}
            <span class="filename photo" style="margin-left: 20px;"></span>
        </div>
        <div class="large-6 columns">
            <img class="photograph" src="{!!Request::root()!!}/trainer/{!!$user->id!!}/photo/{!!$trainer->photo!!}" alt="Trainer PhotoGraph" />
        </div>
    </div>
    
    <div class="continueBtnWrapper">
        <div class="row">
            <div class="large-2 large-offset-10 columns">
                <input class="submitBtn" type="submit" value="Update" name="register" />
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

@stop

