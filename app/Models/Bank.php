<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'swift_code'];

    public function sales()
    {
        return $this->hasMany(Sale::class, 'bank_id', 'id');
    }

    public function scopeData($query)
    {
        return $query->select([
            'id',
            'name',
            'swift_code',
            'created_at'
        ]);
    }
}
