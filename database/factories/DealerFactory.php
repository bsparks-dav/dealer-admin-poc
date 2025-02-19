<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Dealer;

class DealerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dealer::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'address1' => fake()->streetAddress(),
            'address2' => fake()->secondaryAddress(),
            'city' => fake()->city(),
            'state' => fake()->word(),
            'phone' => fake()->phoneNumber(),
            'zip_code' => fake()->word(),
            'discount' => fake()->word(),
            'terms' => fake()->text(),
            'ship_via' => fake()->word(),
            'ups_zone' => fake()->word(),
            'credit_limit' => fake()->word(),
            'credit_hold_flag' => fake()->word(),
            'ffl_id' => fake()->randomNumber(),
        ];
    }
}
