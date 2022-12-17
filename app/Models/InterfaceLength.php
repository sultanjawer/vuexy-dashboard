<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterfaceLength extends Model
{
    use HasFactory;

    protected $fillable = ['id'];

    public function realEstate()
    {
        return $this->belongsTo(RealEstate::class, 'interface_length_id', 'id');
    }
    public function scopeData($query)
    {
        return $query->select([
            'id',
        ]);
    }
}
