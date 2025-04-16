@extends('layouts.primary')

@section('content')
    
    @include('include.subNav')
    
    <div class="pageTitle">
        <div class="row">
            <div class="large-12 columns">
                <h1>Change Password</h1>
                <p>
                    Enter a new password below.
                </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="small-12 medium-4 columns">
            {{ Form::open(array('action' => array('TrainerController@changePassword'))) }}
                {{ Form::token() }}
                
                {{ Form::hidden('reset_code',Input::old('reset_code',$code)) }}
                <div class="labelWrapper">
                    {{ Form::label('new_password', 'New Password ') }}
                    <div class="error">
                        <span class="error">{{ $errors->first('new_password',':message') }}</span>
                        <span class="required">*</span>
                    </div>
                </div>
                {{ Form::password('new_password',array('class' => 'roundInputText')) }}
                <button type="submit" class="greenBtn right">Change</button>
            {{Form::close()}}
        </div>
    </div>

    @include('include.subFooter')
@stop
