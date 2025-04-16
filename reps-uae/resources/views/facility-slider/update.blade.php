@extends('layouts.admin')

@section('content')
    
    <div class="tools">
        <h1>Slider Photo</h1>
    </div>
        
        {!!Form::open(array(
            'files'=> true, 
            'name' => 'AddNewSlider',
            'url' => Request::root().'/admin/facility-slider/save',
            'class' => 'addForm'
        ))!!}

        
        {!!Form::token()!!}
            <div class="form-wrapper">
                {!!Form::hidden('id', $slider->id)!!}
                {{-- <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('text', 'Photo Text ')!!}   
						<span class="redText"> {!! $errors->first('text', ':message') !!}</span>                  
                        {!!Form::text('text',$slider->text)!!}
                    </div>
                </div>

                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('description', 'Description ')!!}
                        <span class="redText"> {!! $errors->first('description', ':message') !!}</span>   
                        {!!Form::textarea('description',$slider->description)!!}
                    </div>
                </div>  
                
                

                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('button_text', 'Button Text ')!!}   
                        <span class="redText"> {!! $errors->first('button_text', ':message') !!}</span>                  
                        {!!Form::text('button_text',$slider->button_text)!!}
                    </div>
                </div>
                 <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('url', 'Redirect Url')!!}   
                        <span class="redText"> {!! $errors->first('url', ':message') !!}</span>                  
                        {!!Form::text('url',$slider->url)!!}
                    </div>
                </div> --}}

                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('sort', 'Sort Order ')!!}   
                        <span class="redText">* {!! $errors->first('sort', ':message') !!}</span>                  
                        {!!Form::text('sort',$slider->sort_order)!!}
                    </div>
                </div>
                
                <div class="row">
                    <div class="large-7 columns">
						{!!Form::label('image', 'Photos')!!}   
						<span class="redText"> {!! $errors->first('image', ':message') !!}</span> <br>
						<i style="font-size:12px;">Recommended file types: png, jpg, jpeg, gif</i>
                        <label for="files">
                            <div class="upload"></div>
                        </label>
						
                        {!!Form::file('image',array('id'=>'files'))!!}
						<span class="filename files"></span>
                    </div>
                </div>
                 <div class="row">
                    <div class="large-12 columns">
                      {!!Form::label('current', 'Current Image')!!}
                        <img style="width:100% margin-top: 40px; margin-bottom: 40px;" src="{!!Request::root()!!}/{!!$slider->location!!}">
                    </div>
                </div>

                
                <div class="row">
                    <div class="large-7 columns">
                        <input class="btn-background" type="submit" value="Update" />
                    </div>
                </div>
               
                
            </div>
		{!!Form::close()!!}
        
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
