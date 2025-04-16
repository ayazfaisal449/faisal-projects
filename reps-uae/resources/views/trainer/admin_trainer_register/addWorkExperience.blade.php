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
    .the_form_content form.registration .regLevelCheckBox {
        border-bottom:0px;
        margin: 5px 0;
    }
    .the_form_content form.registration .regLevelCheckBox label {
        padding-left:0px;
    }
</style>
    <div class="tools">
        <h1>Add Trainer</h1>
        <div class="component" style="padding:0px 12px 12px;">		
            <p>Please complete the fields below. <b>Fields marked <i>*</i> are required.</b></p>
            <div class="clearfix"></div>
            <div class="tab_panel">
                <span class="tab_label">Personal Details</span>
                <span class="tab_label tab_active">Work Experience</span>
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
                        <div class="inputWrapper">
                            <div class="label">
                                {{Form::label('job_title', 'Job Title')}}
                                <div class="error">
                                    <span class="error">{{$errors->first('job_title', ':message')}}</span>
                                    <span class="required">*</span>
                                </div>
                            </div>
                            {{Form::text('job_title',Input::old('job_title'))}}
                            {{Form::token();}}
                            {{Form::hidden('form','Work Experience')}}
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="large-12 columns">
                        <div class="inputWrapper pnl-border-top">
                            <div class="label">
                                {{Form::label('Your Workplace')}}
                                <div class="error">
                                    <span class="error">{{(isset($work_place['empty']['error']) ? $work_place['empty']['error']: '')}}</span>
                                    <span class="required">*</span>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="large-6 columns">
                        @if(isset($work_place))
                            @if(isset($work_place['validData']) && count($work_place['validData']) > 0)
                                @for($i= 0; $i < count($work_place['empty']['data']);$i++)
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
                
                <div class="row">
                    <div class="large-12 columns">
                        <div class="inputWrapper pnl-border-top">
                            <div class="label">
                                {{Form::label('Upload Your CV')}}
                                <div class="error">
                                    <span class="error">{{$errors->first('cv', ':message')}}</span>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="large-12 columns">
						<i>Recommended file types: pdf, doc, docx</i>
                        <label for="cv" style="padding-left:0px;">
                            <div class="upload"></div>
                        </label>
                        {{Form::file('cv',array('id'=>'cv'))}}
						<span class="filename cv"></span>
                    </div>
                </div>
                
                <div class="row">
                    <div class="large-12 columns">
                        <div class="inputWrapper pnl-border-top">
                            <div class="label">
                                {{Form::label('Level of Registration')}}
                                <div class="error">
                                    <span class="error">{{$errors->first('registration_category_id', ':message')}}</span>
                                    <span class="required">*</span>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <?php $x=1; ?>
                    @foreach($regCategory as $reg)
                        <div class="large-6 columns">
                            <div class="regLevelCheckBox clearfix">
                                {{Form::label('reg'.$reg->id, ' '.$reg->level)}}
                                {{Form::checkbox('registration_category_id[]', $reg->id, '',array('id' => 'reg'.$reg->id))}}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    @endforeach
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