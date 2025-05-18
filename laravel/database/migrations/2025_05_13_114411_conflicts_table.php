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
        Schema::create('conflicts', function (Blueprint $table): void {
            $table->id()->primary()->autoIncrement();
            $table->string('name');
            $table->string('link');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('casualties');
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
