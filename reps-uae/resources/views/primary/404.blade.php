@extends('layouts.primary')

@section('content')
    @include('include.subNav')
    
    <div style="text-align:center;width:100%;">
        <img style="margin-top:120px;" src="{{ Request::root() . '/img/404-image.png' }}" />
        <h1 class="color-green" style="font-size:70px;">Error: 404!</h1>
        <p>Sorry, the Page you were looking for could not be found.</p>
    </div>

    @include('include.subFooter')
@stop