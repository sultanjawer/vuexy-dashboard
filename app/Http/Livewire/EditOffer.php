<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Services\MediatorService;
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

    protected $listeners = ['setMediatorsIds', 'setIds', 'setNeiborhoods', 'refreshSelect2' => '$refresh'];
    public $land_fields = ['price_by_meter', 'direction_ids', 'land_type_id', 'licensed_id', 'street_width_ids', 'interface_length_id', 'interface_length', 'character'];
    public $duplex_fields = ['price_by_meter',  'direction_ids', 'land_type_id', 'licensed_id', 'street_width_ids', 'interface_length_id', 'interface_length', 'character', 'real_estate_age', 'building_type_id', 'building_status_id', 'construction_delivery_id'];
    public $condominium_fields = ['real_estate_age', 'floors_number', 'flats_number', 'stores_number', 'flat_rooms_number', 'annual_income',];
    public $flat_fields = ['floor_number', 'real_estate_age', 'bathroom_number', 'flat_rooms_number'];
    public $chalet_fields = ['direction_ids', 'street_width_ids', 'owner_ship_type_id', 'real_estate_age'];
    public $main_fields = ['city_id', 'neighborhood_id', 'land_number',  'real_estate_statement', 'block_number', 'notes', 'space', 'property_type_id', 'mediators_ids', 'branch_id', 'total_price',];

    #Form One
    public $city_id = 1;
    public $city;
    public $neighborhood_id = 1;
    public $land_number;
    public $block_number;
    public $real_estate_statement = '';
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
        $this->land_type_id = $offer->realEstate->land_type_id;
        $this->licensed_id = $offer->realEstate->licensed_id;
        $this->street_width_ids = $offer->realEstate->streetWidths->pluck('id')->toArray();
        $this->direction_ids = $offer->realEstate->directions->pluck('id')->toArray();
        $this->mediators_ids = $offer->mediators->pluck('id')->toArray();
        $this->branch_id = $offer->realEstate->branch_id;
        $this->interface_length_id = $offer->realEstate->interface_length_id;
        $this->interface_length = $offer->realEstate->interface_length;
        $this->character  = $offer->realEstate->character;
        $this->owner_ship_type_id = $offer->realEstate->owner_ship_type_id;
        $this->real_estate_age = $offer->realEstate->real_estate_age;
        $this->floor_number = $offer->realEstate->floor_number;
        $this->floors_number = $offer->realEstate->floors_number;
        $this->bathroom_number = $offer->realEstate->bathroom_number;
        $this->real_estate_statement = $offer->realEstate->real_estate_statement;
        $this->flats_number = $offer->realEstate->flats_numbers;
        $this->stores_number = $offer->realEstate->stores_number;
        $this->flat_rooms_number = $offer->realEstate->flat_rooms_number;
        $this->annual_income = $offer->realEstate->annual_income;
        $this->building_type_id = $offer->realEstate->building_type_id;
        $this->building_status_id = $offer->realEstate->building_status_id;
        $this->construction_delivery_id = $offer->realEstate->construction_delivery_id;
        $this->yes = $offer->offer_type_id == 1 ? $this->yes = 'option1' : $this->no = 'option2';
        $this->is_direct = $offer->offer_type_id == 1 ? true : false;
        $this->setNeiborhoods();
    }

    public function setIds()
    {
        $array = [];
        $array['mediators_ids'] = $this->mediators_ids;
        $array['direction_ids'] = $this->direction_ids;
        $array['street_width_ids'] = $this->street_width_ids;
        $this->emit('setids', $array, $this->is_direct);
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

    public function isDirectOffer($check)
    {
        $this->no = '';
        $this->yes = '';

        if ($check == 'yes') {
            $this->yes = 'option1';
            $this->is_direct = true;
            $this->emit('mediators-show', $this->is_direct);
            $this->emit('mediatorsIds', $this->mediators_ids, $this->is_direct);
        }

        if ($check == 'no') {
            $this->no = 'option2';
            $this->is_direct = false;
            $this->emit('mediators-show', $this->is_direct);
            $this->emit('mediatorsIds', $this->mediators_ids, $this->is_direct);
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
                $validation[$field] = ['nullable'];
                continue;
            }

            if ($field == "block_number") {
                $validation[$field] = ['nullable'];
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
                $validation[$field . '.required'] = 'هذا الحقل مطلوب';
                continue;
            }

            if ($field == "block_number") {
                $validation[$field . '.required'] = 'هذا الحقل مطلوب';
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

    public function render()
    {
        return view('livewire.edit-offer');
    }

    public function update(OfferService $offerService)
    {
        $this->price_by_meter = (float)str_replace(',', '', $this->price_by_meter);
        $this->total_price = (float)str_replace(',', '', $this->total_price);
        $this->space = (float)str_replace(',', '', $this->space);
        $this->floor_number = (int)str_replace(',', '', $this->floor_number);
        $this->floors_number = (int)str_replace(',', '', $this->floors_number);
        $this->flats_number = (int)str_replace(',', '', $this->flats_number);
        $this->stores_number = (int)str_replace(',', '', $this->stores_number);
        $this->bathroom_number = (int)str_replace(',', '', $this->bathroom_number);
        $this->flat_rooms_number  = (int)str_replace(',', '', $this->flat_rooms_number);
        $this->annual_income = (float)str_replace(',', '', $this->annual_income);

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

        if (in_array($this->property_type_id, [1, 2, 5])) {
            if (!$this->direction_ids) {
                $this->alert('warning', '', [
                    'toast' => true,
                    'position' => 'center',
                    'timer' => 6000,
                    'text' => 'يرجى اختيار اتجاه واحد على الأقل 😌',
                    'timerProgressBar' => true,
                ]);
                return false;
            }

            if (!$this->street_width_ids) {
                $this->alert('warning', '', [
                    'toast' => true,
                    'position' => 'center',
                    'timer' => 6000,
                    'text' => 'يرجى اختيار عرض شارع واحد على الأقل 😌',
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
