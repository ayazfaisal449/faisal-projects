@extends('layouts.primary')

@section('content')
@include('include.subNav')
<div class="row">
         <div class="columns large-12 medium-12 small-12">
             <div class="title-div">

                 <h4>{{$category}}</h4>
                 <p><a class="activeMe right" href="">{{$category}}</a><i class="right fa fa-angle-right"></i><a class="right" href="{{Request::root()}}/training/cpd-providers">Continuing Professional Development </a><i class="right fa fa-angle-right"></i><a class="right" href="{{Request::root()}}/training/entry-qualifications">Training</a><i class="right fa fa-angle-right"></i> <a class="right" href="/">Home</a></p>
             </div>
        </div>
    </div>
   <style> span.bg-cont {
        z-index: 0;
    } </style>

    <div class="row top20 bottom20">
        <div class="columns large-12 small-12">
            <p>
               Qualifications which are recognised by REPs UAE have been accredited by an international awarding body to ensure quality and standards. Click here to see a list of approved training providers and the qualifications they offer which give entry to REPs or can add an extra category to your profile.
            </p>
        </div>
    </div> 

<style>span.bg-cont {
        z-index: 0;
    }

    .custom-accordion .body-accordion a:hover {
        text-decoration: underline;
    }
    .custom-accordion .body-accordion a h5 {
        color: #32a543;
    } .custom-accordion .body-accordion .topneg {
    padding: 0;
    margin-top: -50px;
}</style>
<div class="row bottom30 entry-qualification">
    <div class="columns large-12 cat-box">
        <?php
        $tmp_cat = 0;

        //echo '<pre>'. print_r($qualifications,true).'</pre>';
        ?>

        <div class="border-cstm">
            <div class="custom-accordion cpd_provider">
                <div class="body-accordion" data-body="" style="display: block;"><div class="row"> 
                            <div class="columns medium-12 small-12 topneg">
                                
                                <div class="row course-provider">
                                    <div class="columns large-6"> <h7>Course</h7></div>
                                    <div class="columns large-3"> <h7>Training Provider</h7></div>
                                    <div class="columns large-3"> <h7>CPD Points</h7></div>
                                </div>
                    <?php
                    $qualiKey = '';
                    foreach ($cpdCourseByCategory  as $qualific_key => $qualific) {
                        ?>
                                        <div class="row">
                                            <div class="columns large-6">
                                                <h5 style="border-bottom: none;"><?php echo $qualific['cource_name']; ?></h5>
                                            </div>
                                            <div class="columns large-3">
                                           <a target="_blank" href="http://<?php echo $qualific['website']; ?>"><h5><?php echo $qualific['name']; ?></h5></a>
                                            </div> 
                                            <div class="columns large-3 text-right">
                                                <h5 style="border-bottom: none;"><?php echo $qualific['cpd_d']; ?></h5>
                                            </div> 
                                        </div>                 
<?php } ?></div>
                        </div>
                </div>
            </div>
        </div>

    </div>
</div>



@stop
@section('back')
    
{{--@include('include.subNav')
    
    <div class="pageTitle">
        <div class="row">
            <div class="large-12 columns">
                <h1>Continuing Professional Development (CPD)</h1>
            </div>
        </div>
    </div>
    
    @if (isset($showme))
    <div class="row backbtn">
        <a href="{{ action('CourseController@cpdCourseProviders') }}">Back</a>  
    </div>
    @endif
     
   <div class="entryQualifications">
        <div class="row">
            <div class="large-2 columns">
                <a target="_blank" href="http://{{$cpdCourseProvider['website']}}"><img src="{{Request::root()}}/images/courseProvider/{{$cpdCourseProvider['id']}}/{{$cpdCourseProvider['logo']}}" /></a>
            </div>
            <div class="large-10 columns">
                <table>
                    <thead>
                        <tr>
                            <td>
                                {{$cpdCourseProvider['name']}}
                            </td>
                            <td>
                                REPs UAE CPD Points
                            </td>
                        </tr>
                    </thead>
                     @foreach($cpdCourseProvider['courses'] as $course)
                    <tbody>
                        <tr>
                            <td>{{$course['name']}}</td>
                            <td>{{$course['description']}}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    
    @include('include.subFooter')

@stop--}}

<!-- Adding the fancy box for the images -->
@section('customScripts')
    $(document).ready(function() {
            $('.ui-accordion-header-icon').appen
    });

  $(function() {
    $( "#accordion" ).accordion({
      heightStyle: "fill"
    });
  });

    $('.header-accordion').on('click',function(){
        var num = $(this).data('head');
        if($('.body-accordion[data-body='+num+']').hasClass('open')){
            $('.body-accordion[data-body='+num+']').slideUp("fast").removeClass('open');
            $('.header-accordion[data-head='+num+']').removeClass('activer');
        }
        else{
          
            $('.body-accordion[data-body='+num+']').slideDown().addClass('open');
            $('.header-accordion[data-head='+num+']').addClass('activer');
        }
        
    });
    



@stop
  