<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, 
    Notifiable, 
    InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'staff_id',
        'customer_id',
        'name',
        'email',
        'password',
        'role_id',
        'is_activated',
        'verification_token',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // ==============================Relationship==================================================

    public function avatar(): HasOne
    {
        return $this->hasOne(Media::class, 'model_id', 'id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }


    // ============================== Accessor & Mutator ==========================================

    public function getAvatarProfileAttribute()
    {
        return optional($this->getFirstMedia('avatar_image'))->getUrl('avatar');
    }
    
    public function getAvatarThumbnailAttribute()
    {
        return optional($this->getFirstMedia('avatar_image'))->getUrl('thumbnail');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // ========================== Custom Methods ======================================================

    public function registerMediaCollections(): void
    {
        $this->addMediaConversion('avatar')
        ->width(300)
        ->nonQueued();

        $this->addMediaConversion('thumbnail')
        ->width(120)
        ->nonQueued();
    }

    public function hasRole($role) {
        return $this->role()->where('name', $role)->first() ? true : false;
    }


    // ========================== Scope ======================================================

    public function scopeByRole($query, $role)
    {
        return $query->whereRelation('role', 'name', $role);
    }

    public function scopeActive($query)
    {
        return $query->where('is_activated', true);
    }
    
    public function scopeInactive($query)
    {
        return $query->where('is_activated', false);
    }

}