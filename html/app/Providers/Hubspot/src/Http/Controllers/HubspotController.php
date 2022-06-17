<?php

namespace Smsto\Hubspot\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HubspotController extends Controller
{

    /**
     * Component gui
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request)
    {
        $response = Http::get('https://integration.sms.to/component_bulk_sms/manifest.json');
        $manifest = json_decode($response, true);
        $url = route('home'); // to get Base Url
        $VITE_ROUTE_PARAMS =  $url . "rest/V1/smsto-sms/params";
        $VITE_ROUTE_SMSTO =  $url . "rest/V1/smsto-sms/callsmsto";
        dd($VITE_ROUTE_PARAMS);
        return view('hubspot::hubspot');
    }

    /**
     * Render json error for validation
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @param Request $request
     * @return void
     */
    public function error(Request $request) {
        return response(['message' => 'Input validation failed'], 422);
    }
}
