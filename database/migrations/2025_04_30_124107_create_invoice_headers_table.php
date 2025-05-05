<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoice_headers', function (Blueprint $table) {
            $table->id();
            $table->string('inv_no');
            $table->string('inv_order_no');
            $table->string('inv_customer_no');
            $table->date('inv_date');
            $table->date('inv_date_entered');
            $table->date('inv_order_date');
            $table->string('inv_type');
            $table->string('inv_apply_to_no');
            $table->string('inv_purchase_ord_no');
            $table->string('inv_no_alt');
            $table->string('inv_cust_bal_method');
            $table->string('inv_terms_code');
            $table->string('inv_frt_pay_code');
            $table->decimal('inv_discount_percent');
            $table->string('inv_job_no');
            $table->string('inv_mfg_location');
            $table->string('inv_profit_center');
            $table->string('inv_department');
            $table->string('inv_ar_reference');
            $table->decimal('inv_tot_sale_amt');
            $table->decimal('inv_tot_cost');
            $table->decimal('inv_tot_weight');
            $table->decimal('inv_misc_chg_amt');
            $table->string('inv_misc_chg_acct_no');
            $table->decimal('inv_frt_amt');
            $table->string('inv_frt_acct_no');
            $table->decimal('inv_comm_percent');
            $table->decimal('inv_comm_amount');
            $table->string('inv_comment1');
            $table->string('inv_comment2');
            $table->string('inv_comment3');
            $table->decimal('inv_payment_amt');
            $table->decimal('inv_payment_disc_amt');
            $table->string('inv_check_no');
            $table->date('inv_check_date');
            $table->string('inv_cash_acct_no');
            $table->date('inv_date_picked');
            $table->date('inv_date_billed');
            $table->string('inv_selection_code');
            $table->date('inv_posted_date');
            $table->string('inv_part_posted_flag');
            $table->string('inv_copy_to_bm_fg');
            $table->string('inv_edi_fg');
            $table->string('inv_edi_po_no_cont');
            $table->string('inv_edi_exp_flg');
            $table->string('inv_closed_fg');
            $table->decimal('inv_acc_misc_chg_amt');
            $table->decimal('inv_acc_frt_amt');
            $table->decimal('inv_acc_tot_sale_amt');
            $table->string('inv_store_no');
            $table->string('inv_rma_status');
            $table->string('inv_phatm_inv_flag');
            $table->string('inv_dept_no');
            $table->string('inv_bol_no');
            $table->string('inv_bol_printed');
            $table->string('inv_ref_doc_no');
            $table->string('inv_payment_tp');
            $table->date('inv_full_pay_date');
            $table->string('inv_po_req_gen_flg');
            $table->foreignId('customer_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_headers');
    }
};
