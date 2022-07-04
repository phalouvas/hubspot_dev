<?php

namespace Smsto\Hubspot\Http\Controllers\Api;

use Illuminate\Support\Facades\Http;
use Smsto\Hubspot\Http\Requests\Api\EditSettingsRequest;
use Smsto\Hubspot\Http\Requests\Api\FetchSettingsRequest;
use Smsto\Hubspot\Models\Settings;

class SettingsController extends AdminController {

    /**
     * Display a listing of the resource.
     *
     * @param  \Smsto\Hubspot\Http\Requests\Api\FetchSettingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function fetch(FetchSettingsRequest $request)
    {
        $settings = Settings::where([
            'app_id' => $request->appId,
            'hub_id' => $request->portalId,
            'user_id' => $request->userId,
        ])->get();

        $response = [
            'response' => [
                'accounts' => []
            ]
        ];
        foreach ($settings as $setting) {
            $api_key = $setting->api_key;
            $user = Http::withToken($api_key)->asJson()->acceptJson()->get('https://sms.to/api/v1/authenticated_user');
            if ($user->failed()) {
                $response['response']['accounts'][] = [
                    'accountId' => $request->userId,
                    'accountName' => $request->email,
                ];
                continue;
            }
            $user = json_decode($user, true);
            $user = $user['user'];

            $response['response']['accounts'][] = [
                'accountId' => $user['id'],
                'accountName' => $user['name'],
            ];
        }

        return response($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Smsto\Hubspot\Http\Requests\Api\EditSettingsRequest  $request
     * @param  \Smsto\Hubspot\Models\Settings $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(EditSettingsRequest $request, Settings $settings)
    {
        $settings = Settings::where([
            'app_id' => $request->appId,
            'hub_id' => $request->portalId,
            'user_id' => $request->userId,
        ])->firstOrFail();

        return response(
            [
                'response' => [
                    'iframeUrl' => route('hubspot.web.settings.edit', ['settings' => $settings])
                ]
            ]
        );
    }

}