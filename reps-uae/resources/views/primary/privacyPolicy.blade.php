@extends('layouts.primary')

@section('content')
    
    @include('include.subNav')
    
    <div class="pageTitle">
        <div class="row">
             @foreach($privacy as $dat)
            <div class="large-12 columns">
               
                <h1>{!!$dat->text!!}</h1>
                <p>REPs UAE is committed to protecting the privacy of data provided to us by members.</p>
                <p>This policy sets out how personal information will be treated by REPs UAE.  </p>
            </div>
        </div>
    </div>

   {!!$dat->textarea1!!}
    @endforeach 
    @include('include.subFooter')
    
@stop

@section('customScripts')
@stop
