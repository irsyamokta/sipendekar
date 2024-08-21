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
        Schema::create('srq_responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('participant_id');
            $table->unsignedBigInteger('question_id');
            $table->string('test_type');
            $table->integer('score');
            $table->date('date');
            $table->timestamps();
        
            $table->foreign('participant_id')->references('id_peserta')->on('pesertas')->onDelete('cascade');
            $table->foreign('question_id')->references('id_srq')->on('instrumen_srq')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('srq_responses');
    }
};
