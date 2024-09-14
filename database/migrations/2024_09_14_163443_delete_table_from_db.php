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
        //Schema::dropIfExists('posts');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::create('posts', function (Blueprint $table) {
        //    // Я МОГУ ВЕРНУТЬ ТОЛЬКО СТРУКТУРУ(СО ВСЕМИ ИЗМЕНЕНИЯМИ!) ТАБЛ. БЕЗ ДАННЫХ - НАХУЯ ЭТО НАДО!
        //});
    }
};
