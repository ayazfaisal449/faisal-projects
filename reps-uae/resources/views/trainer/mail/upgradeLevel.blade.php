<p>Dear {{ $firstname }}</p>

@if($status == 1)
	<p>
	Thank you for submitting additional certificates and requesting an upgrade to your level or category on REPs UAE. We are pleased to give you the additional categories as requested.      
	</p>

	<p>Your membership is now at <strong>{{ $level }}</strong>, <strong>Categories: {{ implode(', ', $categories) }}</strong></p>
	
	@if(isset($valid_until))

    Valid until: <strong>{{ $valid_until }}</strong>
    @endif

	<p>{{ $messageTxt }}</p>

	{{-- <p>
	You can now contact the REPs office on <a href="mailto:faisal.ayaz@sigmads.com">faisal.ayaz@sigmads.com</a> or 
	call +971 4 340 7407 to arrange to collect your new updated 
	member ID card and certificate stating full status. There is 
	no additional cost for this service. 
	</p>
 --}}
	<p>Your membership is now activated with your profile visible on our website under '<a href="{{ URL::action('TrainerController@trainerSearchUserIndex') }}">Search Trainer</a>'.</p>

	<!-- <p>Your e-certificate will be sent to you shortly. You may come to our office at your convenience to collect your new membership card. There is no additional cost for this service.</p> -->
	<!-- <p>We will soon be launching our very own REPs app, which will have a wide range of features for both you as a Trainer and the public.</p> -->
    <!-- <p>Moving with the times, and in unison with our App launch, your membership card will also become digital and available through our soon to be launched REPs app.  Please note that no more plastic membership cards will be printed in the interim period, an e-certificate will be emailed to you upon request.</p> -->
@else
	<p>
	Thank you for submitting additional certificates and requesting an upgrade to your level or category on REPs UAE. Unfortunately we are unable to upgrade your status at the moment as the certificates that you have supplied are not recognised as REPs Entry Level qualifications for the categories you have requested. 
	</p>

	<p>{{ $messageTxt }}</p>

	{{-- <p>Please see our website for further details on REPs categorisation of Entry Level 
	qualifications.  In order to request an additional category to your membership you 
	must be holding a relevant REPs recognised qualification.</p> --}}

	<p>Please see our website: '<a href="{{ URL::action('PrimaryController@standard') }}">Standards</a>' for further details on REPs categorisation of Entry Level qualifications.  In order to request an additional category to your membership you must be holding a relevant REPs recognised qualification. </p>
@endif



<p>To stay connected with REPs UAE please connect with us on:</p>

<table>
    <tr>
        <td><a href="https://www.facebook.com/REPSUAE"><img style="height:50px;width:50px;" src="https://lh6.googleusercontent.com/-CNXV2lHwUBY/VZI3WmgRg3I/AAAAAAAAAjE/VEKrDb79dXo/s225-no/fb.png"></a></td>
        <td><a href="https://twitter.com/repsuae"><img style="height:50px;width:50px;" src="https://lh4.googleusercontent.com/-xHXILWXjtVs/VZI3WjzuTPI/AAAAAAAAAjA/KROqhXhGYjs/s225-no/twitter.png"></a></td>
        <td><a href="https://instagram.com/repsuae"><img style="height:50px;width:50px;" src="https://lh6.googleusercontent.com/-NPxVIZPYwts/VZI3WnIBUFI/AAAAAAAAAjI/UY5HVUIHwnQ/s225-no/instagram.png" alt=""></a></td>
        <td>@repsuae</td>
    </tr>
</table>

<h3>MEMBERS BENEFITS</h3>

<p>For a list of membership benefits, please go to '<a href="{{ URL::action('PrimaryController@benefits') }}">Benefits</a>' on our website.</p>

<h3>CPR/FIRST AID</h3>

<p>In line with other Registers, as of January 2016 all REPs members must have an up to date first aid certification.</p>

<p>FIRST AID courses are being conducted out of our offices in Gold and Diamond Park for a special member price of Dhs350.</p>

<p>Please contact membership@repsuae.com for a list of upcoming dates</p>

<h3>COMPREHENSIVE LIABILITY INSURANCE FOR FITNESS PROFESSIONALS</h3>

<!-- <p>We are delighted to announce we have negotiated an extremely good rate for all REPs registered fitness professionals in the UAE. For as little as Dhs708.75 (VAT incl.) per year you can obtain full professional liability insurance. For policy information and application form go to our website: '<a href="{{ URL::action('PrimaryController@insurance') }}">Insurance</a>' or come in to our office.</p> -->
<p>We are pleased to announce that we have finally secured an option for Public Liability and Professional Indemnity Insurance for REPs members.  The amount is Dhs1,472 + 5% VAT per year.  For more information and how to apply, please contact Yasser Mohammed at +971 4 237 2822 or email him at <a href="mailto:yasser.mohammed@alfuttaim.com">yasser.mohammed@alfuttaim.com</a></p>

<h3>ON GOING TRAINING/CPD POINTS</h3>

<p>Upon membership renewal you will be requested to upload certificates from REPs approved continuing education courses. <!-- <span style="color:red"> As of January 2017, you are required to accumulate 20 CPD points over 2 years. </span> --> For information on approved courses please browse through our website: '<a href="{{ URL::action('CourseController@cpdCourseProviders') }}">Approved Training</a>' for a list of approved Training Providers. Click on any of their logos for a list of courses.</p>

<p>Please note that 30 days grace period will be given from expiration of membership, after which, a penalty of Dhs100 will be incurred for late renewal.</p>

<p>We look forward to working together with you in developing and professionalising the fitness industry in the UAE.</p>

<p>If you require any further guidance, please do not hesitate to contact us on 04 340 7407 or <a href="mailto:faisal.ayaz@sigmads.com">faisal.ayaz@sigmads.com</a>, we’re all here to offer support.</p>

<p>Kind Regards,</p>
 
<p>REPs UAE Team</p>

<p>
    Gold and Diamond Park, <br />
    2nd Floor Bldg. 7-208<br />
    {{-- 'Just Kidding' building <br /> --}}
    Al Quoz Industrial Area<br />
    Near First Gulf Bank Metro Station<br />
    Dubai, United Arab Emirates
</p>