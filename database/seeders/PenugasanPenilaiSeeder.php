<?php

namespace Database\Seeders;

use App\Models\Outsourcing;
use App\Models\PenugasanPenilai;
use App\Models\Siklus;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenugasanPenilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siklus = Siklus::first();

        $users = User::pluck('id')->all();

        foreach (Outsourcing::all() as $outsourcing) {
            foreach (['atasan', 'penerima_layanan', 'teman'] as $tipe) {
                PenugasanPenilai::updateOrCreate(
                    [
                        'siklus_id'       => $siklus->id,
                        'outsourcing_id' => $outsourcing->id,
                        'tipe_penilai'   => $tipe,
                    ],
                    [
                        'penilai_id'   => collect($users)->random(),
                        'bobot_penilai' => rand(10, 40),
                        'status'       => 'aktif',
                        'catatan'      => null,
                    ]
                );
            }
        }
    }
}
