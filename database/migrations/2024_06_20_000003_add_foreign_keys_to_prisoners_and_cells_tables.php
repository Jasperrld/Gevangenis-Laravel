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
        Schema::table('cells', function (Blueprint $table) {
            $table->foreign('prisoner_id')->references('id')->on('prisoners')->onDelete('set null');
        });

        Schema::table('prisoners', function (Blueprint $table) {
            $table->foreign('cel_id')->references('id')->on('cells')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cells', function (Blueprint $table) {
            $table->dropForeign(['prisoner_id']);
        });

        Schema::table('prisoners', function (Blueprint $table) {
            $table->dropForeign(['cel_id']);
        });
    }
};
