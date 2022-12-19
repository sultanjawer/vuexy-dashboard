<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Offer;
use App\Models\RealEstate;

class OfferService extends Controller
{
    public function store($data)
    {

        $real_estate = $this->createRealEstate($data);
        $offer = Offer::create([
            // 'mediators_ids' => json_encode($data['mediators_ids']), #
            'offer_type_id' => $data['is_direct'] ? 1 : 2, #
            'user_id' => auth()->id(),
            'who_add' => auth()->id(),
            'who_edit' => null,
            'who_cancel' => null,
            'booking_ids' => [], #
            'real_estate_id' => $real_estate->id, #
        ]);

        $branch =  Branch::find($real_estate->branch_id);
        $offer_code = ucwords($branch->code) . '-' . $offer->id . '-USR' . auth()->id();
        $offer->offer_code = $offer_code;
        $offer->save();
        $offer->mediators()->sync($data['mediators_ids']);

        return Offer::find($offer->id);
    }

    public function getRealEstateType($id)
    {
        if ($id == 1) {
            return 'land';
        }
        if ($id == 2) {
            return 'duplex';
        }
        if ($id == 3) {
            return 'condominium';
        }
        if ($id == 4) {
            return 'flat';
        }
        if ($id == 5) {
            return 'chalet';
        }
    }

    public function createRealEstate($data)
    {
        $real_estate_type = $this->getRealEstateType($data['property_type_id']);

        if ($real_estate_type == 'land') {
            return $this->createLand($data);
        }

        if ($real_estate_type == 'duplex') {
            return $this->createDuplex($data);
        }

        if ($real_estate_type == 'condominium') {
            return $this->createCondominium($data);
        }

        if ($real_estate_type == 'flat') {
            return $this->createFlat($data);
        }

        if ($real_estate_type == 'chalet') {
            return $this->createChalet($data);
        }
    }

    public function createChalet($data)
    {
        $chalet = RealEstate::create([
            'city_id' => $data['city_id'],
            'neighborhood_id' => $data['neighborhood_id'],
            'land_number' => $data['land_number'],
            'block_number' => $data['block_number'],
            'property_type_id' => $data['property_type_id'],
            'property_status_id' => 1,
            'branch_id' => $data['branch_id'],
            'space' => $data['space'],
            'notes' => $data['notes'],
            // 'street_width_id' => $data['street_width_id'],
            // 'direction_id' => $data['direction_id'],
            'real_estate_type' => 'chalet',
            'price' => $data['price'],
            'owner_ship_type_id' => $data['owner_ship_type_id'],
            'real_estate_age' => $data['real_estate_age']
        ]);


        $chalet->directions()->sync($data['direction_ids']);
        $chalet->streetWidths()->sync($data['street_width_ids']);
        return $chalet;
    }

    public function createFlat($data)
    {
        $flat = RealEstate::create([
            'city_id' => $data['city_id'],
            'neighborhood_id' => $data['neighborhood_id'],
            'land_number' => $data['land_number'],
            'block_number' => $data['block_number'],
            'property_type_id' => $data['property_type_id'],
            'property_status_id' => 1,
            'space' => $data['space'],
            'branch_id' => $data['branch_id'],
            'notes' => $data['notes'],
            'real_estate_type' => 'flat',
            'floor_number' => $data['floor_number'],
            'price' => $data['price'],
            'real_estate_age' => $data['real_estate_age'],
        ]);


        // $condominium->directions()->sync($data['direction_ids']);
        // $condominium->streetWidths()->sync($data['street_width_ids']);
        return $flat;
    }

