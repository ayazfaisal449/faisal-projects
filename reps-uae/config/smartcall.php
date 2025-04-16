<?php
return array(
    'userId' => 'cranium@smartcall.ae',
    'password' => 'cm901',
    'url' => 'http://www.smartcall.ae/ClientAPIV3/SubmitMultiXML.aspx',
    'wrapperTemplate' => '<SMS>
		<UserID>%s</UserID>
		<Pwd>%s</Pwd>
		<Messages>%s</Messages>
	</SMS>',
    'messageTemplate' => '<Message>
		<MobileNumber>%s</MobileNumber>
		<Text>%s</Text>
		<Unicode>0</Unicode>
	</Message>',

    'oneMonthBeforeMessage' =>
        'Dear valued REPs member, We would like to remind you that your REPs membership will expire at the end of this month. Failure to renew within 30 days of expiration will incur a Dhs100  penalty fee. You may renew online at www.repsuae.com or at our office in Gold and Diamond Park. Please call 04 3407407 with any queries.',

    'weekAfterMessage' =>
        'Dear valued REPs member, Just a gentle reminder that your REPs membership has now expired. Failure to renew your membership before the end of this month will incur a Dhs100 penalty fee. You may renew online at www.repsuae.com or at our office in Gold and Diamond Park. Please call 04 3407407 with any queries.',

    // New working template, as specified by smartcall
    'wrapperTemplate2' =>
        '
	<SMS>
		<UserID>%s</UserID>
		<Pwd>%s</Pwd>
		<CampaignID>REPS UAE</CampaignID>
		<Messages>
			%s
		</Messages>
	</SMS>
	',
    'messageTemplate2' =>
        '
	<Message>
		<MobileNumber>%s</MobileNumber>
		<SenderID></SenderID>
		<Text>%s</Text>
		<Unicode>0</Unicode>
	</Message>
	',
);
