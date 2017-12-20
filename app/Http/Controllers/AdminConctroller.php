<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Stripe\Charge;
use App\Models\User;
use App\Models\Local;
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
			return redirect()->back()->with('success', __('messages.success_changes_saved'));
		}
	}

	public function getInactiveLocals()
	{
		$locals = Local::where('approved', '0')->get();

		return view('admin.inactive_locals', compact('locals'));
	}

	public function approveLocal($id)
	{
		$local = Local::findOrFail($id);

		$result = DB::transaction(function () use ($local) {
			try {
				// charge a customer
				Charge::create([
					'customer' => $local->stripe_id,
					'amount' => $local->stripe_amount,
					'currency' => 'chf',
				]);
			} catch (\Exception $e) {
				return redirect()->back()->with('error', $e->getMessage());
			}

			// approve the user
			$local->approved = '1';
			$local->save();

			return true;
		});

		if ($result === true) {
			return redirect()->back()->with('success', __('messages.success_changes_saved'));
		}
	}
}
