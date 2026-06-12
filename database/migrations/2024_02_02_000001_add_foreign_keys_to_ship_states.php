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
        Schema::table('ship_states', function (Blueprint $table) {
            $table->foreign('district_id')->references('id')->on('ship_districts')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('ship_cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ship_states', function (Blueprint $table) {
            $table->dropForeign(['district_id']);
            $table->dropForeign(['city_id']);
        });
    }
};
