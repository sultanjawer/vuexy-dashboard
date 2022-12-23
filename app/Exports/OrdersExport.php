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

    public $filters = [];
    public $sort_field = 'id';
    public $sort_direction = 'desc';
    public $rows_number = 10;
    public $paginate_ids = [];
    public $user_field = 'user_id';

    public function __construct($filters, $sort_field, $sort_direction, $rows_number, $paginate_ids, $user_field = 'user_id')
    {
        $this->filters = $filters;
        $this->sort_field = $sort_field;
        $this->sort_direction = $sort_direction;
        $this->rows_number = $rows_number;
        $this->paginate_ids = $paginate_ids;
        $this->user_field = $user_field;
    }

    public function query()
    {
        $user = auth()->user();

        $collection = Order::query()->filters($this->filters);

        if ($user->user_type == 'superadmin') {
            $data = $collection->whereIn('id', $this->paginate_ids);
            return $data->reorder($this->sort_field, $this->sort_direction);
        }

        if ($user->user_type == 'admin') {
            $data = $collection->whereIn('id', $this->paginate_ids)->where('user_id', $user->id);
            return $data->reorder($this->sort_field, $this->sort_direction);
        }

        if ($user->user_type == 'marketer') {
            $data = $collection->whereIn('id', $this->paginate_ids)->where($this->user_field, $user->id);
            return $data->reorder($this->sort_field, $this->sort_direction);
        }
    }

    public function headings(): array
    {
        return [
            'رقم الطلب',
            'كود الطلب',
            'كود العرض',
            'حالة الطلب',
            'رقم العميل',
            'المستخدم المضيف للطلب',
            'اسم العميل',
            'رقم هاتف العميل',
            'جهة العمل',
            'نوع الموظف',
            'هل مدعوم من الإسكان',
            'نوع العقار',
            'المساحة',
            'السعر يبدأ من ',
            'السعر ينتهى الى',
            'المبلغ المتوفر',
            'طريقة الشراء',
            'الرغبة للشراء',
            'المدينة',
            'اسم الفرع',
            'الطلب مسند الى المسوق',
            'تاريخ إسناد الطلب للمسوق',
            'تاريخ الإنشاء',
            'تاريخ إلغاء الطلب',
            'ملاحظات الطلب',
        ];
    }

    public function map($order): array
    {
        $offer = getOffer($order->offer_id);
        if ($offer) {
            $offer_code = $offer->offer_code;
        } else {
            $offer_code = 'Null';
        }

        return [
            $order->id,
            $order->order_code,
            $offer_code,
            $order->orderStatus->name,
            $order->customer_id,
            $order->user->name,
            $order->customer_name,
            $order->customer_phone,
            $order->employer_name,
            $order->employee_type == 'public' ? 'عام' : 'خاص',
            $order->support_eskan == 1 ? 'نعم' : 'لا',
            $order->propertyType->name,
            number_format($order->area),
            number_format($order->price_from),
            number_format($order->price_to),
            number_format($order->avaliable_amount),
            $order->purch_method_id,
            $order->desire_to_buy_id,
            $order->city->name,
            $order->branch->name,
            getUserName($order->assign_to),
            $order->assign_to_date ?? 'Null',
            Date::dateTimeToExcel($order->created_at),
            $order->closed_date ?? 'Null',
            $order->notes,
            // Date::dateTimeToExcel($branch->updated_at ?? 0), # should not be null
        ];
    }

    public function columnFormats(): array
    {
        return [
            'W' => NumberFormat::FORMAT_DATE_DDMMYYYY,
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
