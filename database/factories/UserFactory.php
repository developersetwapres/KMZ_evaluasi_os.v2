<?php

namespace Database\Factories;

use App\Models\MasterPegawai;
use App\Models\Outsourcing;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nip' => $this->faker->numerify('################'),
            'nip_sso' => $this->faker->numerify('#########'),
            'is_ldap' => 0,
            'email' => $this->faker->unique()->safeEmail(),

            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => 'evaluator',
            'remember_token' => Str::random(10),
            // 'two_factor_secret' => Str::random(10),
            // 'two_factor_recovery_codes' => Str::random(10),
            'two_factor_confirmed_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the model does not have two-factor authentication configured.
     */
    public function withoutTwoFactor(): static
    {
        return $this->state(fn(array $attributes) => [
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ]);
    }

    public function asOutsourcing()
    {
        return $this->afterCreating(function ($user) {
            $outsourcing = Outsourcing::factory()->create();
            $user->userable()->associate($outsourcing)->save();
        });
    }

    public function asPegawai()
    {
        return $this->afterCreating(function ($user) {
            $pegawai = MasterPegawai::factory()->create();
            $user->userable()->associate($pegawai)->save();
        });
    }
}
