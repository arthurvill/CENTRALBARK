<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Pet extends Model implements HasMedia
{
    use HasFactory, 
    InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'customer_id',
        'name',
        'sex',
        'birth_date',
        'breed',
        'color',
        'weight'

    ];

    // ==============================Relationship==================================================
    
    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function customer():BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function bookings():HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function vaccination_histories():HasMany
    {
        return $this->hasMany(VaccinationHistory::class);
    }

    // ============================== Accessor & Mutator ==========================================

    public function getAvatarProfileAttribute()
    {
        return optional($this->getFirstMedia('avatar_image'))->getUrl('avatar');
    }

    // ========================== Custom Methods ======================================================

    //media convertion
    public function registerMediaCollections(): void
    {
        $this
        ->addMediaConversion('avatar')
        ->width(450)
        ->keepOriginalImageFormat()
        ->nonQueued();
    }
}