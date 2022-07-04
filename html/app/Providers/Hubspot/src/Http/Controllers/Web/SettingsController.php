<?php

namespace Smsto\Hubspot\Http\Controllers\Web;

use Smsto\Hubspot\Http\Requests\Web\CreateSettingsRequest;
use Smsto\Hubspot\Http\Requests\Web\StoreSettingsRequest;
use Smsto\Hubspot\Http\Requests\Web\UpdateSettingsRequest;
use Smsto\Hubspot\Models\Settings;
use HubSpot\Factory;

class SettingsController extends WebController
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Http\Requests\CreateSettingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function create(CreateSettingsRequest $request)
    {
        return view('hubspot::settings.create', ['code' => $request->validated()['code']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSettingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettingsRequest $request)
    {
        $validated = $request->validate($request->rules());
        $validated['show_reports'] = isset($validated['show_reports']) ? true : false;
        $validated['show_people'] = isset($validated['show_people']) ? true : false;

        $tokens = Factory::create()->auth()->oAuth()->tokensApi()->createToken(
            'authorization_code',
            $validated['code'],
            route('hubspot.web.settings.create'),
            config('hubspot.client_id'),
            config('hubspot.client_secret')
        );
        $validated['access_token'] = $tokens->getAccessToken();
        $validated['refresh_token'] = $tokens->getRefreshToken();
        $validated['expires_in'] = $tokens->getExpiresIn();
        $validated['expires_at'] = time() + $tokens['expires_in'] * 0.95;
        $validated['token_type'] = $tokens->getTokenType();

        $client = Factory::createWithAccessToken($validated['access_token']);
        $api_response = $client->auth()->oAuth()->accessTokensApi()->getAccessToken($validated['access_token']);
        $validated['user'] = $api_response->getUser();
        $validated['hub_domain'] = $api_response->getHubDomain();
        $validated['scopes'] = $api_response->getScopes();
        $validated['scope_to_scope_group_pks'] = $api_response->getScopeToScopeGroupPks();
        $validated['trial_scopes'] = $api_response->getTrialScopes();
        $validated['trial_scope_to_scope_group_pks'] = $api_response->getTrialScopeToScopeGroupPks();
        $validated['hub_id'] = $api_response->getHubId();
        $validated['app_id'] = $api_response->getAppId();
        $validated['user_id'] = $api_response->getUserId();

        $settings = Settings::create($validated);
        return redirect(route('hubspot.web.settings.completed', ['settings' => $settings->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Smsto\Hubspot\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function completed(Settings $settings)
    {
        return view('hubspot::settings.completed', ['settings' => $settings]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Smsto\Hubspot\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $settings)
    {
        return view('hubspot::settings.edit', ['settings' => $settings]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSettingsRequest  $request
     * @param  \Smsto\Hubspot\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingsRequest $request, Settings $settings)
    {
        $settings->update($request->validated());
        return redirect()->back()->with('message', 'Saved successfully!!!');
    }

}
