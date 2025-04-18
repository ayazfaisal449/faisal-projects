<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apple Pay Integration</title>
    <!-- Include Apple Pay JS Script -->
    <script src="https://applepay.cdn-apple.com/jsapi/v1/apple-pay-sdk.js"></script>
</head>
<body>
    <!-- Apple Pay Button -->
    <button id="apple-pay-button">Apple Pay</button>

    <script>
        // Handle Apple Pay button click
        document.getElementById('apple-pay-button').addEventListener('click', function () {
            const paymentRequest = {
                countryCode: 'US',
                currencyCode: 'USD',
                total: {
                    label: 'Your Order Total',
                    amount: '10.00' // Amount in USD
                }
            };

            const session = new ApplePaySession(1, paymentRequest);

            // Handle payment authorization
            session.onvalidatemerchant = function (event) {
                // Send validation URL to your server for verification
                const validationURL = event.validationURL;
                fetch('validate.php', {
                    method: 'POST',
                    body: JSON.stringify({ validationURL: validationURL }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(response => response.json())
                  .then(merchantSessionData => {
                      session.completeMerchantValidation(merchantSessionData);
                  })
                  .catch(error => {
                      console.error('Error validating merchant:', error);
                      session.abort();
                  });
            };

            // Handle payment authorization
            session.onpaymentauthorized = function (event) {
                // Send payment token to your server for processing
                const paymentToken = event.payment.token;
                fetch('process_payment.php', {
                    method: 'POST',
                    body: JSON.stringify({ paymentToken: paymentToken }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(response => response.json())
                  .then(paymentResult => {
                      session.completePayment(paymentResult);
                  })
                  .catch(error => {
                      console.error('Error processing payment:', error);
                      session.abort();
                  });
            };

            // Start Apple Pay payment session
            session.begin();
        });
    </script>
</body>
</html>
