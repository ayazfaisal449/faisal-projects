@extends('layouts.primary')

@section('content')
    @include('include.subNav')
    
   <div class="border-bottom">
        <div class="row">
            <div class="large-12 columns">
                <h1>Your Qualifications</h1>
                <p>Hi, {{$user->first_name}} {{$user->last_name}}. These are your Certificates</p>
            </div>
        </div>
    </div>
    
    @foreach($qualifications as $qualification)
        <div class="yourCertifications">
            <div class="row">
                <div class="large-12 columns">
                    <h2>Qualification</h2>
                </div>
            </div>
            <div class="row">
                <div class="large-6 columns">
                    <h3>Description</h3>
                    <div class="wrapper">
                        <h6>Name of Course/Qualification</h6>
                        <p>{{$qualification->course_name}}</p>
                        
                        <h6>Date Completed</h6>
                        <p>{{$qualification->date_completed}}</p>
                        
                        <h6>Course Provider/Name of Institution</h6>
                        <p>{{$qualification->course_provider}}</p>
                    </div>
                </div>
                
                <div class="large-6 columns">
                    <h3>Certificates</h3>
                    <div class="wrapper">
                        @for($i=0;$i<count($qualification->certificate);$i++)
                            <?php $ext = pathinfo($qualification->certificate[$i], PATHINFO_EXTENSION); ?>
                            <a class="filecont" href="{{Request::root().'/trainer/'.$user->id.'/certificate/'.$qualification->certificate[$i]}}" target="_blank">
                                @if ($ext == 'doc' || $ext == 'docx')
                                    <img width="140" src="{{ Request::root() }}/img/docicon_doc.png" alt="{{ $qualification->certificate[$i] }}" title="{{ $qualification->certificate[$i] }}" />
                                @elseif ($ext == 'pdf')
                                    <img width="140" src="{{ Request::root() }}/img/docicon_pdf.png" alt="{{ $qualification->certificate[$i] }}" title="{{ $qualification->certificate[$i] }}" />
                                @else
                                    <img width="140" src="{{ Request::root() }}/img/docicon_img.png" alt="{{ $qualification->certificate[$i] }}" title="{{ $qualification->certificate[$i] }}" />
                                @endif
                            </a>
                        @endfor
                    </div>
                </div>
            </div> 
        </div>
    @endforeach
    
    @include('include.subFooter')
          
@stop
