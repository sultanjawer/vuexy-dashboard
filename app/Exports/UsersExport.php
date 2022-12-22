<?php

namespace App\Exports;

use App\Models\User;

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


class UsersExport implements WithColumnFormatting, FromQuery, WithMapping, ShouldAutoSize, WithStyles, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;

    public function query()
    {
        return User::query();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Phone Number',
            'Email',
            'User Type',
            'User Status',
            'Advertiser Number',
            'Created At',
            // 'Updated At',
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->phone,
            $user->email,
            $user->user_type,
            $user->user_status,
            $user->advertiser_number,
            Date::dateTimeToExcel($user->created_at),
            // Date::dateTimeToExcel($user->updated_at ?? 0), # should not be null
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
