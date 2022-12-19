<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StreetWidth extends Model
{
    use HasFactory;

    protected $fillable = ['street_number', 'name'];

    public function realEstates()
    {
        return $this->belongsToMany(RealEstate::class, 'street_width_real_estate', 'street_width_id', 'real_estate_id', 'id', 'id');
    }

    public function scopeData($query)
    {
        return $query->select([
            'id',
            'name',
            'street_number'
        ]);
    }
}