    public function createCondominium($data)
    {
        $condominium = RealEstate::create([
            'city_id' => $data['city_id'],
            'neighborhood_id' => $data['neighborhood_id'],
            'land_number' => $data['land_number'],
            'block_number' => $data['block_number'],
            'property_type_id' => $data['property_type_id'],
            'property_status_id' => 1,
            'space' => $data['space'],
            'total_price' => $data['total_price'],
            'notes' => $data['notes'],
            'branch_id' => $data['branch_id'],
            'real_estate_type' => 'condominium',
            'floors_number' => $data['floors_number'],
            'flats_number' => $data['flats_number'],
            'stores_number' => $data['stores_number'],
            'flat_rooms_number' => $data['flat_rooms_number'],
            'annual_income' => $data['annual_income'],
            'real_estate_age' => $data['real_estate_age'],
        ]);

        // $condominium->directions()->sync($data['direction_ids']);
        // $condominium->streetWidths()->sync($data['street_width_ids']);
        return $condominium;
    }

    public function createDuplex($data)
    {
        $duplex = RealEstate::create([
            'city_id' => $data['city_id'],
            'neighborhood_id' => $data['neighborhood_id'],
            'land_number' => $data['land_number'],
            'block_number' => $data['block_number'],
            'property_type_id' => $data['property_type_id'],
            'property_status_id' => 1,
            'space' => $data['space'],
            // 'street_width_id' => $data['street_width_id'],
            // 'direction_id' => $data['direction_id'],
            'land_type_id' => $data['land_type_id'],
            'licensed_id' => $data['licensed_id'],
            'price_by_meter' => $data['price_by_meter'],
            'total_price' => $data['total_price'],
            'real_estate_type' => 'duplex',
            'notes' => $data['notes'],
            'branch_id' => $data['branch_id'],
            'character' => $data['character'],
            'interface_length_id' => $data['interface_length_id'],
            'building_type_id' => $data['building_type_id'],
            'building_status_id' => $data['building_status_id'],
            'construction_delivery_id' => $data['construction_delivery_id'],
            'real_estate_age' => $data['real_estate_age']
        ]);

        $duplex->directions()->sync($data['direction_ids']);
        $duplex->streetWidths()->sync($data['street_width_ids']);
        return $duplex;
    }

    public function createLand($data)
    {
        $land = RealEstate::create([
            'city_id' => $data['city_id'],
            'neighborhood_id' => $data['neighborhood_id'],
            'land_number' => $data['land_number'],
            'block_number' => $data['block_number'],
            'property_type_id' => $data['property_type_id'],
            'property_status_id' => 1,
            'space' => $data['space'],
            'price_by_meter' => $data['price_by_meter'],
            'total_price' => $data['total_price'],
            // 'direction_id' => $data['direction_id'],
            'land_type_id' => $data['land_type_id'],
            'licensed_id' => $data['licensed_id'],
            // 'street_width_id' => $data['street_width_id'],
            'branch_id' => $data['branch_id'],
            'real_estate_type' => 'land',
            'notes' => $data['notes'],
            'character' => $data['character'],
            'interface_length_id' => $data['interface_length_id'],
        ]);

        $land->directions()->sync($data['direction_ids']);
        $land->streetWidths()->sync($data['street_width_ids']);
        return $land;
    }

