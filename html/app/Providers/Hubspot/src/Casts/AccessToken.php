<?php

namespace Smsto\Hubspot\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use HubSpot\Factory;
use Smsto\Hubspot\Models\Settings;

class AccessToken implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return array
     */
    public function get($model, $key, $value, $attributes)
    {
        if ($attributes['expires_at'] < time()) {
            $tokens = Factory::create()->auth()->oAuth()->tokensApi()->createToken(
                'refresh_token',
                null,
                route('hubspot.settings.create'),
                config('hubspot.client_id'),
                config('hubspot.client_secret'),
                $attributes['refresh_token']
            );
            $settings = Settings::find($attributes['id']);
            $settings->update([
                'access_token' => $tokens->getAccessToken(),
                'refresh_token' => $tokens->getRefreshToken(),
                'expires_in' => $tokens->getExpiresIn(),
                'expires_at' => time() + $tokens['expires_in'] * 0.95
            ]);
            return $tokens->getAccessToken();
        }
        return $value;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  array  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, $key, $value, $attributes)
    {
        return $value;
    }
}
