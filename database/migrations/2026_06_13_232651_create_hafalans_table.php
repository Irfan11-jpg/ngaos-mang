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
        Schema::create('hafalans', function (Blueprint $table) {
            $table->id();
            // Menghubungkan hafalan ini ke user (santri)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->string('surah');
            $table->string('ayat');
            $table->string('status'); // Contoh status: 'Lancar', 'Perlu Diulang'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hafalans');
    }
};