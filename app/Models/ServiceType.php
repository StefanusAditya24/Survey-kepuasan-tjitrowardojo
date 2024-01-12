<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ServiceType extends Model
{
    protected $fillable = [
        'name'
    ];
}
