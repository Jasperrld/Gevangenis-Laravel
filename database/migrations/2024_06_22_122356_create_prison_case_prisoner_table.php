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
        Schema::create('prison_case_prisoner', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prison_case_id');
            $table->unsignedBigInteger('prisoner_id');
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('prison_case_id')->references('id')->on('prison_cases')->onDelete('cascade');
            $table->foreign('prisoner_id')->references('id')->on('prisoners')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prison_case_prisoner');
    }
};
