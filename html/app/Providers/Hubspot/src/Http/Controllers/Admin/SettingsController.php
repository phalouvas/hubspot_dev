<?php

namespace Smsto\Hubspot\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Smsto\Hubspot\Models\Settings;

class SettingsController extends AdminController
{
    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Settings::select('*');
        if ($request->search) {
            $query->where('hub_id', $request->search)
            ->orWhere('user_id', $request->search)
            ->orWhere('smsto_user', 'LIKE', '%' . $request->search . '%');
        }
        $settings = $query->paginate();

        return view('hubspot::settings.index', ['settings' => $settings]);
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
