<?php

namespace Smsto\Hubspot\Http\Controllers\Admin;

use Smsto\Hubspot\Models\Settings;

class SettingsController extends AdminController
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
     * Display the specified resource.
     *
     * @param  \Smsto\Hubspot\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        return view('hubspot::settings.show', ['settings' => $settings]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Smsto\Hubspot\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        $settings->delete();
        return redirect()->back()->with('message', 'Deleted successfully!!!');
    }
}
