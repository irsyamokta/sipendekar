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
        Schema::create('pesertas', function (Blueprint $table) {
            $table->bigIncrements('id_peserta');
            $table->string('nama_lengkap');
            $table->string('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('sekolah');
            $table->string('nomor_hp');
            $table->string('email');
            $table->string('token')->unique();

            $table->primary('id_peserta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
