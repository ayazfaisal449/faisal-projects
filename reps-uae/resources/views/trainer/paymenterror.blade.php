@extends('layouts.primary')

@section('content')
    <div class="row">
        <div class="large-12 columns">
            <h1>Payment Error</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="large-12 columns">
            <h6>{{ $message }}</h6>
        </div>
    </div>
@stop