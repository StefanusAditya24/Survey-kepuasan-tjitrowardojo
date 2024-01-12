<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobOptions = [
            1 => 'PNS',
            2 => 'TNI',
            3 => 'POLRI',
            4 => 'Swasta',
            5 => 'Wiraswasta',
        ];

        foreach ($jobOptions as $job) Job::create(['name' => $job]);
    }
}
