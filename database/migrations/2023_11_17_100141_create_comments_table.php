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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('name_user', 250)->nullable();
            $table->text('text')->nullable();
            $table->integer('status')->default(0)->nullable();
            $table->text('answer')->nullable();
            $table->integer('id_recipe')->nullable();
            $table->integer('id_comment_answer')->nullable();
            $table->integer('please')->nullable();
            $table->string('email', 250)->nullable();
            $table->text('imgs', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
