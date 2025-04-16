@extends('layouts.primary')

@section('content')

    @include('include.subNav')

    <div class="border-bottom">
        <div class="row">
            <div class="large-12 columns">
                <h1 class="color-green">Trainer Login</h1>
                <p>Please provide your account email and password to log in.</p>
            </div>
        </div>
    </div>

    {!! Form::open([
        'url' => Request::root() . '/trainer/authenticate',
        'name' => 'login',
        'class' => 'registration',
    ]) !!}

    <div class="loginWrapper border-bottom">
        <div class="row">
            <div class="large-4 columns end">

                @if ($generalMessage)
                    <div class="generalMessage">
                        <span class="{{ $generalMessage['status'] }}">
                            {{ $generalMessage['text'] }}
                        </span>
                    </div>
                @endif
                <div class="inputWrapper">

                    <div class="label">
                        <label for="eMail">E-Mail</label>
                        <div class="error">
                            <span class="error">{{ $errors->first() }}</span>
                            <span class="required">*</span>
                        </div>
                    </div>

                    <input type="text" name="email" value="" id="eMial" />
                </div>

                <div class="inputWrapper">

                    <div class="label">
                        <label for="password">Password</label>
                        <div class="error">
                            <span class="error"></span>
                            <span class="required">*</span>
                        </div>
                    </div>
                    <input type="password" name="password" value="" id="password" />
                </div>

            </div>
        </div>
    </div>


    <div class="continueBtnWrapper trainerLogin">
        <div class="row" style="border-top:0px;">
            <div class="large-4 columns">
                <div class="forgotWrapper">
                    <img src="{{ Request::root() }}/img/lock.png">
                    <a class="forgotPass" href="<?php echo Request::root() . '/trainer/forgot-password'; ?>">Forgot Password</a>
                </div>
            </div>
            <div class="large-2 large-offset-6 columns">
                <input class="submitBtn" type="submit" value="Login" />
            </div>
        </div>
    </div>

    {!! Form::close() !!}

    @include('include.subFooter')

@stop

@section('customScripts')
@stop
