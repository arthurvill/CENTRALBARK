<?php 

namespace App\Traits;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToBooking {

    /**
     * the model belongs to Booking
     *
     * @return BelongsTo
     */
    public function booking():BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}