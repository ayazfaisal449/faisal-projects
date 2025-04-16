@extends('layouts.admin')

@section('content')
<div class="tools">
    <h1>Edit Category</h1>
</div>

{!!Form::open(array(
            'files'=> true, 
            'name' => 'AddNewSlider',
            'url' => Request::root().'/admin/blog-category/save',
            'class' => 'addForm'
        ))!!}


{!!Form::token()!!}
<div class="form-wrapper">
    {!!Form::hidden('id', $category->id)!!}
<!--    <div class="row">
        <div class="large-7 columns">
            {!!Form::label('title', 'Title ')!!}   
            <span class="redText">* {!! $errors->first('title', ':message') !!}</span>                  
            {!!Form::text('title',$category->title)!!}
        </div>
    </div>-->
    <div class="row">
        <div class="large-7 columns">
            <label for="title">Category Title</label>   
            <span class="redText"></span>       
            <span class="redText">* {!! $errors->first('title', ':message') !!}</span>    
            <input name="title" type="text" value="{!!$category->title!!}" id="title" id="title" oninput="make_slug()">        
        </div>
    </div>
    <div class="row">
        <div class="large-7 columns">
            <label for="slug">Slug</label>   
            <span class="redText"></span>       
            <span class="redText">* {!! $errors->first('slug', ':message') !!}</span>    
            <input name="slug" type="text" value="{!!$category->slug!!}" id="slug" id="slug">        
        </div>
    </div>

    <div class="row">
        <div class="large-7 columns">
            {!!Form::label('description', 'Description ')!!}
            <span class="redText"> {!! $errors->first('description', ':message') !!}</span>   
            {!!Form::textarea('description',$category->description)!!}
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
<script>
    function make_slug() {
        var Text = $('#title').val();
        var slug = Text.toLowerCase()
                .replace(/ /g, '-')
                .replace(/[^\w-]+/g, '');
        $("#slug").val(slug);
    }
</script>