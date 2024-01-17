<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property string $name
 */
class ServiceType extends Model
{
    protected $fillable = [
        'name'
    ];
}
