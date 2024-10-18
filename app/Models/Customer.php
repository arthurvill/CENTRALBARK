<?php

namespace App\Models;

use App\Traits\HasManyPet;
use App\Traits\HasOneUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, 
    HasOneUser, 
    HasManyPet;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'sex',
        'birth_date',
        'address',
        'contact',
    ];

      // ==============================Relationship==================================================

      // ============================== Accessor & Mutator ==========================================
  
      public function getFullNameAttribute()
      {
          return $this->first_name . ' ' . $this->last_name;
      }
}