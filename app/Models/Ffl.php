<?php

namespace App\Models;

use App\Enums\LicenseType;
use App\Enums\USState;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ffl extends Model
{
    use HasFactory;


    protected $fillable = [
        'license_no',
        'license_name',
        'license_type',
        'expire_date',
        'business_name',
        'address1',
        'address2',
        'city',
        'state',
        'zip_code',
        'county',
        'bus_email',
        'bus_phone',
        'fax',
        'email',
        'store_hours',
        'directions',
        'dealer_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'expire_date' => 'date',
        'dealer_id' => 'integer',
        'license_type' => LicenseType::class,
        'state' => USState::class,
    ];

    public function dealer(): BelongsTo
    {
        return $this->belongsTo(Dealer::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope('dealer', function (Builder $query) {
            if (auth()->hasUser()) {
                $query->where('dealer_id', auth()->user()->id);
            }
        });
    }
}
