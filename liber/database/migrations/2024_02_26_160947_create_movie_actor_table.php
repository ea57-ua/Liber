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
        Schema::create('movie_actor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movie_id');
            $table->unsignedBigInteger('actor_id');

            $table->foreign('movie_id')
                ->references('id')
                ->on('movies')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('actor_id')
                ->references('id')
                ->on('actors')
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
        Schema::dropIfExists('movie_actor');
    }
};
