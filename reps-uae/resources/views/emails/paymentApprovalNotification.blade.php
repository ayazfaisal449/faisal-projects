<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>Your renewal payment has been approved!</h2>
    <div>
        <p>
            Hello {{$name}}. Thank you for renewing your registration with REPs UAE. Your membership has been extended to {{$expiry_date}}.
        </p>

        <p>You can view and download your REPs E-Card and E-Certificate by logging in to your <a href="https://www.repsuae.com/trainer/login">dashboard</a> or by clicking on this link - <a href="https://www.repsuae.com/trainer/login">https://www.repsuae.com/trainer/login</a>. You can also have access to a REPs PAR-Q form and REPs registered exercise professional logo.</p>

        <p>To stay connected with REPs UAE and stay up to date with all of our latest news, please follow us on:</p>

        <p><a href="https://www.facebook.com/REPSUAE">Facebook</a> and <a href="https://instagram.com/repsuae">Instagram</a> @repsuae</p>

        <h3>COMPREHENSIVE LIABILITY INSURANCE FOR FITNESS PROFESSIONALS</h3>

        <p>Public Liability and Professional Indemnity Insurance for REPs members is available for the amount of Dhs1,472 + 5% VAT per year. For more information and how to apply, please contact Yasser Mohammed at +971 4 237 2822 or email him at <a href="mailto:yasser.mohammed@alfuttaim.com">yasser.mohammed@alfuttaim.com</a>.</p>

        <h3>ON GOING TRAINING/CPD POINTS</h3>

        <p>Upon membership renewal, you will be requested to upload your continuing education certificates from REPs approved education courses. You are required to obtain 20 CPD points over a 2-year period. For information on approved courses, please browse through our website: '<a href="{{ URL::action('CourseController@cpdCourseProviders') }}">Approved Training</a>' for a list of CPD courses. You will also receive a monthly mailer informing you of upcoming courses.</p>
        
        <p><strong>**Please note that a 30 days grace period will be given from expiration of membership, after which, a penalty of Dhs100 will be incurred for late renewal**</strong></p>

        <p>We look forward to working together with you in developing and professionalising the fitness industry in the UAE.</p>

        <p>If you require any further guidance, please do not hesitate to contact us on 04 321 3388 or <a href="mailto:faisal.ayaz@sigmads.com">faisal.ayaz@sigmads.com</a>, we are here to offer support.</p>
        
        <p>Kind Regards,</p>
         
        <p>REPs UAE Team</p>
        <p>
            Gold and Diamond Park, <br />
            2nd Floor Bldg. 7-208<br />
            Al Quoz Industrial Area<br />
            Near Equiti Metro Station<br />
            Dubai, United Arab Emirates
        </p>
    </div>
</body>
</html>




