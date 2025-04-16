@extends('layouts.admin')

@section('content')
<script src="/js/tinymce/tinymce.min.js"></script>
        <!-- <script>tinymce.init({ selector:'textarea' });</script> -->
        <div class="tools">
            <h1>Video</h1>
        </div>
        
        {{Form::open(array(
            'files'=> true,
            'url' => Request::root().'/admin/video/save', 
            'name' => 'addNewPermission',
            'class' => 'addForm'
        ))}}
			{{Form::token();}}
            <div class="form-wrapper">
                <div class="row">
                    <div class="large-7 columns">
                        {{Form::label('typeId', 'Video Type');}} 
						<span class="redText">*</span>                    
                        {{Form::select('typeId',$types)}}
                    </div>
                </div>
                
                <div class="row">
                    <div class="large-7 columns">
                        {{Form::label('title', 'Title ')}}
						<span class="redText">* {{ $errors->first('title', ':message') }}</span> 
                        {{Form::text('title')}}
                    </div>
                </div>
                
                <div class="row">
                    <div class="large-7 columns">
                        {{Form::label('description', 'Description')}}
                        {{Form::textarea('description')}}
                    </div>
                </div>

                <div class="row">
                    <div class="large-7 columns">
						{{Form::label('image', 'Image')}}   
						
						<i style="font-size:12px;">Recommended file types: png, jpg, jpeg, gif</i>
                        <label for="files">
                            <div class="upload"></div>
                        </label>
						
                        {{Form::file('image',array('id'=>'files'))}}
						<span class="filename files"></span>
                    </div>
                </div>
                
                <div class="row">
                    <div class="large-7 columns">
                    {{Form::label('code', 'Video Code ')}}
					<span class="redText">* {{ $errors->first('code', ':message') }}</span> 
                    {{Form::text('code')}}
                    </div>
                </div>
                    
                <div class="row">
                    <div class="large-7 columns">
                        <input class="btn-background" type="submit" value="Create" />
                    </div>
                </div>
            </div>
		{{Form::close()}}
        


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