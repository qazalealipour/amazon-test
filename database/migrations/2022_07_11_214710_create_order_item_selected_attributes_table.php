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
        Schema::create('order_item_selected_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id')->constrained('order_items')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('category_attribute_id')->constrained('category_attributes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('category_value_id')->constrained('category_values')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('value')->nullable();
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
        Schema::dropIfExists('order_item_selected_attributes');
    }
};