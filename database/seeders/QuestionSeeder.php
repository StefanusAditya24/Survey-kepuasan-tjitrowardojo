<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            1 => 'Bagaimana pendapat Saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanannya',
            2 => 'Bagaimana pemahaman Saudara tentang kemudahan prosedur pelayanan',
            3 => 'Bagaimana pendapat Saudara tentang kecepatan waktu dalam memberikan pelayanan',
            4 => 'Bagaimana pendapat Saudara tentang biaya/tarif dalam pelayanan',
            5 => 'Bagaimana pendapat Saudara tentang kesesuaian produk pelayanan antara yang tercantum dalam standar pelayanan dengan hasil yang diberikan',
            6 => 'Bagaimana pendapat Saudara tentang kemampuan (kompetensi) petugas dalam memberikan pelayanan',
            7 => 'Bagaimana pendapat Saudara tentang perilaku petugas dalam pelayanan terkait kesopanan dan keramahan',
            8 => 'Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana',
            9 => 'Bagaimana pendapat Saudara tentang penanganan pengaduan pengguna layanan',
        ];


        foreach ($questions as $question) Question::create(['name' => $question]);
    }
}
