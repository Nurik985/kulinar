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
        Schema::create('headings', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250)->nullable();
            $table->string('url', 250)->unique('url')->nullable();
            $table->string('title', 250)->nullable();
            $table->text('text')->nullable();
            $table->text('w_cook')->nullable();
            $table->text('ingredients_accept')->nullable();
            $table->text('ingredients_block')->nullable();
            $table->text('cooking_m')->nullable();
            $table->integer('type')->default(1);
            $table->string('fade', 50)->nullable();
            $table->string('link_razdel', 50)->nullable();
            $table->text('parent')->nullable();
            $table->text('recept')->nullable();
            $table->integer('col_recipe')->nullable()->default(0);
            $table->text('parent_sect')->nullable();
            $table->integer('col_public_recipe')->nullable()->default(0);
            $table->string('img', 100)->nullable();
            $table->integer('osn_section')->nullable();
            $table->text('parent_bread')->nullable();
            $table->text('firsttext')->nullable();
            $table->longText('genzapros')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('headings');
    }
};
