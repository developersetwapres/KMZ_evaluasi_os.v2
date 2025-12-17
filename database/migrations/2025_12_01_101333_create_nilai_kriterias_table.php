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
        // Schema::create('nilai_kriterias', function (Blueprint $table) {
        // $table->id();
        // $table->uuid('uuid')->unique();

        // $table->foreignId('penilaian_id')->constrained('penilaians')->onDelete('cascade')->onUpdate('cascade');
        // $table->foreignId('kriteria_id')->constrained('kriterias')->onDelete('restrict')->onUpdate('cascade');
        // $table->smallInteger('nilai');

        // $table->timestamps();

        // $table->unique(['penilaian_id', 'kriteria_id'], 'uq_nilai');
        // $table->index('kriteria_id', 'fk_nilai_kriteria');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('nilai_kriterias');
    }
};
