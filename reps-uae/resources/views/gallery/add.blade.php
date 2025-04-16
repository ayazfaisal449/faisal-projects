@extends('layouts.admin')

@section('content')

<div class="tools">
    <h1>Photo Gallery</h1>
</div>

{!!Form::open(array(
            'files'=> true, 
            'name' => 'addNewPhotoCategory',
            'url' => Request::root().'/admin/gallery/save',
            'class' => 'addForm'
        ))!!}

{!!Form::token()!!}
<div class="form-wrapper">

    <div class="row">
        <div class="large-7 columns">
            {!!Form::label('name', 'Photo Text ')!!}
            <span class="redText">* {!! $errors->first('name', ':message') !!}</span>
            {!!Form::text('name')!!}
        </div>
    </div>

    <!-- <div class="row">
        <div class="large-7 columns">
            {!!Form::label('sort', 'Sort Order ')!!}
            <span class="redText">* {!! $errors->first('sort', ':message') !!}</span>
            {!!Form::text('sort')!!}
        </div>
    </div> -->

    <div class="row">
        <div class="large-7 columns">
            {!!Form::label('button_text', 'Button Text ')!!}
            <span class="redText">* {!! $errors->first('button_text', ':message') !!}</span>
            {!!Form::text('button_text')!!}
        </div>
    </div>
    <div class="row">
        <div class="large-7 columns">
            {!!Form::label('url', 'Redirect Url')!!}
            <span class="redText">* {!! $errors->first('url', ':message') !!}</span>
            {!!Form::text('url')!!}
        </div>
    </div>

    <div class="row">
        <div class="large-7 columns">
            {!! Form::label('files1', 'Photos') !!}
            <span class="redText">* {!! $errors->first('files', ':message') !!}</span> <br>
            <i style="font-size:12px;">Recommended file types: png, jpg, jpeg, gif</i>
            <label for="files">
                <div class="upload"></div>
            </label>

            {!! Form::file('files[]', array('id' => 'files', 'multiple' => 'multiple', 'onchange' => 'checkFileCount(this)')) !!}
            <span class="filename files"></span>
            <span id="error-message" class="redText"></span>
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
for (var i = 0; i < files.length; i++) { var $p=$("<p>
    </p>").text(files[i].name).appendTo('.filename.' + $(this).attr('id'));
    }
    });
    });

    @stop

 <script>
    function checkFileCount(input) {
        var maxFiles = 4; // Maximum number of files allowed
        var fileCount = input.files.length;

        if (fileCount > maxFiles) {
            input.value = ''; // Clear selected files
            document.getElementById('error-message').innerText = 'You can only upload a maximum of ' + maxFiles + ' images.';
        } else {
            document.getElementById('error-message').innerText = '';
        }
    }
</script>