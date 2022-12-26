<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Services\SaleService;
use App\Models\Customer;
use App\Models\Offer;
use Livewire\Component;

class CreateSale extends Component
{

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['setCustomers', 'refreshComponent' => '$refresh'];

    #Form One
    public $offer_code;
    public $neighborhood_name;
    public $land_number;
    public $space;
    public $price;
    public $vat;
    public $saee_type;
    public $saee_prc;
    public $saee_price;
    public $total_price;
    public $paid_amount;

    #Form Two
    public $customer_id;
    public $customer_name;
    public $customer_phone;
    public $customer_email;
    public $customer_id_number;
    public $customer_nationality;
    public $customer_city_name;
    public $employee_type;
    public $customer_support_eskan;
    public $public = '';
    public $private = '';

    #Form Three
    public  $building_number;
    public  $street_name;
    public  $neighborhood;
    public  $zip_code;
    public  $addtional_number;
    public  $unit_number;

    #Recieved Offer
    public $offer;
    public $order;
    public $customer;
    public $offer_id;

    public $cash = '';
    public $check = 'option2';
    public $bank = '';

    public $yes = '';
    public $no = '';

    public $customers = [];
    public $customers_ids;
    public $value;

    public $fields = [

        #Offer
        'offer_code',
        'neighborhood_name',
        'land_number',
        'space',
        'price',
        'vat',
        'saee_prc',
        'saee_price',
        'total_price',
        'paid_amount',

        // 'cash',
        // 'check',
        // 'bank',

        #Customer
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_id_number',
        'customer_nationality',
        'customer_city_name',
        // 'employee_type',
        // 'public',
        // 'private',

        'building_number',
        'street_name',
        'neighborhood',
        'zip_code',
        'addtional_number',
        'unit_number',

    ];

    public function mount($offer_id)
    {
        $this->offer = Offer::find($offer_id);
        $this->offer_id = $offer_id;
        $this->setData();
        $this->searchCustomers();
    }

    public function setData()
    {
        #Offer Fields
        $this->offer_code = $this->offer->offer_code;
        $this->neighborhood_name = $this->offer->realEstate->neighborhood->name;
        $this->land_number = $this->offer->realEstate->land_number;
        $this->space = number_format($this->offer->realEstate->space);
        $this->price = number_format($this->offer->realEstate->total_price);
        $this->total_price = number_format($this->offer->realEstate->total_price);
        $this->vat = 0;
        $this->saee_prc = 0;
        $this->saee_price = number_format(0);
        $this->paid_amount = number_format(0);
    }

    public function rules()
    {
        $fields = $this->fields;

        $validation = [];

        foreach ($fields as $field) {

            if ($this->saee_type == 'saee_prc' && $field == 'saee_prc') {
                $validation[$field] = ['required'];
                if (($key = array_search('saee_price', $validation)) !== false) {
                    unset($validation[$key]);
                }
            }

            if ($this->saee_type == 'saee_price' && $field == 'saee_price') {
                $validation[$field] = ['required'];
                if (($key = array_search('saee_prc', $validation)) !== false) {
                    unset($validation[$key]);
                }
            }

            $validation[$field] = ['required'];
        }

        return $validation;
    }

    public function messages()
    {
        $fields = $this->fields;

        $validation = [];

        foreach ($fields as $field) {
            $validation[$field . '.required'] = "❌ هذا الحقل مطلوب ❌";
        }

        return $validation;
    }

    public function setCustomerData()
    {
        $this->customer = Customer::find($this->customer_id);

        if ($this->customer) {
            $this->customer_name = $this->customer->name;
            $this->customer_phone = $this->customer->phone;
            $this->customer_email = $this->customer->email;
            $this->customer_id_number = $this->customer->nationality_id;
            $this->customer_nationality = $this->customer->nationality ? $this->customer->nationality->id : null;
            $this->customer_city_name = $this->customer->city_id;
            $this->building_number = $this->customer->building_number;
            $this->street_name = $this->customer->street_name;
            $this->neighborhood = $this->customer->neighborhood_name;
            $this->zip_code = $this->customer->zip_code;
            $this->customer_support_eskan = $this->customer->support_eskan;
            $this->addtional_number = $this->customer->addtional_number;
            $this->unit_number = $this->customer->unit_number;

            if ($this->customer->employee_type == 'public') {
                $this->public = 'option1';
                $this->private = '';
            } else {
                $this->public = '';
                $this->private = 'option2';
            }
            $this->emit('message', 'لقد تم جلب بيانات العميل بنجاح 👍✅', true);
            $this->validate();
        } else {
            $this->customer_phone = $this->customer_id;
            $this->emit('message', '‼️ بيانات العميل غير موجودة، ولكن سيتم إعتماد البيانات المدخلة للعميل، يرجى إدخال جميع الحقول ‼️', false);
            $this->private = '';
            $this->public = 'option1';
            $this->validate();
        }
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

        if ($propertyName == 'customer_id') {
            $this->setCustomerData();
        }

        if ($propertyName == 'yes') {
            $this->yes = 'option1';
            $this->no = '';
        }

        if ($propertyName == 'no') {
            $this->yes = '';
            $this->no = 'option2';
        }

        if ($propertyName == 'public') {
            $this->private = '';
            $this->public = 'option1';
        }

        if ($propertyName == 'private') {
            $this->public = '';
            $this->private = 'option2';
        }

        if ($propertyName == 'cash') {
            $this->cash = 'option1';
            $this->check = '';
            $this->bank = '';
        }

        if ($propertyName == 'check') {
            $this->cash = '';
            $this->check = 'option2';
            $this->bank = '';
        }

        if ($propertyName == 'bank') {
            $this->cash = '';
            $this->check = '';
            $this->bank = 'option3';
        }

        if ($propertyName == 'saee_type') {
            $this->saee_type = $value;
            $this->emit('setSaee', $value);
        }

        if ($propertyName == "paid_amount" || $propertyName == 'saee_price' || $propertyName == 'price') {
            $this->is_numeric($propertyName, $value);
        }

        $this->validate();
    }

    public function searchCustomers()
    {
        $customers = Customer::get(['id', 'phone', 'name', 'nationality_id']);
        $this->customers = $customers;
    }

    public function render()
    {
        return view('livewire.create-sale');
    }

    public function store(SaleService $saleService)
    {

        $this->paid_amount = (int)str_replace(',', '', $this->paid_amount);
        $this->saee_price = (int)str_replace(',', '', $this->saee_price);
        $this->price = (int)str_replace(',', '', $this->price);
        $this->total_price = (int)str_replace(',', '', $this->total_price);

        $data = $this->validate();

        $data['offer_id'] = $this->offer_id;
        $data['customer_id'] = $this->customer_id;

        if ($this->cash) {
            $data['payment_method_id'] = 1;
        }

        if ($this->bank) {
            $data['payment_method_id'] = 2;
        }

        if ($this->check) {
            $data['payment_method_id'] = 3;
        }

        if ($this->public) {
            $data['employee_type'] = 'public';
        }

        if ($this->private) {
            $data['employee_type'] = 'private';
        }

        if ($this->yes) {
            $data['support_eskan'] = 1;
        }

        if ($this->no) {
            $data['support_eskan'] = 0;
        }

        $result =  $saleService->store($data);

        if ($result) {
            return redirect()->route('panel.sales')->with('message', '👍 تم تحديث المبيعات بنجاح');
        }
    }
}
