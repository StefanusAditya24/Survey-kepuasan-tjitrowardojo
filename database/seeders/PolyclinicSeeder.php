<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Polyclinic;
use Illuminate\Database\Seeder;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 */
class PolyclinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polyclinics = [
            1 => 'Poli Anak',
            2 => 'Poli Bedah',
            3 => 'Poli Bedah Orthopedi',
            4 => 'Poli Bedah Urologi',
            5 => 'Poli Dalam 1',
            6 => 'Poli Dalam 2',
            7 => 'Poli Gigi Bedah Mulut',
            8 => 'Poli Gigi Endodonsi',
            9 => 'Poli Hemodialisa',
            10 => 'Poli Jantung dan Pembuluh Darah',
            11 => 'Poli Jiwa 1',
            12 => 'Poli Jiwa 2',
            13 => 'Poli Kulit dan Kelamin',
            14 => 'Poli Mata',
            15 => 'Poli Obstetri Ginekologi',
            16 => 'Poli Paru',
            17 => 'Poli Psikologi',
            18 => 'Poli Rama Shinta Skin Care',
            19 => 'Poli Sub Spesialis Bedah Onkologi',
            20 => 'Poli Sub Spesialis Fetomaternal',
            21 => 'Poli Sub Spesialis Ginjal Hipertensi',
            22 => 'Poli Sub Spesialis Hemato onkologi',
            23 => 'Poli Syaraf',
            24 => 'Poli THT',
        ];

        foreach ($polyclinics as $id => $polyclinic) {
            if (!Polyclinic::where('id', $id)->exists()) {
                Polyclinic::create(['id' => $id, 'poly_name' => $polyclinic]);
            }
        }
    }
}