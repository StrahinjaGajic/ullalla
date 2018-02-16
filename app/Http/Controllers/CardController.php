<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Stripe\Customer;
use Illuminate\Http\Request;

class CardController extends Controller
{
	public function __construct()
	{
        $this->middleware('auth:web,local');
	}

    public function getCard()
    {   
    	$local = Auth::guard('local')->user();
        $user = $local ? $local : Auth::user();

        return view('pages.profile.add_card', compact('user'));
    }

    public function postCard()
    {   
    	$local = Auth::guard('local')->user();
        $user = $local ? $local : Auth::user();

        try {
            $customer = Customer::retrieve($user->stripe_id); // stored in your application
            $customer->email = $user->email; // obtained with Checkout
            $customer->source = request('stripeToken'); // obtained with Checkout
            $customer->save();

            $last4 = $customer->sources->data[0]->last4;
            $user->stripe_last4_digits = $last4;
            $user->save();

            Session::flash('success', __('messages.card_updated'));
            // return response()->json([
            //     'customer' => $customer
            // ]);
        } catch(\Error\Card $e) {

            // Use the variable $error to save any errors
            // To be displayed to the customer later in the page
            $body = $e->getJsonBody();
            $err  = $body['error'];
            $error = $err['message'];
        }
    }
}
