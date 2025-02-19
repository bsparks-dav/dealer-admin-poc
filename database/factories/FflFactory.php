<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Dealer;
use App\Models\Ffl;

class FflFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ffl::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'license_no' => fake()->word(),
            'license_name' => fake()->word(),
            'license_type' => fake()->word(),
            'expire_date' => fake()->date(),
            'business_name' => fake()->word(),
            'address1' => fake()->streetAddress(),
            'address2' => fake()->secondaryAddress(),
            'city' => fake()->city(),
            'state' => fake()->word(),
            'zip_code' => fake()->word(),
            'county' => fake()->word(),
            'bus_email' => fake()->word(),
            'bus_phone' => fake()->word(),
            'fax' => fake()->word(),
            'email' => fake()->safeEmail(),
            'store_hours' => fake()->word(),
            'directions' => fake()->text(),
            'dealer_id' => Dealer::factory(),
        ];
    }
}
