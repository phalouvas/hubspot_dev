<?php

namespace Smsto\Hubspot\Http\Controllers\Web;

use Illuminate\Support\Facades\Http;
use Smsto\Hubspot\Http\Requests\Web\SendCardsRequest;
use Smsto\Hubspot\Models\Settings;

class CardsController extends WebController {

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Smsto\Hubspot\Http\Requests\Api\IndexCardsRequest  $request
     * @param \Smsto\Hubspot\Models\Settings $settings
     * @return \Illuminate\Http\Response
     */
    public function gui(SendCardsRequest $request, Settings $settings)
    {
        $validated = $request->validated();

        $response = Http::get('https://integration.sms.to/component_bulk_sms/manifest.json');
        $manifest = json_decode($response, true);
        $data = [
            'VITE_ROUTE_PARAMS' =>  route('hubspot.api.smsto.params', ['settings' => $settings]),
            'VITE_ROUTE_SMSTO' =>  route('hubspot.api.smsto.call', ['settings' => $settings]),
            'assets_link' => $manifest['src/main.ts']['css'][0],
            'js_link' => $manifest['src/main.ts']['file'],
            'sender_id' => isset($validated['sender_id']) ? $validated['sender_id'] : $settings->sender_id,
            'to' => isset($validated['to']) ? $validated['to'] : '',
            'active_tab' => isset($validated['active_tab']) ? $validated['active_tab'] : 'pasted',
        ];
        return view('hubspot::iframe', $data);
    }

}