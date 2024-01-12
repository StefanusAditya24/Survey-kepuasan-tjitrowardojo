<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            QuestionSeeder::class,
        ]);

        User::create(['username' => 'admin', 'password' => bcrypt('admin')]);
    }
}
