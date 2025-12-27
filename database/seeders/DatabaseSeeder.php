<?php

namespace Database\Seeders;

use App\Models\Siklus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SiklusSeeder::class,
            UnitSeeder::class,
            BiroSeeder::class,
            JabatanSeeder::class,
            BobotSkorSeeder::class,
            AspekSeeder::class,
            KriteriaSeeder::class,
            IndikatorSeeder::class,
            MasterPegawaiSeeder::class,
            OutsourcingSeeder::class,
            UserSeeder::class,
        ]);

        // User::factory(30)->asOutsourcing()->create();
        // User::factory(30)->asPegawai()->create();

        // PenugasanPenilai::factory(100)->create();
    }
}
