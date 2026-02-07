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
        Schema::create('rekap_penilaians', function (Blueprint $table) {
            $table->id();

            $table->foreignId('siklus_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('outsourcings_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('skor_perilaku', 6, 2)->nullable();
            $table->decimal('skor_teknis', 6, 2)->nullable();
            $table->decimal('skor_akhir', 6, 2)->nullable();
            $table->string('label', 50)->nullable();
            $table->json('rincian_penilai')->nullable();

            $table->timestamps();

            $table->unique(['siklus_id', 'outsourcings_id'], 'uq_rekap');
            $table->index('outsourcings_id', 'fk_rekap_outsourcings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_penilaians');
    }
};
