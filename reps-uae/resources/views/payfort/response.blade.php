@extends('layouts.primary')

@section('content')
    @include('include.subNav')
    
    <div style="text-align:center;width:100%;">
        <img style="margin-top:120px;" src="{{ Request::root() . '/img/404-image.png' }}" />
        <h1 class="color-green" style="font-size:70px;">{{ $head }}</h1>
        <p>{{ $message }}</p>
    </div>

    @include('include.subFooter')
@stop