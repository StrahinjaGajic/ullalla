<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\BlackBook;
use Illuminate\Http\Request;

class BlackbookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
    	$blackbooks = BlackBook::orderBy('date')->orderBy('created_at')->get();
    	return view('pages.blackbook.index', compact('blackbooks'));
    }

    public function postBlackbook(Request $request)
    {
    	$user = Auth::user();

    	$this->validate($request, [
    		'date' => 'required',
    		'client_name' => 'required_without:client_phone',
    		'client_phone' => 'required_without:client_name',
    		'description' => 'required',
    		'photo' => 'url',
    	]);

    	$carbonDate = Carbon::parse($request->date);
        $date = $carbonDate->format('Y-m-d H:i:s');

    	$blackbook = new BlackBook;
    	$blackbook->name = $request->client_name;
    	$blackbook->phone = $request->client_phone;
    	$blackbook->city = $request->city;
    	$blackbook->photo = $request->photo;
    	$blackbook->comment = $request->description;
    	$blackbook->date = $date;

    	$user->blackbooks()->save($blackbook);

    	return redirect()->back()->with('success', __('messages.success_blackbook_entry'));
    }
}
