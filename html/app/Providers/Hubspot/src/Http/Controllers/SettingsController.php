<?php

namespace Smsto\Hubspot\Http\Controllers;

use GuzzleHttp\Client;
use HubSpot\Client\Automation\Actions\Model\ActionLabels;
use Smsto\Hubspot\Http\Requests\CreateSettingsRequest;
use Smsto\Hubspot\Http\Requests\StoreSettingsRequest;
use Smsto\Hubspot\Http\Requests\UpdateSettingsRequest;
use Smsto\Hubspot\Models\Settings;
use HubSpot\Factory;
use \HubSpot\Client\Automation\Actions\Model\ExtensionActionDefinitionInput;
use HubSpot\Client\Automation\Actions\Model\FieldTypeDefinition;
use HubSpot\Client\Automation\Actions\Model\InputFieldDefinition;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Settings::paginate());
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
        // Prepare URL
        $endpoint = 'https://api.hubapi.com/automation/v4/actions/940573?hapikey=eu1-ed0c-30e3-4167-9b3d-353dae4ca4da';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '
        {
            "actionUrl": "https://example.com/hubspot",
            "published": false,
            "inputFields": [
                {
                    "typeDefinition": {
                        "name": "widgetName",
                        "type": "string",
                        "fieldType": "text",
                        "options": [],
                        "optionsUrl": null,
                        "referencedObjectType": null,
                        "externalOptions": false,
                        "externalOptionsReferenceType": null
                    },
                    "supportedValueTypes": [
                        "STATIC_VALUE"
                    ],
                    "isRequired": true,
                    "automationFieldType": null
                },
                {
                    "typeDefinition": {
                        "name": "widgetColor",
                        "type": "enumeration",
                        "fieldType": "select",
                        "options": [
                            {
                                "label": "Red",
                                "value": "red"
                            },
                            {
                                "label": "Blue",
                                "value": "blue"
                            },
                            {
                                "label": "Green",
                                "value": "green"
                            }
                        ],
                        "optionsUrl": null,
                        "referencedObjectType": null,
                        "externalOptions": false,
                        "externalOptionsReferenceType": null
                    },
                    "supportedValueTypes": [
                        "STATIC_VALUE"
                    ],
                    "isRequired": true,
                    "automationFieldType": null
                },
                {
                    "typeDefinition": {
                        "name": "widgetOwner",
                        "type": "enumeration",
                        "fieldType": null,
                        "options": [],
                        "optionsUrl": null,
                        "referencedObjectType": "OWNER",
                        "externalOptions": false,
                        "externalOptionsReferenceType": null
                    },
                    "supportedValueTypes": [
                        "STATIC_VALUE"
                    ],
                    "isRequired": true,
                    "automationFieldType": null
                },
                {
                    "typeDefinition": {
                        "name": "widgetQuantity",
                        "type": "number",
                        "fieldType": null,
                        "options": [],
                        "optionsUrl": null,
                        "referencedObjectType": null,
                        "externalOptions": false,
                        "externalOptionsReferenceType": null
                    },
                    "supportedValueTypes": [
                        "OBJECT_PROPERTY"
                    ],
                    "isRequired": true,
                    "automationFieldType": null
                }
            ],
            "objectRequestOptions": null,
            "labels": {
                "en": {
                    "inputFieldLabels": {
                        "widgetName": "Widget Name",
                        "widgetColor": "Widget Color",
                        "widgetOwner": "Widget Owner",
                        "widgetQuantity": "Widget Quantity"
                    },
                    "inputFieldDescriptions": {
                        "widgetName": "Enter the full widget name. I support <a href=\"https://hubspot.com\">links</a> too.",
                        "widgetColor": "This is the color that will be used to paint the widget."
                    },
                    "actionName": "Create Widget - Example 1",
                    "actionDescription": "This action will create a new widget in our system. So cool!",
                    "actionCardContent": "Create widget {{widgetName}}"
                }
            },
            "objectTypes": [
                "0-1",
                "0-3"
            ],
            "id": "23974702",
            "revisionId": "1",
            "functions": []
        }
        ');
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response    = curl_exec($ch); //Log the response from HubSpot as needed.
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); //Log the response status code
        curl_close($ch);
        dd($response, $status_code);



        return view('hubspot::settings.show', ['settings' => $settings]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $settings)
    {
        //
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
        $validated = $request->validate($request->rules());
        $validated['show_reports'] = isset($validated['show_reports']) ? true : false;
        $validated['show_people'] = isset($validated['show_people']) ? true : false;
        return response($settings->update($validated));
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
