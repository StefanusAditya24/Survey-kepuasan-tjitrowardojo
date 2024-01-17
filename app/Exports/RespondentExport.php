<?php

declare(strict_types=1);

namespace App\Exports;

use App\Models\Respondent;
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
        $questions = $this->questionRepository->getQuestions();
        $respondent = $this->respondentRepository->getRespondents($current_date, true);
        $attributes = $this->respondentAnswerRepository->getRespondentAnswerIndex();
        $attributeIndexes = $this->respondentAnswerRepository->getRespondentAnswerIndex();
        $totalRespondent = $this->respondentRepository->countRespondent();
        $wightedIndex = 12;
        return view('livewire.admin.respondent.export', [
            'questions' => $questions,
            'respondents' => $respondent,
            'attributes' => $attributes,
            'attributeIndexes' => $attributeIndexes,
            'wightedIndex' => $wightedIndex,
            'totalRespondent' => $totalRespondent
        ]);
    }
}