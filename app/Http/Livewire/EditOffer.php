<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Services\OfferService;
use App\Models\City;
use App\Models\Mediator;
use App\Models\Offer;
use App\Models\RealEstate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EditOffer extends Component
{
    use LivewireAlert;

    protected $listeners = ['setMediatorsIds', 'setIds', 'setEvent', 'refreshSelect2' => '$refresh'];
    public $land_fields = ['price_by_meter', 'total_price', 'direction_ids', 'land_type_id', 'licensed_id', 'street_width_ids', 'interface_length_id', 'character'];
    public $duplex_fields = ['price_by_meter', 'total_price', 'direction_ids', 'land_type_id', 'licensed_id', 'street_width_ids', 'interface_length_id', 'character', 'real_estate_age', 'building_type_id', 'building_status_id', 'construction_delivery_id'];
    public $condominium_fields = ['real_estate_age', 'floors_number', 'flats_number', 'stores_number', 'flat_rooms_number', 'annual_income', 'total_price',];
    public $flat_fields = ['price', 'floor_number', 'real_estate_age'];
    public $chalet_fields = ['direction_ids', 'street_width_ids', 'owner_ship_type_id', 'real_estate_age', 'price'];
    public $main_fields = ['city_id', 'neighborhood_id', 'land_number', 'block_number', 'notes', 'space', 'property_type_id', 'mediators_ids', 'branch_id'];

    #Form One
    public $city_id = 1;
    public $city;
    public $neighborhood_id = 1;
    public $land_number;
    public $block_number;
    public $notes = '';

    #Form Two
    public $property_type_id; #Type of real Estate [land, duplex, comdimiuom, flat, chalet]
    public $space;

    public $price_by_meter = 0;
    public $total_price = 0;
    public $direction_ids = [];
    public $land_type_id = 1;
    public $licensed_id = 1;
    public $street_width_ids = [];
    public $branch_id = 1;
    public $interface_length_id = 1;
    public $character = '';

    public $owner_ship_type_id = 1;
    public $real_estate_age;
    public $price = 0;

    public $floor_number = 0;
    public $floors_number = 0;
    public $flats_number = 0;
    public $stores_number = 0;
    public $flat_rooms_number = 0;
    public $annual_income = 0;

    public $building_type_id = 1;
    public $building_status_id = 1;
    public $construction_delivery_id = 1;

    #Form Three
    public $yes = 'option1';
    public $no = '';
    public $is_direct = true;
    public $mediators_ids = [];

    #Switching
    public $first = 'active';
    public $second = '';
    public $third = '';

    public $offer_id;
    public $offer;

    public function mount($offer_id)
    {
        $this->offer_id = $offer_id;
        $this->offer = Offer::find($offer_id);
        $offer = $this->offer;
        $this->city_id = $offer->realEstate->city_id;
        $this->neighborhood_id = $offer->realEstate->neighborhood_id;
        $this->land_number = $offer->realEstate->land_number;
        $this->block_number = $offer->realEstate->block_number;
        $this->space = $offer->realEstate->space;
        $this->notes = $offer->realEstate->notes;
        $this->property_type_id = $offer->realEstate->property_type_id;
        $this->price_by_meter = $offer->realEstate->price_by_meter;
        $this->total_price = $offer->realEstate->total_price;
        $this->direction_ids = $offer->realEstate->directions->pluck('id')->toArray();
        $this->land_type_id = $offer->realEstate->land_type_id;
        $this->licensed_id = $offer->realEstate->licensed_id;
        $this->street_width_ids = $offer->realEstate->streetWidths->pluck('id')->toArray();
        $this->branch_id = $offer->realEstate->branch_id;
        $this->interface_length_id = $offer->realEstate->interface_length_id;
        $this->character  = $offer->realEstate->character;
        $this->owner_ship_type_id = $offer->realEstate->owner_ship_type_id;
        $this->real_estate_age = $offer->realEstate->real_estate_age;
        $this->price = $offer->realEstate->price;
        $this->floor_number = $offer->realEstate->floor_number;
        $this->floors_number = $offer->realEstate->floors_number;
        $this->flats_number = $offer->realEstate->flats_number;
        $this->stores_number = $offer->realEstate->stores_number;
        $this->flat_rooms_number = $offer->realEstate->flat_rooms_number;
        $this->annual_income = $offer->realEstate->annual_income;
        $this->building_type_id = $offer->realEstate->building_type_id;
        $this->building_status_id = $offer->realEstate->building_status_id;
        $this->construction_delivery_id = $offer->realEstate->construction_delivery_id;
        $this->yes = $offer->offer_type_id == 1 ? $this->yes = 'option1' : $this->no = 'option2';
        $this->is_direct = $offer->offer_type_id == 1 ? true : false;
        dd(json_decode($offer->mediators_ids));
        $this->mediators_ids = array_map('intval', json_decode($offer->mediators_ids));
        $this->setEvent();
    }

    public function setIds()
    {
        $array = [];
        $array['mediators_ids'] = $this->mediators_ids;
        $array['direction_ids'] = $this->direction_ids;
        $array['street_width_ids'] = $this->street_width_ids;
        $this->emit('setids', $array, $this->is_direct);
    }

    public function setEvent()
    {
        $this->city = City::find($this->city_id);
        $neighborhoods = $this->city->neighborhoods()->get(['id', 'name'])->toArray();

        foreach ($neighborhoods as $key => $neighborhood) {

            foreach ($neighborhood as $index => $value) {

                if ($this->neighborhood_id == $value) {
                    $neighborhood['selected'] = true;
                }

                if ($index == 'name') {
                    $neighborhood['text'] = $value;
                    unset($neighborhood['name']);
                    $neighborhoods[$key] = $neighborhood;
                }
            }
        }

        $neighborhoods_json = json_decode(json_encode($neighborhoods));
        $this->emit('neighborhoods', $neighborhoods_json, $this->neighborhood_id);
    }

    public function step($form)
    {
        $this->first = '';
        $this->second = '';
        $this->third = '';

        if ($form == 'first') {
            $this->first = 'active';
        }

        if ($form == 'second') {
            $this->emit('set-form', $this->property_type_id);
            $this->second = 'active';
        }

        if ($form == 'third') {
            $this->third = 'active';
        }
    }

    public function hydrate()
    {
        $this->emit('select2', $this->mediators_ids);
    }

    public function setMediatorsIds()
    {
        $this->emit('refreshSelect2');
    }

    public function is_numeric($name, $value)
    {
        $int_value = str_replace(',', '', $value);
        if (is_numeric($int_value)) {
            $this->fill([$name => number_format((int)str_replace(',', '', $value))]);
        } else {
            $this->validate([$name => 'numeric'], [$name . '.numeric' => "الحقل يقبل ارقام فقط"]);
        }

        return $int_value;
    }

    public function updated($propertyName, $value)
    {

        if ($propertyName == 'city_id') {
            $this->setEvent();
        }

        if ($propertyName == 'yes') {
            $this->yes = 'option1';
            $this->no = '';
            $this->is_direct = true;
            $this->emit('mediators-show', $this->is_direct);
            $this->emit('mediatorsIds', $this->mediators_ids, $this->is_direct);
        }

        if ($propertyName == 'no') {
            $this->yes = '';
            $this->no = 'option2';
            $this->is_direct = false;
            $this->emit('mediators-show', $this->is_direct);
            $this->emit('mediatorsIds', $this->mediators_ids, $this->is_direct);
        }

        if ($propertyName == "space" || $propertyName == 'price_by_meter' || $propertyName == "price" || $propertyName == "annual_income") {
            $this->is_numeric($propertyName, $value);
        }

        if ($this->price_by_meter && $this->space) {
            $space = $this->is_numeric('space', $this->space);
            $price_by_meter = $this->is_numeric('price_by_meter', $this->price_by_meter);
            $this->total_price = number_format((int)str_replace(',', '', $price_by_meter * $space));
        }

        $this->validateOnly($propertyName);
    }

    public function getFields()
    {
        if ($this->property_type_id == 1) {
            return array_merge($this->land_fields, $this->main_fields);
        }

        if ($this->property_type_id == 2) {
            return array_merge($this->duplex_fields, $this->main_fields);
        }

        if ($this->property_type_id == 3) {
            return array_merge($this->condominium_fields, $this->main_fields);
        }

        if ($this->property_type_id == 4) {
            return array_merge($this->flat_fields, $this->main_fields);
        }

        if ($this->property_type_id == 5) {
            return array_merge($this->chalet_fields, $this->main_fields);
        }
    }

    public function rules()
    {
        $fields = $this->getFields();

        $validation = [];

        foreach ($fields as $field) {
            if ($field == "mediators_ids") {
                if (!$this->is_direct) {
                    $validation[$field] = ['required'];
                }
                continue;
            }

            if ($field == "land_number") {
                $validation[$field] = ['unique:real_estates,land_number,' . $this->offer->id, 'required'];
                continue;
            }

            if ($field == "block_number") {
                $validation[$field] = ['unique:real_estates,block_number,' . $this->offer->id, 'required'];
                continue;
            }

            $validation[$field] = ['required'];
        }

        return $validation;
    }

    public function messages()
    {

        $fields = $this->getFields();

        $validation = [];

        foreach ($fields as $field) {

            if ($field == "land_number") {
                $validation[$field . '.unique'] = 'رقم الأرض موجود بالفعل';
                $validation[$field . '.required'] = 'هذا الحقل مطلوب';
                continue;
            }

            if ($field == "block_number") {
                $validation[$field . '.unique'] = 'رقم الأرض موجود بالفعل';
                $validation[$field . '.required'] = 'هذا الحقل مطلوب';
                continue;
            }

            $validation[$field . '.required'] = 'هذا الحقل مطلوب';
        }

        return $validation;
    }

    public function render()
    {
        $this->setEvent();
        return view('livewire.edit-offer');
    }

    public function update(OfferService $offerService)
    {
        $this->price_by_meter = (int)str_replace(',', '', $this->price_by_meter);
        $this->total_price = (int)str_replace(',', '', $this->total_price);
        $this->price = (int)str_replace(',', '', $this->price);
        $this->floor_number = (int)str_replace(',', '', $this->floor_number);
        $this->floors_number = (int)str_replace(',', '', $this->floors_number);
        $this->flats_number = (int)str_replace(',', '', $this->flats_number);
        $this->stores_number = (int)str_replace(',', '', $this->stores_number);
        $this->flat_rooms_number  = (int)str_replace(',', '', $this->flat_rooms_number);
        $this->annual_income = (int)str_replace(',', '', $this->annual_income);

        if (!$this->is_direct) {
            if (!$this->mediators_ids) {
                $this->alert('warning', '', [
                    'toast' => true,
                    'position' => 'center',
                    'timer' => 6000,
                    'text' => 'هذا العرض غير مباشر يرجى اختيار وسيط واحد على الاقل 😌',
                    'timerProgressBar' => true,
                ]);
                return false;
            }
        }

        $data = $this->validate();

        if ($this->is_direct) {
            $data['is_direct'] = true;
            $data['mediators_ids'] = [];
        }

        if (!$this->is_direct) {
            $data['is_direct'] = false;
        }


        $offer = $offerService->update($this->offer, $data);

        if ($offer) {
            return redirect()->route('panel.offers')->with('message', 'تم تحديث العرض بنجاح');
        }
    }
}
