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
        DB::table('movie_lists')
            ->whereNull('poster_image')
            ->update(['poster_image' => '/img/default-list-image.jpg']);

        Schema::table('movie_lists', function (Blueprint $table) {
            $table->string('poster_image')->default('/img/default-list-image.jpg')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movie_lists', function (Blueprint $table) {
            Schema::table('movie_lists', function (Blueprint $table) {
                $table->string('poster_image')->default(null)->change();
            });
        });
    }
};
