<?php

namespace Smsto\Hubspot\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Smsto\Hubspot\Http\Requests\SmstoRequest;
use Smsto\Hubspot\Models\Settings;

class SmstoController extends Controller
{
    /**
     * Get params
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @param Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function params(Request $request) {
        return response(Settings::select('sender_id', 'show_reports', 'show_people')->first());
    }

    /**
     * Call smsto
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @param Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function call(SmstoRequest $request) {
        $settings = Settings::first();
        $validated = $request->validate($request->rules());
        $method = strtolower($validated['_method']);
        $url = $validated['_url'];
        $payload = isset($validated['payload']) ? $validated['payload'] : null;
        $response = Http::withToken($settings->api_key)->asJson()->acceptJson()->$method($url, $payload);
        return response(json_decode($response, true));
    }
}
