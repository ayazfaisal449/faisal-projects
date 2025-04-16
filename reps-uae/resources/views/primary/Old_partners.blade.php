@extends('layouts.primary')

@section('content')
    
    @include('include.subNav')
    
    <div class="border-bottom">
        <div class="row">
            <div class="large-12 columns">
                <h1 class="color-green">Partners</h1>
            </div>
        </div>
    </div>
    
    <div class="row">
        @foreach($partners as $partner)
        <div class="teamMember clearfix">
            <div class="large-3 columns">
                <div class="teamMemberPicx">
                    <a href="{{ $partner->url }}" target="_blank" alt="">{{ HTML::image($partner->location,'',array('style'=>'heigth: 200px;')) }}</a>
                </div>
            </div>
            <div class="large-9 columns">
                <div class="teamMemberDesc">
                    {{ $partner->description }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
   @include('include.subFooter')
    
@stop

@section('customScripts')
@stop
