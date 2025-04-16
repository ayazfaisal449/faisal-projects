@extends('layouts.admin')

@section('content')
<script src="/js/tinymce/tinymce.min.js"></script>
<script>
tinymce.init({
    selector: 'textarea'
});
</script>
<div class="tools">
    <h1>Add Job</h1>
</div>
{!!Form::open(array(
            'files'=> true, 
            'name' => 'AddNewJob',
            'url' => Request::root().'/admin/jobs/save',
            'class' => 'addForm'
        ))!!}
{!!Form::token()!!}
<div class="form-wrapper">
    <div class="row">
        <div class="large-7 columns">
            {!!Form::label('job_role', 'Role')!!}
            <span class="redText">* {!! $errors->first('job_role', ':message') !!}</span>
            {!!Form::text('job_role')!!}
        </div>
    </div>

    <div class="row">
        <div class="large-7 columns">
            {!!Form::label('email', 'Email')!!}
            <span class="redText">* {!! $errors->first('email', ':message') !!}</span>
            {!!Form::email('email')!!}
        </div>
    </div>

    <div class="row">
        <div class="large-7 columns">
            {!!Form::label('branch', 'Branch')!!}
            <span class="redText">* {!! $errors->first('branch', ':message') !!}</span>
            {!!Form::text('branch')!!}
        </div>
    </div>

    <div class="row">
        <div class="large-7 columns">
            {!!Form::label('image', 'Photo')!!}
            <span class="redText">* {!! $errors->first('image', ':message') !!}</span> <br>
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
            {!!Form::label('description', 'Description ')!!}
            <span class="redText"> {!! $errors->first('description', ':message') !!}</span>
            {!!Form::textarea('description')!!}
        </div>
    </div>

    <!-- <div class="row">
        <div class="large-7 columns">
            {!!Form::label('sort', 'Sort Order ')!!}
            <span class="redText">* {!! $errors->first('sort', ':message') !!}</span>
            {!!Form::text('sort', 0)!!}
        </div>
    </div> -->

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



$('#files').change(
    function() {
        var file = this.files[0],
            img;
        var fileExtension = ['png', 'jpeg', 'jpg', 'gif'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert('Please upload images in .png, .jpg, .jpeg, or .gif formats only.');
            this.value = ''; // Clean field
            return false;
        } else if (Math.round(file.size / (1024 * 1024)) > 2) {
            alert('File size must be less than 2 MB');
            this.value = '';
            return false;
        }
    });

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
