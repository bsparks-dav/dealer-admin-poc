<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Models\InvoiceSalesPerson;

class InvoiceSalesPersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoiceSalesPerson::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'inv_salesman_no1' => fake()->word(),
            'inv_salesman_pct_co1' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_salesman_com_am1' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_salesman_no2' => fake()->word(),
            'inv_salesman_pct_co2' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_salesman_com_am2' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_salesman_no3' => fake()->word(),
            'inv_salesman_pct_co3' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_salesman_com_am3' => fake()->randomFloat(0, 0, 9999999999.),
            'customer_id' => Customer::factory(),
        ];
    }
}
