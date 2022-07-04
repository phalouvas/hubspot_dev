<?php

namespace Smsto\Hubspot\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Smsto\Hubspot\Http\Requests\Admin\UpdateActionsRequest;

class ActionsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $endpoint = "https://api.hubapi.com/automation/v4/actions/" . config('hubspot.app_id') . "?hapikey=" . config('hubspot.api_key');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response    = json_decode(curl_exec($ch), true);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return view("hubspot::actions.index", $response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $action_id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $action_id)
    {
        $endpoint = "https://api.hubapi.com/automation/v4/actions/" . config('hubspot.app_id') . "/$action_id" . "?hapikey=" . config('hubspot.api_key');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response    = json_decode(curl_exec($ch), true);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return view("hubspot::actions.edit", $response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  UpdateActionsRequest  $request
     * @param  int  $action_id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActionsRequest $request, int $action_id)
    {
        $published = $request->validated('published') ? 'true' : 'false';
        $endpoint = "https://api.hubapi.com/automation/v4/actions/" . config('hubspot.app_id') . "/$action_id" . "?hapikey=" . config('hubspot.api_key');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "accept: application/json",
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($ch, CURLOPT_POSTFIELDS, '
        {
            "actionUrl": "' . $request->validated('actionUrl') . '",
            "published": ' . $published . '
        }
        ');

        $response    = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return redirect(route('hubspot.admin.actions.index'))->with('message', 'Saved successfully!!!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $action_id
     * @return \Illuminate\Http\Response
     */
    public function archive(int $action_id)
    {
        $endpoint = "https://api.hubapi.com/automation/v4/actions/" . config('hubspot.app_id') . "/$action_id" . "?hapikey=" . config('hubspot.api_key');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "accept: application/json",
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        $response    = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return redirect(route('hubspot.admin.actions.index'))->with('message', 'Item archived successfully!!!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jsons = config('hubspot.jsons');
        foreach ($jsons as $key => $value) {
            unset($jsons[$key]['payload']);
        }

        return view("hubspot::actions.create", ['jsons' => $jsons]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jsons = config('hubspot.jsons');
        $json = $jsons[$request->json_id];

        $endpoint = "https://api.hubapi.com/automation/v4/actions/" . config('hubspot.app_id') .  "?hapikey=" . config('hubspot.api_key');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "accept: application/json",
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json['payload']);

        $response    = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return redirect(route('hubspot.admin.actions.index'))->with('message', 'Created successfully!!!');
    }

}
