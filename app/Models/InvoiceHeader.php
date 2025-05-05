<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceHeader extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inv_no',
        'inv_order_no',
        'inv_customer_no',
        'inv_date',
        'inv_date_entered',
        'inv_order_date',
        'inv_type',
        'inv_apply_to_no',
        'inv_purchase_ord_no',
        'inv_no_alt',
        'inv_cust_bal_method',
        'inv_terms_code',
        'inv_frt_pay_code',
        'inv_discount_percent',
        'inv_job_no',
        'inv_mfg_location',
        'inv_profit_center',
        'inv_department',
        'inv_ar_reference',
        'inv_tot_sale_amt',
        'inv_tot_cost',
        'inv_tot_weight',
        'inv_misc_chg_amt',
        'inv_misc_chg_acct_no',
        'inv_frt_amt',
        'inv_frt_acct_no',
        'inv_comm_percent',
        'inv_comm_amount',
        'inv_comment1',
        'inv_comment2',
        'inv_comment3',
        'inv_payment_amt',
        'inv_payment_disc_amt',
        'inv_check_no',
        'inv_check_date',
        'inv_cash_acct_no',
        'inv_date_picked',
        'inv_date_billed',
        'inv_selection_code',
        'inv_posted_date',
        'inv_part_posted_flag',
        'inv_copy_to_bm_fg',
        'inv_edi_fg',
        'inv_edi_po_no_cont',
        'inv_edi_exp_flg',
        'inv_closed_fg',
        'inv_acc_misc_chg_amt',
        'inv_acc_frt_amt',
        'inv_acc_tot_sale_amt',
        'inv_store_no',
        'inv_rma_status',
        'inv_phatm_inv_flag',
        'inv_dept_no',
        'inv_bol_no',
        'inv_bol_printed',
        'inv_ref_doc_no',
        'inv_payment_tp',
        'inv_full_pay_date',
        'inv_po_req_gen_flg',
        'customer_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'inv_date' => 'date',
        'inv_date_entered' => 'date',
        'inv_order_date' => 'date',
        'inv_discount_percent' => 'decimal',
        'inv_tot_sale_amt' => 'decimal',
        'inv_tot_cost' => 'decimal',
        'inv_tot_weight' => 'decimal',
        'inv_misc_chg_amt' => 'decimal',
        'inv_frt_amt' => 'decimal',
        'inv_comm_percent' => 'decimal',
        'inv_comm_amount' => 'decimal',
        'inv_payment_amt' => 'decimal',
        'inv_payment_disc_amt' => 'decimal',
        'inv_check_date' => 'date',
        'inv_date_picked' => 'date',
        'inv_date_billed' => 'date',
        'inv_posted_date' => 'date',
        'inv_acc_misc_chg_amt' => 'decimal',
        'inv_acc_frt_amt' => 'decimal',
        'inv_acc_tot_sale_amt' => 'decimal',
        'inv_full_pay_date' => 'date',
        'customer_id' => 'integer',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
