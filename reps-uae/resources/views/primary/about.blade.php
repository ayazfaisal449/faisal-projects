@extends('layouts.primary')

@section('content')
    
 
    
    <div class="row">
         <div class="columns large-12 medium-12 small-12">
             <div class="title-div">
                @foreach($about as $dat)
                  <h4>{!!$dat->text!!}</h4>

                 <p><a class="activeMe right" href="">About</a><i class="right fa fa-angle-right"></i> <a class="right" href="{{Request::root()}}">Home</a></p>
             </div>
            <div class="row ">
                 <div class="columns large-12 medium-12 small-12">
                    <img class="bottom20" src="{{$dat->images}}">
                 </div>
            </div>
        </div>
    </div> 

    <div class="row">
        <div class="small-12 columns">
            {!!$dat->textarea1!!}
        </div>
    </div>


      @endforeach
@stop

@section('customScripts')
@stop
