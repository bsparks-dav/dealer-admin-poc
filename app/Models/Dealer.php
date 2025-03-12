<?php

namespace App\Models;

use App\Enums\LicenseType;
use App\Enums\USState;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasCurrentTenantLabel;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Storage;

class Dealer extends Model implements HasAvatar, HasName, HasCurrentTenantLabel
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
        'discount',
        'terms',
        'ship_via',
        'ups_zone',
        'credit_limit',
        'credit_hold_flag',
        'ffl_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ffl_id' => 'integer',
        'state' => USState::class,
    ];


    public function getFilamentAvatarUrl(): ?string
    {
        return null;
    }

    public function ffl(): HasOne
    {
        return $this->hasOne(Ffl::class);
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

    public function getCurrentTenantLabel(): string
    {
        return 'Dealer ';
    }

    public function getFilamentName(): string
    {
        return $this->name;
    }

}
