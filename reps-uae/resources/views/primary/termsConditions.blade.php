@extends('layouts.primary')

@section('content')
    
    @include('include.subNav')
    
    <div class="pageTitle">
        <div class="row">
            <div class="large-12 columns">
                @foreach($terms as $dat)
                <h1>{!!$dat->text!!}</h1>
                <p>These our our terms and conditions for using our site.  Please read them carefully.</p>
            </div>
        </div>
    </div>

   {!!$dat->textarea1!!}
    @endforeach
    
    @include('include.subFooter')
    
@stop

@section('customScripts')
@stop
