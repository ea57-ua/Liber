<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $genres = array(
            array('name' => 'Action'),
            array('name' => 'Adventure'),
            array('name' => 'Animation'),
            array('name' => 'Biography'),
            array('name' => 'Comedy'),
            array('name' => 'Crime'),
            array('name' => 'Documentary'),
            array('name' => 'Drama'),
            array('name' => 'Family'),
            array('name' => 'Fantasy'),
            array('name' => 'Film-Noir'),
            array('name' => 'History'),
            array('name' => 'Horror'),
            array('name' => 'Music'),
            array('name' => 'Musical'),
            array('name' => 'Mystery'),
            array('name' => 'Romance'),
            array('name' => 'Sci-Fi'),
            array('name' => 'Sport'),
            array('name' => 'Thriller'),
            array('name' => 'War'),
            array('name' => 'Western')
        );

        DB::table('genres')->insert($genres);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genres');
    }
};
