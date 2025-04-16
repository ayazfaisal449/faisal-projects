@extends('layouts.admin')

@section('content')
<!--<script src="/js/tinymce/tinymce.min.js"></script>-->
<!--<script>tinymce.init({selector: 'textarea'});</script>-->
<div class="tools">
    <h1>Add Category</h1>
</div>

{!!Form::open(array(
            'files'=> true, 
            'name' => 'AddNewSlider',
            'url' => Request::root().'/admin/blog-category/save',
            'class' => 'addForm'
        ))!!}


{!!Form::token()!!}
<div class="form-wrapper">

<!--    <div class="row">
        <div class="large-7 columns">
            {!!Form::label('title', 'Category Title ')!!}   
            <span class="redText">*{!! $errors->first('title', ':message') !!}</span>                  
            {!!Form::text('title')!!}
        </div>
    </div>-->
    <div class="row">
        <div class="large-7 columns">
            <label for="title">Category Title</label>   
            <span class="redText"></span>       
            <span class="redText">* {!! $errors->first('title', ':message') !!}</span>    
            <input name="title" type="text" id="title" id="title" oninput="make_slug()">        
        </div>
    </div>
    <div class="row">
        <div class="large-7 columns">
            <label for="slug">Slug</label>   
            <span class="redText"></span>       
            <span class="redText">* {!! $errors->first('slug', ':message') !!}</span>    
            <input name="slug" type="text" id="slug" id="slug">        
        </div>
    </div>
    <div class="row">
        <div class="large-7 columns">
            {!!Form::label('description', 'Short deacription ')!!}
            <span class="redText"> {!! $errors->first('description', ':message') !!}</span>   
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
<script>
    function make_slug() {
        var Text = $('#title').val();
        var slug = Text.toLowerCase()
                .replace(/ /g, '-')
                .replace(/[^\w-]+/g, '');
        $("#slug").val(slug);
    }
</script>