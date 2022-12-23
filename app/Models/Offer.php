<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_code',
        'real_estate_id',
        'offer_type_id',
        'user_id',
        'who_add',
        'who_edit',
        'who_cancel',
        // 'mediators_ids',
        'booking_ids',
    ];

    protected $casts = [
        'mediators_ids' => 'array',
        'booking_ids' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function offerEdits()
    {
        return $this->hasMany(OfferEditors::class, 'offer_id', 'id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'offer_id', 'id');
    }

    public function offerType()
    {
        return $this->belongsTo(OfferType::class, 'offer_type_id', 'id');
    }

    public function realEstate()
    {
        return $this->belongsTo(RealEstate::class, 'real_estate_id', 'id');
    }

    public function propertyStatus()
    {
        return $this->belongsTo(PropertyStatus::class, 'property_status_id', 'id');
    }

    public function mediators()
    {
        return $this->belongsToMany(Mediator::class, 'offer_mediator', 'offer_id', 'mediator_id', 'id', 'id');
    }

    public function scopeData($query)
    {
        return $query->select([
            'id',
            'offer_code',
            'real_estate_id',
            'offer_type_id',
            'user_id',
            'who_add',
            'who_edit',
            'who_cancel',
            // 'mediators_ids',
            'booking_ids',
        ]);
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
        ], $filters);


        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('offer_code', 'like', '%' . $filters['search'] . '%');
        });
    }
}
