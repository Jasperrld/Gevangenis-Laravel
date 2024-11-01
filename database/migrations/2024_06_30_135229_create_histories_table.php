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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->string('pasfoto')->nullable();
            $table->string('name', 100);
            $table->string('arrestatiereden', 100);
            $table->integer('BSN_nummer');
            $table->string('adres', 100);
            $table->string('woonplaats', 100);
            $table->date('datumarrestatie');
            $table->json('zaak_id')->nullable();
            $table->unsignedBigInteger('cel_id')->nullable();
            $table->date('insluitingsdatum');
            $table->date('uitsluitingsdatum');
            $table->longText('maatschappelijke_aantekeningen');
            $table->integer('location_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
