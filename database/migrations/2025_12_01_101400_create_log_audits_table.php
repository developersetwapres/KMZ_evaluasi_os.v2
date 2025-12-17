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
        Schema::create('log_audits', function (Blueprint $table) {
            $table->id();

            $table->foreignId('master_pegawai_id')->nullable()->constrained()->nullOnDelete()->onUpdate('cascade');
            $table->string('aksi', 100);
            $table->string('tabel', 100)->nullable();
            $table->unsignedBigInteger('target_id')->nullable();
            $table->json('data')->nullable();

            $table->timestamps();

            $table->index('master_pegawai_id', 'fk_log_pengguna');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_audits');
    }
};
