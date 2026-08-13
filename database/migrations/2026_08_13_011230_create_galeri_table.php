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
        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artikel_id')->constrained('artikel')->onDelete('cascade');
            $table->string('judul_gambar')->nullable();
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type')->nullable();
            $table->string('file_size')->nullable();
            $table->enum('tipe_media', ['gambar', 'video'])->default('gambar');
            $table->boolean('is_cover')->default(false);
            $table->integer('urutan')->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['artikel_id', 'urutan']);
            $table->index('is_cover');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri');
    }
};
