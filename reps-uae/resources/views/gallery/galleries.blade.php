@extends('layouts.primary')

@section('content')

@include('include.subNav')


<style>
    @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600&display=swap');

    .image-container {
        padding: 0px 1%;
        display: flex;
        flex-wrap: wrap;
    }

    .image-container .image-wrapper {
        width: 25%;
        margin-bottom: 40px;
    }
    /* .image-container .image-wrapper:not(:last-child) {
    margin-right: 20px;
    } */

    .image-container .image-wrapper .columns img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .image-container .image-wrapper .columns {
    height: 275px;
    width: 100%;
    padding-left: 0;
}
.video-title, .videos {
    background: #F8F8F8;
}
.video-title h3{
    padding: 43px 0 15px;
    font-size: 20px;
    margin-bottom: 0;
}

.videos {
    padding: 20px 0;
    margin: 0;
}
.image-container .image-wrapper:last-child .columns {
    padding-right: 0;
}
    .title2 {
        padding: 0px 1%;
        margin-bottom: 16px;
        font-size: 17px;
        font-family: 'Raleway', sans-serif;
        font-weight: 600;
    }


    .videos-container {
        display: flex;
        flex-wrap: wrap;
        /* Prevent videos from wrapping to the next line */
        overflow-x: auto;
        /* Enable horizontal scrolling if videos exceed container width */
    }
    .vid-img-box {
    flex: 0 0 33%;
    }
    .v-img-title p {
    font-size: 17px;
    font-weight: 600;
    margin-left: 13px;
    cursor: pointer;
}
.image-container .image-wrapper:not(:last-child) .columns {
    padding-right: 1.25rem;
}
    .video-wrapper {
        flex: 0 0 auto;
        /* Prevent videos from growing or shrinking */
        margin-right: 10px;
        /* Add some spacing between videos */
    }

    .video-wrapper iframe {
        width: 300px;
        /* Adjust the width of the video iframe to your desired size */
        height: 200px;
        /* Adjust the height of the video iframe to your desired size */
    }

    span.bg-cont {
    z-index: -1;
    }
    /* popup style */
    .popup{
    background: rgb(0 0 0 / 60%);
    padding: 0px;
    width: 100%;
    display: none;
    transition: 2s ease all;
    position: fixed;
    top: 0px;
    height: 100%;
    left: 0;
    right: 0;
    z-index: 99999;
}
.mypopup-inner {    
    padding: 0px;
    width: 852px;
    height: 505px;
    position: fixed;
    top: 50px;
    left: 0;
    right: 0;
    margin: 0 auto;
}
span.close {
    position: absolute;
    right: 10px;
    top: 10px;
    padding: 0px 10px 2px;
    background: #fff;
    border-radius: 50px;
    font-size: 16px;
    cursor: pointer;
}
.popup-body iframe, .popup-body {
    width: 100%;
    height: 100%;
}
.event-title h3 {
    padding-top: 0;
    font-size: 20px;
    margin-bottom: 26px;
}
.galleryTitle .row:before, .galleryTitle .row:after{
    content: unset;
}
.video-container{
    margin: 0px 0 20px;
    height: 246px;
	cursor:pointer;
}
.video-container img.pop-toggle {
    height: 246px;
    width: 100%;
    object-fit: cover;
    object-position: right;
}
/* .lightbox{
    top: 15% !important;
} */
@media screen and (max-width: 768px){

    .mypopup-inner {
        padding: 0px;
        width: 90%;
        height: 400px;
    }
}
@media screen and (max-width: 468px){

    .image-container {
    padding: 0;
    margin-bottom: 15px;
}
.title2 {
    padding: 0px 3%;
}
    .image-container .image-wrapper {
    margin-right: unset;
    padding-right: 10px;
    padding-left: 10px;
    margin-bottom: 20px;
    width: 100%;
}
    .videos-container {
    display: unset;
}
.image-container .image-wrapper .columns {
    padding-right: 0px !important;
    margin-bottom: 15px;
}

}

</style>

<div class="pageTitle">
    <div class="row">
        <div class="large-12 columns">
            <h1 class="color-green">Media</h1>
        </div>
    </div>
</div>

<div class="galleryTitle event-title">
    <div class="row">
        <div class="large-12 columns">
            <h3>Photos</h3>
        </div>
    </div>
</div>

<div class="galleries">
<div class="row">
    @if(count($galleries) > 0)
    @foreach($galleries as $id => $gallery)
    <div class="title2">{{$gallery['name']}}</div>
    <div class="image-container">
		<?php
        $i = 1;
		?>
        @foreach($gallery['photo'] as $image)
        <?php  if($i <= 4){
            ?>
        <a href="{{ Request::root().'/images/photo_gallery/'.$id.'/'.$image }}"  data-lightbox="{{$gallery['name']}}" class="image-wrapper">
        <div class="large-centered columns">
            <!-- <a href="{{ Request::root().'/images/photo_gallery/'.$id.'/'.$image }}"  data-lightbox="{{ $image }}" > -->
                <img src="{{ Request::root().'/images/photo_gallery/'.$id.'/'.$image }}"/>
            <!-- </a> -->
        </div>
        </a>
        <?php $i++; }?>
        @endforeach
		
    </div>
    @endforeach
    @else
    <div class="norecord" style="padding-left:10px">No record found.</div>
    @endif
    </div>
</div>



<div class="galleryTitle video-title">
    <div class="row">
        <div class="large-12 columns">
            <h3>Videos</h3>
        </div>
    </div>
</div>

<div class="videos">
    @if($videos->count() > 0)
    <div class="row videos-container">
       <?php
       $counter = 1;
       ?> 
       @foreach($videos->sortByDesc('id') as $video)
        <div class="vid-img-box">
            <div class="large-centered columns">
                @if(!empty($video->image))
                    <div class="video-container">
                        <img src="{{ Request::root() }}/{{ $video->image }}" alt="Video Image" class="pop-toggle" myattr="myPopup<?php print $counter; ?>">
                    </div>
                @else
                    <div class="video-container">
                        <img src="{{ Request::root() }}/images/default.jpg" alt="Default Image" class="pop-toggle" myattr="myPopup<?php print $counter; ?>">
                    </div>
                @endif
            </div>
            <div class="v-img-title">
                <p class="pop-toggle" myattr="myPopup<?php print $counter; ?>">Video for {{$video->title}}</p>
            </div>            
        </div>

        <div id="myPopup<?php print $counter; ?>" class="popup">
            <div class="mypopup-inner">
                <div class="popup-header">          
                <span class="close">x</span>
                </div>
                <div class="popup-body">
                    <!-- <h1><?php //print $counter; ?></h1> -->
                <iframe src="//www.youtube.com/embed/{{$video->code}}" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <?php $counter++; ?>
        @endforeach
    </div>
    @else
    <div class="norecord" style="padding-left:10px">No record found.</div>
    @endif
</div>





<!-- popup -->



<script>
$(document).ready(function(){
  $(".pop-toggle").click(function(){
    var mid = $(this).attr("myattr");
    $('#'+mid).show();
  });
  
  $(".close").click(function(){
    $('.popup').hide();
    $(".popup iframe")[0].stopVideo = "";
  });
});
</script>


@include('include.subFooter')


@stop