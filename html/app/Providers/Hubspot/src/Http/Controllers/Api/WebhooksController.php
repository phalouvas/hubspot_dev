<?php

namespace Smsto\Hubspot\Http\Controllers\Api;

use Illuminate\Http\Request;

class WebhooksController extends AdminController {

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Smsto\Hubspot\Http\Requests\Api\IndexCardsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
        return response(['status' => 'success']);
    }

}