<?php

namespace Smsto\Hubspot\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Smsto\Hubspot\Http\Requests\Api\SmstoRequest;
use Smsto\Hubspot\Http\Requests\Api\SendSmstoRequest;
use Smsto\Hubspot\Models\Settings;

class SmstoController extends AdminController
{
    /**
     * Get params
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @param Smsto\Hubspot\Models\Settings $settings
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function params(Settings $settings)
    {
        $response = [
            "success" => true,
            "message" => null,
            "messages" => null,
            "data" => [
                "show_reports" => $settings->show_reports,
                "show_people" => $settings->show_people
            ]
        ];

        return response($response);
    }

    /**
     * Call smsto
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @param Request $request
     * @param Smsto\Hubspot\Models\Settings $settings
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function call(SmstoRequest $request, Settings $settings)
    {
        $validated = $request->validate($request->rules());
        $method = strtolower($validated['_method']);
        $url = $validated['_url'];
        $payload = isset($validated['payload']) ? json_decode($validated['payload'], true) : null;
        $response = Http::withToken($settings->api_key)->asJson()->acceptJson()->$method($url, $payload);
        return response(json_decode($response, true));
    }

    /**
     * Call smsto
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @param Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function send(SendSmstoRequest $request)
    {
        $validated = $request->validated();

        $settings = Settings::where([
            'app_id' => config('hubspot.app_id'),
            'hub_id' => $validated['origin']['portalId']
        ])->first();

        $validated['inputFields']['sender_id'] = isset($validated['inputFields']['sender_id']) ? $validated['inputFields']['sender_id'] : $settings->sender_id;

        $api_key = $settings->api_key;
        $response = Http::withToken($api_key)->asJson()->acceptJson()->post('https://api.sms.to/sms/send', $validated['inputFields']);
        $response = json_decode($response, true);
        if ($response['success']) {
            $settings->createTimelineEvent($validated, 'SUCCESS');
            return response([
                "outputFields" => [
                    'hs_execution_state' => "SUCCESS",
                    "myOutput" => $response['message']
                ]
            ]);
        } else {
            $settings->createTimelineEvent($validated, 'FAILED');
            return response([
                "outputFields" => [
                    'hs_execution_state' => "FAIL_CONTINUE",
                    "myOutput" => "Something went wrong"
                ]
            ]);
        }
    }
}
