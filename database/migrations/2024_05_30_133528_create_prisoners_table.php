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
        Schema::create('prisoners', function (Blueprint $table) {
            $table->id();
            $table->string('pasfoto')->nullable();
            $table->string(column: 'name', length: 100);
            $table->string(column: 'arrestatiereden', length: 100);
            $table->integer(column: 'BSN_nummer');
            $table->string(column: 'adres', length: 100);
            $table->string(column: 'woonplaats', length: 100);
            $table->date(column: 'datumarrestatie');
            $table->unsignedBigInteger(column: 'zaak_id')->nullable();
            $table->unsignedBigInteger(column: 'cel_id')->nullable();
            $table->date(column: 'insluitingsdatum');
            $table->date(column: 'uitsluitingsdatum');
            $table->longText(column: 'maatschappelijke_aantekeningen');
            $table->integer(column: 'location_id')->nullable();
            $table->string('verslag_pdf_path')->nullable();
            $table->timestamps();

            // $table->foreign('zaak_id')->references('id')->on('prison_cases')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        // Schema::table('prisoners', function (Blueprint $table) {
        //     $table->dropForeign(['zaak_id']);
        // });

        Schema::dropIfExists('prisoners');
    }
};
