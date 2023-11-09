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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('url', 250)->unique('url');
            $table->text('link_source')->nullable();
            $table->text('text')->nullable();
            $table->text('ingridients')->nullable();
            $table->text('cooking_t')->nullable();
            $table->text('cooking_tg')->nullable();
            $table->text('portion')->nullable();
            $table->text('calories')->nullable();
            $table->text('steps')->nullable();
            $table->longText('end_text')->nullable();
            $table->text('title')->nullable();
            $table->text('img')->nullable();
            $table->text('screen')->nullable();
            $table->text('w_cook')->nullable();
            $table->text('method')->nullable();
            $table->text('world')->nullable();
            $table->integer('status')->nullable()->default(2);
            $table->integer('view')->nullable()->default(0);
            $table->integer('positive_rating')->nullable()->default(0);
            $table->integer('negative_rating')->nullable()->default(0);
            $table->float('kkal', 8,2)->nullable()->default(0);
            $table->float('protein', 8,2)->nullable()->default(0);
            $table->float('zhir', 8,2)->nullable()->default(0);
            $table->float('ugl', 8,2)->nullable()->default(0);
            $table->integer('total_steps')->nullable()->default(0);
            $table->integer('author_id')->nullable()->default(0);
            $table->integer('attention')->nullable()->default(0);
            $table->integer('col_symbol')->nullable()->default(0);
            $table->integer('dorabotky')->nullable()->default(0);
            $table->integer('get_recipe')->nullable()->default(0);
            $table->integer('checked')->nullable()->default(0);
            $table->integer('approv')->nullable()->default(0);
            $table->integer('for_korrektor')->nullable()->default(0);
            $table->integer('for_author')->nullable()->default(0);
            $table->integer('for_admin')->nullable()->default(0);
            $table->text('autoingr')->nullable()->default(null);
            $table->text('zapingr')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
