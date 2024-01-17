<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('respondent_answers', function (Blueprint $table) {
            $table->unsignedBigInteger('answer_id')->after('answer');

            DB::table('respondent_answers')->update(['custom_answer' => DB::raw('answer')]);

            $table->foreign('answer_id')->references('id')->on('question_answers')->onDelete('cascade');
            $table->dropColumn('answer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('respondent_answers', function (Blueprint $table) {
            $table->string('answer');

            DB::table('respondent_answers')->update(['answer' => DB::raw('custom_answer')]);

            $table->dropForeign(['answer_id']);
        });
    }
};
