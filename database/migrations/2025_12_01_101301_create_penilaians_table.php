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
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('kriteria_id')->constrained('kriterias')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('penugasan_id')->constrained('penugasan_penilais')->onDelete('cascade')->onUpdate('cascade');
            $table->smallInteger('nilai');

            $table->timestamps();

            $table->unique(['penugasan_id', 'kriteria_id'], 'uq_nilai');
            $table->index('kriteria_id', 'fk_nilai_kriteria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
