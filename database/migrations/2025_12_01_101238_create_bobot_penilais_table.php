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
        // Schema::create('bobot_penilais', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('siklus_id')
        //         ->constrained('sikluses')
        //         ->cascadeOnDelete();

        //     $table->foreignId('penugasan_penilai_id')
        //         ->constrained('penugasan_penilais')
        //         ->cascadeOnDelete();

        //     $table->decimal('bobot', 5, 2)
        //         ->comment('Bobot penilai dalam persen');

        //     $table->timestamps();

        //     $table->unique(['siklus_id', 'penugasan_penilai_id'], 'uniq_bobot_penilai');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bobot_penilais');
    }
};
