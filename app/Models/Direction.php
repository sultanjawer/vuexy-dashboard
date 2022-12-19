<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function offers()
    {
        return $this->hasMany(Offer::class, 'direction_id', 'id');
    }

    public function realEstates()
    {
        return $this->belongsToMany(RealEstate::class, 'direction_real_estate', 'direction_id', 'real_estate_id', 'id', 'id');
    }

    public function scopeData($query)
    {
        return $query->select([
            'id',
            'name',
        ]);
    }
}
