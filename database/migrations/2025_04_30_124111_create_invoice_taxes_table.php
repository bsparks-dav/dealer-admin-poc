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
        Schema::create('invoice_taxes', function (Blueprint $table) {
            $table->id();
            $table->string('inv_tax_code_1');
            $table->string('inv_tax_code_2');
            $table->string('inv_tax_code_3');
            $table->string('inv_tax_percent_1');
            $table->string('inv_tax_percent_2');
            $table->string('inv_tax_percent_3');
            $table->decimal('inv_sales_tax_amt_1');
            $table->decimal('inv_sales_tax_amt_2');
            $table->decimal('inv_sales_tax_amt_3');
            $table->decimal('inv_tot_tax_amt');
            $table->decimal('inv_acc_tot_tax_amt');
            $table->decimal('inv_acc_sale_tax_amt');
            $table->foreignId('customer_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_taxes');
    }
};
