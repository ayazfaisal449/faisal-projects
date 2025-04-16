@extends('layouts.admin')

@section('content')
     <script src="/js/tinymce/tinymce.min.js"></script>
     <script src="/js/tinymce/plugins/code/plugin.min.js"></script>
        <script>
            tinymce.init({ 
                selector:'textarea',
                plugins: 'code',
                toolbar: 'code',
            });
    </script>
    <div class="tools">
        <h1>Manage Setting</h1>
    </div>
        
        {!!Form::open(array(
            'files'=> true, 
            'name' => 'AddFooter',
            'url' => Request::root().'/admin/setting/save',
            'class' => 'addForm'
        ))!!}

        
        {!!Form::token()!!}
            <div class="form-wrapper">
                {!!Form::hidden('id', $data->id)!!}
             <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('text', 'Opening Hours ')!!}   
                                          
                        {!!Form::text('opening_hours',$data->opening_hours)!!}
                    </div>
                </div>

               
                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('text', 'Ramadan Timing ')!!}   
                                         
                        {!!Form::text('ramadan_timing',$data->ramadan_timing)!!}
                    </div>
                </div>

                 

                  
                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('description', 'Location')!!}
                        <span class="redText"> {!! $errors->first('description', ':message') !!}</span>   
                        {!!Form::textarea('location',$data->location)!!}
                    </div>
                </div>  

                 <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('text', 'Phone Number ')!!}   
                                         
                        {!!Form::text('mobile',$data->mobile)!!}
                    </div>
                </div>
              

                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('text', 'Information ')!!}   
                                         
                        {!!Form::text('information',$data->information)!!}
                    </div>
                </div>

                <!-- <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('photo', 'Photo')!!}   
                        <span class="redText"> {!! $errors->first('photo', ':message') !!}</span> <br>
                        <i style="font-size:12px;">Recommended file types: png, jpg, jpeg, gif</i><br>
                        <label for="photo" style="padding-left:0px;">
                            <div class="upload"></div>
                        </label>
                        {!!Form::file('photo', array('id' => 'photo'))!!}
                        <span class="filename photo"></span>
                        <input type="hidden" name="old_photo" value="{!!$data->image!!}"/>
                    </div>
                    <div class="large-12 columns">
                        <img style="max-height: 119px; margin-top: 40px; margin-bottom: 40px;" src="{!! Request::root() !!}/{!! $data->image !!}">
                    </div>
                </div> -->

                

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
