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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->text('description');
            $table->text('image_path');
            $table->decimal('price', 10, 3);
            $table->decimal('weight', 10, 2);
            $table->decimal('length', 10, 1);
            $table->decimal('width', 10, 1);
            $table->decimal('height', 10, 1);
            $table->text('tags')->nullable();
            $table->tinyInteger('marketable')->default(1);
            $table->integer('marketable_number')->default(0);
            $table->integer('frozen_number')->default(0);
            $table->integer('sold_number')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->bigInteger('view')->default(0);
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('product_categories')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('products');
    }
};
