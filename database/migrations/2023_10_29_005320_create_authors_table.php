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
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable()->default(null);
            $table->text('password', 100)->nullable()->default(null);
            $table->string('email', 55)->nullable()->default(null);
            $table->string('news_email', 55)->nullable();
            $table->decimal('rank', 1,0)->nullable()->default(0);
            $table->string('ip_reg', 15)->nullable()->default(null);
            $table->string('ip_visit', 15)->nullable()->default(null);
            $table->integer('dtreg')->default(0);
            $table->integer('dtvisit')->default(0);
            $table->smallInteger('visits')->nullable()->default(0);
            $table->text('city')->nullable();
            $table->text('country')->nullable();
            $table->integer('news',)->nullable()->default(null);
            $table->integer('in_rating')->default(1);
            $table->integer('comment')->nullable()->default(null);
            $table->text('interes')->nullable();
            $table->text('about')->nullable();
            $table->text('bluda')->nullable();
            $table->text('photo')->nullable();
            $table->integer('sex')->default(0);
            $table->text('hash')->nullable();
            $table->integer('is_active')->default(1);
            $table->integer('is_author')->default(0);
            $table->integer('is_korrektor')->default(0);
            $table->text('opit')->nullable();
            $table->text('primer')->nullable();
            $table->text('oplata')->nullable();
            $table->integer('currency')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
