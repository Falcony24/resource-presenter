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
        if(Schema::hasTable('conflicts')) return;
        Schema::create('conflicts', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string ('conflict_id');
            $table->string('location');
            $table->text('side_a');
            $table->text('side_a_2nd')->nullable();
            $table->text('side_b');
            $table->text('side_b_2nd')->nullable();
            $table->integer('incompatibility');
            $table->string('territory_name');
            $table->integer('year');
            $table->integer('intensity_level');
            $table->integer('cumulative_intensity');
            $table->integer('type_of_conflict');
            $table->date('start_date');
            $table->date('start_date_2nd')->nullable();
            $table->date('end_date')->nullable();
            $table->string('region');
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
