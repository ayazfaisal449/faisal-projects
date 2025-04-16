@extends('layouts.primary')

@section('content')
    
    @include('include.subNav')
    
    <div class="border-bottom">
        <div class="row">
            <div class="large-12 columns">
                <h1 class="color-green">Code of Ethics</h1>
            </div>
        </div>
    </div>
    
    <div class="background-grey">
        <div class="row">
            <div class="large-12 columns">
                <p>
                    REPs UAE seeks an ethical advancement of the sport and fitness industry. 
                    It is true to the mission of REPs UAE to ensure that registered exercise 
                    professionals maintain ethical standards when practicing their profession. 
                    The REPs UAE Code of Ethics enables further protection to individuals 
                    seeking a healthy and balanced lifestyle.
                </p>
                <p>
                    It is expected that all exercise professionals maintain 
                    a high degree of professionalism and ethical behaviour. 
                    All REPs UAE registered exercise professionals agree to
                    abide by this Code of Ethics.
                </p>
                
                <div class="download">
                    <a href="{{Request::root()}}/download/REPs-UAE-Code-of-Ethics-2014.pdf">
                        <img src ="{{Request::root()}}/img/download.png" alt="Download Code of Ethics" />
                        <span>Download</span>
                    </a>
                    <span>(REPs UAE - Code of Ethics)</span>
                </div>
                
                <p class="margin-top-bottom-20">
                    REPs UAE works to promote ethical practices in the fitness industry.  It is part of the 
                    mission of REPs to ensure that registered exercise professionals maintain ethical standards.  
                    The REPs UAE Code of Ethics provides further protection for members of the public
                    seeking a healthy lifestyle and using the services of a registered exercise professional.  
                </p>
                
                <div class="ethicsHeaderGreen">
                    Professional Standards
                </div>
                
                <p class="special">
                    The exercise professional will:
                </p>
                
                <div class="row">
                    <div class="large-4 columns">
                        <p class="ethicsParagraphGreen">
                            Maintain their level of qualification and undergo 
                            continuing professional development activities
                        </p>
                        <p class="ethicsParagraphGreen">
                            On request detail their qualifications, 
                            experience and registration details to participants
                        </p>
                        <p class="ethicsParagraphGreen">
                            Understand legal responsibilities and 
                            accountability as an exercise professional
                        </p>
                    </div>
                    <div class="large-4 columns">
                        <p class="ethicsParagraphGreen">
                            Promote and maintain practice based on 
                            current knowledge and research
                        </p>
                        <p class="ethicsParagraphGreen">
                            Recognise when it is important to refer 
                            a participant to another professional
                        </p>
                        <p class="ethicsParagraphGreen">
                            Accept responsibility for professional decisions
                        </p>
                    </div>
                    <div class="large-4 columns">
                        <p class="ethicsParagraphGreen">
                            Act within the boundaries of their qualification
                            and registration level
                        </p>
                        <p class="ethicsParagraphGreen">
                            Project an image of professionalism and good health
                        </p>
                    </div>
                </div>
                
                <div class="ethicsHeaderBlack">
                    Relationships
                </div>
                
                <p class="special">
                    The exercise professional will:
                </p>
                
                <div class="row">
                    <div class="large-4 columns">
                        <p class="ethicsParagraphBlack">
                            Act with integrity as an exercise professional
                        </p>
                        <p class="ethicsParagraphBlack">
                            Avoid inappropriate behaviour in relations with
                            participants while working as an exercise professional
                        </p>
                    </div>
                    <div class="large-4 columns">
                        <p class="ethicsParagraphBlack">
                            Promote the welfare and best interests of participants
                        </p>
                    </div>
                    <div class="large-4 columns">
                        <p class="ethicsParagraphBlack">
                            Ensure clarity, honesty and accuracy in all
                            communications with participants and others
                        </p>
                    </div>
                </div>
                
                <div class="ethicsHeaderOrange">
                   Respect and Transparency
                </div>
                
                <p class="special">
                    The exercise professional will:
                </p>
                
                <div class="row">
                    <div class="large-4 columns">
                        <p class="ethicsParagraphOrange">
                            Respect individual difference and diversity
                        </p>
                        <p class="ethicsParagraphOrange">
                            Keep clear records of dealings with participants
                        </p>
                        <p class="ethicsParagraphOrange">
                            Inform participants transparently of any fi nancial costs
                            related to activity
                        </p>
                    </div>
                    <div class="large-4 columns">
                        <p class="ethicsParagraphOrange">
                            Treat everyone equitably and sensitively within the
                            context of their activity and ability – regardless of age,
                            disability, gender and ethnic background
                        </p>
                        <p class="ethicsParagraphOrange">
                            Respect and preserve confidential information relating
                            to participants in terms of personal, social, health, and
                            fitness information
                        </p>
                        <p class="ethicsParagraphOrange">
                            Ensure relationships between registered professionals
                            and their clients should be based on documented,
                            contractual arrangements which are clear, transparent
                            and unambiguous. 
                        </p>
                    </div>
                    <div class="large-4 columns">
                        <p class="ethicsParagraphOrange">
                            Challenge any form of discrimination against a
                            participant
                        </p>
                        <p class="ethicsParagraphOrange">
                            Only disclose information to other professionals that is
                            necessary and with permission of the participant
                        </p>
                    </div>
                </div>
                
                <div class="ethicsHeaderRed">
                    Safety
                </div>
                
                <p class="special">
                    The exercise professional will:
                </p>
                
                 <div class="row">
                    <div class="large-4 columns">
                        <p class="ethicsParagraphRed">
                            Maintain the safety of participants
                        </p>
                        <p class="ethicsParagraphRed">
                            Show a duty of care and deal with accidents and
                            emergencies appropriately
                        </p>
                    </div>
                    <div class="large-4 columns">
                        <p class="ethicsParagraphRed">
                            Not advocate of condone the use performance
                            enhancing substances
                        </p>
                        <p class="ethicsParagraphRed">
                            Ensure participants have prepared adequately for
                            activity
                        </p>
                    </div>
                    <div class="large-4 columns">
                        <p class="ethicsParagraphRed">
                            Identify and respect the physical limits of ability of
                            participant
                        </p>
                    </div>
                </div>
                
                <div class="ethicsHeaderGrey">
                    General
                </div>
                
                <p class="special">
                    The exercise professional will:
                </p>
                
                <div class="row">
                    <div class="large-4 columns">
                        <p class="ethicsParagraphGrey">
                            Not do anything that brings themselves, another fi tness
                            professional, a fi tness centre, REPs UAE, or the fi tness
                            industry in to disrepute
                        </p>
                    </div>
                    <div class="large-4 columns end">
                        <p class="ethicsParagraphGrey">
                            Ensure advertising of services is truthful, inoffensive
                            and does not make claims that can not be supported
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
   @include('include.subFooter')
    
@stop

<!-- Adding the fancy box for the images -->
@section('customScripts')
	$(document).ready(function() {
		
          
       
	});
@stop
