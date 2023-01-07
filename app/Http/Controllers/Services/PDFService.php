<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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

    public function writePdf($data, $code)
    {
        $fillable = array_merge($this->fillable, $data);

        $original_pdf = public_path() . '/pdfs/madar.pdf';
        $temp_path = public_path() . '/assets/pdfjs/web/madar.pdf';

        $pdf = new Pdf($original_pdf, [
            'locale' => 'ar_SA.utf8',
            'procEnv' => [
                'LANG' => 'ar_SA.utf-8',
            ],
            'command' => 'C:\Program Files (x86)\PDFtk\bin\pdftk.exe',
            'useExec' => true,
        ]);

        $result = $pdf->fillForm($fillable)
            ->needAppearances()
            ->saveAs($temp_path);

        $this->updateInfo($code);

        if ($result === false) {
            dd($pdf->getError());
        }

        $path = asset('madar_platform.pdf');
        return $path;
    }

    public function exportPdf($file_path, $name)
    {
        return Response::download($file_path, $name . '.pdf', ['Content-Type: application/pdf']);
    }

    public function updateInfo($title)
    {
        $path_text_file = public_path() . '/assets/pdfjs/web/pdf_metadata.txt';
        $path_pdf = public_path() . '/pdfs/madar.pdf';

        Artisan::call('pdf:update-info', [
            'input' => $path_pdf,
            'output' => $path_text_file,
            'title' => $title
        ]);
    }
}
