<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SalesExport implements WithColumnFormatting, FromQuery, WithMapping, ShouldAutoSize, WithStyles, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;

    public $filters = [];
    public $sort_field = 'id';
    public $sort_direction = 'desc';
    public $rows_number = 10;
    public $paginate_ids = [];

    public function __construct($filters, $sort_field, $sort_direction, $rows_number, $paginate_ids)
    {
        $this->filters = $filters;
        $this->sort_field = $sort_field;
        $this->sort_direction = $sort_direction;
        $this->rows_number = $rows_number;
        $this->paginate_ids = $paginate_ids;
    }

    public function query()
    {
        return Sale::query()->filters($this->filters)->whereIn('id', $this->paginate_ids)->reorder($this->sort_field, $this->sort_direction);
    }

    public function headings(): array
    {
        return [
            'رقم البيعة',
            'كود البيعة',
            'كود العرض',
            'كود الطلب',
            'المستخدم المضيف للصفقة',
            'التاريخ',
            'المدينة',
            'نوع العقار',
            'رقم الأرض',
            'المساحة',
            'سعر العقار',
            'نوع العملاء',
            'اسم الفرع',
            'حالة الصفقة',
            // 'Updated At',
        ];
    }

    public function map($sale): array
    {
        return [
            $sale->id,
            $sale->sale_code,
            $sale->offer->offer_code,
            $sale->order ? $sale->order->order_code : 'Null',
            $sale->user->name,
            Date::dateTimeToExcel($sale->created_at),
            $sale->realEstate->city->name,
            $sale->realEstate->propertyType->name,
            number_format($sale->realEstate->space),
            $sale->realEstate->land_number,
            number_format($sale->realEstate->total_price),
            'customers',
            $sale->realEstate->branch->name,
            $sale->sale_status == 1 ? 'نشط' : 'غير نشط',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
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
