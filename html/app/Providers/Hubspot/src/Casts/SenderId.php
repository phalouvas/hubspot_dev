<?php

namespace Smsto\Hubspot\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use HubSpot\Factory;
use Illuminate\Support\Facades\Http;
use Smsto\Hubspot\Models\Settings;

class SenderId implements CastsAttributes
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
        if (empty($value)) {
            $response = Http::withToken($attributes['api_key'])->asJson()->acceptJson()->get('https://sms.to/api/v1/authenticated_user');
            $response = json_decode($response, true);
            $value = $response['user']['sender_id'];
            $settings = Settings::find($attributes['id']);
            $settings->update(['sender_id' => $value]);
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
