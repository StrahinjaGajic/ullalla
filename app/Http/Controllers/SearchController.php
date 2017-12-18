<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function getQuickSeachResults(Request, $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'radius' => 'required'
        ]);

        // $users = $request-

        dd($request->all());
    }
}
