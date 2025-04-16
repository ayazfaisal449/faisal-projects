@extends('layouts.primary')

@section('content')

    @include('include.subNav')

    <div class="border-bottom">
        <div class="row">
            <div class="large-12 columns">
                <h1 class="color-green">Trainer has been successfully registered</h1>
            </div>
        </div>
    </div>
        
    <div class="row">
        <div class="large-12 columns" style="text-align:center;">
            <img src="{{Request::root()}}/img/success-ico1999.png" style="margin:40px;" />
            <h6 style="font-family:'OpenSans-Bold';font-weight:bold;font-size:14px;">Thank you for registering with REPs UAE. </h6>
            <p>
                You will soon receive an automated email acknowledging your registration.<br />
                Please allow between 1-4 weeks for processing.
            </p>
        </div>
    </div>

    <div class="swril cpdProviders"></div>
@stop
    