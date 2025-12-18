<?php

namespace Database\Seeders;

use App\Models\BobotSkor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BobotSkorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'siklus_id'  => 1,
                'title' => 'Aspek teknis dan kualitas kerja',
                'bobot' => 60.00,
            ],
            [
                'siklus_id'  => 1,
                'title' => 'Aspek Perilaku',
                'bobot' => 60.00,
            ],
            [
                'siklus_id'  => 1,
                'title' => 'Tipe penilai Atasan',
                'bobot' => 50.00,
            ],
            [
                'siklus_id'  => 1,
                'title' => 'Tipe penilai Penerima Layanan',
                'bobot' => 30.00,
            ],
            [
                'siklus_id'  => 1,
                'title' => 'Tipe penilai Teman',
                'bobot' => 20.00,
            ]
        ];

        foreach ($data as $key => $value) {
            BobotSkor::create($value);
        }
    }
}
