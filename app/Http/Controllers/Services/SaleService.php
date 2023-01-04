<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Offer;
use App\Models\OfferEditors;
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
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            // 'employer_id' => $data['customer_email'],
            'nationality_country' => $data['nationality_country'],
            'employer_name' => null,
            'nationality_id' => $data['nationality_id'],
            // 'NID',
            'city_id' => $data['city_id'],
            'building_number' => $data['building_number'],
            'street_name' => $data['street_name'],
            'neighborhood_name' => $data['neighborhood_name'],
            'zip_code' => $data['zip_code'],
            'addtional_number' => $data['addtional_number'],
            'unit_number' => $data['unit_number'],
            'adj' => $data['adj'] ?? 'نفسه',
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
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'nationality_country' => $data['nationality_country'],
            'nationality_id' => $data['nationality_id'],
            'city_id' => $data['city_id'],
            'building_number' => $data['building_number'],
            'street_name' => $data['street_name'],
            'neighborhood_name' => $data['neighborhood_name'],
            'zip_code' => $data['zip_code'],
            'addtional_number' => $data['addtional_number'],
            'adj' => $data['adj'] ?? 'نفسه',
            'unit_number' => $data['unit_number'],
            'support_eskan' => $data['support_eskan'],
            'employee_type' => $data['employee_type'],
            'who_edit' => auth()->id(),
        ]);

        return Customer::find($customer->id);
    }

    public function setCustomer($data, $id, $phone, $type)
    {
        if ($type == 'buyer') {
            $new_data = [
                'name' => $data['customer_buyer_name'],
                'phone' => $data['customer_buyer_phone'],
                'email' => $data['customer_buyer_email'],
                'nationality_country' => $data['customer_buyer_nationality'],
                'nationality_id' => $data['customer_buyer_id_number'],
                'city_id' => $data['customer_buyer_city_name'],
                'building_number' => $data['customer_buyer_building_number'],
                'street_name' => $data['customer_buyer_street_name'],
                'neighborhood_name' => $data['customer_buyer_neighborhood'],
                'zip_code' => $data['customer_buyer_zip_code'],
                'addtional_number' => $data['customer_buyer_addtional_number'],
                'unit_number' => $data['customer_buyer_unit_number'],
                'support_eskan' => $data['customer_buyer_support_eskan'],
                'employee_type' => $data['customer_buyer_employee_type'],
                'adj' => $data['buyer_adj'] ?? 'نفسه',
            ];
        }

        if ($type == 'seller') {
            $new_data = [
                'name' => $data['customer_seller_name'],
                'phone' => $data['customer_seller_phone'],
                'email' => $data['customer_seller_email'],
                'nationality_country' => $data['customer_seller_nationality'],
                'nationality_id' => $data['customer_seller_id_number'],
                'city_id' => $data['customer_seller_city_name'],
                'building_number' => $data['customer_seller_building_number'],
                'street_name' => $data['customer_seller_street_name'],
                'neighborhood_name' => $data['customer_seller_neighborhood'],
                'zip_code' => $data['customer_seller_zip_code'],
                'addtional_number' => $data['customer_seller_addtional_number'],
                'unit_number' => $data['customer_seller_unit_number'],
                'support_eskan' => $data['customer_seller_support_eskan'],
                'employee_type' => $data['customer_seller_employee_type'],
                'adj' => $data['seller_adj'] ?? 'نفسه',
            ];
        }

        $customer = Customer::find($id);
        $customer_phone = Customer::where('phone', $phone)->first();

        if (!$customer) {
            if (!$customer_phone) {
                $customer = $this->createCustomer($new_data);
            } else {
                $customer = $this->updateCustomer($customer_phone, $new_data);
            }
        } else {
            $customer = $this->updateCustomer($customer, $new_data);
        }

        return $customer;
    }

    public function store($data)
    {
        $customer_buyer = $this->setCustomer($data, $data['customer_buyer_id'], $data['customer_buyer_phone'], 'buyer');
        $customer_seller = $this->setCustomer($data, $data['customer_seller_id'], $data['customer_seller_phone'], 'seller');

        $user = auth()->user();
        $offer = Offer::find($data['offer_id']);
        $payment_method = PaymentMethod::find($data['payment_method_id']);
        $branch = Branch::find($offer->realEstate->branch->id);

        $sale = Sale::create([
            'sale_code' =>  '',
            'user_id' => $user->id,
            'offer_id' => $offer->id,
            'customer_id' => $customer_buyer->id,
            'customer_buyer_id' => $customer_buyer->id,
            'customer_seller_id' => $customer_seller->id,
            'real_estate_id' => $offer->realEstate->id,
            'order_id' => $offer->order ? $offer->order->id : null,
            'payment_method_id' => $payment_method->id,
            'is_first_home' => $data['is_first_home'],
            'bank_id' => $data['bank_id'],
            'check_number' => $data['check_number'],
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
        $sale->realEstate->update(['property_status_id' => 3]);

        if ($user->user_type == 'admin' || $user->user_type == 'superadmin') {
            $link_admin =  route('panel.user', $user->id);
            $admin = "<a href='$link_admin'>$user->name</a>";
            $note = "قام المدير $admin ببيع العرض";
        }

        if ($user->user_type == 'marketer') {
            $marketer_name = getUserName($user->id);
            $link_ma = route('panel.user', $user->id);
            $marketer = "<a href='$link_ma'> $marketer_name</a>";
            $note = "قام المسوق $marketer ببيع العرض";
        }

        if ($user->user_type == 'office') {
            $office_name = getUserName($user->id);
            $link_office = route('panel.user', $user->id);
            $office = "<a href='$link_office'> $office_name</a>";
            $note = "قام المكتب $office ببيع العرض";
        }

        OfferEditors::create([
            'offer_id' => $offer->id,
            'user_id' => $user->id,
            'note' => $note,
            'action' => 'sell',
        ]);

        return true;
    }

    public function update($sale_id, $data)
    {
        $customer_buyer = $this->setCustomer($data, $data['customer_buyer_id'], $data['customer_buyer_phone'], 'buyer');
        $customer_seller = $this->setCustomer($data, $data['customer_seller_id'], $data['customer_seller_phone'], 'seller');

        $sale = Sale::with(['offer.realEstate.neighborhood', 'customer.nationality'])->find($sale_id);

        $sale->update([
            'customer_id' => $customer_buyer->id,
            'payment_method_id' => $data['payment_method_id'],
            'vat' => $data['vat'],
            'saee_prc' => $data['saee_prc'],
            'bank_id' => $data['bank_id'],
            'is_first_home' => $data['is_first_home'],
            'check_number' => $data['check_number'],
            'saee_price' => $data['saee_price'],
            'tatal_req_amount' => $data['total_price'],
            'paid_amount' => $data['paid_amount'],
            'who_edit' => auth()->id(),
        ]);

        return true;
    }

    public function cancel($sale_id)
    {
        $sale = Sale::find($sale_id);
        $user = auth()->user();
        $real_estate = $sale->realEstate;
        $offer = $sale->offer;

        $real_estate->update(['property_status_id' => 1]);
        $sale->update([
            'sale_status' => 2
        ]);

        if ($user->user_type == 'admin' || $user->user_type == 'superadmin') {
            $link_admin =  route('panel.user', $user->id);
            $admin = "<a href='$link_admin'>$user->name</a>";
            $note = "قام المدير $admin بالغاء الاتفاقية";
        }

        if ($user->user_type == 'marketer') {
            $marketer_name = getUserName($user->id);
            $link_ma = route('panel.user', $user->id);
            $marketer = "<a href='$link_ma'> $marketer_name</a>";
            $note = "قام المسوق $marketer بإلغاء الاتفاقية";
        }

        if ($user->user_type == 'office') {
            $office_name = getUserName($user->id);
            $link_office = route('panel.user', $user->id);
            $office = "<a href='$link_office'> $office_name</a>";
            $note = "قام المكتب $office بالغاء الاتفاقية";
        }

        OfferEditors::create([
            'offer_id' => $offer->id,
            'user_id' => $user->id,
            'note' => $note,
            'action' => 'cancel',
        ]);

        return true;
    }
}
