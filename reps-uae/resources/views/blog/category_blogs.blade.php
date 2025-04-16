@extends('layouts.primary')


@section('content')
<span class="bg-cont"></span>
<style>
    a.btn {
    padding: 12px 0;
    }
</style>
@include('include.subNav')

<div class="REP-blog-listing">

    <div class="REP-listing-top">
        <h1>Blog</h1>
    </div>
    <div class="REP-list-blogs">
        <div class="container">
            <div class="row">
                @if(!empty($data))
                @foreach($data as $key => $value) 
                <div class="col-md-4">
                    <div class="REP-blog-sec">
                        <div class="REP-blog-img">
                            <a href="{{Request::root()}}/post/{{$value->slug}}"><img src="{{Request::root()}}/{{$value->thumbnail}}" alt="blog image" /></a>
                        </div>
                        <div class="REP-blog-txt">
                            <a href="{{Request::root()}}/post/{{$value->slug}}"><h2>{{$value->title}}</h2></a>
                            <p><?php echo substr(strip_tags($value->description), 0, 200); ?></p>
                            <label><?php echo date("M d, Y", strtotime($value->date)); ?></label>
                        </div>
                    </div>
                </div>
                @endforeach
                
                @endif
            </div>
        </div>
    </div>
</div>
@include('include.subFooter')
@stop