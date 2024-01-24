<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\PatientRoom;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 */
class UserSeeder extends Seeder
{
    public function run(): void
    {
        $patient_rooms = PatientRoom::all();

        $users = [
            'PUNTADEWA' => [
                ['name' => 'Admin Puntadewa', 'username' => 'adminPuntadewa', 'password' => bcrypt('admin'), 'patient_room_id' => '1' ]
            ],
            'ASTER' => [
                ['name' => 'Admin Aster', 'username' => 'adminAster', 'password' => bcrypt('admin'), 'patient_room_id' => '2' ]
            ],
            'BOUGENVILE' => [
                ['name' => 'Admin Bougenvile', 'username' => 'adminBougenvile', 'password' => bcrypt('admin'), 'patient_room_id' => '3' ]
            ],
            'CEMPAKA' => [
                ['name' => 'Admin Cempaka', 'username' => 'adminCempaka', 'password' => bcrypt('admin'), 'patient_room_id' => '4' ]
            ],
            'GLADIOL' => [
                ['name' => 'Admin Gladiol', 'username' => 'adminGladiol', 'password' => bcrypt('admin'), 'patient_room_id' => '5' ]
            ],
            'ICU' => [
                ['name' => 'Admin Icu', 'username' => 'adminIcu', 'password' => bcrypt('admin'), 'patient_room_id' => '6' ]
            ],
            'PERISTI' => [
                ['name' => 'Admin Peristi', 'username' => 'adminPeristi', 'password' => bcrypt('admin'), 'patient_room_id' => '7' ]
            ],
            'DAHLIA' => [
                ['name' => 'Admin Dahlia', 'username' => 'adminDahlia', 'password' => bcrypt('admin'), 'patient_room_id' => '8' ]
            ],
            'EDELWISE' => [
                ['name' => 'Admin Edelwise', 'username' => 'adminEdelwise', 'password' => bcrypt('admin'), 'patient_room_id' => '9' ]
            ],
            'HCU' => [
                ['name' => 'Admin Hcu', 'username' => 'adminHcu', 'password' => bcrypt('admin'), 'patient_room_id' => '10' ]
            ],
            'PICU NICU' => [
                ['name' => 'Admin Picu Nicu', 'username' => 'adminPicuNicu', 'password' => bcrypt('admin'), 'patient_room_id' => '11' ]
            ],
            'BIMA' => [
                ['name' => 'Admin Bima', 'username' => 'adminBima', 'password' => bcrypt('admin'), 'patient_room_id' => '12' ]
            ],
            'ICCU' => [
                ['name' => 'Admin Iccu', 'username' => 'adminIccu', 'password' => bcrypt('admin'), 'patient_room_id' => '13' ]
            ],
            'ARJUNA' => [
                ['name' => 'Admin Arjuna', 'username' => 'adminArjuna', 'password' => bcrypt('admin'), 'patient_room_id' => '14' ]
            ],
            'VK' => [
                ['name' => 'Admin Vk', 'username' => 'adminVk', 'password' => bcrypt('admin'), 'patient_room_id' => '15']
            ],
        ];

        /** @var PatientRoom $patient_room */
        foreach ($patient_rooms as $patient_room) {
            $roomUser = $users[$patient_room->room_name] ?? [];

            foreach ($roomUser as $userData) {
                $patient_room->users()->create([
                    'name' => $userData['name'],
                    'username' => $userData['username'],
                    'password' => $userData['password'],
                    'patient_room_id' => $userData['patient_room_id'],
                ]);
            }
        }

        User::create([
            'name' => 'Super Admin',
            'username' => 'administrator',
            'password' => bcrypt('admin'),
            'patient_room_id' => null,
        ]);
    }
}