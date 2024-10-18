<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model implements HasMedia
{
    use HasFactory, 
    InteractsWithMedia;

    public const PENDING = 0;
    public const APPROVED = 1;
    public const CANCELED = 2;

    protected $fillable = [
        'pet_id',
        'schedule_id',
        'payment_method_id',
        'reference_no',
        'note',
        'status',
        'remark',
        'is_online'
    ];  

    // ============================== Relationship ==========================================
 
    public function pet():BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function schedule():BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function payment_method():BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
  
    public function results():HasMany
    {
        return $this->hasMany(Result::class);
    }

    public function prescriptions():HasMany
    {
        return $this->hasMany(Prescription::class);
    }
     
    // ============================== Accessor & Mutator ==========================================

    public function getPaymentReceiptAttribute()
    {
        return optional($this->getFirstMedia('payment_receipts'))->getUrl('card');
    }
  
    // ========================== Custom Methods ======================================================
        
    /**
     * media conversion
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaConversion('card')
        ->width(600)
        ->keepOriginalImageFormat()
        ->nonQueued();
    }
}