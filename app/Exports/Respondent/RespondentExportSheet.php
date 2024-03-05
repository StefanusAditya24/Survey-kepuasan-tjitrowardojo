<?php

declare(strict_types=1);

namespace App\Exports\Respondent;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 */
class RespondentExportSheet implements FromView, WithTitle
{
    public function __construct(
        protected string     $title,
        protected Collection $respondents,
        protected Collection $questions,
        protected array      $respondentAnswers,
    )
    {
    }

    public function title(): string
    {
        return $this->title;
    }

    public function view(): View
    {
//        dd($this->respondentAnswers);
        $averageAttributes = [];
        $calculatedAverageAttributes = [];
        foreach ($this->respondentAnswers as $respondentAnswer) {
            $averageAttributes[] = $respondentAnswer['respondent_count'] === 0 ? 0 : $respondentAnswer['average_weight'] * 25;
            $calculatedAverageAttributes[] = $respondentAnswer['respondent_count'] === 0 ? 0 : $respondentAnswer['average_weight'] * 0.11;
        }
        $totalCalculatedAverageAttributes = array_sum($calculatedAverageAttributes) ;
        $serviceUnitIndex = $totalCalculatedAverageAttributes * 25;
        return view('livewire.admin.respondent.export', [
            'questions' => $this->questions,
            'respondents' => $this->respondents,
            'attributes' => $this->respondentAnswers,
//            'calculatedAttributes' =>  $respondentAnswer['respondent_count'],
//            'weightedAttribute' => $weightedAttribute,
//            'serviceUnitIndex' => $serviceUnitIndex
            'averageAttributes' => $averageAttributes,
            'calculatedAverageAttributes' => $calculatedAverageAttributes,
            'totalCalculatedAverageAttributes' => $totalCalculatedAverageAttributes,
            'serviceUnitIndex' => $serviceUnitIndex
        ]);
    }
}