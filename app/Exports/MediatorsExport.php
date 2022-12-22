<?php

namespace App\Exports;

use App\Models\Mediator;

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

class MediatorsExport implements WithColumnFormatting, FromQuery, WithMapping, ShouldAutoSize, WithStyles, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;

    public function query()
    {
        return Mediator::query();
    }

    public function headings(): array
    {
        return [

            'ID',
            'User Owner',
            'Name',
            'Phone Number',
            'Type',
            'Status',
            'Created At',
            // 'Updated At',


        ];
    }

    public function map($mediator): array
    {
        return [
            $mediator->id,
            $mediator->user->name,
            $mediator->name,
            $mediator->phone_number,
            $mediator->type,
            $mediator->status,
            Date::dateTimeToExcel($mediator->created_at),
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
