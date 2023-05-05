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
        Schema::create('public_mail_files', function (Blueprint $table) {
            $table->id();
            $table->text('file_path');
            $table->unsignedBigInteger('file_size');
            $table->string('file_type');
            $table->enum('storage_location', ['public', 'storage']);
            $table->tinyInteger('status')->default(0);
            $table->foreignId('public_mail_id')->constrained('public_mail')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('public_mail_files');
    }
};
