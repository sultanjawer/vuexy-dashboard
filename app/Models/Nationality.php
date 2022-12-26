<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'nationality_country', 'id');
    }

    public function scopeData($query)
    {
        return $query->select([
            'id',
            'name',
            'created_at'
        ]);
    }
}
