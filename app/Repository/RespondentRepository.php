<?php

namespace App\Repository;

use App\Models\Respondent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class RespondentRepository
{
    public function __construct(
        protected Respondent $model = new Respondent()
    ) {
    }

    public function getRespondent(mixed $respondentId): ?Respondent
    {
        return $this->model->findOrFail($respondentId);
    }

    public function getRespondents(?Carbon $filter = null): Collection
    {
        $respondent = $this->model->query();
        if (!empty($filter))
            $respondent->whereMonth('created_at', $filter->month)->whereYear('created_at', $filter->year);

        return $respondent->get();
    }

    public function addRespondent(array $data): Respondent
    {
        return Respondent::create($data);
    }
}
