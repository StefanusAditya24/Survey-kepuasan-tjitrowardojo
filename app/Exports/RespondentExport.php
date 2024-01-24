<?php

declare(strict_types=1);

namespace App\Exports;

use App\Repository\QuestionRepository;
use App\Repository\RespondentAnswerRepository;
use App\Repository\RespondentRepository;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 */
class RespondentExport implements FromView
{
    public function __construct(
       protected RespondentRepository $respondentRepository = new RespondentRepository(),
       protected QuestionRepository $questionRepository = new QuestionRepository(),
        protected RespondentAnswerRepository $respondentAnswerRepository = new RespondentAnswerRepository(),
    ) {
    }

    public function view(): View
    {
        $current_date = Carbon::now();
        $questions = $this->questionRepository->getQuestions(true);
        $respondents = $this->respondentRepository->getRespondents($current_date, true);
        $attributes = $this->respondentAnswerRepository->getRespondentAnswerIndex();
        $calculatedAttributes = [];
        foreach ($attributes as $attribute) {
            $calculatedAttributes[] = $attribute['total_weight'] / $attribute['respondent_count'];
        }
        $weightedAttribute = array_sum($calculatedAttributes);
        $serviceUnitIndex = $weightedAttribute * 25;
        return view('livewire.admin.respondent.export', [
            'questions' => $questions,
            'respondents' => $respondents,
            'attributes' => $attributes,
            'calculatedAttributes' => $calculatedAttributes,
            'weightedAttribute' => $weightedAttribute,
            'serviceUnitIndex' => $serviceUnitIndex
        ]);
    }
}