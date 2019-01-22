<?php

namespace App\Http\Controllers;

use App\Member;
use App\Payment_log;
use Paystack;

class MemberController extends Controller
{
    public function test()
    {
        $member = Member::find(1);
        return view('pay')->with('member', $member);
    }

    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        $pay_log = new Payment_log();
        $pay_log->status = $paymentDetails['status'];
        $pay_log->data_id = $paymentDetails['data']['id'];
        $pay_log->reference = $paymentDetails['data']['reference'];
        $pay_log->amount = $paymentDetails['data']['amount'];
        $pay_log->gateway_response = $paymentDetails['data']['gateway_response'];
        $pay_log->first_name = $paymentDetails['data']['metadata']['first_name'];
        $pay_log->last_name = $paymentDetails['data']['metadata']['last_name'];
        $pay_log->email = $paymentDetails['data']['customer']['email'];
        $pay_log->phone = $paymentDetails['data']['metadata']['phone'];
        $pay_log->payment_purpose = $paymentDetails['data']['metadata']['payment_purpose'];
        $pay_log->customer_code = $paymentDetails['data']['customer']['customer_code'];
        $pay_log->channel = $paymentDetails['data']['channel'];
        $pay_log->currency = $paymentDetails['data']['currency'];
        $pay_log->save();

        return view('front.index');
     
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
