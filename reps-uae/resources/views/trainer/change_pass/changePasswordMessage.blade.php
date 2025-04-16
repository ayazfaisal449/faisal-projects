@extends('layouts.primary')

@section('content')
    
    @include('include.subNav')
    
    <div class="pageTitle">
        <div class="row">
            <div class="large-12 columns">
                <h1>Password Reset</h1>
                <p>
                    An email containing a reset link has been sent to your email address:  <u>{{ $mail_id }}</u>
                </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="small-12 columns">
            You have been emailed a password reset link. Follow the instruction in the email to
            have your password changed.
        </div>
    </div>

    @include('include.subFooter')
@stop
