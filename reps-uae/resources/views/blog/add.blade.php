@extends('layouts.admin')

@section('content')
<script src="/js/tinymce/tinymce.min.js"></script>
<script>tinymce.init({selector: 'textarea'});</script>
<div class="tools">
    <h1>Add Blog</h1>
</div>

{!!Form::open(array(
            'files'=> true,
            'date'=>true,
            'name' => 'AddNewSlider',
            'url' => Request::root().'/admin/blog/save',
            'class' => 'addForm'
        ))!!}

{!!Form::token()!!}
<div class="form-wrapper">

    <!--    <div class="row">
            <div class="large-7 columns">
                {!!Form::label('title', 'Title')!!}   
                <span class="redText">* {!! $errors->first('title', ':message') !!}</span>                  
                {!!Form::text('title')!!}
            </div>
        </div>-->
    <div class="row">
        <div class="large-7 columns">
            <label for="title">Title</label>   
            <span class="redText"></span>       
            <span class="redText">* {!! $errors->first('title', ':message') !!}</span>    
            <input name="title" type="text" id="title" id="title" oninput="make_slug()">        
        </div>
    </div>
    <!--    <div class="row">
            <div class="large-7 columns">
                {!!Form::label('slug', 'Slug')!!}   
                <span class="redText">* {!! $errors->first('slug', ':message') !!}</span>                  
                {!!Form::text('slug')!!}
            </div>
        </div>-->
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
            {!!Form::label('thumbnail', 'Thumbnail')!!}   
            <span class="redText">* {!! $errors->first('thumbnail', ':message') !!}</span> <br>
            <i style="font-size:12px;">Recommended file types: png, jpg, jpeg, gif</i>
            <label for="files">
                <div class="upload"></div>
            </label>

            {!!Form::file('thumbnail',array('id'=>'files'))!!}
            <span class="filename files"></span>
        </div>
    </div>

    <div class="row">
        <div class="large-7 columns">
            {!!Form::label('photo', 'photo')!!}   
            <span class="redText">* {!! $errors->first('photo', ':message') !!}</span> <br>
            <i style="font-size:12px;">Recommended file types: png, jpg, jpeg, gif</i><br>
            <label for="photo" style="padding-left:0px;">
                <div class="upload"></div>
            </label>
            {!!Form::file('photo',array('id'=>'photo'))!!}

            <span class="filename photo"></span>
        </div>
    </div>

    <div class="row">
        <div class="large-7 columns">
            {!!Form::label('category_id', 'Blog Category')!!}   
            <span class="redText">* {!! $errors->first('Category', ':message') !!}</span>    			
            <select name="category" id="categoryCourse">
                <option value="" selected disabled> Select Category</option>
                @if(count($category) > 0)
                @foreach($category as $key => $value) 
                <option value="{!!$value->id!!}" >{!!$value->title!!}</option>
                @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="row">
        <div class="large-7 columns">
            <label for="date">Date</label>   
            <span class="redText">* </span>       
            <span class="redText"> {!! $errors->first('date', ':message') !!}</span>    
            <input name="date" type="date" id="date">        </div>
    </div>

    <div class="row">
        <div class="large-7 columns">
            {!!Form::label('description', 'Description ')!!}
            <span class="redText"> {!! $errors->first('description', ':message') !!}</span>   
            {!!Form::textarea('description')!!}
        </div>
    </div>

    <div class="form-check">
        <input class="form-check-input" name="publish_status" type="checkbox" value="1" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
            Publish Status
        </label>
    </div><br>  

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