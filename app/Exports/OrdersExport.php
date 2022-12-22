<?php

namespace App\Exports;

use App\Models\Order;

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

class OrdersExport implements WithColumnFormatting, FromQuery, WithMapping, ShouldAutoSize, WithStyles, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;

    public function query()
    {
        return Order::query();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Order Code',
            'Order Status',
            'Customer ID',
            'User Owner',
            'Offer Owner',
            'Customer Name',
            'Customer Phone Number',
            'Employer Name',
            'Employee Type',
            'Support Eskan',
            'Property Type',
            'City',
            'Area',
            'Price From',
            'Price To',
            'Avaliable Amount',
            'Purch Method',
            'Desire To Buy',
            'Assign To',
            'Branch Name',
            'Notes',
            'Closed Date',
            'Who Edit',
            'Who Cancel',
            'Who Add',
            'Assign To Date',
            'Created At',
            // 'Updated At',
        ];
    }

    public function map($order): array
    {
        return [
            $order->id,
            $order->order_code,
            $order->orderStatus->name,
            $order->customer_id,
            $order->user->name,
            getOffer($order->offer_id)->offer_code,
            $order->customer_name,
            $order->customer_phone,
            $order->employer_name,
            $order->employee_type,
            $order->support_eskan,
            $order->propertyType->name,
            $order->city->name,
            $order->area,
            $order->price_from,
            $order->price_to,
            $order->avaliable_amount,
            $order->purch_method_id,
            $order->desire_to_buy_id,
            getUserName($order->assign_to),
            $order->branch->name,
            $order->notes,
            $order->closed_date,
            getUserName($order->who_edit),
            getUserName($order->who_cancel),
            getUserName($order->who_add),
            getUserName($order->assign_to_date),
            Date::dateTimeToExcel($order->created_at),
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
