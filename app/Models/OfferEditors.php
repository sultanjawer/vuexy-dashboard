<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferEditors extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'user_id',
        'note',
        'action',
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeData($query)
    {
        return $query->select([
            'id',
            'offer_id',
            'user_id',
            'note',
            'action',
            'created_at',
        ]);
    }
}
