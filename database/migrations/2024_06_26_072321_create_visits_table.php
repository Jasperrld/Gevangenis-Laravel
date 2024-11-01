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
        Schema::create('visits', function (Blueprint $table) {
            $table->unsignedBigInteger('visitor_id')->nullable();
            $table->unsignedBigInteger('prisoner_id')->nullable();
            $table->date('bezoekdatum');
            $table->time('tijd_in');
            $table->time('tijd_uit');
            $table->integer('location_id')->nullable();
            $table->id();
            $table->timestamps();


             // Define foreign key constraints
             $table->foreign('visitor_id')->references('id')->on('visitors')->onDelete('cascade');
             $table->foreign('prisoner_id')->references('id')->on('prisoners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
