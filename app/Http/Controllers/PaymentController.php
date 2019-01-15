<?php

namespace App\Http\Controllers;

use Paystack;

class PaymentController extends Controller
{
    // redirect the user to paystack payment page
    // @return Url
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    // Obtain Payment Information
    // @return Url
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
