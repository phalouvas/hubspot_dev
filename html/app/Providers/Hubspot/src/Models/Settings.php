<?php

namespace Smsto\Hubspot\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Smsto\Hubspot\Casts\AccessToken;
use HubSpot\Factory;
use HubSpot\Client\Auth\OAuth\ApiException;
use HubSpot\Client\Crm\Timeline\Model\TimelineEvent;
use Illuminate\Support\Facades\Http;

class Settings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @var array<string>
     */
    protected $fillable = [
        'refresh_token',
        'expires_in',
        'access_token',
        'expires_at',
        'token_type',

        'user',
        'hub_domain',
        'scopes',
        'scope_to_scope_group_pks',
        'trial_scopes',
        'trial_scope_to_scope_group_pks',
        'hub_id',
        'app_id',
        'user_id',

        'api_key',
        'sender_id',
        'show_reports',
        'show_people'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @var array
     */
    protected $casts = [
        'access_token' => AccessToken::class,
        'show_reports' => 'boolean',
        'show_people' => 'boolean',
        'scopes' => 'array',
        'scope_to_scope_group_pks' => 'array',
        'trial_scopes' => 'array',
        'trial_scope_to_scope_group_pks' => 'array',
    ];

    /**
     * Get hubspot token. Refresh it if expires
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @return string
     */
    public function refreshAccessToken() {
        if (time() + 555555555 < $this->expires_at) {
            return $this->refresh_token;
        }
        $tokens = Factory::create()->auth()->oAuth()->tokensApi()->createToken(
            'refresh_token',
            null,
            route('hubspot.settings.create'),
            config('hubspot.client_id'),
            config('hubspot.client_secret'),
            $this->refresh_token
        );
        $this->update([
            'expires_in' => $tokens->getExpiresIn(),
            'expires_at' => time() + $tokens['expires_in'] * 0.95,
            'access_token' => $tokens->getAccessToken(),
            'refresh_token' => $tokens->getRefreshToken()
        ]);
        return $tokens->getAccessToken();
    }

    /**
     * Create a new time line event for send status
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @param array $validated
     * @param string $status
     * @return \HubSpot\Client\Crm\Timeline\Model\TimelineEventResponse|\HubSpot\Client\Crm\Timeline\Model\Error
     * @throws \InvalidArgumentException
     */
    public function createTimelineEvent(array $validated, string $status) {
        $token = $this->refreshAccessToken();
        $client = Factory::createWithAccessToken($token);

        if (!isset($validated['inputFields']['sender_id'])) {
            $response = Http::withToken($this->api_key)->asJson()->acceptJson()->get('https://sms.to/api/v1/authenticated_user');
            $response = json_decode($response, true);
            $sender_id = $response['user']['sender_id'];
        } else {
            $sender_id = $validated['inputFields']['sender_id'];
        }

        $TimelineEvent = new TimelineEvent(
            [
                'event_template_id' => config('hubspot.timeline_event_template_id'),
                'object_id' => $validated['object']['objectId'],
                'tokens' => [
                    'status' => $status,
                    'phone' => $validated['inputFields']['to'],
                    'sender_id' => $sender_id,
                    'message' => $validated['inputFields']['message']
                ],
                //'extra_data' => $extraData,
                //'timeline_i_frame' => $timelineIFrame
            ]
        );
        return $client->crm()->timeline()->eventsApi()->create($TimelineEvent);
    }
}
