<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;

class OrderController extends Controller
{
    function stripe_post(Request $request)  {
        // dd($request->stripeToken);
        $stripe =  Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $data = Stripe\Charge::create ([
                "amount" => 100*100,
                "currency" => "INR",
                "source" => $request->stripeToken,
                "description" => "This payment for testing purpose.",
        ]);
        Session::flash('success', 'Payment Successfull!');
        return back();
    }
//=======================================for test===================================
    public function stripe_new(Request $request){
        // dd($request);
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $token = Stripe\Token::create([
            'card' => [
                'number' => $request->card_number,
                'exp_month' => $request->exp_month,
                'exp_year' => $request->exp_year,
                'cvc' => $request->cvv,
            ],
        ]);
        $customer = Stripe\Customer::create([
            'email' => 'hellovjai@gmail.com',
            'source' => $token->id,
        ]);

        // Charge the customer
        $payment_details = Stripe\Charge::create([
            'amount' => 100*100,
            'currency' => 'usd',
            'customer' => $customer->id,
            'description' => 'Charge for ',
        ]);
        dd($token);
    }
}
