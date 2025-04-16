@extends('layouts.primary')

@section('content')
    
    @include('include.subNav')
    
    <div class="pageTitle">
        <div class="row">
            <div class="large-12 columns">
                <h1>Forgot Password</h1>
                <p>
                    Enter your account email below to reset your password.
                </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="large-4 columns end">
            @if ($message)
            <div class="generalMessage">
                <span class="{{ $message['status'] }}">
                    {{ $message['text'] }}
                </span>
            </div>
            @endif
            
            {{ Form::open(array('url' => Request::root().'/trainer/resetPassword','files' => true, 'name' => 'changePassword')) }}
                {{ Form::token() }}
                <div class="labelWrapper">
                    {{ Form::label('email', 'Email') }}
                    <div class="error">
                        <span class="error">
                            {{ $errors->first('email',':message') }}
                        </span>
                        <span class="required">*</span>
                    </div>
                </div>
                {{ Form::text('email','',array('class' => 'roundInputText')) }}
                <button type="submit" class="greenBtn right">Reset</button>
            {{Form::close()}}
        </div>
    </div>

    @include('include.subFooter')
@stop
