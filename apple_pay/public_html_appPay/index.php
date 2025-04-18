<?php
require_once ('/var/www/sdomains/ecoms/alaswad.scdwapps.com/public_html/apple_pay_conf.php');
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ApplePay Test</title>
<style>
#applePay {  
	width: 150px;  
	height: 50px;  
	display: none;   
	border-radius: 5px;    
	margin-left: auto;
	margin-right: auto;
	margin-top: 20px;
	background-image: -webkit-named-image(apple-pay-logo-white); 
	background-position: 50% 50%;
	background-color: black;
	background-size: 60%; 
	background-repeat: no-repeat;  
}
</style>
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div>
<button type="button" id="applePay"></button>
<p style="display:none" id="got_notactive">ApplePay is possible on this browser, but not currently activated.</p>
<p style="display:none" id="notgot">ApplePay is not available on this browser</p>
<p style="display:none" id="success">Test transaction completed, thanks. <a href="<?=$_SERVER["SCRIPT_URL"]?>">reset</a></p>
</div>
<script type="text/javascript">

var debug = <?=DEBUG?>;

if (window.ApplePaySession) {
   var merchantIdentifier = '<?=PRODUCTION_MERCHANTIDENTIFIER?>';
   var promise = ApplePaySession.canMakePaymentsWithActiveCard(merchantIdentifier);
   promise.then(function (canMakePayments) {
	   if (canMakePayments) {
		 document.getElementById("applePay").style.display = "block";
		 logit('hi, I can do ApplePay');
	  } else {   
		 document.getElementById("got_notactive").style.display = "block";
		 logit('ApplePay is possible on this browser, but not currently activated.');
	  }
	}); 
} else {
	logit('ApplePay is not available on this browser');
	document.getElementById("notgot").style.display = "block";
}

