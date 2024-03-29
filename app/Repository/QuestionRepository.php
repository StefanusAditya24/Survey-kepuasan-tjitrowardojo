<?php

namespace App\Repository;

use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class QuestionRepository
{
    public function __construct(
        protected Question $model = new Question()
    ) {
    }

    public function getQuestion(mixed $questionId, ?bool $loadAnswers = false): ?Question
    {
        $query = $this->model->newQuery();

        if ($loadAnswers)
            $query->with(['questionAnswers', 'questionType']);

        return $query->findOrFail($questionId);
    }

    public function getQuestions(?bool $multipleOnly = false, ?bool $excludeMultiple = false): Collection
    {
        $questions = $this->model->with(['questionType', 'questionAnswers']);

       if ($multipleOnly) {
           $questions->whereHas('questionType', function ($query) {
               $query->where('type', 'Multiple Choice');
           });
       }

        if ($excludeMultiple) {
            $questions->whereHas('questionType', function ($query) {
                $query->whereNot('type', 'Multiple Choice');
            });
        }

        return $questions->get();
    }

    public function getAnswerCountByQuestionId(?Carbon $filter = null, mixed $questionId): array
    {
        $administratorRole = auth()->user()->patient_room_id;
        $answersQuery = $this->model->with(['questionAnswers', 'respondentAnswers'])->find($questionId);

        if (!empty($administratorRole)) {
            $answersQuery->whereHas('respondentAnswers', function ($query) use ($administratorRole) {
                $query->where('patient_room_id', $administratorRole);
            });
        }

        if (!empty($filter)) {
            $answersQuery->whereMonth('created_at', $filter->month)->whereYear('created_at', $filter->year);
        }

        $answers = $answersQuery->first();

        return $answers->questionAnswers->flatMap(function ($answer) {
            return [$answer->answer => $answer->answers->count()];
        })->all();
    }
}
