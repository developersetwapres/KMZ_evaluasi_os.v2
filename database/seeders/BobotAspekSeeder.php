<?php

namespace Database\Seeders;

use App\Models\BobotAspek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BobotAspekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'siklus_id' => 1,
                'aspek_penilaian_id' => 1,
                'bobot' => 60.00,
            ],
            [
                'siklus_id' => 1,
                'aspek_penilaian_id' => 2,
                'bobot' => 40.00,
            ],
        ];

        foreach ($data as $key => $value) {
            BobotAspek::create($value);
        }
    }
}
