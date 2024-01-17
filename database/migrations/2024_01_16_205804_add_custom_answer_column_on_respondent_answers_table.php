<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->string('custom_answer')->after('answer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('respondent_answers', function (Blueprint $table) {
            $table->dropColumn('custom_answer');
        });
    }
};
