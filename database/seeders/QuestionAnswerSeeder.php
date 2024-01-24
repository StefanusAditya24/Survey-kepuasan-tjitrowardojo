<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 */
class QuestionAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = Question::all();

        $answers = [
            'Bagaimana pendapat Saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanannya' => [
                ['answer' => 'Tidak Sesuai', 'answer_value' => 1],
                ['answer' => 'Kurang Sesuai', 'answer_value' => 2],
                ['answer' => 'Sesuai', 'answer_value' => 3],
                ['answer' => 'Sangat Sesuai', 'answer_value' => 4],
            ],
            'Bagaimana pemahaman Saudara tentang kemudahan prosedur pelayanan' => [
                ['answer' => 'Tidak Mudah', 'answer_value' => 1],
                ['answer' => 'Kurang Mudah', 'answer_value' => 2],
                ['answer' => 'Mudah', 'answer_value' => 3],
                ['answer' => 'Sangat Mudah', 'answer_value' => 4],
            ],
            'Bagaimana pendapat Saudara tentang kecepatan waktu dalam memberikan pelayanan' => [
                ['answer' => 'Tidak Cepat', 'answer_value' => 1],
                ['answer' => 'Kurang Cepat', 'answer_value' => 2],
                ['answer' => 'Cepat', 'answer_value' => 3],
                ['answer' => 'Sangat Cepat', 'answer_value' => 4],
            ],
            'Bagaimana pendapat Saudara tentang biaya / tarif dalam pelayanan' => [
                ['answer' => 'Tidak Mahal', 'answer_value' => 4],
                ['answer' => 'Cukup Mahal', 'answer_value' => 3],
                ['answer' => 'Mahal', 'answer_value' => 2],
                ['answer' => 'Sangat Mahal', 'answer_value' => 1],
            ],
            'Bagaimana pendapat Saudara tentang kesesuaian produk pelayanan antara yang tercantum dalam standar pelayanan dengan hasil yang diberikan' => [
                ['answer' => 'Tidak Sesuai', 'answer_value' => 1],
                ['answer' => 'Kurang Sesuai', 'answer_value' => 2],
                ['answer' => 'Sesuai', 'answer_value' => 3],
                ['answer' => 'Sangat Sesuai', 'answer_value' => 4],
            ],
            'Bagaimana pendapat Saudara tentang kemampuan (kompetensi) petugas dalam memberikan pelayanan' => [
                ['answer' => 'Tidak Kompeten', 'answer_value' => 1],
                ['answer' => 'Kurang Kompeten', 'answer_value' => 2],
                ['answer' => 'Kompeten', 'answer_value' => 3],
                ['answer' => 'Sangat Kompeten', 'answer_value' => 4],
            ],
            'Bagaimana pendapat Saudara tentang perilaku petugas dalam pelayanan terkait kesopanan dan keramahan' => [
                ['answer' => 'Tidak sopan dan ramah', 'answer_value' => 1],
                ['answer' => 'Kurang sopan dan ramah', 'answer_value' => 2],
                ['answer' => 'Sopan dan ramah', 'answer_value' => 3],
                ['answer' => 'Sangat sopan dan ramah', 'answer_value' => 4],
            ],
            'Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana' => [
                ['answer' => 'Buruk', 'answer_value' => 1],
                ['answer' => 'Cukup', 'answer_value' => 2],
                ['answer' => 'Baik', 'answer_value' => 3],
                ['answer' => 'Sangat Baik', 'answer_value' => 4],
            ],
            'Bagaimana pendapat Saudara tentang penanganan pengaduan pengguna layanan' => [
                ['answer' => 'Tidak ada', 'answer_value' => 1],
                ['answer' => 'Ada tetapi tidak berfungsi', 'answer_value' => 2],
                ['answer' => 'Berfungsi dan kurang maksimal', 'answer_value' => 3],
                ['answer' => 'Dikelola dengan baik', 'answer_value' => 4],
            ],
            'Apakah Saudara mengetahui adanya praktek diskriminasi pelayanan karena hubungan kekerabatan oleh petugas Rumah Sakit' => [
                ['answer' => 'Ada', 'answer_value' => 1],
                ['answer' => 'Tidak ada', 'answer_value' => 0],
                ['answer' => 'Lainnya', 'answer_value' => 0],
            ],
            'Apakah Saudara mengetahui adanya petugas Rumah Sakit yang membertikan pelayanan khusus diluar prosedur dengan meminta imbalan tertentu' => [
                ['answer' => 'Ada', 'answer_value' => 1],
                ['answer' => 'Tidak ada', 'answer_value' => 0],
                ['answer' => 'Lainnya', 'answer_value' => 0],
            ],
            'Apakah Saudara mengetahui adanya pungutan liar (pungli) di Rumah Sakit' => [
                ['answer' => 'Ada', 'answer_value' => 1],
                ['answer' => 'Tidak ada', 'answer_value' => 0],
                ['answer' => 'Lainnya', 'answer_value' => 0],
            ],
            'Apakah Saudara mengetahui adanya percaloan / perantara oleh petugas Rumah Sakit untuk mempercepat proses pelayanan di Rumah Sakit' => [
                ['answer' => 'Ada', 'answer_value' => 1],
                ['answer' => 'Tidak ada', 'answer_value' => 0],
                ['answer' => 'Lainnya', 'answer_value' => 0],
            ],
            'Apakah Saudara mengetahui adanya percaloan / perantara oleh orang diluar petugas Rumah Sakit untuk mempercepat proses pelayanan di Rumah Sakit' => [
                ['answer' => 'Ada', 'answer_value' => 1],
                ['answer' => 'Tidak ada', 'answer_value' => 0],
                ['answer' => 'Lainnya', 'answer_value' => 0],
            ],
            'Apakah Saudara mengetahui adanya pungutan tarif tambahan diluar tarif resmi oleh petugas Rumah Sakit' => [
                ['answer' => 'Ada', 'answer_value' => 1],
                ['answer' => 'Tidak ada', 'answer_value' => 0],
                ['answer' => 'Lainnya', 'answer_value' => 0],
            ],
            'Apakah Saudara merasa bahwa pelayanan di Rumah Sakit transparan dan terbuka' => [
                ['answer' => 'Ada', 'answer_value' => 1],
                ['answer' => 'Tidak ada', 'answer_value' => 0],
                ['answer' => 'Lainnya', 'answer_value' => 0],
            ],
            'Mohon untuk memberikan kritik dan saran untuk peningkatan pelayanan di RSUD dr. Tjitrowardojo Purworejo' => [
                ['answer' => '', 'answer_value' => 1],
            ]
        ];


        /* @var Question $question */
        foreach ($questions as $question) {
            $answersForQuestion = $answers[$question->name] ?? [];

            foreach ($answersForQuestion as $answerData) {
                $question->questionAnswers()->create([
                    'answer' => $answerData['answer'],
                    'answer_value' => $answerData['answer_value'],
                ]);
            }
        }
    }
}