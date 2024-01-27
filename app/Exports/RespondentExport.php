<?php

declare(strict_types=1);

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromView;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 */
class RespondentExport implements FromView
{
    public function __construct(
        protected Collection $respondents,
        protected Collection $questions,
        protected array $respondentAnswers,
    ) {
    }

    public function view(): View
    {
        $calculatedAttributes = [];
        foreach ($this->respondentAnswers as $respondentAnswer) {
            $calculatedAttributes[] = $respondentAnswer['total_weight'] / $respondentAnswer['respondent_count'];
        }
        $weightedAttribute = array_sum($calculatedAttributes);
        $serviceUnitIndex = $weightedAttribute * 25;
        return view('livewire.admin.respondent.export', [
            'questions' => $this->questions,
            'respondents' => $this->respondents,
            'attributes' => $this->respondentAnswers,
            'calculatedAttributes' => $calculatedAttributes,
            'weightedAttribute' => $weightedAttribute,
            'serviceUnitIndex' => $serviceUnitIndex
        ]);
    }
}