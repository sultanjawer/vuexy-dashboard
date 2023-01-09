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

    public $offer_code = "";
    public $neighborhood_name = "";
    public $land_number = "";
    public $space = 0;
    public $saee_type = "saee_prc";

    public $seller_adj = '';
    public $buyer_adj = '';

    public $price = 0;
    public $deserved_amount = 0;
    public $vat = 0;
    public $saee_prc = 0;
    public $saee_price = 0;
    public $total_price = 0;
    public $paid_amount = 0;
    public $price_sub = 0;
    public $still_amount = 0;
    public $check_number = '';
    public $bank_id = 1;
    public $message_vat = '';
    public $deserved_amount_mesage = '';
    public $deserved_amount_success = '';
    public $success_message_vat = '';
    public $message_paid_amount = '';
    public $success_message_saee_prc = '';
    public $error_message_saee_prc = '';
    public $who_receive = '';


    public $customer_buyer_nationality_type = '';
    public $customer_seller_nationality_type = '';

    #Recieved Offer
    public $offer;
    public $order;
    public $offer_id;

    public $is_first_yes = '';
    public $is_first_no = 'option2';

    public $customer_seller = "";
    public $customer_buyer = "";

    public $cash = "";
    public $check = 'option2';
    public $bank = '';

    public $customers = [];
    public $customers_ids = "";

    // Buyer Customer
    public $customer_buyer_id = "";
    public $customer_buyer_name = "";
    public $customer_buyer_phone = "";
    public $customer_buyer_email = "";
    public $customer_buyer_id_number = "";
    public $customer_buyer_nationality = 3;
    public $customer_buyer_city_name = "";
    public $customer_buyer_employee_type = "";
    public $customer_buyer_support_eskan = "";
    public $customer_buyer_public = "";
    public $customer_buyer_private = "";
    public $customer_buyer_yes = "";
    public $customer_buyer_no = "";

    #Form Three
    public $customer_buyer_building_number = "";
    public $customer_buyer_street_name = "";
    public $customer_buyer_neighborhood = "";
    public $customer_buyer_zip_code = "";
    public $customer_buyer_addtional_number = "";
    public $customer_buyer_unit_number = "";

    // Seller Customer
    public $customer_seller_id = "";
    public $customer_seller_name = "";
    public $customer_seller_phone = "";
    public $customer_seller_email = "";
    public $customer_seller_id_number = "";
    public $customer_seller_nationality = 3;
    public $customer_seller_city_name = "";
    public $customer_seller_employee_type = "";
    public $customer_seller_support_eskan = "";
    public $customer_seller_public = "";
    public $customer_seller_private = "";
    public $customer_seller_yes = "";
    public $customer_seller_no = "";

    #Form Three
    public $customer_seller_building_number = "";
    public $customer_seller_street_name = "";
    public $customer_seller_neighborhood = "";
    public $customer_seller_zip_code = "";
    public $customer_seller_addtional_number = "";
    public $customer_seller_unit_number = "";

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
        'who_receive',

        #Customer Buyer
        'customer_buyer_name',
        'customer_buyer_phone',
        'customer_buyer_email',
        'customer_buyer_id_number',
        'customer_buyer_nationality',
        'customer_buyer_city_name',
        'customer_buyer_building_number',
        'customer_buyer_street_name',
        'customer_buyer_neighborhood',
        'customer_buyer_zip_code',
        'customer_buyer_addtional_number',
        'customer_buyer_unit_number',
        'customer_buyer_nationality_type',

        #Customer Seller
        'customer_seller_name',
        'customer_seller_phone',
        'customer_seller_email',
        'customer_seller_id_number',
        'customer_seller_nationality',
        'customer_seller_city_name',
        'customer_seller_building_number',
        'customer_seller_street_name',
        'customer_seller_neighborhood',
        'customer_seller_zip_code',
        'customer_seller_addtional_number',
        'customer_seller_unit_number',
        'customer_seller_nationality_type',
    ];

    public function mount($offer_id)
    {
        $this->offer = Offer::with(['realEstate'])->find($offer_id);
        $this->offer_id = $offer_id;
        $this->setSaleData();
        $this->customers  = Customer::get(['id', 'phone', 'name', 'nationality_id']);
    }

    public function setSaleData()
    {
        #Offer Fields
        $this->offer_code = $this->offer->offer_code;
        $this->neighborhood_name = $this->offer->realEstate->neighborhood->name;
        $this->land_number = $this->offer->realEstate->land_number;
        $this->space = number_format($this->offer->realEstate->space);
        $this->price = number_format($this->offer->realEstate->total_price);
        $this->total_price =  number_format($this->offer->realEstate->total_price);
        $this->vat = 0;
        $this->saee_prc = 0;
        $this->check_number = '';
        $this->bank_id = 1;
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


        if ($this->check) {
            $validation['check_number'] = ['required'];
            if (($key = array_search('bank_id', $validation)) !== false) {
                unset($validation[$key]);
            }
        }

        if ($this->bank) {
            $validation['bank_id'] = ['required'];
            if (($key = array_search('check_number', $validation)) !== false) {
                unset($validation[$key]);
            }
        }

        if ($this->is_first_yes) {
            $validation['deserved_amount'] = ['required'];
        }

        return $validation;
    }

    public function messages()
    {
        $fields = $this->fields;

        $validation = [];

        foreach ($fields as $field) {
            $validation[$field . '.required'] = "هذا الحقل مطلوب";
        }

        if ($this->check) {
            $validation['check_number.required'] = "هذا الحقل مطلوب";
            if (($key = array_search('bank_id', $validation)) !== false) {
                unset($validation[$key]);
            }
        }

        if ($this->bank) {
            $validation['bank_id.required'] = "هذا الحقل مطلوب";
            if (($key = array_search('check_number', $validation)) !== false) {
                unset($validation[$key]);
            }
        }

        if ($this->is_first_yes) {
            $validation['deserved_amount.required'] = "هذا الحقل مطلوب";
        }

        return $validation;
    }

    public function setCustomerBuyer()
    {
        $this->customer_buyer = Customer::find($this->customer_buyer_id);

        if ($this->customer_buyer) {
            $this->customer_buyer_name = $this->customer_buyer->name;
            $this->customer_buyer_phone = $this->customer_buyer->phone;
            $this->customer_buyer_email = $this->customer_buyer->email;
            $this->customer_buyer_id_number = $this->customer_buyer->nationality_id;
            $this->customer_buyer_nationality = $this->customer_buyer->nationality ? $this->customer_buyer->nationality->id : null;
            $this->customer_buyer_city_name = $this->customer_buyer->city_id;
            $this->customer_buyer_building_number = $this->customer_buyer->building_number;
            $this->customer_buyer_street_name = $this->customer_buyer->street_name;
            $this->customer_buyer_neighborhood = $this->customer_buyer->neighborhood_name;
            $this->customer_buyer_zip_code = $this->customer_buyer->zip_code;
            $this->customer_buyer_support_eskan = $this->customer_buyer->support_eskan;
            $this->customer_buyer_addtional_number = $this->customer_buyer->addtional_number;
            $this->customer_buyer_unit_number = $this->customer_buyer->unit_number;
            $this->customer_buyer_nationality_type = $this->customer_buyer->nationality_type;

            if ($this->customer_buyer->employee_type == 'public') {
                $this->customer_buyer_public = 'option1';
                $this->customer_buyer_private = '';
            } else {
                $this->customer_buyer_public = '';
                $this->customer_buyer_private = 'option2';
            }

            if ($this->customer_buyer->support_eskan) {
                $this->customer_buyer_yes = 'option1';
                $this->customer_buyer_no = '';
            } else {
                $this->customer_buyer_yes = '';
                $this->customer_buyer_no = 'option2';
            }

            $this->emit('message_buyer', 'لقد تم جلب بيانات العميل بنجاح 👍✅', true);
        } else {
            $this->customer_buyer_phone = $this->customer_buyer_id;
            $this->emit('message_buyer', '‼️ بيانات العميل غير موجودة، ولكن سيتم إعتماد البيانات المدخلة للعميل، يرجى إدخال جميع الحقول ‼️', false);
            $this->customer_buyer_private = '';
            $this->customer_buyer_public = 'option1';
        }
    }

    public function setCustomerSeller()
    {
        $this->customer_seller = Customer::find($this->customer_seller_id);

        if ($this->customer_seller) {
            $this->customer_seller_name = $this->customer_seller->name;
            $this->customer_seller_phone = $this->customer_seller->phone;
            $this->customer_seller_email = $this->customer_seller->email;
            $this->customer_seller_id_number = $this->customer_seller->nationality_id;
            $this->customer_seller_nationality = $this->customer_seller->nationality ? $this->customer_seller->nationality->id : null;
            $this->customer_seller_city_name = $this->customer_seller->city_id;
            $this->customer_seller_building_number = $this->customer_seller->building_number;
            $this->customer_seller_street_name = $this->customer_seller->street_name;
            $this->customer_seller_neighborhood = $this->customer_seller->neighborhood_name;
            $this->customer_seller_zip_code = $this->customer_seller->zip_code;
            $this->customer_seller_support_eskan = $this->customer_seller->support_eskan;
            $this->customer_seller_addtional_number = $this->customer_seller->addtional_number;
            $this->customer_seller_unit_number = $this->customer_seller->unit_number;
            $this->customer_seller_nationality_type = $this->customer_seller->nationality_type;

            if ($this->customer_seller->employee_type == 'public') {
                $this->customer_seller_public = 'option1';
                $this->customer_seller_private = '';
            } else {
                $this->customer_seller_public = '';
                $this->customer_seller_private = 'option2';
            }

            if ($this->customer_seller->support_eskan) {
                $this->customer_seller_yes = 'option1';
                $this->customer_seller_no = '';
            } else {
                $this->customer_seller_yes = '';
                $this->customer_seller_no = 'option2';
            }

            $this->emit('message_seller', 'لقد تم جلب بيانات العميل بنجاح 👍✅', true);
        } else {
            $this->customer_buyer_phone = $this->customer_buyer_id;
            $this->emit('message_seller', '‼️ بيانات العميل غير موجودة، ولكن سيتم إعتماد البيانات المدخلة للعميل، يرجى إدخال جميع الحقول ‼️', false);
            $this->customer_buyer_private = '';
            $this->customer_buyer_public = 'option1';
        }
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

    public function updated($propertyName, $value)
    {
        if ($propertyName == 'customer_buyer_id') {
            $this->setCustomerBuyer();
        }

        if ($propertyName == 'customer_seller_id') {
            $this->setCustomerSeller();
        }

        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.create-sale');
    }

    public function store(SaleService $saleService)
    {
        $this->paid_amount = (float)str_replace(',', '', $this->paid_amount);
        $this->saee_price = (float)str_replace(',', '', $this->saee_price);
        $this->price = (float)str_replace(',', '', $this->price);
        $this->total_price = (float)str_replace(',', '', $this->total_price);
        $this->vat = (float)str_replace(',', '', $this->vat);
        $this->saee_prc = (float)str_replace(',', '', $this->saee_prc);
        $this->deserved_amount = (float)str_replace(',', '', $this->deserved_amount);

        $data = $this->validate();

        $data['offer_id'] = $this->offer_id;
        $data['customer_buyer_id'] = $this->customer_buyer_id;
        $data['customer_seller_id'] = $this->customer_seller_id;
        $data['bank_id'] = $this->bank_id;
        $data['check_number'] = $this->check_number;
        $data['seller_adj'] = $this->seller_adj;
        $data['buyer_adj'] = $this->buyer_adj;
        $data['deserved_amount'] = (float)$this->deserved_amount;
        $data['customer_buyer_support_eskan'] = 1;
        $data['customer_seller_support_eskan'] = 1;

        if ($this->cash) {
            $data['payment_method_id'] = 1;
        }

        if ($this->check) {
            $data['payment_method_id'] = 2;
        }

        if ($this->bank) {
            $data['payment_method_id'] = 3;
        }

        if ($this->customer_buyer_public) {
            $data['customer_buyer_employee_type'] = 'public';
        }

        if ($this->customer_buyer_private) {
            $data['customer_buyer_employee_type'] = 'private';
        }

        if ($this->customer_seller_public) {
            $data['customer_seller_employee_type'] = 'public';
        }

        if ($this->customer_seller_private) {
            $data['customer_seller_employee_type'] = 'private';
        }

        if ($this->customer_seller_yes) {
            $data['customer_seller_support_eskan'] = 1;
        }

        if ($this->customer_seller_no) {
            $data['customer_seller_support_eskan'] = 0;
        }

        if ($this->customer_buyer_yes) {
            $data['customer_buyer_support_eskan'] = 1;
        }

        if ($this->customer_buyer_no) {
            $data['customer_buyer_support_eskan'] = 0;
        }

        if ($this->is_first_yes) {
            $data['is_first_home'] = 1;
        }

        if ($this->is_first_no) {
            $data['is_first_home'] = 2;
        }

        $result =  $saleService->store($data);

        if ($result) {
            return redirect()->route('panel.offers')->with('message', '👍 تم تحديث المبيعات بنجاح');
        }
    }

    public function isFirstHome($check)
    {
        $this->is_first_yes = '';
        $this->is_first_no = '';
        $this->deserved_amount = 0.0;

        if ($check == 'yes') {
            $this->is_first_yes = 'option1';
            $this->vat = 0;
            $this->deservedAmount();
            $this->vat();
        }

        if ($check == 'no') {
            $this->is_first_no = 'option2';
            $this->deserved_amount = 0.0;
            $this->vat();
        }
    }


    public function customerIdType($propertyName)
    {
        $value = $this->{$propertyName};
        if ($propertyName == 'customer_seller_id_number') {
            $this->{$propertyName} = $this->is_numeric($propertyName, $value);
        }

        if ($propertyName == 'customer_buyer_id_number') {
            $this->{$propertyName} =  $this->is_numeric($propertyName, $value);
        }
    }

    public function deservedAmount()
    {
        $deserved_amount = (float)$this->is_numeric('deserved_amount', $this->deserved_amount);
        $real_estate_price = (float)$this->offer->realEstate->total_price;
        $saee_prc = $this->is_numeric('saee_prc', $this->saee_prc);
        $saee_price = $this->is_numeric('saee_price', $this->saee_price);
        $vat = $this->is_numeric('vat', $this->vat);
        $total_price = 0;
        $process  = (float)(($deserved_amount * 5) / 100);

        dd($process, $deserved_amount);
        $this->deserved_amount_mesage = '';
        $this->deserved_amount_success = '';

        if ($real_estate_price > 1000000) {
            $deserved_amount = $real_estate_price - 1000000;
            $result  = number_format((float)(($deserved_amount * 5) / 100), 3);
            $process  = (float)(($deserved_amount * 5) / 100);
            $this->is_numeric('deserved_amount', $deserved_amount);
            $this->deserved_amount_mesage = "مقدار المبلغ المستحق $result ريال";

            $total_price = (float)($real_estate_price + $saee_prc + $process + $vat + $saee_price);
            $this->is_numeric('total_price', $total_price);
            return true;
        }

        $this->deserved_amount = 0.0;
        $this->deserved_amount_mesage = "مقدار المبلغ المستحق 0.0 ريال";
    }

    public function vat()
    {
        $this->success_message_vat = '';
        $this->message_vat = "";
        $real_estate_price = (float)$this->offer->realEstate->total_price;
        $vat = 0;
        $saee_prc = (float)$this->saee_prc;
        $total_price = 0;

        if ($this->vat > 100) {
            $this->vat = 0;
            $this->message_vat = "نسبة الضريبة بين 0 - 100";
            $this->success_message_vat = '';
            return false;
        }

        $vat = (float)$this->vat;
        $process = (float)(($real_estate_price * $vat) / 100);
        $saee_prc = (float)(($real_estate_price * $saee_prc) / 100);
        $total_price = (float)($real_estate_price + $saee_prc + $process);

        $result = number_format($process, 3);
        $this->is_numeric('total_price', $total_price);
        $this->success_message_vat = "مبلغ الضريبة من سعر العقار: $result ريال سعودي";
        $this->message_vat = '';
        $this->deservedAmount();
        $this->paidAmount();
    }

    public function changeSaeeType()
    {
        $this->price_sub = 0;
        $this->paid_amount = 0;
        $this->saee_price = 0;
        $this->total_price = 0;
        $this->saee_prc = 0;
        $this->emit('setSaee', $this->saee_type);
    }

    public function saeePrc()
    {
        $real_estate_price = (float)$this->offer->realEstate->total_price;
        $this->error_message_saee_prc = '';
        $this->success_message_saee_prc = '';
        $saee_prc = (float)$this->saee_prc;
        $total_price = 0;
        $vat = (float)$this->vat;

        if ($this->saee_prc > 100) {
            $this->saee_prc = 0;
            $this->error_message_saee_prc = 'نسبة الضريبة بين 0 - 100';
            return false;
        }

        $process = (float)(($real_estate_price * $saee_prc) / 100);
        $vat_prc = (float)(($real_estate_price * $vat) / 100);

        $total_price = (float)($real_estate_price + $vat_prc + $process);
        $result = number_format($process, 3);

        $this->success_message_saee_prc = "مبلغ السعي من سعر العقار: $result ريال سعودي";
        $this->is_numeric('total_price', $total_price);
        $this->is_numeric('saee_prc', $saee_prc);
        $this->deservedAmount();
        $this->paidAmount();
    }

    public function totalPrice()
    {
        $this->is_numeric('total_price', $this->total_price);
        $this->deservedAmount();
    }

    public function saeePrice()
    {
        $real_estate_price = $this->offer->realEstate->total_price;
        $saee_price = (float)$this->saee_price;
        $vat = (float)$this->vat;
        $process = ($real_estate_price * $vat) / 100;
        $total_price = $process + $real_estate_price + $saee_price;
        $this->is_numeric('total_price', $total_price);
        $this->is_numeric('saee_price', $saee_price);
        $this->deservedAmount();
        $this->paidAmount();
    }

    public function paidAmount()
    {
        $total_price = (float)$this->is_numeric('total_price', $this->total_price);
        $paid_amount =  (float)$this->is_numeric('paid_amount', $this->paid_amount);
        $this->message_paid_amount = '';

        if ($paid_amount > $total_price) {
            $this->message_paid_amount = "يجب ان يكون المبلغ أقل أو يساوي السعر الكلي للعرض";
            $this->still_amount = 0;
            $this->deservedAmount();
            return false;
        }

        $process = (float)($total_price - $paid_amount);
        $this->is_numeric('still_amount', $process);
        $this->deservedAmount();
    }

    public function paymentMethod($method)
    {
        $this->check = '';
        $this->cash = '';
        $this->bank = '';

        if ($method == 'cash') {
            $this->cash = 'option1';
            $this->bank_id = null;
            $this->check_number = null;
        }

        if ($method == 'check') {
            $this->check = 'option2';
            $this->bank_id = null;
        }

        if ($method == 'bank') {
            $this->bank = 'option3';
            $this->check_number = null;
        }
    }

    public function customerBuyerId()
    {
        $this->setCustomerBuyer();
    }

    public function customerSellerId()
    {
        $this->setCustomerSeller();
    }

    public function customerBuyerEskan($check)
    {
        $this->customer_buyer_no = '';
        $this->customer_buyer_yes = '';

        if ($check == 'yes') {
            $this->customer_buyer_yes = 'option1';
        }

        if ($check == 'no') {
            $this->customer_buyer_no = 'option2';
        }
    }

    public function customerSellerEskan($check)
    {
        $this->customer_seller_no = '';
        $this->customer_seller_yes = '';

        if ($check == 'yes') {
            $this->customer_seller_yes = 'option1';
        }

        if ($check == 'no') {
            $this->customer_seller_no = 'option2';
        }
    }

    public function customerBuyerType($type)
    {
        $this->customer_buyer_private = '';
        $this->customer_buyer_public = '';

        if ($type == 'public') {
            $this->customer_buyer_public = 'option1';
        }

        if ($type == 'private') {
            $this->customer_buyer_private = 'option2';
        }
    }

    public function customerSellerType($type)
    {
        $this->customer_seller_private = '';
        $this->customer_seller_public = '';

        if ($type == 'customer_seller_public') {
            $this->customer_seller_public = 'option1';
        }

        if ($type == 'customer_seller_private') {
            $this->customer_seller_private = 'option2';
        }
    }
}
