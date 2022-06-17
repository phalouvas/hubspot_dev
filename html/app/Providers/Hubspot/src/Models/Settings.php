<?php

namespace Smsto\Hubspot\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'show_reports' => 'boolean',
        'show_people' => 'boolean',
    ];

}
