<?php

namespace App\Models;

use App\Traits\BelongsToBooking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory, 
    BelongsToBooking;

    protected $fillable = [
        'booking_id',
        'drug',
        'description',
        'preparation',
        'qty',
        'direction',
    ];
}