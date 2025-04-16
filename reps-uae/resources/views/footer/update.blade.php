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
        <h1>Add Footer</h1>
    </div>
        
        {!!Form::open(array(
            'files'=> true, 
            'name' => 'AddFooter',
            'url' => Request::root().'/admin/footer/submit_footer',
            'class' => 'addForm'
        ))!!}

        
        {!!Form::token()!!}
            <div class="form-wrapper">
            {!!Form::hidden('id', $data->id)!!}
            

               
                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('text', 'Title ')!!}   
                                         
                        {!!Form::text('text',$data->text)!!}
                    </div>
                </div>
                <div class="row">
                    <div class="large-7 columns">
						{!!Form::label('image', 'Image')!!}   
						 <br>
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
                      {!!Form::label('Banner', 'Banner Image')!!}
                      @if($data->images)
                        <img style="max-height: 300px; margin-top: 40px; margin-bottom: 40px;" src="{!!Request::root()!!}/{!!$data->images!!}">
                      @endif
                    </div>
                </div>
                
                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('description', 'Page Content ')!!}
                         
                        {!!Form::textarea('description1',$data->textarea1)!!}
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
