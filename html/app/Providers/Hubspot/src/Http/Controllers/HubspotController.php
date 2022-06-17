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
        $data = [
            'VITE_ROUTE_PARAMS' =>  route('hubspot.smsto.params'),
            'VITE_ROUTE_SMSTO' =>  route('hubspot.smsto.call'),
            'assets_link' => $manifest['src/main.ts']['css'][0],
            'js_link' => $manifest['src/main.ts']['file']
        ];
        return view('hubspot::hubspot', $data);
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
