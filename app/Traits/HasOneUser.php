<?php 

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasOneUser {

    /**
     * the model has one user
     *
     * @return HasOne
     */
    public function user():HasOne
    {
        return $this->hasOne(User::class);
    }
}