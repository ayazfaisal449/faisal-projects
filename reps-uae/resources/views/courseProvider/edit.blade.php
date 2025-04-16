@extends('layouts.admin')

@section('content')

    <div class="tools">
        <h1>Course Provider</h1>
    </div>

    {!! Form::open([
        'url' => 'admin/courseProvider/save',
        'files' => true,
        'id' => 'addNewCourseProvider',
        'class' => 'addForm',
    ]) !!}

    <div class="form-wrapper">

        <div class="row">
            <div class="large-7 columns">
                {!! Form::label('name', 'Name ') !!}
                <span class="redText">* {!! $errors->first('name', ':message') !!}</span>
                {!! Form::text('name', $courseProvider->name) !!}
            </div>
        </div>

        <div class="row">
            <div class="large-7 columns">
                {!! Form::label('description', 'Description ') !!}
                <span class="redText">* {!! $errors->first('description', ':message') !!}</span>
                {!! Form::textarea('description', $courseProvider->description) !!}
            </div>
        </div>

        <div class="row">
            <div class="large-7 columns">
                {!! Form::label('website', 'Website ') !!}
                <span class="redText">* {!! $errors->first('website', ':message') !!}</span>
                {!! Form::text('website', $courseProvider->website) !!}
            </div>
        </div>

        <div class="row">
            <div class="large-7 columns">
                {!! Form::label('category', 'Category ') !!}
                <span class="redText">* {!! $errors->first('category', ':message') !!}</span>
                {!! Form::select(
                    'category',
                    ['1' => 'PERSONAL TRAINER / GYM INSTRUCTOR COURSES', 2 => 'YOGA / PILATES COURSES'],
                    $courseProvider->category
                ) !!}
            </div>
        </div>

        <div class="row">
            <div class="large-7 columns">
                {!! Form::label('logoimg', 'Logo ') !!}
                <span class="redText">* {!! $errors->first('logo', ':message') !!}</span>
                <i style="font-size: 12px;display: block;">Recommended file types: jpg, png, gif</i>
                <label for="logo">
                    <div class="upload"></div>
                </label>
                {!! Form::file('file', ['id' => 'logo']) !!}
                {!! Form::hidden('id', $courseProvider->id) !!}
                <span class="filename logo"></span>
            </div>
            <div class="large-3 large-offset-1 columns end">
                <img src="{{ asset($src . '/' . $courseProvider->id . '/' . $courseProvider->logo) }}" alt="User Logo"
                    width="250" height="250">

            </div>
        </div>

        <div class="row">
            <div class="large-7 columns">
                {!! Form::submit('Update', ['name' => 'submit', 'class' => 'btn-background']) !!}
            </div>
        </div>

    </div>

    {!! Form::close() !!}

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
