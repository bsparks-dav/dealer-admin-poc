<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $guarded = [];

    public function dealer(): BelongsTo
    {
        return $this->belongsTo(Dealer::class);
    }

}
