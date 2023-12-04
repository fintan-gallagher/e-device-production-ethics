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
        Schema::create('artist_record', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artist_id');
            $table->unsignedBigInteger('record_id');

            $table->foreign('artist_id')->references('id')->on('artists')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('record_id')->references('id')->on('records')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_record');
    }
};
