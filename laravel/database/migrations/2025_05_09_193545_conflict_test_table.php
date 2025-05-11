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
        Schema::create('conflict_test', function (Blueprint $table) {
            $table->id()->autoIncrement()->primary();
            $table->string('name')->nullable();
            $table->string('side_a_other_sides');
            $table->string('side_b_other_sides');
            $table->integer('start_date_accuracy');
            $table->date('start_date');
            $table->integer('end_date_accuracy');
            $table->date('end_date');
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
