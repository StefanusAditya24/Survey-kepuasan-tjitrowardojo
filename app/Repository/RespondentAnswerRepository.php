<?php

namespace App\Repository;

use App\Models\RespondentAnswer;
use Carbon\Carbon;
use Illuminate\Support\Str;

class RespondentAnswerRepository
{
    public function __construct(
        protected RespondentAnswer $model = new RespondentAnswer(),
    ) {
    }

    public function getAnswerCountByQuestionId(?Carbon $filter = null, mixed $questionId): array
    {
        $dataToBeReturn = [
            'Tidak Sesuai' => 0,
            'Kurang Sesuai' => 0,
            'Sesuai' => 0,
            'Sangat Sesuai' => 0,
            'Lainnya' => 0,
        ];

        $answers = $this->model->where('question_id', $questionId);

        if (!empty($filter))
            $answers->whereMonth('created_at', $filter->month)->whereYear('created_at', $filter->year);

        $answers = $answers->get();
        $dataToBeReturn['Tidak Sesuai'] = $answers->filter(fn ($answer) => $answer->answer == 'Tidak Sesuai')->count();
        $dataToBeReturn['Kurang Sesuai'] = $answers->filter(fn ($answer) => $answer->answer == 'Kurang Sesuai')->count();
        $dataToBeReturn['Sesuai'] = $answers->filter(fn ($answer) => $answer->answer == 'Sesuai')->count();
        $dataToBeReturn['Sangat Sesuai'] = $answers->filter(fn ($answer) => $answer->answer == 'Sangat Sesuai')->count();
        $dataToBeReturn['Lainnya'] = $answers->filter(fn ($answer) => !Str::contains($answer->answer, 'Sesuai'))->count();

        return $dataToBeReturn;
    }

    public function addRespondentAnswer(array $data): RespondentAnswer
    {
        return RespondentAnswer::create($data);
    }
}
