<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Services\OfferService;
use App\Models\City;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CreateOffer extends Component
{
    use LivewireAlert;

    protected $listeners = ['setMediatorsIds', 'setNeiborhoods', 'refreshSelect2' => '$refresh'];
    public $land_fields = ['price_by_meter', 'total_price', 'direction_ids', 'land_type_id', 'licensed_id', 'street_width_ids', 'interface_length_id', 'character'];
    public $duplex_fields = ['price_by_meter', 'total_price', 'direction_ids', 'land_type_id', 'licensed_id', 'street_width_ids', 'interface_length_id', 'character', 'real_estate_age', 'building_type_id', 'building_status_id', 'construction_delivery_id'];
    public $condominium_fields = ['real_estate_age', 'floors_number', 'flats_number', 'stores_number', 'flat_rooms_number', 'annual_income', 'total_price',];
    public $flat_fields = ['floor_number', 'real_estate_age'];
    public $chalet_fields = ['direction_ids', 'street_width_ids', 'owner_ship_type_id', 'real_estate_age', 'price'];
    public $main_fields = ['city_id', 'neighborhood_id', 'land_number', 'real_estate_statement', 'block_number', 'notes', 'space', 'property_type_id', 'mediators_ids', 'branch_id'];

    public $property_types = ['land', 'duplex', 'condominium', 'flat', 'chalet'];

    #Form One
    public $city_id = 1;
    public $city;
    public $neighborhood_id = 1;
    public $land_number;
    public $block_number;
    public $real_estate_statement = '';
    public $notes = '';

    #Form Two
    public $property_type_id = 1; #Type of real Estate [land, duplex, comdimiuom, flat, chalet]
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
    public $yes = '';
    public $no = 'option2';
    public $is_direct = false;
    public $mediators_ids = [];

    #Switching
    public $first = 'active';
    public $second = '';
    public $third = '';

    public $neighborhoods_json;


    public function setNeiborhoods()
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
            $this->second = 'active';
        }

        if ($form == 'third') {
            $this->emit('mediators-show', $this->is_direct);
            $this->third = 'active';
        }
    }

    public function hydrate()
    {
        $this->emit('select2', $this->mediators_ids);
    }

    public function render()
    {
        return view('livewire.create-offer');
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
            $this->city = City::find($value);
            $neighborhoods = $this->city->neighborhoods()->get(['id', 'name'])->toArray();

            foreach ($neighborhoods as $key => $neighborhood) {

                foreach ($neighborhood as $index => $value) {
                    if ($index == 'name') {
                        $neighborhood['text'] = $value;
                        unset($neighborhood['name']);
                        $neighborhoods[$key] = $neighborhood;
                    }
                }
            }

            $neighborhoods_json = json_decode(json_encode($neighborhoods));

            $this->emit('neighborhoods', $neighborhoods_json);
        }

        if ($propertyName == 'yes') {
            $this->yes = 'option1';
            $this->no = '';
            $this->is_direct = true;
            $this->emit('mediators-show', $this->is_direct);
        }


        if ($propertyName == 'no') {
            $this->yes = '';
            $this->no = 'option2';
            $this->is_direct = false;
            $this->emit('mediators-show', $this->is_direct);
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
                $validation[$field] = ['unique:real_estates,land_number', 'nullable'];
                continue;
            }

            if ($field == "block_number") {
                $validation[$field] = ['unique:real_estates,block_number', 'nullable'];
                continue;
            }

            if ($field == "real_estate_statement") {
                $validation[$field] = ['unique:real_estates,block_number', 'nullable'];
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

    public function store(OfferService $offerService)
    {
        $this->price_by_meter = (int)str_replace(',', '', $this->price_by_meter);
        $this->total_price = (int)str_replace(',', '', $this->total_price);
        $this->price = (int)str_replace(',', '', $this->price);
        $this->space = (int)str_replace(',', '', $this->space);
        $this->floor_number = (int)str_replace(',', '', $this->floor_number);
        $this->floors_number = (int)str_replace(',', '', $this->floors_number);
        $this->flats_number = (int)str_replace(',', '', $this->flats_number);
        $this->stores_number = (int)str_replace(',', '', $this->stores_number);
        $this->flat_rooms_number  = (int)str_replace(',', '', $this->flat_rooms_number);
        $this->annual_income = (int)str_replace(',', '', $this->annual_income);

        $data = $this->validate();

        if ($this->is_direct) {
            $data['is_direct'] = true;
            $data['mediators_ids'] = [];
        }

        if (!$this->is_direct) {
            $data['is_direct'] = false;
        }

        $offer = $offerService->store($data);

        if ($offer) {
            return redirect()->route('panel.offers')->with('message', 'تم إنشاء العرض بنجاح');
        }
    }
}
