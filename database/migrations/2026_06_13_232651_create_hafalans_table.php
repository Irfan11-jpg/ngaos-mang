<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hafalan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('guru_id')->constrained('users')->onDelete('cascade');
            $table->integer('nomor_surah');
            $table->string('nama_surah');
            $table->integer('ayat_mulai');
            $table->integer('ayat_selesai');
            $table->enum('status', ['belum', 'proses', 'selesai'])->default('belum');
            $table->enum('nilai_hafalan', ['A', 'B', 'C', 'D'])->nullable();
            $table->text('catatan')->nullable();
            $table->date('tanggal_setor')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hafalan');
    }
};