<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Polyclinic;
use Illuminate\Database\Eloquent\Collection;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 */
class PolyclinicRepository
{
    public function __construct(
        protected Polyclinic $polyclinic = new Polyclinic()
    ) {
    }

    public function getPolyclinic(mixed $polyclinicId): ?Polyclinic
    {
        return $this->polyclinic->findOrFail($polyclinicId);
    }

    public function getPolyclinics(): Collection
    {
        return $this->polyclinic->orderBy('poly_name')->get();
    }
}