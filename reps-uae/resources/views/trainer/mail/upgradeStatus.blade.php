<p style="color:red;">Dear {{ $firstname }}</p>

@if ($newStatusId == 2)
    <p>
    Thank you for submitting additional certificates and requesting an upgrade to your status on REPs UAE from provisional to full status.  Your certificate is accepted and we are pleased to upgrade you on REPs to {{ strtolower($newStatus) }} status.
    </p>

    <p>Your membership is at Categories: <strong style="color:red;"> {{ implode(', ', $categories) }}</strong></p>

    @if(isset($update_until))

    Valid until: <strong style="color:red;">{{ $update_until }}</strong>
    @endif

    @if (!empty($messageTxt))
        <p>{{ $messageTxt }}</p>
    @endif

    {{-- <p>
    You can now contact the REPs office on <a href="mailto:faisal.ayaz@sigmads.com">faisal.ayaz@sigmads.com</a> or 
    call +971 4 340 7407 to arrange to collect your new updated 
    member ID card and certificate stating full status. There is 
    no additional cost for this service. 
    </p> --}}
    
    <p>Your membership is now activated with your profile visible on our website under '<a href="{{ URL::action('TrainerController@trainerSearchUserIndex') }}">Search Trainer</a>'.</p>

    <p>An e-certificate can be be emailed to you upon request.</p>

    {{-- <p>Your e-certificate will be sent to you shortly. You may come to our office at your convenience to collect your new membership card. There is no additional cost for this service. </p> 
    <p>You may come to our office at your convenience to collect your membership card, if an e-certificate is required, one will be provided upon request.</p> --}}
@else
    <p>
    Thank you for submitting additional certificates and requesting an upgrade to your status on REPs from Provisional to Full status.  Unfortunately we are unable to upgrade your status at the moment as the certificates that you have supplied are not recognized as REPs Entry Level qualifications.
    </p>

    @if (!empty($messageTxt))
        <p>{{ $messageTxt }}</p>
    @endif

    <p>Please see our website for further details on Provisional Status, as well as information on REPs categorisation of Entry Level qualifications and CPD.</p>
@endif



{{-- <p>Your membership is now activated with your profile visible on our website under '<a href="{{ URL::action('TrainerController@trainerSearchUserIndex') }}">Search Trainer</a>'.</p> --}}

{{-- <p>Your e-certificate will be sent to you shortly. You may come to our office at your convenience to collect your membership card. There is no additional cost for this service. </p> --}}



<p>To stay connected with REPs UAE please connect with us on:</p>

 <p> <a href="https://www.facebook.com/REPSUAE">Facebook</a> and
     <a href="https://instagram.com/repsuae">Instagram</a> @repsuae
 </p>
      

{{-- <h3>MEMBERS BENEFITS</h3>

<p>For a list of membership benefits, please go to '<a href="{{ URL::action('PrimaryController@benefits') }}">Benefits</a>' on our website.</p>

<h3>CPR/FIRST AID</h3>

<p>In line with other Registers, as of January 2016 all REPs members must have an up to date first aid certification.</p>

<p>FIRST AID courses are being conducted out of our offices in Gold and Diamond Park for a special member price of Dhs350.</p>

<p>Please contact membership@repsuae.com for a list of upcoming dates</p> --}}

<h3>COMPREHENSIVE LIABILITY INSURANCE FOR FITNESS PROFESSIONALS</h3>

<!-- <p>We are delighted to announce we have negotiated an extremely good rate for all REPs registered fitness professionals in the UAE. For as little as Dhs708.75 (VAT incl.) per year you can obtain full professional liability insurance. For policy information and application form go to our website: '<a href="{{ URL::action('PrimaryController@insurance') }}">Insurance</a>' or come in to our office.</p> -->
<p>Public Liability and Professional Indemnity Insurance for REPs members is available for the amount of
Dhs1,472 + 5% VAT per year. For more information and how to apply, please contact Yasser Mohammed
at +971 4 237 2822 or email him at <a href="mailto:yasser.mohammed@alfuttaim.com">yasser.mohammed@alfuttaim.com</a></p>

<h3>ON GOING TRAINING/CPD POINTS</h3>

<p>Upon membership renewal you will be requested to upload certificates from REPs approved continuing
education courses. You are required to obtain 20 CPD points over a 2 year period. For information on
approved courses please browse through our website: '<a href="{{ URL::action('CourseController@cpdCourseProviders') }}">Approved Training</a>' for a list of approved Training Providers. Click on any of their logos for a list of courses.</p>

<p>Please note that 30 days grace period will be given from expiration of membership, after which, a
penalty of Dhs100 will be incurred for late renewal.</p>

<p>We look forward to working together with you in developing and professionalising the fitness industry in the UAE.</p>

<p>If you require any further guidance, please do not hesitate to contact us on 04 321 3388 or <a href="mailto:faisal.ayaz@sigmads.com">faisal.ayaz@sigmads.com</a>, we’re all here to offer support.</p>

<p>Kind Regards,</p>
 
<p>REPs UAE Team</p>

<p>
    Gold and Diamond Park, <br />
    2nd Floor Bldg. 7-208<br />
    {{-- 'Just Kidding' building <br /> --}}
    Al Quoz Industrial Area<br />
    Near Umm Al Sheef Metro Station<br />
    Dubai, United Arab Emirates
</p>