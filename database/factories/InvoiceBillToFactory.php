<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Models\InvoiceBillTo;

class InvoiceBillToFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoiceBillTo::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'inv_bill_to_no' => fake()->word(),
            'inv_bill_to_name' => fake()->word(),
            'inv_bill_to_addr_1' => fake()->word(),
            'inv_bill_to_addr_2' => fake()->word(),
            'inv_bill_to_city' => fake()->word(),
            'inv_bill_to_st' => fake()->word(),
            'inv_bill_to_zipcd' => fake()->word(),
            'inv_bill_to_country' => fake()->word(),
            'bill_to_filler1' => fake()->word(),
            'bill_to_filler2' => fake()->word(),
            'inv_bill_to_fr_fo_fg' => fake()->word(),
            'customer_id' => Customer::factory(),
        ];
    }
}
