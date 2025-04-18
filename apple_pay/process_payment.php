<?php
// Include Checkout.com PHP SDK
require 'path/to/checkout-php-library/autoload.php';

use Checkout\CheckoutApi;
use Checkout\Models\Payments\ApplePaySource;
use Checkout\Models\Payments\Payment;

// Set your Checkout.com API keys
$secret_key = 'your_secret_key';

// Initialize Checkout.com API
$api = new CheckoutApi($secret_key);

// Extract payment token from request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postData = json_decode(file_get_contents('php://input'), true);
    if (isset($postData['paymentToken'])) {
        $paymentToken = $postData['paymentToken'];

        // Create ApplePaySource object
        $applePaySource = new ApplePaySource([
            'type' => 'applepay',
            'token_data' => $paymentToken
        ]);

        // Set payment details
        $payment = new Payment([
            'source' => $applePaySource,
            'amount' => 1000, // Amount in cents
            'currency' => 'USD',
            'reference' => 'YourOrderReference',
            'description' => 'Payment for order #YourOrderReference',
        ]);

        try {
            $paymentResponse = $api->payments()->request($payment);
            // Handle successful payment
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Payment successful']);
        } catch (\Checkout\Error\ApiException $e) {
            // Handle payment failure
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
?>
