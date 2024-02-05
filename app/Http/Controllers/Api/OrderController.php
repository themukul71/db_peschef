<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Stripe\Stripe;
use Stripe\Token;

class OrderController extends Controller
{
    function create_token(Request $request)
    {

        try {
            $stripe = new \Stripe\StripeClient('sk_test_51OQ3Z0JuN7XJb0gs8dJ6tecFhaxfL2pQI5y6uhiEs4xBTiqA01Tj2ssEKv6WQiqvQpKhKwJ8hC2j2YWBMXa3XoQF00cb4ay1mF');

            $token = $stripe->tokens->create([
                'card' => [
                    'number' => $request->input('card_number'),
                    'exp_month' => $request->input('exp_month'),
                    'exp_year' => $request->input('exp_year'),
                    'cvc' => $request->input('cvc'),
                ],
            ]);

         
            return response()->json(['token' => $token->id]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
