<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Contact;

class ContactController extends Controller
{
    public function getIndex()
    {
        return view('pages.contact.contact');
    }

    public function postIndex(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required',
            'title' => 'required',
            'message' => 'required',
        ]);
        Mail::to('ullalla@ullalla.com')->send(new Contact($request));
    }
}
