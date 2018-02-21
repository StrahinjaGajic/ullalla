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

        $stripeId = $user->stripe_id;
        $cardId = $user->card_id;
        $email = $user->email;
        $token = request('stripeToken');

        try {
            if ($stripeId) {
                $customer = Customer::retrieve($stripeId);
                $customer->email = $email;
                $customer->source = $token;
                $customer->save();
            } else {
                $customer = Customer::create([
                    'email' => $email,
                    'source' => $token,
                ]);
            }

            $customer = Customer::retrieve($customer->id);

            $user->stripe_id = $customer->id;
            $user->stripe_last4_digits = $customer->sources->data[0]->last4;
            $user->save();

            Session::flash('success', __('messages.card_updated'));

        } catch(\Error\Card $e) {

            // Use the variable $error to save any errors
            // To be displayed to the customer later in the page
            $body = $e->getJsonBody();
            $err  = $body['error'];
            $error = $err['message'];
        }
    }
    public function deleteCard()
    {
        // $customer = \Stripe\Customer::retrieve($user->id);
        // $customer->sources->retrieve("card_1BxccWFoGzjFZMfwvjaHeo6N")->delete();
    }
}
