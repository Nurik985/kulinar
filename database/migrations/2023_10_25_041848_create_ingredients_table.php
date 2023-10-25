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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250)->comment('Название')->unique();
            $table->float('protein', 8, 2)->nullable()->comment('Белки')->default(0);
            $table->float('fat', 8, 2)->nullable()->comment('Жиры')->default(0);
            $table->float('carbohydrates', 8, 2)->nullable()->comment('Углеводы')->default(0);
            $table->float('kkal', 8, 2)->nullable()->comment('Ккал')->default(0);
            $table->float('fiber', 8, 2)->nullable()->comment('Пищевые волокна')->default(0);
            $table->float('water', 8, 2)->nullable()->comment('Вода')->default(0);
            $table->integer('parent')->nullable()->comment('Родительский ингредиент')->default(0);
            $table->integer('new')->default(0)->comment('Новый');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
