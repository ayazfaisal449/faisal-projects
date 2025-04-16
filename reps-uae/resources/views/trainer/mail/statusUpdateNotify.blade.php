<p>Dear {{ $first_name . ' ' . $last_name }}</p>

@if ($old_status_id == 3 && $new_status_id != 3)
    
    <p>Thank you for registering with REPs UAE and welcome to the REPs Community.</p>
    
    <p>Your membership is at Categories: <strong> {{ implode(', ', $categories) }}</strong></p>
    
    @if(isset($update_until))

    Valid until: <strong>{{ $update_until }}</strong>
    @endif

    <p>Your membership is now activated with your profile visible on our website under '<a href="{{ URL::action('TrainerController@trainerSearchUserIndex') }}">Search Trainer</a>'.</p>

    @if ($old_status_id == 3 && $new_status_id == 1)
        <p style="color: red;">
        You have been given <b>Provisional Status</b> on REPs. 
        Trainers are given provisional status where we 
        are unable to verify their certifications against 
        the UAE Fitness Standards.  Please find attached 
        information for provisional members. 
        </p>
    @endif

    @if (!empty($message_for_trainer))
        <p>{{ nl2br($message_for_trainer) }}</p>
    @endif

    <p>You can view and download your REPs E-Card and E-Certificate by logging in to your <a href="https://www.repsuae.com/trainer/login">dashboard</a> or by clicking on this link - <a href="https://www.repsuae.com/trainer/login">https://www.repsuae.com/trainer/login</a>. You can also have access to a REPs PAR-Q form and REPs registered exercise professional logo.</p>

    <p>As a government requirement, please provide us with a copy of your EMIRATES ID at the earliest and send to <a href="mailto:yasser.mohammed@alfuttaim.com">faisal.ayaz@sigmads.com</a>. Please disregard if you have already submitted within your application.</p>

    <p>To stay connected with REPs UAE and stay up to date with all of our latest news, please follow us on: </p>

    <p><a href="https://www.facebook.com/REPSUAE">Facebook</a> and <a href="https://instagram.com/repsuae">Instagram</a> @repsuae</p>

    <h3>COMPREHENSIVE LIABILITY INSURANCE FOR FITNESS PROFESSIONALS</h3>

    <p>Public Liability and Professional Indemnity Insurance for REPs members is available for the amount of Dhs1,472 + 5% VAT per year. For more information and how to apply, please contact Yasser Mohammed at +971 4 237 2822 or email him at <a href="mailto:yasser.mohammed@alfuttaim.com">yasser.mohammed@alfuttaim.com</a></p>

    <h3>ON GOING TRAINING/CPD POINTS</h3>

    <p>Upon membership renewal you will be requested to upload your continuing education certificates from REPs approved education courses. You are required to obtain 20 CPD points over a 2 year period. For information on approved courses please browse through our website: '<a href="{{ URL::action('CourseController@cpdCourseProviders') }}">Approved Training</a>' for a list of CPD courses. You will also receive a monthly mailer informing you of upcoming courses.</p>
    
    <p><strong><em>**Please note that a 30 days grace period will be given from expiration of membership, after which, a penalty of Dhs100 will be incurred for late renewal**</em></strong></p>
    
    <p>We look forward to working together with you in developing and professionalising the fitness industry in the UAE.</p>

    <p>If you require any further guidance, please do not hesitate to contact us on 04 321 3388 or <a href="mailto:faisal.ayaz@sigmads.com">faisal.ayaz@sigmads.com</a>, we’re here to offer support.</p>
    
@else

