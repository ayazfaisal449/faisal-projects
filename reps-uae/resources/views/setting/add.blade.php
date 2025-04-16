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
        <h1>Add Setting</h1>
    </div>
        
        {!!Form::open(array(
            'files'=> true, 
            'name' => 'AddFooter',
            'url' => Request::root().'/admin/setting/save',
            'class' => 'addForm'
        ))!!}

        
        {!!Form::token()!!}
            <div class="form-wrapper">
                
             <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('text', 'Opening Hours ')!!}   
                                          
                        {!!Form::text('opening_hours')!!}
                    </div>
                </div>

               
                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('text', 'Ramadan Timing ')!!}   
                                         
                        {!!Form::text('ramadan_timing')!!}
                    </div>
                </div>

                 

                  
                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('description', 'Location')!!}
                        <span class="redText"> {!! $errors->first('description', ':message') !!}</span>   
                        {!!Form::textarea('description1')!!}
                    </div>
                </div>  

                 <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('text', 'Phone Number ')!!}   
                                         
                        {!!Form::text('mobile')!!}
                    </div>
                </div>
              

                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('text', 'Information ')!!}   
                                         
                        {!!Form::text('information')!!}
                    </div>
                </div>

                 

                

                <div class="row">
                    <div class="large-7 columns">
                        <input class="btn-background" type="submit" value="save" />
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
