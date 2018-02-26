<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\Contact;
use App\Models\BannerPage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function getIndex()
    {
        $smallBanners = BannerPage::getByPageId(1, 3, true)->take(4)->get();

        return view('pages.contact.contact', compact('smallBanners'));
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
