<?php

namespace Database\Seeders;

use App\Models\Age;
use Illuminate\Database\Seeder;

class AgeSeeder extends Seeder
{
    public function run(): void
    {
        $ageRanges = [
            1 => 'Kurang dari 20 Tahun',
            2 => '21 Sampai 25 Tahun',
            3 => '26 Sampai 30 Tahun',
            4 => '31 Sampai 35 Tahun',
            5 => '36 Sampai 40 Tahun',
            6 => '41 Sampai 45 Tahun',
            7 => '46 Sampai 50 Tahun',
            8 => '55 Sampai 60 Tahun',
            9 => 'Lebih dari 60 Tahun',
        ];

        foreach ($ageRanges as $age)
            Age::create(['name' => $age]);
    }
}
