<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Services\PDFService;
use App\Models\Customer;
use App\Models\Sale;
use ArPHP\I18N\Arabic;
use Livewire\Component;

class SaleView extends Component
{

    public $sale_id;
    public $sale;
    public $pdf_path;
    public $pdf_path_amount;
    public $last_update_time;
    public $paid_amount = 0;
    public $space = 0;

    public function mount($sale_id)
    {
        $this->sale_id = $sale_id;
        $this->setData($sale_id);
        $this->setPaidAmountData($sale_id);
    }

    public function setData($sale_id)
    {
        $sale = Sale::with(['offer', 'order', 'customer', 'realEstate'])->find($sale_id);
        $this->sale = $sale;
        $customer_buyer = Customer::find($sale->customer_buyer_id);
        $customer_seller = Customer::find($sale->customer_seller_id);
        $realEstate = $sale->realEstate;

        $obj = new Arabic('Numbers');

        $data_sale = [
            'sale_created_at' => (string)$this->sale->created_at->format('Y-m-d'),
            'sale_code' => $this->sale->sale_code,
            'city_name' => $realEstate->city->name,
            'customer_name' => auth()->user()->name,

            #First Customer
            'customer_buyer_adj' => $customer_buyer->adj,
            'customer_buyer_name' => $customer_buyer->name,
            'customer_buyer_id_type' => $customer_buyer->nationality_type,
            'customer_buyer_id_number' => $customer_buyer->nationality_id,
            'customer_buyer_nationality' => $customer_buyer->nationality->name,
            'customer_buyer_phone' => $customer_buyer->phone,
            'customer_buyer_city_name' => $customer_buyer->city->name,
            'customer_buyer_building_number' => $customer_buyer->building_number,
            'customer_buyer_street_name' => $customer_buyer->street_name,
            'customer_buyer_additional_number' => $customer_buyer->addtional_number,
            'customer_buyer_zip_code' => $customer_buyer->zip_code,
            'customer_buyer_email' => $customer_buyer->email,

            #Second Customer
            'customer_seller_adj' => $customer_seller->adj,
            'customer_seller_name' => $customer_seller->name,
            'customer_seller_id_type' => $customer_seller->nationality_type,
            'customer_seller_id_number' => $customer_seller->nationality_id,
            'customer_seller_nationality' => $customer_seller->nationality->name,
            'customer_seller_phone' => $customer_seller->phone,
            'customer_seller_city_name' => $customer_seller->city->name,
            'customer_seller_building_number' => $customer_seller->building_number,
            'customer_seller_street_name' => $customer_seller->street_name,
            'customer_seller_additional_number' => $customer_seller->addtional_number,
            'customer_seller_zip_code' => $customer_seller->zip_code,
            'customer_seller_email' => $customer_seller->email,

            #Real Estate Information
            'real_estate_statement' => $realEstate->real_estate_statement,
            'real_estate_space' => number_format($realEstate->space, 3),
            'real_estate_location' => $realEstate->city->name . ' ' . $realEstate->land_number . ' ' . $realEstate->block_number,
            'total_price' => number_format((float)$sale->tatal_req_amount, 3),
            'total_price_text' => $obj->int2str((float)$sale->tatal_req_amount),
            'paid_amount' => number_format((float)$sale->paid_amount, 3),
            'date_expire' => "01-02-2022",
            'amount_due' => number_format((float)($sale->tatal_req_amount - $sale->paid_amount), 3),
            'days' => "360",
            'customer_buyer_name' => $customer_buyer->name,
            'customer_seller_name' => $customer_seller->name,
        ];

        $pDFService = new PDFService();
        $pDFService->writePdf($data_sale, $sale->sale_code);
        $this->pdf_path = asset('assets/pdfjs/web/viewer.html?file=madar_platform.pdf');
    }

