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
        Schema::create('prison_cases', function (Blueprint $table) {
            $table->id();
            $table->longText('zaakreden');
            $table->integer('location_id')->nullable();
            $table->string('verslag_pdf_path')->nullable(); // New column for PDF file path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prison_cases');
    }
};
