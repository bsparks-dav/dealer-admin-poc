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
        Schema::create('dealers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('phone');
            $table->string('zip_code');
            $table->string('discount');
            $table->text('terms')->nullable();
            $table->string('ship_via')->nullable();
            $table->string('ups_zone')->nullable();
            $table->string('credit_limit')->nullable();
            $table->string('credit_hold_flag')->nullable();
            $table->unsignedInteger('ffl_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dealers');
    }
};
