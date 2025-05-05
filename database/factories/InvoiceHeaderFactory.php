<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Models\InvoiceHeader;

class InvoiceHeaderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoiceHeader::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'inv_no' => fake()->word(),
            'inv_order_no' => fake()->word(),
            'inv_customer_no' => fake()->word(),
            'inv_date' => fake()->date(),
            'inv_date_entered' => fake()->date(),
            'inv_order_date' => fake()->date(),
            'inv_type' => fake()->word(),
            'inv_apply_to_no' => fake()->word(),
            'inv_purchase_ord_no' => fake()->word(),
            'inv_no_alt' => fake()->word(),
            'inv_cust_bal_method' => fake()->word(),
            'inv_terms_code' => fake()->word(),
            'inv_frt_pay_code' => fake()->word(),
            'inv_discount_percent' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_job_no' => fake()->word(),
            'inv_mfg_location' => fake()->word(),
            'inv_profit_center' => fake()->word(),
            'inv_department' => fake()->word(),
            'inv_ar_reference' => fake()->word(),
            'inv_tot_sale_amt' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_tot_cost' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_tot_weight' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_misc_chg_amt' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_misc_chg_acct_no' => fake()->word(),
            'inv_frt_amt' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_frt_acct_no' => fake()->word(),
            'inv_comm_percent' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_comm_amount' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_comment1' => fake()->word(),
            'inv_comment2' => fake()->word(),
            'inv_comment3' => fake()->word(),
            'inv_payment_amt' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_payment_disc_amt' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_check_no' => fake()->word(),
            'inv_check_date' => fake()->date(),
            'inv_cash_acct_no' => fake()->word(),
            'inv_date_picked' => fake()->date(),
            'inv_date_billed' => fake()->date(),
            'inv_selection_code' => fake()->word(),
            'inv_posted_date' => fake()->date(),
            'inv_part_posted_flag' => fake()->word(),
            'inv_copy_to_bm_fg' => fake()->word(),
            'inv_edi_fg' => fake()->word(),
            'inv_edi_po_no_cont' => fake()->word(),
            'inv_edi_exp_flg' => fake()->word(),
            'inv_closed_fg' => fake()->word(),
            'inv_acc_misc_chg_amt' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_acc_frt_amt' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_acc_tot_sale_amt' => fake()->randomFloat(0, 0, 9999999999.),
            'inv_store_no' => fake()->word(),
            'inv_rma_status' => fake()->word(),
            'inv_phatm_inv_flag' => fake()->word(),
            'inv_dept_no' => fake()->word(),
            'inv_bol_no' => fake()->word(),
            'inv_bol_printed' => fake()->word(),
            'inv_ref_doc_no' => fake()->word(),
            'inv_payment_tp' => fake()->word(),
            'inv_full_pay_date' => fake()->date(),
            'inv_po_req_gen_flg' => fake()->word(),
            'customer_id' => Customer::factory(),
        ];
    }
}
