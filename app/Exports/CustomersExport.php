<?php

namespace App\Exports;

use App\Models\Customer;

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

class CustomersExport implements WithColumnFormatting, FromQuery, WithMapping, ShouldAutoSize, WithStyles, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;

    public function query()
    {
        return Customer::query();
    }

    public function headings(): array
    {
        return [

            'ID',
            'User Owner',
            'Name',
            'Phone Number',
            'Email',
            'Employer ID',
            'Employer Name',
            'Nationality ID',
            // 'NID',
            'City',
            'Building Number',
            'Street Name',
            'Neighborhood Name',
            'Zip Code',
            'Addtional Number',
            'Unit Number',
            'Support Eskan',
            'Employee Type',
            'Status',
            'Is Buy',
            'Who Add',
            'Who Edit',
            'Created At',
            // 'Updated At',


        ];
    }

    public function map($customer): array
    {
        return [
            $customer->id,
            $customer->user->name,
            $customer->name,
            $customer->phone,
            $customer->email,
            $customer->employer_id,
            $customer->employer_name,
            $customer->nationality_id,
            $customer->city->name,
            $customer->building_number,
            $customer->street_name,
            $customer->neighborhood_name,
            $customer->zip_code,
            $customer->addtional_number,
            $customer->unit_number,
            $customer->support_eskan,
            $customer->employee_type,
            $customer->status,
            $customer->is_buy,
            getUserName($customer->who_add),
            getUserName($customer->who_edit),
            Date::dateTimeToExcel($customer->created_at),
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
