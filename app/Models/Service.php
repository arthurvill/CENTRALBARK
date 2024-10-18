<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['service_category_id', 'name', 'description', 'fee'];

    // ==============================Relationship==================================================

    public function service_category():BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function schedules():HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}