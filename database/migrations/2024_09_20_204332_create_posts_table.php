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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // добавили
            $table->text('content'); // добавили
            $table->string('image'); // добавили
            $table->unsignedBigInteger('likes')->nullable(); // добавили
            $table->boolean('is_published')->default(1); // добавили
            $table->timestamps();

						$table->softDeletes(); // добавили

						$table->unsignedBigInteger('category_id')->nullable(); // добавили. Обязательно называть т.к. назвали модель(с малелькой буквы), тогда Laravel привяжет все сам
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
