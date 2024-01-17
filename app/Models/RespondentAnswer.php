<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property Respondent $respondent
 * @property Question $question
 * @property QuestionAnswer $answer
 */
class RespondentAnswer extends Model
{
    protected $fillable = [
        'respondent_id',
        'question_id',
        'answer_id',
        'custom_answer'
    ];

    public function respondent(): BelongsTo
    {
        return $this->belongsTo(Respondent::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function answer(): BelongsTo
    {
        return $this->belongsTo(QuestionAnswer::class);
    }
}
