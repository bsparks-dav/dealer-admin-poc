<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceSalesPerson extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inv_salesman_no1',
        'inv_salesman_pct_co1',
        'inv_salesman_com_am1',
        'inv_salesman_no2',
        'inv_salesman_pct_co2',
        'inv_salesman_com_am2',
        'inv_salesman_no3',
        'inv_salesman_pct_co3',
        'inv_salesman_com_am3',
        'customer_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'inv_salesman_pct_co1' => 'decimal',
        'inv_salesman_com_am1' => 'decimal',
        'inv_salesman_pct_co2' => 'decimal',
        'inv_salesman_com_am2' => 'decimal',
        'inv_salesman_pct_co3' => 'decimal',
        'inv_salesman_com_am3' => 'decimal',
        'customer_id' => 'integer',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
