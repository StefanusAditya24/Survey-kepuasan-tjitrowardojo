<?php

namespace Database\Seeders;

use App\Models\ServiceType;
use Illuminate\Database\Seeder;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviceTypeOptions = [
            1 => 'Rawat Jalan',
            2 => 'Rawat Inap',
            3 => 'IGD',
            4 => 'Instalasi Farmasi',
            5 => 'Instalasi Rehabilitas Medik',
            6 => 'Laboratorium',
            7 => 'Instalasi Radiologi',
            8 => 'Ruang Bersalin dan Peristi',
            9 => 'Bagian Administrasi',
        ];

        foreach ($serviceTypeOptions as $serviceType) ServiceType::create(['name' => $serviceType]);
    }
}
