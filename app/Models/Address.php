<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    public function dealer(): BelongsTo
    {
        return $this->belongsTo(Dealer::class);
    }
}
