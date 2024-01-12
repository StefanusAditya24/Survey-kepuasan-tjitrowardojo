<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('respondents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number');
            $table->enum('gender', ['male', 'female']);
            $table->unsignedBigInteger('age_id');
            $table->unsignedBigInteger('education_id');
            $table->string('job');
            $table->unsignedBigInteger('service_type_id');
            $table->timestamps();

            $table->foreign('age_id')->references('id')->on('ages');
            $table->foreign('education_id')->references('id')->on('educations');
            $table->foreign('service_type_id')->references('id')->on('service_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respondents');
    }
};
