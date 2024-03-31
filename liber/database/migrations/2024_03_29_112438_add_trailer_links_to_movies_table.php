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
        Schema::table('movies', function (Blueprint $table) {
            $table->string('trailer_link')->default('https://www.youtube.com');
            $table->string('background_image_link')->default(asset('img/image-not-found.png'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropColumn('trailer_link');
            $table->dropColumn('background_image_link');
        });
    }
};
