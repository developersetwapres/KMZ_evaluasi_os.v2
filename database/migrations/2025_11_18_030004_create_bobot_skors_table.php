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
        Schema::create('bobot_skors', function (Blueprint $table) {
            $table->id();

            $table->foreignId('siklus_id')->constrained('sikluses')->cascadeOnDelete();
            $table->string('title');
            $table->decimal('bobot', 5, 2)->comment('Bobot penilai dalam persen');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bobot_skors');
    }
};
