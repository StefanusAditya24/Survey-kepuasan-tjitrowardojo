<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\PatientRoom;
use Illuminate\Database\Seeder;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 */
class PatientRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            1 => 'PUNTADEWA',
            2 => 'ASTER',
            3 => 'BOUGENVILE',
            4 => 'CEMPAKA',
            5 => 'GLADIOL',
            6 => 'ICU',
            7 => 'PERISTI',
            8 => 'DAHLIA',
            9 => 'EDELWISE',
            10 => 'HCU',
            11 => 'PICU NICU',
            12 => 'BIMA',
            13 => 'ICCU',
            14 => 'ARJUNA',
            15 => 'VK'
        ];

        foreach ($rooms as $room) PatientRoom::create(['room_name' => $room]);
    }
}