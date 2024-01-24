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

    public function getRespondentAnswerIndex(?Carbon $filter = null): array
    {
        $result = $this->getRespondentAnswerIndexQuery($filter);
        $countQuery = $this->getCountQuery($filter);

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

    protected function getRespondentAnswerIndexQuery(?Carbon $filter = null): \Illuminate\Database\Eloquent\Builder
    {
        $admin = (string) auth()->user()->patient_room_id;

        $query = $this->model->newQuery()
            ->join('question_answers as qa', 'respondent_answers.answer_id', '=', 'qa.id')
            ->join('respondents as r', 'respondent_answers.respondent_id', '=', 'r.id')
            ->join('questions as q', 'qa.question_id', '=', 'q.id')
            ->join('question_types as qt', 'q.question_type_id', '=', 'qt.id')
            ->where('qt.type', '=', 'Multiple Choice')
            ->where('r.patient_room_id', '=', $admin)
            ->groupBy('qa.question_id', 'r.patient_room_id')
            ->select('qa.question_id', DB::raw('SUM(qa.answer_value) as total_weight'), 'r.patient_room_id');

        if ($filter) {
            $query->whereMonth('r.created_at', $filter->month)
                ->whereYear('r.created_at', $filter->year);
        }

        return $query;
    }


    protected function getCountQuery(?Carbon $filter = null): \Illuminate\Database\Eloquent\Builder
    {
        $admin = (string) auth()->user()->patient_room_id;

        $query = $this->model->newQuery()
            ->join('respondents as r', 'respondent_answers.respondent_id', '=', 'r.id')
            ->join('questions', 'respondent_answers.question_id', '=', 'questions.id')
            ->join('question_types', 'questions.question_type_id', '=', 'question_types.id')
            ->where('question_types.type', 'Multiple Choice')
            ->where('r.patient_room_id', '=', $admin)
            ->groupBy('questions.id', 'r.patient_room_id')
            ->select('questions.id as question_id', DB::raw('count(distinct respondent_answers.respondent_id) as respondent_count'));

        if ($filter) {
            $query->join('respondents', 'respondent_answers.respondent_id', '=', 'respondents.id')
                ->whereMonth('respondents.created_at', $filter->month)
                ->whereYear('respondents.created_at', $filter->year);
        }

        return $query;
    }


    protected function restructureResults(array $resultArray, array $countPerQuestionArray): array
    {
        $questionMap = [];

        foreach ($resultArray as $item) {
            $questionMap[$item['question_id']] = [
                'question_id' => $item['question_id'],
                'total_weight' => $item['total_weight'],
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
