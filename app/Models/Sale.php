<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'sale_code',
        'user_id',
        'order_id',
        'offer_id',
        'customer_id',
        'customer_buyer_id',
        'customer_seller_id',
        'real_estate_id',
        'payment_method_id',
        'check_number',
        'bank_id',
        'vat',
        'saee_prc',
        'saee_price',
        'tatal_req_amount',
        'paid_amount',
        'sale_status',
        'who_add',
        'who_edit',
        'who_cancel',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id', 'id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function realEstate()
    {
        return $this->belongsTo(RealEstate::class, 'real_estate_id', 'id');
    }

    public function paymentMethod()
    {
        return $this->hasOne(PaymentMethod::class, 'payment_method_id', 'id');
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'sale_status' => null,
            'property_type_id' => null,
            'branch_type_id' => null,
            'city_id' => null
        ], $filters);


        $builder->when($filters['search'] != '', function ($query) use ($filters) {

            if (!$filters['sale_status']) {
                $status = [1, 2];
            } else {
                $status = [$filters['sale_status']];
            }

            if (!$filters['branch_type_id']) {
                $filters['branch_type_id'] = getBranches()->pluck('id')->toArray();
            } else {
                $filters['branch_type_id'] = [$filters['branch_type_id']];
            }

            if (!$filters['city_id']) {
                $filters['city_id'] = getCities()->pluck('id')->toArray();
            } else {
                $filters['city_id'] = [$filters['city_id']];
            }

            if (!$filters['property_type_id']) {
                $filters['property_type_id'] = getPropertyTypes()->pluck('id')->toArray();
            } else {
                $filters['property_type_id'] = [$filters['property_type_id']];
            }

            $query
                ->orWhere('sale_code', 'like', '%' . $filters['search'] . '%')
                ->whereIn('sale_status', $status)

                ->whereHas('realEstate.propertyType', function ($query) use ($filters) {
                    $query->whereIn('property_type_id', $filters['property_type_id']);
                })

                ->whereHas('realEstate.branch', function ($query) use ($filters) {
                    $query->whereIn('id', $filters['branch_type_id']);
                })

                ->whereHas('realEstate.city', function ($query) use ($filters) {
                    $query->whereIn('id', $filters['city_id']);
                });
        });


        $builder->when($filters['search'] == '', function ($query) use ($filters) {

            if (!$filters['sale_status']) {
                $status = [1, 2];
            } else {
                $status = [$filters['sale_status']];
            }

            if (!$filters['branch_type_id']) {
                $filters['branch_type_id'] = getBranches()->pluck('id')->toArray();
            } else {
                $filters['branch_type_id'] = [$filters['branch_type_id']];
            }

            if (!$filters['city_id']) {
                $filters['city_id'] = getCities()->pluck('id')->toArray();
            } else {
                $filters['city_id'] = [$filters['city_id']];
            }

            if (!$filters['property_type_id']) {
                $filters['property_type_id'] = getPropertyTypes()->pluck('id')->toArray();
            } else {
                $filters['property_type_id'] = [$filters['property_type_id']];
            }

            $query
                ->whereIn('sale_status', $status)

                ->whereHas('realEstate.propertyType', function ($query) use ($filters) {
                    $query->whereIn('property_type_id', $filters['property_type_id']);
                })

                ->whereHas('realEstate.branch', function ($query) use ($filters) {
                    $query->whereIn('id', $filters['branch_type_id']);
                })

                ->whereHas('realEstate.city', function ($query) use ($filters) {
                    $query->whereIn('id', $filters['city_id']);
                });
        });
    }

    public function scopeData($query)
    {
        return $query->select([
            'id',
            'sale_code',
            'user_id',
            'order_id',
            'offer_id',
            'customer_id',
            'real_estate_id',
            'payment_method_id',

            'vat',
            'check_number',
            'bank_id',
            'saee_prc',
            'saee_price',
            'tatal_req_amount',
            'paid_amount',
            'sale_status',
            'who_add',
            'who_edit',
            'who_cancel',
            'created_at'
        ]);
    }
}
