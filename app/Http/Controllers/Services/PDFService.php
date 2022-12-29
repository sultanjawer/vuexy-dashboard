<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use mikehaertl\pdftk\Pdf;

class PDFService extends Controller
{

    protected $fillable =  [
        'sale_created_at' => "",
        'sale_code' => "",
        'city_name' => "",

        #First Customer
        'customer_buyer_adj' => "",
        'customer_buyer_name' => "",
        'customer_buyer_id_type' => "",
        'customer_buyer_id_number' => "",
        'customer_buyer_nationality' => "",
        'customer_buyer_phone' => "",
        'customer_buyer_city_name' => "",
        'customer_buyer_building_number' => "",
        'customer_buyer_street_name' => "",
        'customer_buyer_additional_number' => "",
        'customer_buyer_zip_code' => "",
        'customer_buyer_email' => "",

        #Second Customer
        'customer_seller_adj' => "",
        'customer_seller_name' => "",
        'customer_seller_id_type' => "",
        'customer_seller_id_number' => "",
        'customer_seller_nationality' => "",
        'customer_seller_phone' => "",
        'customer_seller_city_name' => "",
        'customer_seller_building_number' => "",
        'customer_seller_street_name' => "",
        'customer_seller_additional_number' => "",
        'customer_seller_zip_code' => "",
        'customer_seller_email' => "",

        #Real Estate Information
        'real_estate_statement' => "",
        'real_estate_space' => "",
        'real_estate_location' => "",
        'total_price' => "",
        'total_price_text' => "",
        'paid_amount' => "",
        'date_expire' => "",
        'amount_due' => "",
        'days' => "",
        'customer_buyer_name' => "",
        'customer_seller_name' => "",
    ];

    public function exportPdf($data)
    {
        $fillable = array_merge($this->fillable, $data);

        $original_pdf = public_path() . '/pdfs/madar.pdf';
        $temp_path = public_path('temp') . '/madar.pdf';

        $pdf = new Pdf($original_pdf, [
            'locale' => 'ar_SA.utf8',
            'procEnv' => [
                'LANG' => 'ar_SA.utf-8',
            ],
        ]);

        $pdf->tempDir = public_path('temp');

        $result = $pdf->fillForm($fillable)
            ->needAppearances()
            ->execute();

        if ($result === false) {
            dd($pdf->getError());
        }

        $content = file_get_contents((string) $pdf->getTmpFile());

        // return Response::download(public_path('madar.pdf'), 'madar.pdf', ['Content-Type: application/pdf']);
        return Response::download(public_path('madar.pdf'), 'madarr.pdf', ['Content-Type: application/pdf']);
    }
}
