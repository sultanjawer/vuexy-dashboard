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
        return Customer::query()->filters($this->filters)->whereIn('id', $this->paginate_ids)->reorder($this->sort_field, $this->sort_direction);
    }

    public function headings(): array
    {
        return [
            'رقم العميل',
            'المستخدم المضيف للعميل',
            'اسم العميل',
            'رقم هاتف العميل',
            'ايميل العميل',
            'جهة العمل',
            'اسم الموظيف',
            'نوع التوظيف',
            'رقم هوية العميل',
            // 'NID',
            'المدينة',
            'الحي',
            'رقم بالمبنى',
            'رقم الشارع',
            'الرمز البريدي',
            'الرقم الإضافي',
            'رقم الوحدة',
            'هل مدعوم من الإسكان',
            'حالة العميل',
            'هل اشترى ؟',
            'تاريخ تسجيل العميل',
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
            $customer->employee_type == 'public' ? 'عام' : 'خاص',
            $customer->nationality_id,
            $customer->city->name,
            $customer->neighborhood_name,
            $customer->building_number,
            $customer->street_name,
            $customer->zip_code,
            $customer->addtional_number,
            $customer->unit_number,
            $customer->support_eskan == 1 ? 'نعم' : 'لا',
            $customer->status == 1 ? 'نشط' : 'غير نشط',
            $customer->is_buy == 1 ? 'نعم' : 'لا',
            Date::dateTimeToExcel($customer->created_at),
            // Date::dateTimeToExcel($branch->updated_at ?? 0), # should not be null
        ];
    }

    public function columnFormats(): array
    {
        return [
            'T' => NumberFormat::FORMAT_DATE_DDMMYYYY,
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
