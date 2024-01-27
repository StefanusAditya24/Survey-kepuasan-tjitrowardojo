<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $educationOptions = [
            1 => 'SD',
            2 => 'SMP',
            3 => 'SMA',
            4 => 'DIPLOMA 3',
            5 => 'SARJANA',
            6 => 'PASCASARJANA / LEBIH',
        ];

        foreach ($educationOptions as $id => $educationOption) {
            if (!Education::where('id', $id)->exists()) {
                Education::create(['id' => $id, 'name' => $educationOption]);
            }
        }
    }
}
