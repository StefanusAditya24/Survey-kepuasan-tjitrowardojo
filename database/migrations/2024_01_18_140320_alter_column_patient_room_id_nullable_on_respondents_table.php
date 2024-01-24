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
        Schema::table('respondents', function (Blueprint $table) {
            $table->dropForeign('respondents_patient_room_id_foreign');
        });

        Schema::table('respondents', function (Blueprint $table) {
            $table->string('patient_room_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('respondents', function (Blueprint $table) {
            $table->string('patient_room_id')->nullable(false)->change();

            $table->foreign('patient_room_id')->references('id')->on('patient_rooms')->onDelete('cascade');
        });
    }
};
