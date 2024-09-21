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
					$table->unsignedBigInteger('category_id')->nullable(); // добавили (только положительные)
            $table->string('title');
            $table->text('content');
            $table->string('image');
            $table->unsignedBigInteger('likes')->nullable();
            $table->boolean('is_published')->default(1);
            $table->timestamps();

						$table->softDeletes();

						$table->index('category_id', 'post_category_idx'); // добавили (<поле>,<имя индекса>)
						$table->foreign('category_id', 'post_category_fk')->on('categories')->references('id'); // добавили (???)

						//$table->foreign('category_id')->references('id')->on('categories'); 

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
