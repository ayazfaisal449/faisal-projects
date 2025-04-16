@extends('layouts.primary')

@section('content')
    
    @include('include.subNav')
    <div class="row">
         <div class="columns large-12 medium-12 small-12">
             <div class="title-div">
                 <h4>Reps Quarterly</h4>
                 <p>Browse through our REPs quarterly magazines below.<a class="activeMe right" href="">Reps Quarterly</a><i class="right fa fa-angle-right"></i> <a class="right" href="{{Request::root()}}">Home</a></p>
             </div>
            <div class="row ">
                 <div class="columns large-12 medium-12 small-12">
                    
                 </div>
            </div>
        </div>
    </div> 
   
    
    <div class="marketing-mag">
        <div class="row">
            <div class="large-12 medium-12 small-12 columns">
                <iframe width="100%" height="900px" src="http://online.fliphtml5.com/mixt/iigl/#p=1" frameborder="0" allowfullscreen allowtransparency></iframe>
            </div>
            
        </div>
        <div class="row">
            <div class="large-12 medium-12 small-12 columns">
                <h3>REPs UAE Magazine</h3>
                <p>A quarterly publication updating you on industry news and trends. Sharing success stories and career highlights from some of our REPs members.</p>
            </div>
        </div>
        <div class="row subResource">
            <h2>Previous Issues</h2>
            <iframe style='width:100%;height:900px' src='http://fliphtml5.com/bookcase/vdya'  seamless='seamless' scrolling='no' frameborder='0' allowtransparency='true' allowfullscreen ></iframe>
           
            <div class="clearfix"></div>
        </div>
        @if (isset($showme))
            <div class="row subResource">
                <h2>Flyers</h2>

                <div class="column large-3 medium-4 small-6 subResourceItm">
                    <a class="dlink nop" href="#">Download</a>
                    <div class="subResourceImg">
                        <img src="{{ Request::root() . "/img/global-registers/UK-REPS.png"}}" alt="" />
                        <p>Sample Flyer 1</p>
                    </div>
                </div>
                <div class="column large-3 medium-4 small-6 subResourceItm">
                    <a class="dlink nop" href="#">Download</a>
                    <div class="subResourceImg">
                        <img src="{{ Request::root() . "/img/global-registers/New-Zealand-REPS.png"}}" alt="" />
                        <p>Sample Flyer 2</p>
                    </div>
                </div>
                <div class="column large-3 medium-4 small-6 subResourceItm end">
                    <a class="dlink nop" href="#">Download</a>
                    <div class="subResourceImg">
                        <img src="{{ Request::root() . "/img/global-registers/SA-REPS.png"}}" alt="" />
                        <p>Sample Flyer 3</p>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        @endif
    </div>
    
   @include('include.subFooter')
@stop

<!-- Adding the fancy box for the images -->
@section('customScripts')
    $(document).ready(function() {
    });
@stop