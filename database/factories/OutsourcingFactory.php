<?php

namespace Database\Factories;

use App\Models\Jabatan;
use App\Models\Outsourcing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\outsourcing>
 */
class OutsourcingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'image' => $this->faker->imageUrl(200, 200, 'people'),
            'jabatan_id' => $this->faker->numberBetween(1, 15),
            // 'nrp_os' => User::factory(),
            'nrp_os' => $this->faker->unique()->numerify('##########'),
            'kode_biro' => $this->faker->numerify('##'),
            'status' => $this->faker->randomElement(['aktif', 'nonaktif']),
        ];
    }
}
