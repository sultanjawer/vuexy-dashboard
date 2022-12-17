<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function realEstate()
    {
        return $this->belongsTo(RealEstate::class, 'building_type_id', 'id');
    }

    public function scopeData($query)
    {
        return $query->select([
            'id',
            'name',
        ]);
    }
}
