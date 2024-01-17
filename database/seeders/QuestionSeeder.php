<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Question;
use App\Models\QuestionType;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            1 => [
                'name' => 'Bagaimana pendapat Saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanannya',
                'category_id' => 1,
                'question_type_id' => 1
            ],
            2 => [
                'name' => 'Bagaimana pemahaman Saudara tentang kemudahan prosedur pelayanan',
                'category_id' => 1,
                'question_type_id' => 1
            ],
            3 => [
                'name' => 'Bagaimana pendapat Saudara tentang kecepatan waktu dalam memberikan pelayanan',
                'category_id' => 1,
                'question_type_id' => 1
            ],
            4 => [
                'name' => 'Bagaimana pendapat Saudara tentang biaya / tarif dalam pelayanan',
                'category_id' => 1,
                'question_type_id' => 1
            ],
            5 => [
                'name' => 'Bagaimana pendapat Saudara tentang kesesuaian produk pelayanan antara yang tercantum dalam standar pelayanan dengan hasil yang diberikan',
                'category_id' => 1,
                'question_type_id' => 1,
                'question_type_id' => 1
            ],
            6 => [
                'name' => 'Bagaimana pendapat Saudara tentang kemampuan (kompetensi) petugas dalam memberikan pelayanan',
                'category_id' => 1,
                'question_type_id' => 1,
                'question_type_id' => 1
            ],
            7 => [
                'name' => 'Bagaimana pendapat Saudara tentang perilaku petugas dalam pelayanan terkait kesopanan dan keramahan',
                'category_id' => 1,
                'question_type_id' => 1
            ],
            8 => [
                'name' => 'Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana',
                'category_id' => 1,
                'question_type_id' => 1
            ],
            9 => [
                'name' => 'Bagaimana pendapat Saudara tentang penanganan pengaduan pengguna layanan',
                'category_id' => 1,
                'question_type_id' => 1
            ],
            10 => [
                'name' => 'Apakah Saudara mengetahui adanya praktek diskriminasi pelayanan karena hubungan kekerabatan oleh petugas Rumah Sakit',
                'category_id' => 2,
                'question_type_id' => 2
            ],
            11 => [
                'name' => 'Apakah Saudara mengetahui adanya petugas Rumah Sakit yang membertikan pelayanan khusus diluar prosedur dengan meminta imbalan tertentu',
                'category_id' => 2,
                'question_type_id' => 2
            ],
            12 => [
                'name' => 'Apakah Saudara mengetahui adanya pungutan liar (pungli) di Rumah Sakit',
                'category_id' => 2,
                'question_type_id' => 2
            ],
            13 => [
                'name' => 'Apakah Saudara mengetahui adanya percaloan / perantara oleh petugas Rumah Sakit untuk mempercepat proses pelayanan di Rumah Sakit',
                'category_id' => 2,
                'question_type_id' => 2
            ],
            14 => [
                'name' => 'Apakah Saudara mengetahui adanya percaloan / perantara oleh orang diluar petugas Rumah Sakit untuk mempercepat proses pelayanan di Rumah Sakit',
                'category_id' => 2,
                'question_type_id' => 2
            ],
            15 => [
                'name' => 'Apakah Saudara mengetahui adanya pungutan tarif tambahan diluar tarif resmi oleh petugas Rumah Sakit',
                'category_id' => 2,
                'question_type_id' => 2
            ],
            16 => [
                'name' => 'Apakah Saudara merasa bahwa pelayanan di Rumah Sakit transparan dan terbuka',
                'category_id' => 2,
                'question_type_id' => 2
            ],
            17 => [
                'name' => 'Mohon untuk memberikan kritik dan saran untuk peningkatan pelayanan di RSUD dr. Tjitrowardojo Purworejo',
                'category_id' => 2,
                'question_type_id' => 3
            ]
        ];


        foreach ($questions as $questionData) {
            $question = Question::create([
                'name' => $questionData['name'],
                'category_id' => $questionData['category_id'],
                'question_type_id' => $questionData['question_type_id'],
            ]);

            // Associate category
            $category = Category::find($questionData['category_id']);
            if ($category) {
                $question->category()->associate($category);
            }

            // Associate question type
            $type = QuestionType::find($questionData['question_type_id']);
            if ($type) {
                $question->questionType()->associate($type);
            }

            $question->save();
        }

    }
}
