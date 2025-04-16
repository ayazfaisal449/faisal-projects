@extends('layouts.primary')

@section('content')
    
    @include('include.subNav')
    
    <div class="border-bottom">
        <div class="row">
            <div class="large-12 columns">
                <h1 class="color-green">Global Registers</h1>
                <p>
                    The registration of qualified and competent fitness professionals is now a common feature of 
                    the fitness industry around the world.  REPs UAE is proud to be a full member the International 
                    Confederation of Registers for Exercise Professionals (ICREPs).  REPs UAE had to meet stringent 
                    entry criteria to join ICREPs and show that the standards and processes for the register in the UAE 
                    are comparable to other nations around the world. 
                </p>
                <p>REPs close working relationship with ICREPs and the other fitness registers around the world means we 
                    can learn from global best practice and ensure that the UAE fitness industry rightfully takes its place 
                    and has influence at the global level. 
                </p>
                <p>REPs is working on a global matrix to show how instructors from ICREPs member countries can move to the 
                    UAE and be recognised with REPs and what REPs UAE members have to do to be recognised on other ICREPs 
                    member registers when they move to other countries. 
                </p>
                <p>
                    Click on a logo below to visit the website of our partner registers and fellow ICREPs members 
                    around the world. 
                </p>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="large-3 columns">
            <div class="registerWrapper">
                <a href="http://www.icreps.org " target="_blank">
                    <img src="{{Request::root()}}/img/global-registers/IC-REPS.png" alt="ICREPs"/>
                    <span>ICREPs</span>
                </a>
            </div>
        </div>
        <div class="large-3 columns">
            <div class="registerWrapper">
                <a href="http://www.fitness.org.au" target="_blank">
                    <img src="{{Request::root()}}/img/global-registers/Australia-REPS.png" alt="FITNESS AUSTRALIA"/>
                    <span>FITNESS AUSTRALIA</span>
                </a>
            </div>
        </div>
        <div class="large-3 columns">
            <div class="registerWrapper">
                <a href="http://www.provincialfitnessunit.ca/nfla/" target="_blank">
                    <img src="{{Request::root()}}/img/global-registers/Canada-REPS.png" alt="NFLA (CANADA"/>
                    <span>NFLA (CANADA)</span>
                </a>
            </div>
        </div>
        <div class="large-3 columns end">
            <div class="registerWrapper">
                <a href="http://www.repsireland.ie" target="_blank">
                    <img src="{{Request::root()}}/img/global-registers/Ireland-REPS.png" alt="REPS IRELAND"/>
                    <span>REPS IRELAND</span>
                </a>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="large-3 columns">
            <div class="registerWrapper">
                <a href="http://www.reps.org.nz" target="_blank">
                    <img src="{{Request::root()}}/img/global-registers/New-Zealand-REPS.png" alt="REPs NEW ZEALAND"/>
                    <span>REPs NEW ZEALAND</span>
                </a>
            </div>
        </div>
        <div class="large-3 columns">
            <div class="registerWrapper">
                <a href="http://www.repssa.com " target="_blank">
                    <img src="{{Request::root()}}/img/global-registers/SA-REPS.png" alt="REPs SOUTH AFRICA"/>
                    <span>REPs SOUTH AFRICA</span>
                </a>
            </div>
        </div>
        <div class="large-3 columns">
            <div class="registerWrapper">
                <a href="http://www.exerciseregister.org" target="_blank">
                    <img src="{{Request::root()}}/img/global-registers/UK-REPS.png" alt="REPs UK"/>
                    <span>REPs UK</span>
                </a>
            </div>
        </div>
        <div class="large-3 columns end">
            <div class="registerWrapper">
                <a href="http://www.usreps.org" target="_blank">
                    <img src="{{Request::root()}}/img/global-registers/US-REPS.png" alt="USREPs"/>
                    <span>USREPs</span>
                </a>
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
