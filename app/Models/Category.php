<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property string category_name
 */
class Category extends Model
{
    protected $fillable = [
        'category_name'
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}