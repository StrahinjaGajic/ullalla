<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
        $this->middleware('approved');
    }

    public function getIndex($username)
    {
    	$user = Auth::user();

    	return view('pages.notifications.index', compact('user'));
    }
}
