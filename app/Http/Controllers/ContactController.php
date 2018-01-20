<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Contact;
use Mail;

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
        Mail::to('info@ullalla.ch')->send(new Contact($request));
    }
}
