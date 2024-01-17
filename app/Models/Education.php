<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property string $name
 */
class Education extends Model
{

    protected $table = "educations";
    protected $fillable = [
        'name'
    ];
}
