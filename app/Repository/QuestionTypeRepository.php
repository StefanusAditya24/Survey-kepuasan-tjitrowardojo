<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\QuestionType;
use Illuminate\Support\Collection;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 */
class QuestionTypeRepository
{
    public function __construct(
        protected QuestionType $questionType = new QuestionType()
    ) {
    }

    public function getQuestionType(mixed $patientRoomsId): ?QuestionType
    {
        return $this->questionType->findOrFail($patientRoomsId);
    }

    public function getQuestionTypes(): Collection
    {
        return $this->questionType->all();
    }
}