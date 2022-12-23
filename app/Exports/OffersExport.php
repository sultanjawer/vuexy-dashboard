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

    public $filters = [];
    public $sort_field = 'id';
    public $sort_direction = 'desc';
    public $rows_number = 10;
    public $paginate_ids = [];
    public $offer_type_id = 1;

    public function __construct($filters, $sort_field, $sort_direction, $rows_number, $paginate_ids, $offer_type_id)
    {
        $this->filters = $filters;
        $this->sort_field = $sort_field;
        $this->sort_direction = $sort_direction;
        $this->rows_number = $rows_number;
        $this->offer_type_id = $offer_type_id;
        $this->paginate_ids = $paginate_ids;
    }

    public function query()
    {
        $user = auth()->user();

        $types = ['office', 'admin', 'superadmin', 'marketer'];
        if ($user->user_type == 'office') {
            $this->offer_type_id = 2;
        }

        if (in_array($user->user_type, $types)) {
            $offers = Offer::query()->filters($this->filters)->where('offer_type_id', $this->offer_type_id)->whereIn('id', $this->paginate_ids)->reorder($this->sort_field, $this->sort_direction);
            return $offers;
        }
    }

    public function headings(): array
    {
        return [
            'رقم العرض',
            'كود العرض',
            'نوع العقار',
            'نوع العرض',
            'المستخدم المضيف للعرض',
            'تاريخ تسجيل العرض',
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
            Date::dateTimeToExcel($offer->created_at),
            // Date::dateTimeToExcel($branch->updated_at ?? 0), # should not be null
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
