@extends('layouts.primary')

@section('content')
    
    @include('include.subNav')
    
    <div class="pageTitle">
        <div class="row">
            <div class="large-12 columns">
                <h1>Photo Gallery for {{$galleryCategory->name}}</h1>
                <p>
                   {{$galleryCategory->description}}
                </p>
            </div>
        </div>
    </div>
    
    <?php $counter = 1; ?>
    <div class="galleries">
        <div class="row">
            @foreach($gallery as $photo)
                @if($counter%5 == 0)
                    </div></div><div class="galleries"><div class="row">
                @endif
                
            <?php $counter++; ?>
            <div class="large-3 medium-3 small-3 columns {{((count($gallery)+1) == $counter)? 'end':''}}">
                 <a class="fancybox" data-fancybox-group="gallery" href="{{Request::root().'/images/photo_gallery/'.$galleryCategory->id.'/'.$photo->filename}}">
                    <img src="{{ Request::root().'/images/photo_gallery/'.$galleryCategory->id.'/'.$photo->filename }}" />
                </a>
            </div>
            @endforeach
        </div>
    </div>

    @include('include.subFooter')
	 
@stop

@section('customScripts')
    $(document).ready(function () {
        $("a.fancybox").fancybox();
    });
@stop