<?php

namespace Smsto\Hubspot\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Smsto\Hubspot\Casts\AccessToken;

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

}
