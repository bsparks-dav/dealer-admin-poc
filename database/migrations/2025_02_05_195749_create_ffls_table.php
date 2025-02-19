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
        Schema::create('ffls', function (Blueprint $table) {
            $table->id();
            $table->string('license_no');
            $table->string('license_name');
            $table->string('license_type');
            $table->date('expire_date');
            $table->string('business_name');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('county');
            $table->string('bus_email')->nullable();
            $table->string('bus_phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('store_hours')->nullable();
            $table->text('directions')->nullable();
            $table->foreignId('dealer_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ffls');
    }
};
