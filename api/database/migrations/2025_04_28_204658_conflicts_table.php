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
        Schema::create('conflicts', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('conflict_id');
            $table->string('location');
            $table->string('side_a');
            $table->string('side_a_2nd');
            $table->string('side_b');
            $table->string('side_b_2nd');
            $table->integer('incompatibility');
            $table->string('territory_name');
            $table->integer('year');
            $table->integer('intensity_level');
            $table->integer('cumulative_intensity');
            $table->integer('type_of_conflict');
            $table->date('start_date');
            $table->date('start_date_2nd');
            $table->date('end_date');
            $table->integer('region');
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
