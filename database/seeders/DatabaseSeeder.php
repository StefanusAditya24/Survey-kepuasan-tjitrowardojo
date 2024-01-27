<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AgeSeeder::class,
            EducationSeeder::class,
            JobSeeder::class,
            ServiceTypeSeeder::class,
            CategorySeeder::class,
            PatientRoomSeeder::class,
            QuestionTypeSeeder::class,
            QuestionSeeder::class,
            QuestionAnswerSeeder::class,
            UserSeeder::class,
            PolyclinicSeeder::class
        ]);
    }
}
