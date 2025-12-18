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
        // Schema::create('bobot_aspeks', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('siklus_id')
        //         ->constrained('sikluses')
        //         ->cascadeOnDelete();

        //     $table->foreignId('aspek_id')
        //         ->constrained('aspeks')
        //         ->cascadeOnDelete();

        //     $table->decimal('bobot', 5, 2)
        //         ->comment('Bobot aspek dalam persen');

        //     $table->timestamps();

        //     $table->unique(['siklus_id', 'aspek_id'], 'uniq_bobot_aspek');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bobot_aspeks');
    }
};