    public function update($offer, $data)
    {

        $real_estate = RealEstate::find($offer->realEstate->id);
        $id = $real_estate->property_type_id;

        $offer->update([
            // 'mediators_ids' => json_encode($data['mediators_ids']), #
            'offer_type_id' => $data['is_direct'] ? 1 : 2, #
            // 'user_id' => auth()->id(),
            // 'who_add' => auth()->id(),
            'who_edit' => auth()->id(),
            // 'who_cancel' => null,
            // 'booking_ids' => [], #
            // 'real_estate_id' => $real_estate->id, #
        ]);

        if ($id == 1) {
            $real_estate->update([
                'city_id' => $data['city_id'],
                'neighborhood_id' => $data['neighborhood_id'],
                'land_number' => $data['land_number'],
                'block_number' => $data['block_number'],
                // 'property_type_id' => $data['property_type_id'],
                'property_status_id' => 1,
                'space' => $data['space'],
                'price_by_meter' => $data['price_by_meter'],
                'total_price' => $data['total_price'],
                // 'direction_id' => $data['direction_id'],
                'land_type_id' => $data['land_type_id'],
                'licensed_id' => $data['licensed_id'],
                // 'street_width_id' => $data['street_width_id'],
                'branch_id' => $data['branch_id'],
                'real_estate_type' => 'land',
                'notes' => $data['notes'],
                'character' => $data['character'],
                'interface_length_id' => $data['interface_length_id'],
            ]);
        }

        if ($id == 2) {
            $real_estate->update([
                'city_id' => $data['city_id'],
                'neighborhood_id' => $data['neighborhood_id'],
                'land_number' => $data['land_number'],
                'block_number' => $data['block_number'],
                // 'property_type_id' => $data['property_type_id'],
                'property_status_id' => 1,
                'space' => $data['space'],
                // 'street_width_id' => $data['street_width_id'],
                // 'direction_id' => $data['direction_id'],
                'land_type_id' => $data['land_type_id'],
                'licensed_id' => $data['licensed_id'],
                'price_by_meter' => $data['price_by_meter'],
                'total_price' => $data['total_price'],
                // 'real_estate_type' => 'duplex',
                'notes' => $data['notes'],
                'branch_id' => $data['branch_id'],
                'character' => $data['character'],
                'interface_length_id' => $data['interface_length_id'],
                'building_type_id' => $data['building_type_id'],
                'building_status_id' => $data['building_status_id'],
                'construction_delivery_id' => $data['construction_delivery_id'],
                'real_estate_age' => $data['real_estate_age']
            ]);
        }

        if ($id == 3) {
            $real_estate->update([
                'city_id' => $data['city_id'],
                'neighborhood_id' => $data['neighborhood_id'],
                'land_number' => $data['land_number'],
                'block_number' => $data['block_number'],
                // 'property_type_id' => $data['property_type_id'],
                'property_status_id' => 1,
                'space' => $data['space'],
                'total_price' => $data['total_price'],
                'notes' => $data['notes'],
                'branch_id' => $data['branch_id'],
                // 'real_estate_type' => 'condominium',
                'floors_number' => $data['floors_number'],
                'flats_number' => $data['flats_number'],
                'stores_number' => $data['stores_number'],
                'flat_rooms_number' => $data['flat_rooms_number'],
                'annual_income' => $data['annual_income'],
                'real_estate_age' => $data['real_estate_age'],
            ]);
        }

        if ($id == 4) {
            $real_estate->update([
                'city_id' => $data['city_id'],
                'neighborhood_id' => $data['neighborhood_id'],
                'land_number' => $data['land_number'],
                'block_number' => $data['block_number'],
                // 'property_type_id' => $data['property_type_id'],
                'property_status_id' => 1,
                'space' => $data['space'],
                'branch_id' => $data['branch_id'],
                'notes' => $data['notes'],
                // 'real_estate_type' => 'flat',
                'floor_number' => $data['floor_number'],
                'price' => $data['price'],
                'real_estate_age' => $data['real_estate_age'],
            ]);
        }

        if ($id == 5) {
            $real_estate->update([
                'city_id' => $data['city_id'],
                'neighborhood_id' => $data['neighborhood_id'],
                'land_number' => $data['land_number'],
                'block_number' => $data['block_number'],
                // 'property_type_id' => $data['property_type_id'],
                'property_status_id' => 1,
                'branch_id' => $data['branch_id'],
                'space' => $data['space'],
                'notes' => $data['notes'],
                // 'street_width_id' => $data['street_width_id'],
                // 'direction_id' => $data['direction_id'],
                // 'real_estate_type' => 'chalet',
                'price' => $data['price'],
                'owner_ship_type_id' => $data['owner_ship_type_id'],
                'real_estate_age' => $data['real_estate_age']
            ]);
        }

        if (in_array($id, [1, 2, 5])) {
            $real_estate->directions()->sync($data['direction_ids']);
            $real_estate->streetWidths()->sync($data['street_width_ids']);
        }

        if ($offer) {
            $offer->mediators()->sync($data['mediators_ids']);
        }


        return true;
    }
}
