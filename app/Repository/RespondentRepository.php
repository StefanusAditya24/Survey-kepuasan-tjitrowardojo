<?php

namespace App\Repository;

use App\Models\Question;
use App\Models\Respondent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class RespondentRepository
{
    public function __construct(
        protected Respondent $model = new Respondent(),
        protected Question $question = new Question()
    ) {
    }

    public function getRespondent(string $respondentId): ?Respondent
    {
        return $this->model->findOrFail($respondentId);
    }

    public function getRespondents(?Carbon $filter = null, ?bool $loadAssociation = false, ?bool $onlyMultiple = false): Collection
    {
        $respondent = $this->model->query();
        $administratorRole = (string) auth()->user()->patient_room_id;

        $multipleQuestions = $this->question->whereHas('questionType', function ($query) {
            $query->where('type', 'Multiple Choice');
        })->pluck('id')->toArray();

        if ($administratorRole) {
            $respondent->where('patient_room_id', $administratorRole);
        }

        if ($filter) {
            $respondent->whereMonth('respondents.created_at', $filter->month)->whereYear('respondents.created_at', $filter->year);
        }

        $respondent->when($loadAssociation, function ($query) use ($onlyMultiple, $multipleQuestions) {
            $query->with([
                'answers' => function ($query) use ($multipleQuestions) {
                    $query->with(['answer']);
                    if ($multipleQuestions) {
                        $query->whereHas('answer', function ($subQuery) use ($multipleQuestions) {
                            $subQuery->whereIn('question_id', $multipleQuestions);
                        });
                    }
                },
            ]);
        }, function ($query) {
            $query->with(['answers']);
        });

        return $respondent->get();
    }

    public function countRespondent(): int
    {
        (string) $administratorRole = auth()->user()->patient_room_id;
        $respondent = $this->model->query();

        if ($administratorRole !== null)
            $respondent->where('patient_room_id', $administratorRole);

        return $respondent->count();
    }

    public function addRespondent(array $data): Respondent
    {
        return Respondent::create($data);
    }
}
