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
                'title' => 'Aspek Perilaku',
                'bobot' => 0.4,
                'deskripsi' => 'Penilaian terhadap sikap, disiplin, dan perilaku kerja sehari-hari.',
            ],
            [
                'title' => 'Aspek teknis dan kualitas kerja',
                'bobot' => 0.6,
                'deskripsi' => 'Penilaian terhadap kemampuan teknis dan profesional dalam menjalankan tugas.',
            ],

        ];

        foreach ($datas as $key => $value) {
            Aspek::create([
                'title' => $value['title'],
                'bobot' => $value['bobot'],
                'deskripsi' => $value['deskripsi'],
            ]);
        }
    }
}
