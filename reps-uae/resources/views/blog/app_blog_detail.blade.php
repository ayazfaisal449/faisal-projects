@extends('layouts.primary')


@section('content')
@include('include.subNav')

<div class="REP-blog-detail">
    <div class="REP-detail-top">
        <h2><a href="{{Request::root()}}/blog">BACK TO BLOGS</a></h2>
    </div>
    <div class="REP-blog-data">
        <div class="container">
            <div class="row">
                @if(!empty($blog))
                <div class="blog-main-img">
                    <img src="{{Request::root()}}/{{$blog->image}}" alt="blog detail" />
                </div>
                <div class="blog-TXT">
                    <label><?php echo date("M d, Y", strtotime($blog->date)); ?></label>
                    <h3>{{$blog->title}} </h3>
                    <?php echo $blog->description; ?> 	     	
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="REP-related-blog">
    <div class="related-blog-top">
        <h5>Related Blogs</h5>
        <a href="{{Request::root()}}/blog">EXPLORE ALL</a>
    </div>
    <div class="details-related-blog">
        <div class="container">
            <div class="row">
                @if(!empty($category_blog))
                @foreach($category_blog as $key => $value)
                @if($key<=2)
                <div class="col-md-4">
                    <div class="related-blog-Post">
                        <a href="{{Request::root()}}/post/{{$value->slug}}"><img src="{{Request::root()}}/{{$value->thumbnail}}" alt="related blog image" /></a>
                        <div class="related-blog-txt">
                            <a href="{{Request::root()}}/post/{{$value->slug}}"><h6>{{$value->title}}</h6></a>
                            <?php echo substr(strip_tags($value->description), 0, 200); echo $key; ?>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                @endif

            </div>
        </div>
    </div>
</div>
@include('include.subFooter')
@stop