<?php
// database/migrations/xxxx_xx_xx_create_artikeltag_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artikeltag', function (Blueprint $table) {
            $table->id();
            // ===== PASTIKAN REFERENSI KE TABEL artikels =====
            $table->foreignId('artikel_id')->constrained('artikels')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('tags')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikeltag');
    }
};