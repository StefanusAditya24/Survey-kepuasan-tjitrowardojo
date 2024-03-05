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
        protected Question   $question = new Question()
    )
    {
    }

    public function getRespondent(string $respondentId): ?Respondent
    {
        return $this->model->findOrFail($respondentId);
    }

    public function getRespondents(?Carbon $startFilter = null, ?Carbon $endFilter = null, ?bool $loadAssociation = false, ?bool $onlyMultiple = false, ?bool $excludeMultiple = false): Collection
    {
        $respondent = $this->model->query();
        $administratorRole = (string)auth()->user()->patient_room_id;

        $multipleQuestions = $this->question->whereHas('questionType', function ($query) {
            $query->where('type', '=', 'Multiple Choice')
                ->orWhere('question_types.type', '=', 'Open Ended Question');
        })->pluck('id')->toArray();

        $notMultipleQuestion = $this->question->whereHas('questionType', function ($query) {
            $query->whereNot('type', '=', 'Multiple Choice');
        })->pluck('id')->toArray();

        if ($administratorRole) {
            $respondent->where('patient_room_id', $administratorRole);
        }

        if ($startFilter && $endFilter === null) {
            $respondent->whereMonth('respondents.created_at', $startFilter->month)
                ->whereYear('respondents.created_at', $startFilter->year);
        } elseif ($startFilter && $endFilter) {
            $respondent->whereBetween('respondents.created_at', [
                $startFilter->startOfDay(),
                $endFilter->endOfDay(),
            ]);
        }

        $respondent->when($loadAssociation, function ($query) use ($onlyMultiple, $multipleQuestions, $notMultipleQuestion, $excludeMultiple) {
            $query->with([
                'answers' => function ($query) use ($onlyMultiple, $excludeMultiple, $multipleQuestions, $notMultipleQuestion) {
                    $query->with(['answer']);
                    if ($onlyMultiple) {
                        $query->whereHas('answer', function ($subQuery) use ($multipleQuestions) {
                            $subQuery->whereIn('question_id', $multipleQuestions);
                        });
                    }
                    if ($excludeMultiple) {
                        $query->whereHas('answer', function ($subQuery) use ($notMultipleQuestion) {
                            $subQuery->whereIn('question_id', $notMultipleQuestion);
                        });
                    }
                },
                'serviceType',
                'patientRoom',
                'polyclinic'
            ]);
        }, function ($query) {
            $query->with(['answers']);
        });

        return $respondent->get();
    }

    public function getRespondentTotal(): int
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
