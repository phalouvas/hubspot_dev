<?php

namespace Smsto\Hubspot\Http\Controllers;

use Illuminate\Http\Request;

class HubspotController extends Controller
{

    public function index(Request $request)
    {
        return view('hubspot::hubspot');
    }

}
