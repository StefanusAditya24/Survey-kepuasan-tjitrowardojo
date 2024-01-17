<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\PatientRoom;
use Illuminate\Database\Eloquent\Collection;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 */
class PatientRoomRepository
{
    public function __construct(
        protected PatientRoom $patientRoom = new PatientRoom()
    ) {
    }

    public function getPatientRoom(mixed $patientRoomsId): ?PatientRoom
    {
        return $this->patientRoom->findOrFail($patientRoomsId);
    }

    public function getPatientRooms(): Collection
    {
        return $this->patientRoom->all();
    }
}