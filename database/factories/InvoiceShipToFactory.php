<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Models\InvoiceShipTo;

class InvoiceShipToFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoiceShipTo::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'inv_ship_to_no' => fake()->word(),
            'inv_ship_to_name' => fake()->word(),
            'inv_ship_to_addr_1' => fake()->word(),
            'inv_ship_to_addr_2' => fake()->word(),
            'inv_ship_to_city' => fake()->word(),
            'inv_ship_to_st' => fake()->word(),
            'inv_ship_to_zipcd' => fake()->word(),
            'inv_ship_to_country' => fake()->word(),
            'ship_to_filler1' => fake()->word(),
            'ship_to_filler2' => fake()->word(),
            'inv_shipping_date' => fake()->date(),
            'inv_ship_via_code' => fake()->word(),
            'inv_ship_instruct1' => fake()->word(),
            'inv_ship_instruct2' => fake()->word(),
            'inv_ship_to_fr_fo_fg' => fake()->word(),
            'customer_id' => Customer::factory(),
        ];
    }
}
