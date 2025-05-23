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
        if(Schema::hasTable('commodities_prices_units')) return;
        Schema::create('commodities_prices_units', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('symbol');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
