<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Models\Dealer;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

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
            'dealer_id' => Dealer::factory(),
        ];
    }
}
