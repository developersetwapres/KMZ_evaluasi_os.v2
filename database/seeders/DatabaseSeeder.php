<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\Siklus;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jabatan::factory(50)->create();

        $this->call([
            AspekSeeder::class,
            KriteriaSeeder::class,
            JabatanSeeder::class,
            IndikatorSeeder::class,
            PenugasanPenilaiSeeder::class,
        ]);

        // MasterPegawai::factory(50)->create();
        // Outsourcing::factory(50)->create();

        User::factory(30)->asOutsourcing()->create();
        User::factory(30)->asPegawai()->create();

        Siklus::factory(5)->create();
        // PenugasanPenilai::factory(100)->create();
    }
}
