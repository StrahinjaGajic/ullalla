<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
	public function changeLanguage($language)
	{
		if (in_array($language, config()->get('app.locales'))) {
			session()->put('locale', $language);
		}
		return redirect()->back();
	}
}
