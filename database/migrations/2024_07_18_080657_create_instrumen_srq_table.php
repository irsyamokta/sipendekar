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
        Schema::create('instrumen_srq', function (Blueprint $table) {
            $table->bigIncrements('id_srq');
            $table->integer('urutan')->nullable();
            $table->string('pertanyaan');
            $table->timestamps();
            $table->primary('id_srq');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instrumen_srq');
    }
};
