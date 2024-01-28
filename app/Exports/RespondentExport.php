<?php

declare(strict_types=1);

namespace App\Exports;


use App\Exports\Respondent\RespondentExportSheet;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 */
class RespondentExport implements WithMultipleSheets
{
    public function __construct(
        protected Collection $respondentMultiple,
        protected Collection $respondentNotMultiple,
        protected Collection $questionMultiple,
        protected Collection $questionNotMultiple,
        protected array $respondentAnswerMultiple,
        protected array $respondentAnswerNotMultiple,
    ) {
    }

    public function sheets(): array
    {
        return [
            new RespondentExportSheet("Kepuasan", $this->respondentMultiple, $this->questionMultiple, $this->respondentAnswerMultiple),
            new RespondentExportSheet("Anti Korupsi", $this->respondentNotMultiple, $this->questionNotMultiple, $this->respondentAnswerNotMultiple)
        ];
    }
}