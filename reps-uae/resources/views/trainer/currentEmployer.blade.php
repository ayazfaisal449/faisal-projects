@extends('layouts.primary')

@section('content')     

    @include('include.subNav')
    
    <div class="row">
        <div class="large-12 columns">
            <h1>Work Place</h1>
            <p>Update your Work Place & Current Employer. <b>Fields marked <i>*</i> are required.</b></p>
        </div>
    </div>
          
    {!!Form::open(array(
        'url' => Request::root().'/trainer/dashboard/updateCurrentEmployer',
        'files' => true, 
        'name' => 'addNewTrainer',
        'class' => 'registration'
    ))!!}
    
    <div class="trainerSubTitle">
        <div class="row">
            <div class="large-12 columns">
                <div class="errorWrapper">
                    <h3>Job Title</h3>
                    <span class="error">* {!!$errors->first('job_title', ':message')!!}</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="large-4 columns end">
            {!!Form::text('job_title',$workExp->job_title)!!}
            
            {!!Form::token()!!}
            {!!Form::hidden('trainer_id',$trainer->id)!!}
            {!!Form::hidden('user_id',$user->id)!!}
            {!!Form::hidden('id',$workExp->id)!!}
        </div>
    </div>
    
    <div class="trainerSubTitle">
        <div class="row">
            <div class="large-12 columns">
                <div class="errorWrapper">
                    <h3>Your Work Place</h3>
                    <span class="error">* {!!(isset($work_place['empty']['error']) ? $work_place['empty']['error']: '')!!}</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="large-4 columns end">
            @if(isset($work_place))
                @if(isset($work_place['validData']) && count($work_place['validData']) > 0)
                    @for($i= 0; $i<count($work_place['validData']);$i++)
                        <div class="inputWrapper">
                            <span class="error">
                                {!!isset($work_place['validData']['error'][$i])?$work_place['validData']['error'][$i]:''!!}
                            </span>
                            {!!Form::text('work_place[]',$work_place['data'][$i])!!}
                        </div>
                    @endfor
                @else
                    @if(isset($work_place['data']) && count($work_place['data']) > 0)
                        @foreach($work_place['data'] as $value)
                            {!!Form::text('work_place[]',$value)!!}
                        @endforeach
                    @else
                        {!!Form::text('work_place[]','')!!}
                        {!!Form::text('work_place[]','')!!}
                        {!!Form::text('work_place[]','')!!}
                    @endif
                @endif
            @else
                {!!Form::text('work_place[]','')!!}
                {!!Form::text('work_place[]','')!!}
                {!!Form::text('work_place[]','')!!}
            @endif
        </div>
    </div>
    
    <div class="trainerSubTitle">
        <div class="row">
            <div class="large-12 columns">
                <div class="errorWrapper">
                    <h3>Upload Your CV</h3>
                    <span class="error">* {!!$errors->first('cv', ':message')!!}</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="large-6 columns">

            <i>Accepted file types:  Documents only (PDF, DOC)</i><br />
            <i>Limit size to 256000b</i>

            <label for="cv">
                <div class="upload"></div>
            </label>
            {!!Form::file('cv',array('id'=>'cv'))!!}
			<span class="filename cv" style="margin-left: 20px;"></span>
        </div>
        
        <div class="large-6 columns">
            <div class="currentCv">
                <h6>Download your current CV</h6>
                @if (!empty($workExp->cv))
                    <p><a href="{!!Request::root()!!}/trainer/{!!$user->id!!}/cv/{!!$workExp->cv!!}">Current CV: <strong style="text-decoration:underline;">{!!$workExp->cv!!}</strong></a></p>
                @else
                    <p style="color:#c0c0c0;">You have not yet uploaded your CV.</p>
                @endif
            </div>
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




            
           