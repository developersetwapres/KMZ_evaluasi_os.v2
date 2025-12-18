<?php

namespace Database\Seeders;

use App\Models\Aspek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AspekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'title' => 'Aspek teknis dan kualitas kerja',
                'bobot_skor_id' => 1,
                'deskripsi' => 'Penilaian terhadap kemampuan teknis dan profesional dalam menjalankan tugas.',
            ],
            [
                'title' => 'Aspek Perilaku',
                'bobot_skor_id' => 2,
                'deskripsi' => 'Penilaian terhadap sikap, disiplin, dan perilaku kerja sehari-hari.',
            ],
        ];

        foreach ($datas as $key => $value) {
            Aspek::create($value);
        }
    }
}
