<?php

namespace Smsto\Hubspot\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class ValidateHubspotRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $referer = Session::get('hubspot_referer', false) === false ? $request->header('referer', false) : Session::get('hubspot_referer', false);
        if (!$referer || (strpos($referer, 'hubspot.com') === false)) {
            throw new Exception('Forbidden', 403);
        }
        Session::put('hubspot_referer', $referer);
        return $next($request);
    }
}
