<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Stripe\Charge;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function getInactiveUsers()
	{
		$users = User::where('approved', '0')->get();
		
		return view('admin.inactive_users', compact('users'));	
	}

	public function approveUser($id)
	{
		$user = User::findOrFail($id);
		
		$result = DB::transaction(function () use ($user) {
			try {
    			// charge a customer
				Charge::create([
					'customer' => $user->stripe_id,
					'amount' => 1230,
					'currency' => 'chf',
				]);
			} catch (\Exception $e) {
				return redirect()->back()->with('error', $e->getMessage());
			}

			// approve the user
			$user->approved = '1';
			$user->save();

			return true;
		});

		if ($result === true) {
			return redirect()->back()->with('success', 'User Successfully Approved');
		}
	}
}
