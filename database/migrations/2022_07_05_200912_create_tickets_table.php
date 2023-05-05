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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable();
            $table->text('description');
            $table->tinyInteger('seen')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->foreignId('ticket_id')->nullable()->constrained('tickets')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('ticket_categories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('priority_id')->constrained('ticket_priorities')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('reference_id')->constrained('ticket_admins')->nullable()->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('tickets');
    }
};
