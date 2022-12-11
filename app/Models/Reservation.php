<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_id',
        'customer_name',
        'price',
        'status',
        'date_from',
        'date_to',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function scopeData($query)
    {
        return $query->select([
            'id',
            'user_id',
            'customer_id',
            'customer_name',
            'price',
            'status',
            'date_from',
            'date_to',
            'created_at',
            'updated_at'
        ]);
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'reservation_status' => null,
            'date_from' => null,
            'date_to' => null,
        ], $filters);

        if ($filters['date_to']) {
            $filters['date_to'] = date('Y-m-d', strtotime($filters['date_to'] . ' +1 day'));
        }

        $builder->when($filters['search'] == '' && ($filters['date_from']  || $filters['date_to']), function ($query) use ($filters) {
            if (!$filters['reservation_status']) {
                $status = [1, 2];
            } else {
                $status = [$filters['reservation_status']];
            }

            $query
                ->whereBetween('created_at', [$filters['date_from'], $filters['date_to']])
                ->whereIn('status', $status)
                ->orderBy('created_at', 'ASC');
        });


        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query
                ->orWhere('customer_name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('id', 'like', '%' . $filters['search'] . '%')
                ->where('status', 'like', '%' . $filters['reservation_status'] . '%');
        });
    }
}
