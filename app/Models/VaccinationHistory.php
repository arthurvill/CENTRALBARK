<?php

namespace App\Models;

use App\Traits\BelongsToPet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccinationHistory extends Model
{
    use HasFactory, 
    BelongsToPet;

    protected $fillable = [
        'pet_id',
        'vaccine',
        'vaccinated_at',    
    ];

}