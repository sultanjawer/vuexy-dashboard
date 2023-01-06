<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Services\MediatorService;
use App\Http\Controllers\Services\OfferService;
use App\Models\City;
use App\Models\Mediator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CreateOffer extends Component
{
    use LivewireAlert;

    protected $listeners = ['setMediatorsIds', 'setNeiborhoods', 'refreshSelect2' => '$refresh'];
    public $land_fields = ['price_by_meter',  'direction_ids', 'land_type_id', 'licensed_id', 'street_width_ids', 'interface_length_id', 'interface_length', 'character'];
    public $duplex_fields = ['price_by_meter', 'direction_ids', 'land_type_id', 'licensed_id', 'street_width_ids', 'interface_length_id', 'interface_length', 'character', 'real_estate_age', 'building_type_id', 'building_status_id', 'construction_delivery_id'];
    public $condominium_fields = ['real_estate_age', 'floors_number', 'flats_number', 'stores_number', 'flat_rooms_number', 'annual_income',];
    public $flat_fields = ['floor_number', 'real_estate_age', 'bathroom_number', 'flat_rooms_number'];
    public $chalet_fields = ['direction_ids', 'street_width_ids', 'owner_ship_type_id', 'real_estate_age'];
    public $main_fields = ['city_id', 'neighborhood_id', 'land_number', 'real_estate_statement', 'block_number', 'notes', 'space', 'property_type_id', 'mediators_ids', 'branch_id', 'total_price',];

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
    public $interface_length = 0.0;
    public $bathroom_number = 0.0;
    public $character = '';

    public $owner_ship_type_id = 1;
    public $real_estate_age;

    public $floor_number = 0;
    public $floors_number = 0;
    public $flats_number = 0;
    public $stores_number = 0;
    public $flat_rooms_number = 0;
    public $annual_income = 0;

    public $building_type_id = 1;
    public $building_status_id = 1;
    public $construction_delivery_id = 1;

    public $name = '';
    public $phone_number = '';
    public $type = 'office';

    #Form Three
    public $yes = '';
    public $no = 'option2';
    public $is_direct = false;
    public $mediators_ids = [];
    public $mediators = [];

    #Switching
    public $first = 'active';
    public $second = '';
    public $third = '';

    public $neighborhoods_json;

    public function mount()
    {
        $branches = getBranchesUser();
        if ($branches->count()) {
            $branch = $branches->first();
            if ($branch) {
                $this->branch_id = $branch->id;
            }
        }
        $this->mediators = getMediators();
    }

    public function hydrate()
    {
        $this->emit('select2', $this->mediators_ids);
    }

    public function setMediatorsIds()
    {
        $this->emit('refreshSelect2');
    }

    public function render()
    {
        return view('livewire.create-offer');
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
                $validation[$field] = ['nullable'];
                continue;
            }

            if ($field == "real_estate_age") {
                $validation[$field] = ['numeric', 'required'];
                continue;
            }

            if ($field == "interface_length") {
                $validation[$field] = ['numeric', 'required'];
                continue;
            }

            if ($field == "annual_income") {
                $validation[$field] = ['numeric', 'required'];
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
                continue;
            }

            if ($field == "block_number") {
                $validation[$field . '.unique'] = 'رقم الأرض موجود بالفعل';
                continue;
            }

            if ($field == "interface_length") {
                $validation[$field . '.numeric'] = 'الحقل يقبل ارقام فقط';
                $validation[$field . '.required'] = 'هذا الحقل مطلوب';
                continue;
            }

            if ($field == "real_estate_age") {
                $validation[$field . '.numeric'] = 'الحقل يقبل ارقام فقط';
                $validation[$field . '.required'] = 'هذا الحقل مطلوب';
                continue;
            }

            if ($field == "annual_income") {
                $validation[$field . '.numeric'] = 'الحقل يقبل ارقام فقط';
                $validation[$field . '.required'] = 'هذا الحقل مطلوب';
                continue;
            }

            $validation[$field . '.required'] = 'هذا الحقل مطلوب';
        }

        return $validation;
    }

    public function isDirectOffer($check)
    {
        $this->no = '';
        $this->yes = '';

        if ($check == 'yes') {
            $this->yes = 'option1';
            $this->is_direct = true;
            $this->emit('mediators-show', $this->is_direct);
        }

        if ($check == 'no') {
            $this->no = 'option2';
            $this->is_direct = false;
            $this->emit('mediators-show', $this->is_direct);
        }
    }

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

    public function updated($propertyName, $value)
    {
        if ($propertyName == 'city_id') {
            $this->setNeiborhoods();
        }

        if ($propertyName == 'property_type_id') {
            $this->changePropertyType();
        }

        $this->validateOnly($propertyName);
    }

    public function is_numeric($name, $value)
    {
        $string_value = str_replace(',', '', $value);
        $float_value = (float)$string_value;
        $after_comma = explode('.', $string_value);
        $count = 0;

        if (array_key_exists(1, $after_comma)) {
            foreach ($after_comma as $num) {
                $count = $count + 1;
            }
        }

        if (is_numeric($string_value)) {
            $this->fill([$name => number_format($float_value, $count)]);
        } else {
            $this->validate([$name => 'numeric'], [$name . '.numeric' => "الحقل يقبل ارقام فقط"]);
        }
        return $float_value;
    }

    public function changePropertyType()
    {
        $this->space = 0;
        $this->price_by_meter = 0;
        $this->total_price = 0;
    }

    public function space()
    {
        $space = $this->is_numeric('space', $this->space);
        $price_by_meter = $this->is_numeric('price_by_meter', $this->price_by_meter);

        if ($space && $price_by_meter) {
            $total_price = $space * $price_by_meter;
            $this->is_numeric('total_price', $total_price);
        }
    }

    public function priceByMeter()
    {
        $space = $this->is_numeric('space', $this->space);
        $price_by_meter = $this->is_numeric('price_by_meter', $this->price_by_meter);

        if ($space && $price_by_meter) {
            $total_price = $space * $price_by_meter;
            $this->is_numeric('total_price', $total_price);
        }
    }

    public function totalPrice()
    {
        $this->is_numeric('total_price', $this->total_price);
    }

    public function store(OfferService $offerService)
    {
        $this->price_by_meter = (float)str_replace(',', '', $this->price_by_meter);
        $this->total_price = (float)str_replace(',', '', $this->total_price);
        $this->space = (float)str_replace(',', '', $this->space);
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

    public function createMediator(MediatorService $mediatorService)
    {
        $data = $this->validate([
            'name' => ['required'],
            'phone_number' => ['required', 'unique:mediators,phone_number'],
            'type' => ['nullable', 'in:office,individual'],
        ], [
            'name.required' => 'هذا الحقل مطلوب',
            'phone_number.required' => 'هذا الحقل مطلوب',
            'phone_number.unique' => 'رقم هاتف مستخدم، ادخل رقما مختلف',
            'type.required' => 'هذا الحقل مطلوب',
        ]);

        $new_mediator = $mediatorService->store($data);

        $mediators = Mediator::get(['id', 'name', 'phone_number'])->toArray();


        foreach ($mediators as $key => $mediator) {

            foreach ($mediator as $index => $value) {

                if ($index == 'id') {
                    if (in_array($value, $this->mediators_ids)) {
                        $mediator['selected'] = true;
                    }
                }

                if ($index == 'name') {
                    $mediator['text'] = $value . ' :: ' . $mediator['phone_number'];
                    unset($mediator['name']);
                    $mediators[$key] = $mediator;
                }
            }
        }

        array_push($mediators, [
            "id" => $new_mediator->id,
            "selected" => true,
            "text" =>  $new_mediator->name . '::' . $new_mediator->phone_number,
        ]);

        array_push($this->mediators_ids, $new_mediator->id);

        $mediators_json = json_decode(json_encode($mediators));

        $this->emit('submitMediator', $mediators_json);

        $this->alert('success', '', [
            'toast' => true,
            'position' => 'center',
            'timer' => 3000,
            'text' => '👍 تم إضافة الوسيط بنجاح',
            'timerProgressBar' => true,
        ]);
    }
}
