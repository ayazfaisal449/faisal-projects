@extends('layouts.admin')

@section('content')
     <script src="/js/tinymce/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
    <div class="tools">
        <h1>Edit FAQ</h1>
    </div>
        
        {!!Form::open(array(
            'files'=> true, 
            'name' => 'AddNewSlider',
            'url' => Request::root().'/admin/faq/save',
            'class' => 'addForm'
        ))!!}

        
        {!!Form::token();!!}
            <div class="form-wrapper">
                {!!Form::hidden('id', $faq->id)!!}
                {{-- <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('text', 'Photo Text ')!!}   
						<span class="redText"> {!! $errors->first('text', ':message') !!}</span>                  
                        {!!Form::text('text',$faq->text)!!}
                    </div>
                </div>

                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('description', 'Description ')!!}
                        <span class="redText"> {!! $errors->first('description', ':message') !!}</span>   
                        {!!Form::textarea('description',$faq->description)!!}
                    </div>
                </div>  
                
                

                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('button_text', 'Button Text ')!!}   
                        <span class="redText"> {!! $errors->first('button_text', ':message') !!}</span>                  
                        {!!Form::text('button_text',$faq->button_text)!!}
                    </div>
                </div>
                 <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('url', 'Redirect Url')!!}   
                        <span class="redText"> {!! $errors->first('url', ':message') !!}</span>                  
                        {!!Form::text('url',$faq->url)!!}
                    </div>
                </div> --}}
                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('title', 'Title')!!}   
                        <span class="redText"> {!! $errors->first('title', ':message') !!}</span>                  
                        {!!Form::text('title',$faq->title)!!}
                    </div>
                </div>

                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('description', 'Description ')!!}
                        <span class="redText"> {!! $errors->first('description', ':message') !!}</span>   
                        {!!Form::textarea('description',$faq->description)!!}
                    </div>
                </div>

                <div class="row">
                    <div class="large-7 columns">
                        {!!Form::label('sort', 'Sort Order ')!!}   
                        <span class="redText">* {!! $errors->first('sort', ':message') !!}</span>                  
                        {!!Form::text('sort',$faq->sort_order)!!}
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