{{-- <p>Welcome to the REPs Community!</p> --}}
    @if ($old_status_id == 1 && $new_status_id == 2)
        <p>Thank you for submitting additional certificates and requesting an upgrade to your status on REPs UAE from provisional to full status.  Your certificate is accepted and we are pleased to upgrade you on REPs to full status. </p>
    @elseif ($old_status_id == 1 && $new_status_id == 1)
    
        <p>Thank you for submitting additional certificates and requesting an upgrade to your status on REPs from Provisional to Full status.  Unfortunately we are unable to upgrade your status at the moment as the certificates that you have supplied are not recognized as REPs Entry Level qualifications.</p>
    @else
        <p>Thank you for registering with REPs UAE and welcome to the REPs Community.</p>
    @endif
        
    
    <p>Your membership is at Categories: <strong> {{ implode(', ', $categories) }}</strong></p>
    
    @if(isset($update_until))

    Valid until: <strong>{{ $update_until }}</strong>
    @endif

    @if (!empty($message_for_trainer))
        <p>{{ nl2br($message_for_trainer) }}</p>
    @endif
    
    <p>Your membership is now activated with your profile visible on our website under '<a href="{{ URL::action('TrainerController@trainerSearchUserIndex') }}">Search Trainer</a>'.</p>

    {{-- <p>Your e-certificate will be sent to you shortly. You may come to our office at your convenience to collect your membership card.</p> --}}

   {{-- <p>We will soon be launching our very own REPs app, which will have a wide range of features for both you as a Trainer and the public.</p>
    <p>Moving with the times, and in unison with our App launch, your membership card will also become digital and available through our soon to be launched REPs app.  Please note that no more plastic membership cards will be printed in the interim period, an e-certificate will be emailed to you upon request.</p> --}}

    <p>An e-certificate can be be emailed to you upon request.</p>

    <p>To stay connected with REPs UAE please connect with us on:</p>

    <table>
        <tr>
            <td><a href="https://www.facebook.com/REPSUAE"><img style="height:50px;width:50px;" src="https://lh6.googleusercontent.com/-CNXV2lHwUBY/VZI3WmgRg3I/AAAAAAAAAjE/VEKrDb79dXo/s225-no/fb.png"></a></td>
            <td><a href="https://twitter.com/repsuae"><img style="height:50px;width:50px;" src="https://lh4.googleusercontent.com/-xHXILWXjtVs/VZI3WjzuTPI/AAAAAAAAAjA/KROqhXhGYjs/s225-no/twitter.png"></a></td>
            <td><a href="https://instagram.com/repsuae"><img style="height:50px;width:50px;" src="https://lh6.googleusercontent.com/-NPxVIZPYwts/VZI3WnIBUFI/AAAAAAAAAjI/UY5HVUIHwnQ/s225-no/instagram.png" alt=""></a></td>
            <td>@repsuae</td>
        </tr>
    </table>
 @if ($old_status_id == 2 && $new_status_id == 1)
    <h3>MEMBERS BENEFITS</h3>

    <p>For a list of membership benefits, please go to '<a href="{{ URL::action('PrimaryController@benefits') }}">Benefits</a>' on our website.</p>

    <h3>CPR/FIRST AID</h3>

    <p>In line with other Registers, as of January 2016 all REPs members must have an up to date first aid certification.</p>

    <p>FIRST AID courses are being conducted out of our offices in Gold and Diamond Park for a special member price of Dhs350.</p>

    <p>Please contact membership@repsuae.com for a list of upcoming dates</p>
    @endif

    <h3>COMPREHENSIVE LIABILITY INSURANCE FOR FITNESS PROFESSIONALS</h3>

    <p>Public Liability and Professional Indemnity Insurance for REPs members is available for the amount of
      Dhs1,472 + 5% VAT per year. For more information and how to apply, please contact Yasser Mohammed
      at +971 4 237 2822 or email him at <a href="mailto:yasser.mohammed@alfuttaim.com">yasser.mohammed@alfuttaim.com</a></p>

    <h3>ON GOING TRAINING/CPD POINTS</h3>

    <p>Upon membership renewal you will be requested to upload your continuing education certificates from REPs approved education courses. You are required to obtain 20 CPD points over a 2 year period. For information on approved courses please browse through our website: '<a href="{{ URL::action('CourseController@cpdCourseProviders') }}">Approved Training</a>' for a list of CPD courses. You will also receive a monthly mailer informing you of upcoming courses.</p>
    
    <p><strong><em>**Please note that a 30 days grace period will be given from expiration of membership, after which, a penalty of Dhs100 will be incurred for late renewal**</em></strong></p>
    
    <p>We look forward to working together with you in developing and professionalising the fitness industry in
     the UAE.</p>

    <p>If you require any further guidance, please do not hesitate to contact us on 04 321 3388 or <a href="mailto:faisal.ayaz@sigmads.com">faisal.ayaz@sigmads.com</a>, we’re all here to offer support.</p> ok forward to working with you to develop the fitness industry in UAE.</p>

@endif

<p>Kind Regards,</p>

<p>REPs UAE Team</p>

<p>
    Gold and Diamond Park, <br />
    2nd Floor Bldg. 7-208<br />
    Al Quoz Industrial Area<br />
    Near Equiti Metro Station<br />
    Dubai, United Arab Emirates
</p>