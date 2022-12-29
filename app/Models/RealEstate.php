<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstate extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'city_id',
        'neighborhood_id',
        // 'street_width_id',
        // 'direction_id',
        'land_type_id',
        'property_type_id',
        'property_status_id',
        'interface_length_id',
        'licensed_id',
        'owner_ship_type_id',
        'building_type_id',
        'building_status_id',
        'construction_delivery_id',
        'real_estate_age',
        'floor_number',
        'floors_number',
        'flats_numbers',
        'flat_rooms_number',
        'rooms_number',
        'stores_number',
        'real_estate_statement',
        'price_by_meter',
        'total_price',
        'annual_income',
        'space',
        'notes',
        'land_number',
        'block_number',
        'branch_id',
        'character',
        'real_estate_type',
    ];

    #Has One Relationship
    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id',);
    }

    public function neighborhood()
    {
        return $this->hasOne(Neighborhood::class, 'id', 'neighborhood_id',);
    }

    public function streetWidths()
    {
        return $this->belongsToMany(StreetWidth::class, 'street_width_real_estate', 'real_estate_id', 'street_width_id', 'id', 'id');
    }

    public function directions()
    {
        return $this->belongsToMany(Direction::class, 'direction_real_estate', 'real_estate_id', 'direction_id', 'id', 'id');
    }

    public function landType()
    {
        return $this->hasOne(LandType::class, 'id', 'land_type_id',);
    }

    public function interfaceLength()
    {
        return $this->hasOne(InterfaceLength::class, 'id', 'interface_length_id',);
    }

    public function sale()
    {
        return $this->hasOne(Sale::class, 'real_estate_id', 'id');
    }

    public function licensed()
    {
        return $this->hasOne(Licensed::class, 'id', 'licensed_id',);
    }

    public function propertyType()
    {
        return $this->hasOne(PropertyType::class, 'id', 'property_type_id');
    }

    public function propertyStatus()
    {
        return $this->hasOne(PropertyStatus::class, 'id', 'property_status_id');
    }

    public function ownerShipType()
    {
        return $this->hasOne(OwnerShipType::class, 'id', 'owner_ship_type_id');
    }

    public function buildingType()
    {
        return $this->hasOne(BuildingType::class, 'id', 'building_type_id');
    }

    public function buildingStatus()
    {
        return $this->hasOne(BuildingStatus::class, 'id', 'building_status_id');
    }

    public function constructionDelivery()
    {
        return $this->hasOne(ConstructionDelivery::class, 'id', 'construction_delivery_id');
    }

    public function branch()
    {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }


    #Has Many Relationship
    public function offers()
    {
        return $this->hasMany(Offer::class, 'real_estate_id', 'id');
    }

    #Scopes Types
    public function scopeLand($query)
    {
        return $query->where('real_estate_type', 'land');
    }

    public function scopeDuplex($query)
    {
        return $query->where('real_estate_type', 'duplex');
    }

    public function scopeCondominium($query)
    {
        return $query->where('real_estate_type', 'condominium');
    }

    public function scopeFlat($query)
    {
        return $query->where('real_estate_type', 'flat');
    }

    public function scopeChalet($query)
    {
        return $query->where('real_estate_type', 'chalet');
    }
}
