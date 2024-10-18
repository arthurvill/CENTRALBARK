<?php

namespace App\Models;

use App\Traits\HasOneUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory, 
    HasOneUser;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'sex',
    ];

      // ==============================Relationship==================================================
  
      // ============================== Accessor & Mutator ==========================================
  
      public function getFullNameAttribute()
      {
          return $this->first_name . ' ' . $this->last_name;
      }
    
}