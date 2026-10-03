<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('room_amenities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_room');
            $table->unsignedBigInteger('id_facility');
            $table->string('status');
            $table->timestamps();

             $table->foreign('id_room')->references('id')->on('rooms')->onDelete('cascade');;
             $table->foreign('id_facility')->references('id')->on('facilities')->onDelete('cascade');;
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_amenities');
    }
};
