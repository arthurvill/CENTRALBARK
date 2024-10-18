<?php 

namespace App\Traits;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyPet {

    /**
     * the model has many pets
     *
     * @return HasMany
     */
    public function pets():HasMany
    {
        return $this->hasMany(Pet::class);
    }
}