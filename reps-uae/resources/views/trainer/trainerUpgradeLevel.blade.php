@extends('layouts.primary')

@section('content')

    @include('include.subNav')
    
    <div class="row">
        <div class="large-12 columns">
            <h1>Apply to Upgrade your Level and Category</h1>
            <p>Please complete the fields below. <b>Fields marked * are required.</b></p>
        </div>
    </div>
    
    <div class="row">
        <div class="large-12 columns">
            <h5>You Current Level and Category<h5>
            @foreach($trainerReg as $trainerRegCat)
                <p>{!!$trainerRegCat['level']!!}<p>
            @endforeach
        </div>
    </div>
    
    {!!Form::open(array(
        'url' => Request::root().'/trainer/dashboard/upgrade-level-category',
        'files' => true, 
        'name' => 'addNewTrainer',
        'class' => 'registration'
    ))!!}
    
    {!!Form::hidden('trainer_id',$trainer->id)!!}
    {!!Form::hidden('user_id',$user->id)!!}
    
    <div class="trainerSubTitle">
        <div class="row">
            <div class="large-12 columns">
                <div class="errorWrapper">
                    <h3>Select the Level and Category</h3>
                    <span class="error">* {!!$errors->first('category', ':message')!!}</span>
                </div>
            </div>
        </div>
    </div>
          
    <div class="row">
        @foreach($regCategory as $reg)
            <div class="large-6 columns">
                <div class="regLevelCheckBox clearfix">
                    {!!Form::label('reg'.$reg->id, ' '.$reg->level)!!}
                    <?php /*?>{!!Form::radio('category', $reg->id, '',array('id' => 'reg'.$reg->id))!!}<?php */?>
					{!!Form::checkbox('category[]', $reg->id, '',array('id' => 'reg'.$reg->id))!!}
                </div>
            </div>
        @endforeach
    </div>  
    
    <div class="trainerSubTitle">
        <div class="row">
            <div class="large-12 columns">
                <div class="errorWrapper">
                    <h3>Add the Qualification for your selected Level and Category</h3>
                    <span class="error">* </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="qualification">
        
            <div class="large-6 columns">
                
                <div class="inputWrapper">
                    <div class="label">
                        {!!Form::label('course_name', 'Name of Course ')!!}
                        <div class="error">
                            <span class="error">{!!$errors->first('course_name', ':message')!!}</span>
                        </div>
                    </div>
                    {!!Form::text('course_name',request()->old('course_name'))!!}
                </div>

                <div class="inputWrapper">
                    <div class="label">
                    {!!Form::label('course_provider', 'Course Provider')!!}
                        <div class="error">
                            <span class="error">{!!$errors->first('course_provider', ':message')!!}</span>
                        </div>
                    </div>
                    {!!Form::text('course_provider',request()->old('course_provider'))!!}
                </div>
                
                <div class="inputWrapper">
                    <div class="label">
                    {!!Form::label('date_completed', 'Date Completed')!!}
                        <div class="error">
                            <span class="error">{!!$errors->first('date_completed', ':message')!!}</span>
                        </div>
                    </div>
                    {!!Form::text('date_completed',request()->old('date_completed'),array('class'=>'dateC'))!!}
                </div>
            
            </div>
            
             <div class="large-6 columns">
             
                <div class="qualificationCertificate trainerSubTitle">
                    <div class="row">
                        <div class="large-12 columns">
                            <div class="errorWrapper">
                                <h3>Upload Certificates</h3>
                                <span class="error">* {!!$errors->first('certificate', ':message')!!}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <i>Maximum of 1 Certificates only</i><br>
				<i>Recommended file types: pdf, doc, docx, png, jpg</i>
                <label for="certificate">
                    <div class="upload"></div>
                </label>
                {!!Form::file('certificate',array('class'=>'certificate','id'=>'certificate'))!!}
				<span class="filename certificate" style="margin-left: 25px;"></span>
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
    
    {!!Form::close()!!}
     
    @include('include.subFooter')
     
 @stop
 
@section('customScripts') 
    $(function() {
        $(".dateC").datepicker({
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
