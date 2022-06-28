<?php

namespace Smsto\Hubspot\Http\Controllers;

use Smsto\Hubspot\Http\Requests\CreateSettingsRequest;
use Smsto\Hubspot\Http\Requests\StoreSettingsRequest;
use Smsto\Hubspot\Http\Requests\UpdateSettingsRequest;
use Smsto\Hubspot\Models\Settings;
use HubSpot\Factory;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hubspot::settings.index', ['settings' => Settings::paginate()]);
    }

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
            route('hubspot.settings.create'),
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
        return redirect(route('hubspot.settings.show', ['settings' => $settings->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        return view('hubspot::settings.show', ['settings' => $settings]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $settings = Settings::where([
            'app_id' => $request->appId,
            'hub_id' => $request->portalId,
            'user_id' => $request->userId,
        ])->firstOrFail();
        return view('hubspot::settings.edit', ['settings' => $settings]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSettingsRequest  $request
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingsRequest $request, Settings $settings)
    {
        $settings->update($request->validated());
        return redirect()->back()->with('message', 'Settings saved successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
