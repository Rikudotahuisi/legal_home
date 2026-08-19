<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galeris', function (Blueprint $table) {
            $table->boolean('is_slide')->default(false)->after('is_cover');
            $table->integer('slide_urutan')->default(0)->after('is_slide');
        });
    }

    public function down(): void
    {
        Schema::table('galeris', function (Blueprint $table) {
            $table->dropColumn(['is_slide', 'slide_urutan']);
        });
    }
};
