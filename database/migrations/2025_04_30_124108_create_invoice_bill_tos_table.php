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
        Schema::create('invoice_bill_tos', function (Blueprint $table) {
            $table->id();
            $table->string('inv_bill_to_no');
            $table->string('inv_bill_to_name');
            $table->string('inv_bill_to_addr_1');
            $table->string('inv_bill_to_addr_2');
            $table->string('inv_bill_to_city');
            $table->string('inv_bill_to_st');
            $table->string('inv_bill_to_zipcd');
            $table->string('inv_bill_to_country');
            $table->string('bill_to_filler1');
            $table->string('bill_to_filler2');
            $table->string('inv_bill_to_fr_fo_fg');
            $table->foreignId('customer_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_bill_tos');
    }
};
