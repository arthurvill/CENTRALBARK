<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'date_time_start',
        'date_time_end',
        'day_type',
    ];

   
    // ============================== Relationship ==========================================

    public function service():BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function booking():HasOne
    {
        return $this->hasOne(Booking::class);
    }
}