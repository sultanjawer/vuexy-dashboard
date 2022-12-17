<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstructionDelivery extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function realEstate()
    {
        return $this->belongsTo(RealEstate::class, 'construction_delivery_id', 'id');
    }

    public function scopeData($query)
    {
        return $query->select([
            'id',
            'name',
        ]);
    }
}
