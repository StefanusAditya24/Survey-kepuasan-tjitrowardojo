<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property string $id
 * @property string $answer
 * @property string $answer_value
 * @property string $question_id
 * @property Question $question
 */
class QuestionAnswer extends Model
{
    protected $fillable = [
        'answer',
        'answer_value',
        'question_id'
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(RespondentAnswer::class, 'answer_id', 'id');
    }
}