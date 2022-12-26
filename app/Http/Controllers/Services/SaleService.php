<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Offer;
use App\Models\PaymentMethod;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleService extends Controller
{

    public function createCustomer($data)
    {
        $user = auth()->user();

        return Customer::create([
            'user_id' => $user->id,
            'name' => $data['customer_name'],
            'phone' => $data['customer_phone'],
            'email' => $data['customer_email'],
            // 'employer_id' => $data['customer_email'],
            'nationality_country' => $data['customer_nationality'],
            'employer_name' => null,
            'nationality_id' => $data['customer_id_number'],
            // 'NID',
            'city_id' => $data['customer_city_name'],
            'building_number' => $data['building_number'],
            'street_name' => $data['street_name'],
            'neighborhood_name' => $data['neighborhood_name'],
            'zip_code' => $data['zip_code'],
            'addtional_number' => $data['addtional_number'],
            'unit_number' => $data['unit_number'],
            'support_eskan' => $data['support_eskan'],
            'employee_type' => $data['employee_type'],
            'status' => 1,
            'is_buy' => 1,
            'who_add' => $user->id,
            // 'who_edit',
        ]);
    }

    public function updateCustomer($customer, $data)
    {

        $customer->update([
            'name' => $data['customer_name'],
            'phone' => $data['customer_phone'],
            'email' => $data['customer_email'],
            'nationality_country' => $data['customer_nationality'],
            'nationality_id' => $data['customer_id_number'],
            'city_id' => $data['customer_city_name'],
            'building_number' => $data['building_number'],
            'street_name' => $data['street_name'],
            'neighborhood_name' => $data['neighborhood'],
            'zip_code' => $data['zip_code'],
            'addtional_number' => $data['addtional_number'],
            'unit_number' => $data['unit_number'],
            'support_eskan' => $data['support_eskan'],
            'employee_type' => $data['employee_type'],
            'who_edit' => auth()->id(),
        ]);

        return Customer::find($customer->id);
    }

    public function store($data)
    {
        $customer = Customer::find($data['customer_id']);
        $customer_phone = Customer::where('phone', $data['customer_phone'])->first();

        if (!$customer) {
            if (!$customer_phone) {
                $customer = $this->createCustomer($data);
            } else {
                $customer = $this->updateCustomer($customer_phone, $data);
            }
        } else {
            $customer = $this->updateCustomer($customer, $data);
        }

        $user = auth()->user();
        $offer = Offer::find($data['offer_id']);
        $payment_method = PaymentMethod::find($data['payment_method_id']);
        $branch = Branch::find($offer->realEstate->branch->id);

        $sale = Sale::create([
            'sale_code' =>  '',
            'user_id' => $user->id,
            'offer_id' => $offer->id,
            'customer_id' => $customer->id,
            'real_estate_id' => $offer->realEstate->id,
            'order_id' => $offer->order ? $offer->order->id : null,
            'payment_method_id' => $payment_method->id,
            'vat' => $data['vat'],
            'saee_prc' => $data['saee_prc'],
            'saee_price' => $data['saee_price'],
            'tatal_req_amount' => $data['total_price'],
            'paid_amount' => $data['paid_amount'],
            'who_add' => $user->id,
            // 'who_edit',
            // 'who_cancel',
        ]);

        $sale_code = $branch->code . '-' . $sale->id . '-' . 'USR' . $user->id;

        $sale->update(['sale_code' => $sale_code]);

        return true;
    }

    public function update($sale_id, $data)
    {
        $customer = Customer::find($data['customer_id']);
        $customer_phone = Customer::where('phone', $data['customer_phone'])->first();

        if (!$customer) {
            if (!$customer_phone) {
                $customer = $this->createCustomer($data);
                $sale = Sale::with(['offer.realEstate.neighborhood', 'customer.nationality'])->find($sale_id);

                $sale->update([
                    'customer_id' => $customer->id,
                    'payment_method_id' => $data['payment_method_id'],
                    'vat' => $data['vat'],
                    'saee_prc' => $data['saee_prc'],
                    'saee_price' => $data['saee_price'],
                    'tatal_req_amount' => $data['total_price'],
                    'paid_amount' => $data['paid_amount'],
                    'who_edit' => auth()->id(),
                ]);

                return true;
            } else {
                $customer = $customer_phone;
            }
        }

        $sale = Sale::with(['offer.realEstate.neighborhood', 'customer.nationality'])->find($sale_id);

        $this->updateCustomer($customer, $data);

        $sale->update([
            'customer_id' => $customer->id,
            'payment_method_id' => $data['payment_method_id'],
            'vat' => $data['vat'],
            'saee_prc' => $data['saee_prc'],
            'saee_price' => $data['saee_price'],
            'tatal_req_amount' => $data['total_price'],
            'paid_amount' => $data['paid_amount'],
            'who_edit' => auth()->id(),
        ]);

        return true;
    }
}
