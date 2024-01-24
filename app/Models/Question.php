<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property string $id
 * @property string $name
 * @property string $question_type_id
 * @property QuestionType $questionType
 * @property string $category_id
 * @property Category $category
 * @property QuestionAnswer $questionAnswers
 */
class Question extends Model
{
    protected $fillable = [
        'name',
        'question_type_id',
        'category_id'
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(RespondentAnswer::class);
    }

    public function questionType(): BelongsTo
    {
        return $this->belongsTo(QuestionType::class);
    }

    public function questionAnswers(): HasMany
    {
        return $this->hasMany(QuestionAnswer::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
