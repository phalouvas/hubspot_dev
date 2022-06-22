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
        'code',
        'access_token',
        'refresh_token',
        'expires_in',
        'expires_at',
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
    ];

}
