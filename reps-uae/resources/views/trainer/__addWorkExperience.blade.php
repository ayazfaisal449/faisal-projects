@extends('layouts.primary')

@section('content')     
    
    @include('include.subNav')
    
    <div class="row">
        <div class="large-12 columns">
            <h1>Work Place & Level of Registration </h1>
            <p>Please complete the fields below. <b>Fields marked * are required.</b></p>
        </div>
    </div>
    
    <div class="formNumberWrapper">
        <div class="row">
            <div class="large-12 columns">
                @if (!empty($showme))
                    <a href="{{Request::root()}}/trainer/registration"><img src="{{Request::root()}}/img/1.png" alt="Step 1" /></a>
                    <img src="{{Request::root()}}/img/work-place.png" alt="Step 2" />
                    <img src="{{Request::root()}}/img/3.png" alt="Step 3" />
                @endif
                <img src="{{Request::root()}}/img/1.png" alt="Step 1" />
                <img src="{{Request::root()}}/img/work-place.png" alt="Step 2" />
                <img src="{{Request::root()}}/img/3.png" alt="Step 3" />
            </div>
        </div>
    </div>
    
    {{Form::open(array(
        'url' => Request::root().'/trainer/save',
        'files' => true, 
        'name' => 'addNewTrainer',
        'class' => 'registration'
    ))}}
    
    <div class="trainerSubTitle">
        <div class="row">
            <div class="large-12 columns">
                <div class="errorWrapper">
                    <h3>Job Title</h3>
                    <span class="error">* {{$errors->first('job_title', ':message')}}</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="large-4 columns end">
            {{Form::text('job_title',Input::old('job_title'))}}
            
            {{Form::token();}}
            {{Form::hidden('form','Work Experience')}}
            {{Form::hidden('email',$email)}}
        </div>
    </div>
    
     <div class="trainerSubTitle">
        <div class="row">
            <div class="large-12 columns">
                <div class="errorWrapper">
                    <h3>Your Work Place</h3>
                    <span class="error">* {{(isset($work_place['empty']['error']) ? $work_place['empty']['error']: '')}}</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="large-4 columns end">
            @if(isset($work_place))
                @if(isset($work_place['validData']) && count($work_place['validData']) > 0)
                    @for($i= 0; $i<count($work_place['empty']['data']);$i++)
                        <div class="inputWrapper">
                            @if(isset($work_place['validData']['error'][$i]))
                                <div class="label">
                                    <div class="error">
                                        <span class="error">
                                            {{$work_place['validData']['error'][$i]}}
                                        </span>
                                    </div>
                                </div>
                            @endif
                            {{Form::text('work_place[]',$work_place['empty']['data'][$i])}}
                        </div>
                    @endfor
                @else
                    @if(isset($work_place['data']) && count($work_place['data']) > 0)
                        @foreach($work_place['data'] as $value)
                            {{Form::text('work_place[]',$value)}}
                        @endforeach
                    @else
                        {{Form::text('work_place[]','')}}
                        {{Form::text('work_place[]','')}}
                        {{Form::text('work_place[]','')}}
                    @endif
                @endif
            @else
                {{Form::text('work_place[]','')}}
                {{Form::text('work_place[]','')}}
                {{Form::text('work_place[]','')}}
            @endif
        </div>
    </div>
    
    <div class="trainerSubTitle">
        <div class="row">
            <div class="large-12 columns">
                <div class="errorWrapper">
                    <h3>Current Country You Work On</h3>
                    <span class="error">* {{$errors->first('country_id', ':message')}}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="large-4 columns end">
            {{Form::select('country_id',$countries,Input::old('country_id') ? Input::old('country_id') : 234)}}
            
        </div>
    </div>

    <div class="trainerSubTitle">
        <div class="row">
            <div class="large-4 columns">
                <div class="errorWrapper">
                    <h3>Upload Your CV</h3>
                    <span class="error">{{$errors->first('cv', ':message')}}</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="large-12 columns">
            <i>Accepted file types:  Documents only (PDF, DOC)</i><br />
            <i>Limit size to 8MB</i>
            <label for="cv">
                <div class="upload"></div>
            </label>
            {{Form::file('cv',array('id'=>'cv'))}}
            <span class="filename cv"></span>
        </div>
    </div>
    
    <div class="trainerSubTitle">
        <div class="row">
            <div class="large-12 columns">
                <div class="errorWrapper">
                    <h3>Level of Registration</h3>
                    <span class="error">* {{$errors->first('registration_category_id', ':message')}}</span>
                </div>
            </div>
        </div>
    </div>
          
     <div class="row">
         <?php $x = 0; ?>
         @foreach($regCategory as $reg)
            <?php if ($x >= $regCategory->count() - 1) { $r = ' end'; } else { $r = ''; } ?>
            <div class="large-7 columns{{$r}}">
                <div class="regLevelCheckBox clearfix">
                    {{Form::label('reg'.$reg->id, ''.$reg->level)}}
                    {{Form::checkbox('registration_category_id[]', $reg->id, '',array('id' => 'reg'.$reg->id))}}
                </div>
            </div>
            <?php $x++; ?>
        @endforeach
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





            
           