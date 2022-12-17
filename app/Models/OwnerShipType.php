<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerShipType extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function realEstate()
    {
        return $this->belongsTo(RealEstate::class, 'owner_ship_type_id', 'id');
    }

    public function scopeData($query)
    {
        return $query->select([
            'id',
        ]);
    }
}
