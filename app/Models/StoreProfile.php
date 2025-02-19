<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreProfile extends Model
{
    /** @use HasFactory<\Database\Factories\StoreProfileFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_name',
        'slogan',
        'address1',
        'address2',
        'city',
        'state',
        'zip_code',
        'phone',
        'fax',
        'email',
        'website',
        'store_hours',
        'directions',
        'about',
        'dealer_id',
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
