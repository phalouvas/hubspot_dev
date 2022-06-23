<?php

namespace Smsto\Hubspot\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jsons extends Model
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
        'name',
        'payload',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @var array
     */
    protected $casts = [
    ];

}
