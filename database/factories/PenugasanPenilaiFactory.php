<?php

namespace Database\Factories;

use App\Models\Outsourcing;
use App\Models\Siklus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\penugasan_penilai>
 */
class PenugasanPenilaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'siklus_id' => Siklus::query()->inRandomOrder()->value('id'),
            'uuid' => $this->faker->uuid(),
            'outsourcing_id' => Outsourcing::query()->inRandomOrder()->value('id'),
            'penilai_id' => User::query()->inRandomOrder()->value('id'), // boleh null jika mau

            'tipe_penilai' => $this->faker->randomElement([
                'atasan',
                'penerima_layanan',
                'teman',
            ]),

            'bobot_penilai' => $this->faker->randomFloat(2, 0, 100),

            'status' => $this->faker->randomElement([
                'pending',
                'aktif',
                'nonaktif',
            ]),

            'catatan' => $this->faker->optional()->sentence(),
        ];
    }
}
