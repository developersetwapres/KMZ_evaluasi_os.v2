<?php

namespace Database\Seeders;

use App\Models\Siklus;
use Illuminate\Database\Seeder;

class SiklusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'Semester II tahun 2025',
                'tanggal_mulai' => '2025-12-29',
                'tanggal_selesai' => '2026-01-10',
                'is_active' => 1,
            ]
        ];

        foreach ($data as $key => $value) {
            Siklus::create($value);
        }
    }
}
