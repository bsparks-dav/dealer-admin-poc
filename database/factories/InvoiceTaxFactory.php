<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Models\InvoiceTax;

class InvoiceTaxFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoiceTax::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'inv_tax_code_1' => fake()->word(),
            'inv_tax_code_2' => fake()->word(),
            'inv_tax_code_3' => fake()->word(),
            'inv_tax_percent_1' => fake()->word(),
            'inv_tax_percent_2' => fake()->word(),
            'inv_tax_percent_3' => fake()->word(),
            'inv_sales_tax_amt_1' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_sales_tax_amt_2' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_sales_tax_amt_3' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_tot_tax_amt' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_acc_tot_tax_amt' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_acc_sale_tax_amt' => fake()->randomFloat(0, 0, 9999999999.),
            'customer_id' => Customer::factory(),
        ];
    }
}
