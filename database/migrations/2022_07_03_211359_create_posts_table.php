<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable()->unique();
            $table->text('summary');
            $table->text('body');
            $table->text('image_path');
            $table->text('tags')->nullable();
            $table->tinyInteger('commentable')->default(0)->comment('0 => uncommentable, 1 => commentable');
            $table->tinyInteger('status')->default(0);
            $table->foreignId('category_id')->constrained('post_categories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('author_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamp('published_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
