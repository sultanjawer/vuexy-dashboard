<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Offer;
use App\Models\OfferEditors;
use App\Models\RealEstate;

class OfferService extends Controller
{
    public function store($data)
    {
        $real_estate = $this->createRealEstate($data);
        $user = auth()->user();

        $offer = Offer::create([
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

        if ($user->user_type == 'admin' || $user->user_type == 'superadmin') {
            $link_admin =  route('panel.user', $user->id);
            $admin = "<a href='$link_admin'>$user->name</a>";
            $note = "قام المدير $admin بإضافة العرض";
        }

        if ($user->user_type == 'marketer') {
            $marketer_name = getUserName($user->id);
            $link_ma = route('panel.user', $user->id);
            $marketer = "<a href='$link_ma'> $marketer_name</a>";
            $note = "قام المسوق $marketer بإضافة العرض";
        }

        if ($user->user_type == 'office') {
            $office_name = getUserName($user->id);
            $link_office = route('panel.user', $user->id);
            $office = "<a href='$link_office'> $office_name</a>";
            $note = "قام المكتب $office بإضافة العرض";
        }

        OfferEditors::create([
            'offer_id' => $offer->id,
            'user_id' => $user->id,
            'note' => $note,
            'action' => 'add',
        ]);

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
            'real_estate_type' => 'chalet',
            'owner_ship_type_id' => $data['owner_ship_type_id'],
            'real_estate_age' => $data['real_estate_age'],
            'real_estate_statement' => $data['real_estate_statement']
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
            'real_estate_age' => $data['real_estate_age'],
            'real_estate_statement' => $data['real_estate_statement']

        ]);

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
            'real_estate_statement' => $data['real_estate_statement']

        ]);

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
            'real_estate_age' => $data['real_estate_age'],
            'real_estate_statement' => $data['real_estate_statement']

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
            'land_type_id' => $data['land_type_id'],
            'licensed_id' => $data['licensed_id'],
            'branch_id' => $data['branch_id'],
            'real_estate_type' => 'land',
            'notes' => $data['notes'],
            'character' => $data['character'],
            'interface_length_id' => $data['interface_length_id'],
            'real_estate_statement' => $data['real_estate_statement']
        ]);

        $land->directions()->sync($data['direction_ids']);
        $land->streetWidths()->sync($data['street_width_ids']);
        return $land;
    }

    public function update($offer, $data)
    {
        $real_estate = RealEstate::find($offer->realEstate->id);
        $id = $real_estate->property_type_id;
        $user = auth()->user();

        $offer->update([
            'offer_type_id' => $data['is_direct'] ? 1 : 2, #
            'who_edit' => auth()->id(),
        ]);

        if ($id == 1) {
            $real_estate->update([
                'city_id' => $data['city_id'],
                'neighborhood_id' => $data['neighborhood_id'],
                'land_number' => $data['land_number'],
                'block_number' => $data['block_number'],
                'property_status_id' => 1,
                'space' => $data['space'],
                'price_by_meter' => $data['price_by_meter'],
                'total_price' => $data['total_price'],
                'land_type_id' => $data['land_type_id'],
                'licensed_id' => $data['licensed_id'],
                'branch_id' => $data['branch_id'],
                'real_estate_type' => 'land',
                'notes' => $data['notes'],
                'character' => $data['character'],
                'interface_length_id' => $data['interface_length_id'],
                'real_estate_statement' => $data['real_estate_statement']
            ]);
        }

        if ($id == 2) {
            $real_estate->update([
                'city_id' => $data['city_id'],
                'neighborhood_id' => $data['neighborhood_id'],
                'land_number' => $data['land_number'],
                'block_number' => $data['block_number'],
                'property_status_id' => 1,
                'space' => $data['space'],
                'land_type_id' => $data['land_type_id'],
                'licensed_id' => $data['licensed_id'],
                'price_by_meter' => $data['price_by_meter'],
                'total_price' => $data['total_price'],
                'notes' => $data['notes'],
                'branch_id' => $data['branch_id'],
                'character' => $data['character'],
                'interface_length_id' => $data['interface_length_id'],
                'building_type_id' => $data['building_type_id'],
                'building_status_id' => $data['building_status_id'],
                'construction_delivery_id' => $data['construction_delivery_id'],
                'real_estate_age' => $data['real_estate_age'],
                'real_estate_statement' => $data['real_estate_statement']
            ]);
        }

        if ($id == 3) {

            $real_estate->update([
                'city_id' => $data['city_id'],
                'neighborhood_id' => $data['neighborhood_id'],
                'land_number' => $data['land_number'],
                'block_number' => $data['block_number'],
                'property_status_id' => 1,
                'space' => $data['space'],
                'total_price' => $data['total_price'],
                'notes' => $data['notes'],
                'branch_id' => $data['branch_id'],
                'floors_number' => $data['floors_number'],
                'flats_numbers' => $data['flats_number'],
                'stores_number' => $data['stores_number'],
                'flat_rooms_number' => $data['flat_rooms_number'],
                'annual_income' => $data['annual_income'],
                'real_estate_age' => $data['real_estate_age'],
                'real_estate_statement' => $data['real_estate_statement']
            ]);
        }

        if ($id == 4) {
            $real_estate->update([
                'city_id' => $data['city_id'],
                'neighborhood_id' => $data['neighborhood_id'],
                'land_number' => $data['land_number'],
                'block_number' => $data['block_number'],
                'property_status_id' => 1,
                'space' => $data['space'],
                'branch_id' => $data['branch_id'],
                'notes' => $data['notes'],
                'floor_number' => $data['floor_number'],
                'real_estate_age' => $data['real_estate_age'],
                'real_estate_statement' => $data['real_estate_statement']
            ]);
        }

        if ($id == 5) {
            $real_estate->update([
                'city_id' => $data['city_id'],
                'neighborhood_id' => $data['neighborhood_id'],
                'land_number' => $data['land_number'],
                'block_number' => $data['block_number'],
                'property_status_id' => 1,
                'branch_id' => $data['branch_id'],
                'space' => $data['space'],
                'notes' => $data['notes'],
                'owner_ship_type_id' => $data['owner_ship_type_id'],
                'real_estate_age' => $data['real_estate_age'],
                'real_estate_statement' => $data['real_estate_statement']

            ]);
        }

        if ($user->user_type == 'admin' || $user->user_type == 'superadmin') {
            $link_admin =  route('panel.user', $user->id);
            $admin = "<a href='$link_admin'>$user->name</a>";
            $note = "قام المدير $admin بتعديل العرض";
        }

        if ($user->user_type == 'marketer') {
            $marketer_name = getUserName($user->id);
            $link_ma = route('panel.user', $user->id);
            $marketer = "<a href='$link_ma'> $marketer_name</a>";
            $note = "قام المسوق $marketer بتعديل العرض";
        }

        if ($user->user_type == 'office') {
            $office_name = getUserName($user->id);
            $link_office = route('panel.user', $user->id);
            $office = "<a href='$link_office'> $office_name</a>";
            $note = "قام المكتب $office بتعديل العرض";
        }

        OfferEditors::create([
            'offer_id' => $offer->id,
            'user_id' => $user->id,
            'note' => $note,
            'action' => 'edit',
        ]);

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
