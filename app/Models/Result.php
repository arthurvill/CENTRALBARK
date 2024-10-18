<?php

namespace App\Models;

use App\Traits\BelongsToBooking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Result extends Model implements HasMedia
{
    use HasFactory,
    BelongsToBooking, 
    InteractsWithMedia;

    protected $fillable = [
        'booking_id',
        'subject',
        'remark',
    ];


    // ============================== Accessor & Mutator ==========================================
 
    //  public function getFeaturedPhotoAttribute()
    //  {
    //      return $this->getFirstMedia('booking_result_images')->getUrl('card');
    //  }
 
    // ============================== Methods ==========================================

    /**
    * media conversion
    */
    public function registerMediaCollections(): void
    {
        $this->addMediaConversion('card')
            ->width(450)
            ->keepOriginalImageFormat()
            ->nonQueued();
    }
}