document.getElementById("applePay").onclick = function(evt) {

	var runningAmount 	= 42;
	 var runningPP		= 0;
	 var runningTotal	= function() { return runningAmount + runningPP; }
	 // var shippingOption = "";
	 
	 var subTotalDescr	= "Test Goodies";
	 
	 // function getShippingOptions(shippingCountry){
	 // logit('getShippingOptions: ' + shippingCountry );
		// if( shippingCountry.toUpperCase() == "<?=PRODUCTION_COUNTRYCODE?>" ) {
		// 	shippingOption = [{label: 'Standard Shipping', amount: getShippingCosts('domestic_std', true), detail: '3-5 days', identifier: 'domestic_std'},{label: 'Expedited Shipping', amount: getShippingCosts('domestic_exp', false), detail: '1-3 days', identifier: 'domestic_exp'}];
		// } else {
		// 	shippingOption = [{label: 'International Shipping', amount: getShippingCosts('international', true), detail: '5-10 days', identifier: 'international'}];
		// }
	 
	 // }
	 
	 // function getShippingCosts(shippingIdentifier, updateRunningPP ){
	 
		// var shippingCost = 0;
		
		// 	 switch(shippingIdentifier) {
		// case 'domestic_std':
		// 	shippingCost = 3;
		// 	break;
		// case 'domestic_exp':
		// 	shippingCost = 6;
		// 	break;
		// case 'international':
		// 	shippingCost = 9;
		// 	break;
		// default:
		// 	shippingCost = 11;
		// 	}
		
		// if (updateRunningPP == true) {
		// 	runningPP = shippingCost;
		// }
			
		// logit('getShippingCosts: ' + shippingIdentifier + " - " + shippingCost +"|"+ runningPP );
		
		// return 0.1;
	 
	 // }

	 var paymentRequest = {
	   currencyCode: '<?=PRODUCTION_CURRENCYCODE?>',
	   countryCode: '<?=PRODUCTION_COUNTRYCODE?>',
	    // requiredShippingContactFields: ['postalAddress'],
	   //requiredShippingContactFields: ['postalAddress','email', 'name', 'phone'],
	   //requiredBillingContactFields: ['postalAddress','email', 'name', 'phone'],
	   lineItems: [{label: subTotalDescr, amount: runningAmount }, {label: 'P&P', amount: runningPP }],
	   total: {
		  label: '<?=PRODUCTION_DISPLAYNAME?>',
		  amount: runningTotal()
	   },
	   supportedNetworks: ['amex', 'masterCard', 'visa' ],
	   merchantCapabilities: [ 'supports3DS', 'supportsCredit', 'supportsDebit' ]
	};
	
	var session = new ApplePaySession(1, paymentRequest);
	console.log("adil",session);
	
	// Merchant Validation
	session.onvalidatemerchant = function (event) {
		console.log("On Validate",event);	
		// var promise = performValidation('https://apple-pay-gateway-cert.apple.com/paymentservices/startSession');
		var promise = performValidation(event.validationURL);
		console.log("Perform Validation response",promise);
		promise.then(function (merchantSession) {
								console.log("Merchant Session",merchantSession);
								var merchantIdentifierd = merchantSession.merchantIdentifier;
								session.completeMerchantValidation(merchantSession);
								
		}); 
	}


	function performValidation(valURL) {
		return new Promise(function(resolve, reject) {
			var xhr = new XMLHttpRequest();
			xhr.onload = function() {
				var data = JSON.parse(this.responseText);	
				resolve(data);
			};
			xhr.onerror = reject;
			xhr.open('GET', 'apple_pay_comm.php?u=' + valURL);
			xhr.send();
		});
	}

	// session.onshippingcontactselected = function(event) {
	// 	logit('starting session.onshippingcontactselected');
	// 	logit('NB: At this stage, apple only reveals the Country, Locality and 4 characters of the PostCode to protect the privacy of what is only a *prospective* customer at this point. This is enough for you to determine shipping costs, but not the full address of the customer.');
	// 	logit(event);
		
	// 	getShippingOptions( event.shippingContact.countryCode );
		
	// 	var status = ApplePaySession.STATUS_SUCCESS;
	// 	var newShippingMethods = shippingOption;
	// 	var newTotal = { type: 'final', label: '<?=PRODUCTION_DISPLAYNAME?>', amount: runningTotal() };
	// 	var newLineItems =[{type: 'final',label: subTotalDescr, amount: runningAmount }, {type: 'final',label: 'P&P', amount: runningPP }];
		
	// 	session.completeShippingContactSelection(status, newShippingMethods, newTotal, newLineItems );
		
		
	// }
	
	// session.onshippingmethodselected = function(event) {
	// 	logit('starting session.onshippingmethodselected');
	// 	logit(event);
		
	// 	getShippingCosts( event.shippingMethod.identifier, true );
		
	// 	var status = ApplePaySession.STATUS_SUCCESS;
	// 	var newTotal = { type: 'final', label: '<?=PRODUCTION_DISPLAYNAME?>', amount: runningTotal() };
	// 	var newLineItems =[{type: 'final',label: subTotalDescr, amount: runningAmount }, {type: 'final',label: 'P&P', amount: runningPP }];
		
	// 	session.completeShippingMethodSelection(status, newTotal, newLineItems );
		
		
	// }
	
	session.onpaymentmethodselected = function(event) {
		
		var newTotal = { type: 'final', label: '<?=PRODUCTION_DISPLAYNAME?>', amount: runningTotal() };
		var newLineItems =[{type: 'final',label: subTotalDescr, amount: runningAmount }, {type: 'final',label: 'P&P', amount: runningPP }];
		
		session.completePaymentMethodSelection( newTotal, newLineItems );
		
		
	}
	
	session.onpaymentauthorized = function (event) {

    console.log("onpaymentauthorized",event);
		var promise = sendPaymentToken(event.payment.token);
		promise.then(function (success) {	
			var status;
			if (success){
				status = ApplePaySession.STATUS_SUCCESS;
				// ApplePaySession.completePayment(ApplePaySession.STATUS_SUCCESS);
				document.getElementById("applePay").style.display = "none";
				document.getElementById("success").style.display = "block";
			} else {
				status = ApplePaySession.STATUS_FAILURE;
			}
			
			logit( "result of sendPaymentToken() function =  " + success );
			session.completePayment(status);
		});
	}

	function sendPaymentToken(paymentToken) {
		return new Promise(function(resolve, reject) {
			logit('starting function sendPaymentToken()');
			
			var paymentData_data 		= paymentToken.paymentData.data;
			var signature 					= paymentToken.paymentData.signature;
			var transactionIdentifier = paymentToken.transactionIdentifier;
			var publicKeyHash 			= paymentToken.paymentData.header.publicKeyHash;
			var transactionId 			= paymentToken.paymentData.header.transactionId;
			var ephemeralPublicKey 	= paymentToken.paymentData.header.ephemeralPublicKey;
			
			// logit(' merchantIdentifier ='+ merchantIdentifier+' , paymentData_data ='+ paymentData_data+' , transactionIdentifier ='+ transactionIdentifier+' , publicKeyHash ='+ publicKeyHash+' , transactionId ='+ ephemeralPublicKey+' , ephemeralPublicKey ='+ ephemeralPublicKey+' , signature ='+ signature);

			console.log("this is where you would pass the payment token to your third-party payment provider to use the token to charge the card. Only if your provider tells you the payment was successful should you return a resolve(true) here. Otherwise reject;");
			console.log("defaulting to resolve(true) here, just to show what a successfully completed transaction flow looks like");

			// console.log('paymentToken= '+paymentToken);

			var redirect_to = 'https://alaswad.scdwapps.com/call_ms_card_api.php?merchantIdentifier='+merchantIdentifier+'&paymentData_data='+paymentData_data+'&transactionIdentifier='+transactionIdentifier+'&publicKeyHash='+publicKeyHash+'&transactionId='+transactionId+'&ephemeralPublicKey='+ephemeralPublicKey+'&signature='+signature;

			logit('merchantIdentifier ='+ merchantIdentifier);
			logit('data ='+ paymentData_data);
			logit('transactionIdentifier ='+ transactionIdentifier);
			logit('publicKeyHash ='+ publicKeyHash);
			logit('transactionId ='+ transactionId);
			logit('ephemeralPublicKey ='+ ephemeralPublicKey);
			logit('signature ='+ signature);

			// logit('Redirecting to '+ redirect_to);			
			// window.location = redirect_to;
			
			console.log("this is where you would pass the payment token to your third-party payment provider to use the token to charge the card. Only if your provider tells you the payment was successful should you return a resolve(true) here. Otherwise reject;");
			console.log("defaulting to resolve(true) here, just to show what a successfully completed transaction flow looks like");
			if ( debug == true )
			resolve(true);
			else
			reject;
		});
	}
	
	session.oncancel = function(event) {
		logit('starting session.cancel');
		logit(event);
	}
	
	session.begin();

};
	
function logit( data ){
	
	if( debug == true ){
		console.log(data);

		$.ajax({
              type: "GET",
              contentType: "application/json; charset=utf-8",
              url: "https://alaswad.scdwapps.com/pay_response.php",
              data: { event:data },
              success: function (result) {
				console.log("done",result);
                   // do something here
              }
            });
	}	

};
</script>
</body>
</html>
