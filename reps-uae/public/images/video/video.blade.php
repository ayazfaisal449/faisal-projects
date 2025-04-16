@extends('layouts.primary')

@section('content')
    
    @include('include.subNav')
    
     <div class="pageTitle">
        <div class="row">
            <div class="large-12 columns">
                <h1>Video for {{$video->title}}</h1>
                <p>
                   {{$video->description}}
                </p>
            </div>
        </div>
    </div>
    
    <div class="row"> 
        <div class="large-8 large-centered columns">
            <div class="video-container">
                <iframe src="//www.youtube.com/embed/{{$video->code}}" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
	</div>
    
    @include('include.subFooter')
	 
@stop