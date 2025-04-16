@extends('layouts.admin')

@section('content')
     <script src="/js/tinymce/tinymce.min.js"></script>
        <script>tinymce.init({ selector:'textarea' });</script>
    <div class="tools">
        <h1>Add team</h1>
    </div>
        
        {!!Form::open(array(
            'files'=> true, 
            'name' => 'AddNewSlider',
            'url' => Request::root().'/admin/team/save',
            'class' => 'addForm'
        ))!!}

        
        {!!Form::token();!!}
            <div class="form-wrapper">

                  <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('text', 'Name ')!!}   
                        <span class="redText"> {!! $errors->first('text', ':message') !!}</span>    {!!Form::text('name')!!}
                    </div>
                </div>

                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('text', 'Designation')!!}   
                        <span class="redText"> {!! $errors->first('text', ':message') !!}</span>    {!!Form::text('designation')!!}
                    </div>
                </div>
                
                
                
                   <div class="row">
                    <div class="large-7 columns">
						{!!Form::label('image', 'Image')!!}   
						
						<i style="font-size:12px;">Recommended file types: png, jpg, jpeg, gif</i>
                        <label for="files">
                            <div class="upload"></div>
                        </label>
						
                        {!!Form::file('image',array('id'=>'files'))!!}
						<span class="filename files"></span>
                    </div>
                </div>

              
                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('description', 'Description')!!}
                          
                        {!!Form::textarea('description')!!}
                    </div>
                </div>  

               
                <div class="row">
                    <div class="large-7 columns">
                        <input class="btn-background" type="submit" value="Create" />
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
