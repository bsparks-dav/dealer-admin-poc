<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable implements FilamentUser, HasAvatar, HasTenants
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return asset('images/b-biggums.jpg') ?? null;
        // return null;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // $users = DB::connection('sqlsrv')->select('SELECT TOP 10 company_name FROM Davidsons.dbo.SOT_Dealers');
        // return $this->is_admin == 1;
        // dd($this->hasVerifiedEmail());
        // dd($users);
        // return str_ends_with($this->email, '@davidsonsinc.com');
        return true;
    }

    public function dealers(): BelongsToMany
    {
        return $this->belongsToMany(Dealer::class);
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->dealers->contains($tenant);
    }

    public function getTenants(Panel $panel): array|Collection
    {
        return $this->dealers;
    }
}
