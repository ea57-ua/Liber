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
        Schema::create('movie_country', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movie_id');
            $table->unsignedBigInteger('country_id');
            $table->foreign('movie_id')
                ->references('id')
                ->on('movies')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_country');
    }
};
