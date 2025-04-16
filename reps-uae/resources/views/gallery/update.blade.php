@extends('layouts.admin')

@section('content')
    <div class="tools">
		<h1>Update Photo Category & add more Pictures</h1>
    </div>
        
    {!!Form::open(array(
        'files'=> true, 
        'name' => 'updateNewPhotoCategory',
        'url' => Request::root().'/admin/gallery/save',
        'class' => 'addForm'
    ))!!}
        
        {!!Form::token()!!}
        
        <div class="form-wrapper">
            <div class="row">
                <div class="large-7 columns">
                    {!!Form::label('name', 'Photo Category Name ')!!}     
					<span class="redText">* {!! $errors->first('name', ':message') !!}</span>                   
                    {!!Form::text('name', $photoCategory->name)!!}
                    {!!Form::hidden('id', $photoCategory->id)!!}
                </div>
            </div>
            
            <div class="row">
                <div class="large-7 columns">
                    {!!Form::label('description', 'Description')!!}
                    {!!Form::textarea('description', $photoCategory->description)!!}
                </div>
            </div>
               
                
             <div class="row">
                <div class="large-7 columns">
				{!!Form::label('files1', 'Photos')!!}   
				<span class="redText">* {!! $errors->first('files', ':message') !!}</span> <br>
				<i style="font-size:12px;">Recommended file types: png, jpg, jpeg, gif</i>
                    <label for="files">
                        <div class="upload"></div>
                    </label>
                    {!!Form::file('files[]',array('id'=>'files','multiple'=>'multiple'))!!}
					<span class="filename files"></span>
                </div>
            </div>
                
            <div class="row">
                <div class="large-7 columns">
                    <input class="btn-background" type="submit" value="Update" />
                </div>
            </div>
        </div>
        
    {!!Form::close()!!}
        
        @if(count($photos))
            <div class="tools">
                <h1>Existing Pictures in the Photo Category</h1>
            </div>
            
            <div class="galleryEdit">
                <div class="tableHeader">
                    <ul>
                        <li>Photo</li>
                        <li>Action</li>
                    </ul>
                </div>
            </div>
            
            <div class="galleryEdit">
                <div class="tableRows">
                    <ul>
                    @foreach($photos as $photo)
                        <li>
                            <a href="#" onclick="return false;" alt="{!!$photo[1]!!}">
                                <h6>{!!$photo[1]!!}</h6>
                                <img src="{{ asset('images/photo_gallery/'.$photoCategory->id.'/'.$photo[0]) }}" alt="{{ $photo[1] }}" width="50%">

                            </a>
                            <div class="action">
                                <a class="delbtngall" href="{!!Request::root()!!}/admin/gallery/deletePhoto/{!!$photoCategory->id!!}/{!!$photo[0]!!}/{!!$photo[2]!!}">
                                    <span class="delete"></span>
                                </a>
                            </div>
                        </li>
                    @endforeach
                        
                    </ul>
                </div>
            </div>
            
            <div class="paginator clearfix">
                {!!$paginator!!}
            </div>
        @else
            <h3>There are no existing photos</h3>
        @endif
@stop

@section('customScripts')

$(document).ready(function(){
    $("a.delbtngall").click(function() {
        if (confirm('Really delete the selected image?')) {
            return true;
        }
        return false;
    });
    $("input[type=file]").change(function() { 
        $('.filename.' + $(this).attr('id')).empty();
        var files = $(this)[0].files;
        for (var i = 0; i < files.length; i++) {
            var $p = $("<p></p>").text(files[i].name).appendTo('.filename.' + $(this).attr('id'));
        }
    });
});
@stop