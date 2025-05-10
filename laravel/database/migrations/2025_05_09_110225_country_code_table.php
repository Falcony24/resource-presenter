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
        Schema::create('country_code', static function (Blueprint $table) {
            $table->id()->autoIncrement()->primary();
            $table->string('iso_name');
            $table->string('official_state_name');
            $table->string('other_names');
            $table->string('wiki_link');
            $table->string('iso_a-2_code');
            $table->string('iso_a-3_code');
            $table->string('iso_num_code');
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
