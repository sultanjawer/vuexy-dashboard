<?php

namespace App\Exports;

use App\Models\Reservation;

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

class ReservationsExport implements WithColumnFormatting, FromQuery, WithMapping, ShouldAutoSize, WithStyles, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;

    public function query()
    {
        return Reservation::query();
    }

    public function headings(): array
    {
        return [
            'ID',
            'User Owner',
            'Customer ID',
            'Offer ID',
            'offer_code',
            'Customer Name',
            'Price',
            'Status',
            'Date From',
            'Date To',
            'Note',
            'Created At',
            // 'Updated At',
        ];
    }

    public function map($reservation): array
    {
        return [
            $reservation->id,
            $reservation->user->name,
            $reservation->customer_id,
            $reservation->offer_id,
            $reservation->offer->offer_code,
            $reservation->price,
            $reservation->customer->name,
            $reservation->status,
            $reservation->date_from,
            $reservation->date_to,
            $reservation->note,
            Date::dateTimeToExcel($reservation->created_at),
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
