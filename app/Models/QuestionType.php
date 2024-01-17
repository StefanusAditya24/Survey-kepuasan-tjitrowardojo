<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class QuestionType extends Model
{
    protected $fillable = [
        'type'
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}