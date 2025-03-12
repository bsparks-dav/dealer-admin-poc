<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Licensing extends Model
{
    public function dealer(): BelongsTo
    {
        return $this->belongsTo(Dealer::class);
    }

    public static function getManufacturerRecalls(): array
    {
        return [
            [
                'name' => 'Barnes 45 Colt Product Recall Notice',
                'link' => '/media/customer_documents/mfgrecall/Barnes.pdf',
            ],
            [
                'name' => 'Beretta Neo Pistols Safety Recall',
                'link' => '/media/customer_documents/mfgrecall/beretta_neos.pdf',
            ],
            // Add more recalls as needed
        ];
    }

}
