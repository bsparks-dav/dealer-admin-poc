<?php

namespace Database\Factories;

use App\Models\StoreProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<StoreProfile>
 */
class StoreProfileFactory extends Factory
{
   protected $model = StoreProfile::class;

    public function definition(): array
    {
        return [
            'store_name' => fake()->name(),
            'slogan' => fake()->words(),
            'address1' => fake()->streetAddress(),
            'address2' => fake()->streetAddress(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'zip_code' => fake()->postcode(),
            'phone' => fake()->phoneNumber(),
            'fax' => fake()->phoneNumber(),
            'email' => fake()->safeEmail(),
            'website' => fake()->url(),
            'store_hours' => fake()->word(),
            'directions' => fake()->text(),
            'about' => fake()->words(),
            //'dealer_id' => null,
        ];
    }
}
