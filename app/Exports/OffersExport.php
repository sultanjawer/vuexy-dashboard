<?php

namespace App\Exports;

use App\Models\Offer;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OffersExport implements WithColumnFormatting, FromQuery, WithMapping, ShouldAutoSize, WithStyles, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;

    public function query()
    {
        return Offer::query();
    }

    public function headings(): array
    {
        return [

            'ID',
            'Offer Code',
            'Real Estate Type',
            'Offer Type ',
            'User Owner',
            'User Add',
            'User Edit',
            'User Cancel',
            'Created At',
            // 'Updated At',


        ];
    }

    public function map($offer): array
    {
        return [
            $offer->id,
            $offer->offer_code,
            $offer->realEstate->propertyType->name,
            $offer->offerType->name,
            $offer->user->name,
            $offer->user->name,
            $offer->user->name,
            $offer->user->name,
            Date::dateTimeToExcel($offer->created_at),
            // Date::dateTimeToExcel($branch->updated_at ?? 0), # should not be null
        ];
    }

    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
