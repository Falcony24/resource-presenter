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
        if(Schema::hasTable('commodities_prices')) return;
        Schema::create('commodities_prices', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('commodity');
            $table->date('date');
            $table->float('value');
            $table->unsignedBigInteger('unit');
//            $table->timestamps();

            $table->foreign('unit')->references('id')->on('commodities_prices_units')->onDelete('cascade');

            $table->foreign('commodity')->references('id')->on('commodities_types')->onDelete('cascade');
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
