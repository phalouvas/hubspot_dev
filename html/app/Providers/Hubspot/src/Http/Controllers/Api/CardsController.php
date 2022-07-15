<?php

namespace Smsto\Hubspot\Http\Controllers\Api;

use Illuminate\Support\Facades\Http;
use Smsto\Hubspot\Http\Requests\Api\IndexCardsRequest;
use Smsto\Hubspot\Models\Settings;

class CardsController extends AdminController {

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Smsto\Hubspot\Http\Requests\Api\IndexCardsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(IndexCardsRequest $request)
    {        
        $validated = $request->validated();
        $settings = Settings::where([
            'hub_id' => $request->portalId,
            'user_id' => $request->userId,
        ])->firstOrFail();

        $response = Http::withToken($settings->api_key)->asJson()->acceptJson()->get('https://api.sms.to/last/message' );
        $response = json_decode($response, true);

        $response = [
            'results' => [
                0 => [
                    "objectId" => $response['id'],
                    "title" => 'Last message',
                    'link' => null,
                    'status' => $response['status'],
                    'phone' => $response['to'],
                    'sender_id' => $response['sender_id'],
                    'message' => $response['message'],
                    'sent_at' => $response['sent_at']
                ],
            ],
            'settingsAction' => [
                'type' => 'IFRAME',
                'windth' => 890,
                'height' => 748,
                'uri' => route('hubspot.web.settings.edit', ['settings' => $settings]),
                'label' => 'Settings'
            ],
            'primaryAction' => [
                'type' => 'IFRAME',
                'windth' => 890,
                'height' => 748,
                'uri' => route('hubspot.web.cards.gui', [
                    'settings' => $settings, 
                    'to' => $validated['phone'],
                    'sender_id' => $settings->sender_id,
                    'active_tab' => 'single',
                ]),
                'label' => 'Send SMS'
            ],
        ];

        return response($response);
    }

}