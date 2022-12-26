<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Services\SaleService;
use App\Models\Customer;
use App\Models\Sale;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EditSale extends Component
{
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['setCustomers', 'refreshComponent' => '$refresh', 'openSaleModal'];

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
    public $sale;
    public $sale_code;



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

    public function mount($sale_id)
    {
        $this->setData($sale_id);
        $this->setCustomersData();
    }

    public function render()
    {
        return view('livewire.edit-sale');
    }

    public function setData($sale_id)
    {
        $this->sale = Sale::with(['offer.realEstate.neighborhood', 'customer.nationality'])->find($sale_id);

        $customer = $this->sale->customer;
        $offer = $this->sale->offer;
        $nationality = $customer->nationality;
        $realEstate = $offer->realEstate;

        if ($this->sale) {
            $this->sale_code = $this->sale->sale_code;
            $this->offer_code = $offer->offer_code;
            $this->neighborhood_name = $realEstate->neighborhood->name;
            $this->land_number = $realEstate->land_number;
            $this->space = number_format($realEstate->space);
            $this->price = number_format($realEstate->total_price);
            $this->vat = $this->sale->vat;
            $this->saee_type = $this->sale->saee_prc ? 'saee_prc' : 'saee_price';
            $this->saee_prc  = $this->sale->saee_prc;
            $this->saee_price = number_format($this->sale->saee_price);
            $this->total_price = number_format($realEstate->total_price);
            $this->paid_amount = number_format($this->sale->paid_amount);
            // $this->customer_id = $this->sale->customer->id;
            $this->customer_name = $this->sale->customer->name;
            $this->customer_phone = $this->sale->customer->phone;
            $this->customer_email = $this->sale->customer->email;
            $this->customer_id_number = $customer->nationality_id;
            $this->customer_nationality = $nationality ? $nationality->id : null;
            $this->customer_city_name = $customer->city->id;
            $this->employee_type = $customer->employee_type;
            $this->customer_support_eskan = $customer->support_eskan ? $this->yes = 'option1' : $this->no = 'option2';
            $this->public = $this->employee_type == 'public' ? 'option1' : '';
            $this->private = $this->employee_type == 'private' ? 'option2' : '';
            $this->building_number = $customer->building_number;
            $this->street_name = $customer->street_name;
            $this->neighborhood = $customer->neighborhood_name;
            $this->zip_code = $customer->zip_code;
            $this->addtional_number = $customer->addtional_number;
            $this->unit_number = $customer->unit_number;
        }
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
        $customer = Customer::find($this->customer_id);

        if ($customer) {
            $this->customer = $customer;
            $this->customer_name = $this->customer->name;
            $this->customer_phone = $this->customer->phone;
            $this->customer_email = $this->customer->email;
            $this->customer_id_number = $this->customer->nationality_id;
            $this->customer_nationality = $this->customer->nationality ? $this->customer->nationality->name : null;
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

        $this->validate();
    }

    public function setCustomersData()
    {
        $customers = Customer::get(['id', 'phone', 'name', 'nationality_id']);
        $this->customers = $customers;
    }

    public function update(SaleService $saleService)
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

        $result = $saleService->update($this->sale->id, $data);

        if ($result) {
            return redirect()->route('panel.sales')->with('message', 'تم تحديث الصفقة بنجاح');
        }
    }
}
