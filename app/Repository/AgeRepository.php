<?php

namespace App\Repository;

use App\Models\Age;
use Illuminate\Database\Eloquent\Collection;

class AgeRepository
{
    public function __construct(
        protected Age $age = new Age()
    ) {
    }

    public function getAge(mixed $ageId): ?Age
    {
        return $this->age->findOrFail($ageId);
    }

    public function getAges(): Collection
    {
        return $this->age->all();
    }
}
