@extends('layouts.primary')

@section('content')
    @include('include.subNav')
    
   <div class="border-bottom">
        <div class="row">
            <div class="large-12 columns">
                <h1>Download </h1>
                <p>Hi, {{$user->first_name}} {{$user->last_name}} . You can download files from here.</p>
            </div>
        </div>
    </div>
    
    
        <div class="yourCertifications">
            
            <div class="row">
                @foreach($e_certificate as $e_certificates)
                
                    <div class="wrapper">
                       <div class="row">
                         <div class="large-4 columns">
                            <?php $ext = pathinfo($e_certificates->e_certificate, PATHINFO_EXTENSION); ?>
                              @if ($e_certificates->e_certificate)
                            <a class="filecont" href="{{Request::root().'/trainer/'.$user->id.'/e_certificate/'.$e_certificates->e_certificate}}" target="_blank">
                              @if ($ext == 'doc' || $ext == 'docx')
                                    <img width="140" src="{{ Request::root() }}/img/docicon_doc.png" alt="{{ $e_certificates->e_certificate }}" title="{{ $e_certificates->e_certificate }}" />
                                    <div><button class="textsize"> Download E-Certificate</button></div>
                                @elseif ($ext == 'pdf')
                                    <img width="140" src="{{ Request::root() }}/img/docicon_pdf.png" alt="{{ $e_certificates->e_certificate }}" title="{{ $e_certificates->e_certificate }}" />
                                   <div><button class="textsize"> Download E-Certificate</button></div>
                                @else
                                    <img width="160" src="{{Request::root()}}/trainer/{{$user->id}}/e_certificate/{{$e_certificates->e_certificate}}" alt="{{ $e_certificates->e_certificate }}" title="{{ $e_certificates->e_certificate }}" />
                                   <div><button class="textsize">Download E-Certificate</button></div>
                                @endif
                              
                            </a>
                            @endif  
                        </div>

                        <div class="large-4 columns">
                             <a class="filecont" href="{{Request::root().'/download/Physical_Activity_Readiness_Questionnaire.pdf'}}" target="_blank">
                                <img width="140" src="{{ Request::root() }}/download/form.png" />
                               <div> <button class="textsize">Download Physical Activity Questionnaire</button></div>
                           </a>
                        </div>

                        <div class="large-4 columns">
                              <a class="filecont" href="{{Request::root().'/download/REPs_member_logo_for_members_final.jpg'}}" target="_blank">
                                <img width="140" src="{{ Request::root() }}/download/REPs_member_logo_for_members_final.jpg" />
                              <div> <button class="textsize"> Download REPs UAE Logo</button> </div>
                           </a>
                        </div>
                     </div> 
                </div>
            
                @endforeach
         </div> 
     </div>
  
    
   
          
@stop
<style>
    
    a.filecont:hover {
    color: black;
}
.large-4.columns {
    text-align: center;
}
.large-4.columns img {
    width: 170px;
    height: 170px;
    object-fit: contain;
}

.large-4.columns button.textsize {
    font-size: 13px;
}
</style>