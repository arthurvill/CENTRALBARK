<?php 

namespace App\Traits;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToPet {

    /**
     * the model belongs to Pet
     *
     * @return BelongsTo
     */
    public function pet():BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }
}