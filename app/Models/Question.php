<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Question extends Model
{
    protected $fillable = [
        'name'
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(RespondentAnswer::class);
    }
}