    public function setPaidAmountData($sale_id)
    {
        $sale = Sale::with(['offer', 'order', 'customer', 'realEstate'])->find($sale_id);
        $this->sale = $sale;
        $customer_buyer = Customer::find($sale->customer_buyer_id);
        $customer_seller = Customer::find($sale->customer_seller_id);
        $realEstate = $sale->realEstate;
        $this->is_numeric('paid_amount', $sale->paid_amount);
        $this->is_numeric('space', $realEstate->space);


        if ($realEstate->property_type_id == 1) {
            $add = "أرض " . $this->space . "م " .  "ب" . $realEstate->city->name . ' ' . $realEstate->character;
        }

        if ($realEstate->property_type_id == 2) {
            $add = "دبلكس " . $realEstate->buildingStatus->name . " " . $this->space . "م " .  "ب" . $realEstate->city->name . ' ' . $realEstate->character;
        }

        if ($realEstate->property_type_id == 3) {
            $add = "عمارة " . $this->space . "م " .  "ب" . $realEstate->city->name . ' ' . $realEstate->floors_number . 'طوابق';
        }

        if ($realEstate->property_type_id == 4) {
            $add = "شقة " . $this->space . "م " .  "ب" . $realEstate->city->name . ' ' . $realEstate->flat_rooms_number . ' غرف';
        }

        if ($realEstate->property_type_id == 5) {
            $add = "شاليه " . $this->space . "م " .  "ب" . $realEstate->city->name;
        }

        $real_estate_data_1 = "دفعة اتفاقية حجز رقم";
        $real_estate_data_2 = " " . $sale->sale_code;
        $real_estate_data_3 =  "   تخص   " . $add . " والمتبقي " . $this->paid_amount . " ريال";
        $real_estate_data_t = "دفعة رقم (1): " . "مجموع ماتم دفعه حتى تاريخه " . $this->paid_amount . " ريال";

        $data_deposit = [
            'sale_date' => $sale->created_at->format('Y-m-d'),
            'sale_code' => $sale->sale_code,
            'customer_buyer_name' => $customer_buyer->name,
            'customer_seller_name' => $customer_seller->name,
            'paid_amount' =>    "مبلغ  " .  $this->paid_amount . "   ريال فقط لا غير.",
            'check_number' => "شيك " . $sale->check_number,
            'real_estate_data_1' => $real_estate_data_1,
            'real_estate_data_2' => $real_estate_data_2,
            'real_estate_data_3' => $real_estate_data_3,
            'real_estate_data_t' => $real_estate_data_t,
        ];

        $pDFService = new PDFService();
        $pDFService->writePdfAmount($data_deposit, $sale->sale_code);
        $this->pdf_path_amount = asset('assets/pdfjs/web/viewer.html?file=deposit.pdf');
    }

    public function render()
    {
        $this->getLastUpateTime();
        return view('livewire.sale-view');
    }

    public function getLastUpateTime()
    {
        if ($this->sale) {
            if ($this->sale->updated_at) {
                $last_update = $this->sale->updated_at->toDateTimeString();
                $time_now = now();

                $datetime1 = strtotime($last_update);
                $datetime2 = strtotime($time_now);

                $secs = $datetime2 - $datetime1; // == <seconds between the two times>
                $min = $secs / 60;
                $hour = $secs / 3600;
                $days = $secs / 86400;


                if ($days > 0.99) {
                    $this->last_update_time = 'اخر تحديث منذ ' . round($days, 0) . ' يوم';
                    return true;
                }

                if ($hour > 0.99) {
                    $this->last_update_time = 'اخر تحديث منذ ' . round($hour, 0) . ' ساعة';
                    return true;
                }

                if ($min > 0.99) {
                    $this->last_update_time = 'اخر تحديث منذ ' . round($min, 0)  . ' دقيقة';
                    return true;
                }

                $this->last_update_time = 'اخر تحديث منذ ' . $secs . ' ثانية';
                return true;
            }
        }
    }

    public function download(PDFService $pDFService)
    {
        $path = public_path('assets/pdfjs/web/madar_platform.pdf');
        return $pDFService->exportPdf($path, $this->sale->sale_code);
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

    public function downloadAmount(PDFService $pDFService)
    {
        $path = public_path('assets/pdfjs/web/madar_platform_amount.pdf');
        return $pDFService->exportPdf($path, $this->sale->sale_code);
    }
}
