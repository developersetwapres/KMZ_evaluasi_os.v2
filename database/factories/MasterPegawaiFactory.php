<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MasterPegawai>
 */
class MasterPegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'nip' => User::factory(),
            'nip' => $this->faker->unique()->numerify('##########'),
            'name' => $this->faker->name(),
            'kode_instansi' => $this->faker->numerify('###'),
            'kode_unit' => $this->faker->numerify('###'),
            'kode_deputi' => $this->faker->numerify('###'),
            'kode_biro' => $this->faker->numerify('###'),
            'kode_bagian' => $this->faker->numerify('###'),
            'kode_subbagian' => $this->faker->numerify('###'),
            'jabatan' => $this->faker->jobTitle(),
        ];
    }
}
