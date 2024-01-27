<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\QuestionType;
use Illuminate\Database\Seeder;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 */
class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $question_types = [
            1 => 'Multiple Choice',
            2 => 'Polar Question',
            3 => 'Open Ended Question'
        ];

        foreach ($question_types as $id => $question_type) {
            if (!QuestionType::where('id', $id)->exists()) {
                QuestionType::create(['id' => $id, 'type' => $question_type]);
            }
        }
    }
}