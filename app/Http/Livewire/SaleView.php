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
    public $last_update_time;

    public function mount($sale_id)
    {
        $this->sale_id = $sale_id;
        $this->setData($sale_id);
    }

    public function setData($sale_id)
    {
        $sale = Sale::with(['offer', 'order', 'customer', 'realEstate'])->find($sale_id);
        $this->sale = $sale;
        $customer_buyer = Customer::find($sale->customer_buyer_id);
        $customer_seller = Customer::find($sale->customer_seller_id);
        $realEstate = $sale->realEstate;

        $obj = new Arabic('Numbers');

        $data = [
            'sale_created_at' => (string)$this->sale->created_at->format('Y-m-d'),
            'sale_code' => $this->sale->sale_code,
            'city_name' => $realEstate->city->name,
            'customer_name' => auth()->user()->name,

            #First Customer
            'customer_buyer_adj' => $customer_buyer->adj,
            'customer_buyer_name' => $customer_buyer->name,
            'customer_buyer_id_type' => "لا اعلم",
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
            'customer_seller_id_type' => "لا اعلم",
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
        $this->pdf_path = $pDFService->writePdf($data);
        $this->pdf_path = asset('assets/pdfjs/web/viewer.html?file=madar.pdf');
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
        $path = public_path('assets/pdfjs/web/madar.pdf');
        return $pDFService->exportPdf($path, $this->sale->sale_code);
    }
}
