<?php

namespace App\Models;

use App\Enums\USState;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address1',
        'address2',
        'city',
        'state',
        'phone',
        'zip_code',
        'dealer_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'dealer_id' => 'integer',
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
