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
        Schema::create('streaming_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $streamingServices = array(
            array('name' => 'Netflix'),
            array('name' => 'Amazon Prime Video'),
            array('name' => 'Disney+'),
            array('name' => 'HBO Max'),
            array('name' => 'Hulu'),
            array('name' => 'Apple TV+'),
            array('name' => 'Peacock'),
            array('name' => 'Paramount+')
        );

        DB::table('streaming_services')->insert($streamingServices);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('streaming_services');
    }
};
