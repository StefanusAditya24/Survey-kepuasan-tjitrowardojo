<?php

namespace App\Repository;

use App\Models\Question;
use App\Models\RespondentAnswer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class RespondentAnswerRepository
{
    public function __construct(
        protected RespondentAnswer $model = new RespondentAnswer(),
        protected RespondentRepository $respondentRepository = new RespondentRepository()
    ) {
    }

    public function getAnswerCountByQuestionId(?Carbon $filter = null, mixed $questionId): array
    {
        (string) $administratorRole = auth()->user()->patient_room_id;
        $question = Question::with(['questionAnswers', 'questionAnswers.answers.respondent'])->find($questionId);

        return $question->questionAnswers->flatMap(function ($answer) use ($filter, $administratorRole) {
            $count = $answer->answers
                ->filter(function ($respondentAnswer) use ($filter, $administratorRole) {
                    $isAdminRoleMatch = ($administratorRole === null) || ($respondentAnswer->respondent->patient_room_id == $administratorRole);
                    $isDateMatch = (!$filter) || ($respondentAnswer->respondent->created_at->month == $filter->month && $respondentAnswer->respondent->created_at->year == $filter->year);

                    return $isDateMatch && $isAdminRoleMatch;
                })
                ->count();

            return [$answer->answer => $count];
        })->all();
    }

    public function getRespondentAnswerIndex(?Carbon $startFilter = null, ?Carbon $endFilter = null,
                                             ?bool $onlyMultiple = false, ?bool $excludeMultiple = false): array
    {
        $result = $this->getRespondentAnswerIndexQuery($startFilter, $endFilter, $onlyMultiple, $excludeMultiple);
        $countQuery = $this->getCountQuery($startFilter, $endFilter, $onlyMultiple, $excludeMultiple);

        $result = $result->get();
        $countPerQuestion = $countQuery->get();

        $resultArray = $result->toArray();
        $countPerQuestionArray = $countPerQuestion->toArray();
        
        return $this->restructureResults($resultArray, $countPerQuestionArray);
    }

    public function addRespondentAnswer(array $data): RespondentAnswer
    {
        return RespondentAnswer::create($data);
    }

    protected function getRespondentAnswerIndexQuery(?Carbon $startFilter = null, ?Carbon $endFilter = null,
                                                     ?bool $onlyMultiple = false, ?bool $excludeMultiple = false): \Illuminate\Database\Eloquent\Builder
    {
        (string) $userPatientRoomId = auth()->user()->patient_room_id;

        $query = $this->model->newQuery()
            ->join('question_answers as qa', 'respondent_answers.answer_id', '=', 'qa.id')
            ->join('respondents as r', 'respondent_answers.respondent_id', '=', 'r.id')
            ->join('questions as q', 'qa.question_id', '=', 'q.id')
            ->join('question_types as qt', 'q.question_type_id', '=', 'qt.id');
        
        if ($userPatientRoomId) {
            $query->where('r.patient_room_id', '=', $userPatientRoomId);
        }

        if ($onlyMultiple) {
            $query->where('qt.type', '=', 'Multiple Choice');
        }

        if ($excludeMultiple) {
            $query->whereNot('qt.type', '=', 'Multiple Choice');
        }

        if ($startFilter && $endFilter === null) {
            $query->whereMonth('r.created_at', $startFilter->month)
                ->whereYear('r.created_at', $startFilter->year);
        } elseif ($startFilter && $endFilter) {
            $query->whereBetween('r.created_at', [
                $startFilter->startOfDay(),
                $endFilter->endOfDay(),
            ]);
        }
        
        if ($userPatientRoomId) {
            $query->groupBy('qa.question_id', 'r.patient_room_id')
                ->select('qa.question_id', DB::raw('SUM(qa.answer_value) as total_weight', 'r.patient_room_id'));
        } else {
            $query->groupBy('qa.question_id')
                ->select('qa.question_id', DB::raw('SUM(qa.answer_value) as total_weight'));
        }
        
        return $query;
    }


    protected function getCountQuery(?Carbon $startFilter = null, ?Carbon $endFilter = null,
                                     ?bool $onlyMultiple = false, ?bool $excludeMultiple = false): \Illuminate\Database\Eloquent\Builder
    {
        (string) $admin = auth()->user()->patient_room_id;

        $query = $this->model->newQuery()
            ->join('respondents as r', 'respondent_answers.respondent_id', '=', 'r.id')
            ->join('questions', 'respondent_answers.question_id', '=', 'questions.id')
            ->join('question_types', 'questions.question_type_id', '=', 'question_types.id')
            ->where('r.patient_room_id', '=', $admin);

        if ($onlyMultiple) {
            $query->where('question_types.type', '=', 'Multiple Choice');
        }

        if ($excludeMultiple) {
            $query->whereNot('question_types.type', '=', 'Multiple Choice');
        }

        if ($startFilter && $endFilter === null) {
            $query->join('respondents', 'respondent_answers.respondent_id', '=', 'respondents.id')
                  ->whereMonth('r.created_at', $startFilter->month)
                  ->whereYear('r.created_at', $startFilter->year);
        } elseif ($startFilter && $endFilter) {
            $query->join('respondents', 'respondent_answers.respondent_id', '=', 'respondents.id')
                  ->whereBetween('r.created_at', [
                    $startFilter->startOfDay(),
                    $endFilter->endOfDay(),
            ]);
        }

        $query->groupBy('questions.id', 'r.patient_room_id')
              ->select('questions.id as question_id', DB::raw('COUNT(DISTINCT respondent_answers.respondent_id) as respondent_count'));

        return $query;
    }


    protected function restructureResults(array $resultArray, array $countPerQuestionArray): array
    {
        $questionMap = [];
        $respondentTotal = $this->respondentRepository->getRespondentTotal();

        foreach ($resultArray as $item) {
            $questionMap[$item['question_id']] = [
                'question_id' => $item['question_id'],
                'total_weight' => intval($item['total_weight']),
                'average_weight' => number_format(intval($item['total_weight']) / $respondentTotal, 2),
                'respondent_count' => 0,
            ];
        }

        foreach ($countPerQuestionArray as $countItem) {
            $questionId = $countItem['question_id'];
            if (isset($questionMap[$questionId])) {
                $questionMap[$questionId]['respondent_count'] = $countItem['respondent_count'];
            }
        }

        return array_values($questionMap);
    }
}
