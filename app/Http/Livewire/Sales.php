<?php

namespace App\Http\Livewire;

use App\Exports\PDFExports;
use App\Exports\SalesExport;
use App\Http\Controllers\Services\SaleService;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Sales extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $listeners = ['updateReservation', 'changeWebsiteMode', 'refreshComponent' => '$refresh'];
    protected $paginationTheme = 'bootstrap';

    public $rows_number = 10;
    public $search = '';

    public $sort_field = 'id';
    public $sort_direction = 'asc';
    public $style_sort_direction = 'sorting_asc';
    public $paginate_ids = [];

    public $filters = [];

    public $property_type_id = null;
    public $branch_type_id = null;
    public $sale_status = null;
    public $city_id = null;


    public function updated($propertyName)
    {
        if ($propertyName == 'rows_number') {
            $this->resetPage();
        }
    }

    public function getSales($service = null)
    {
        $this->sale_status == 'all' ? $this->sale_status = null : null;
        $this->branch_type_id == 'all' ? $this->branch_type_id = null : null;
        $this->property_type_id == 'all' ? $this->property_type_id = null : null;
        $this->city_id == 'all' ? $this->city_id = null : null;

        $this->filters['search'] = $this->search;
        $this->filters['city_id'] = $this->city_id;
        $this->filters['sale_status'] = $this->sale_status;
        $this->filters['branch_type_id'] = $this->branch_type_id;
        $this->filters['property_type_id'] = $this->property_type_id;

        $models = Sale::data()->filters($this->filters)->reorder($this->sort_field, $this->sort_direction);

        if ($this->rows_number == 'all') {
            $this->rows_number = $models->count();
        }

        if ($service == 'pdf') {
            return $models->get();
        }

        $data = $models->paginate($this->rows_number);

        $this->paginate_ids = $data->pluck('id')->toArray();

        return $data;
    }

    public function sortBy($field)
    {
        if ($this->sort_field == $field) {
            if ($this->sort_direction === 'asc') {
                $this->sort_direction = 'desc';
                $this->style_sort_direction = 'sorting_desc';
            } else {
                $this->sort_direction = 'asc';
                $this->style_sort_direction = 'sorting_asc';
            }
        } else {
            $this->sort_direction = 'asc';
            $this->style_sort_direction = 'sorting_asc';
        }

        $this->sort_field = $field;
    }

    public function render()
    {
        $sales = $this->getSales();

        if ($sales->count() < 9) {
            $this->resetPage();
        }

        return view('livewire.sales', [
            'sales' => $sales
        ]);
    }

    public function callSaleModal($sale_id)
    {
        $this->emit('openSaleModal', $sale_id);
    }

    public function export($type)
    {
        if ($type == 'excel') {
            $excel = Excel::download(new SalesExport($this->filters, $this->sort_field, $this->sort_direction, $this->rows_number, $this->paginate_ids), 'sales.xlsx');

            $this->alert('success', '', [
                'toast' => true,
                'position' => 'center',
                'timer' => 6000,
                'text' => 'تم تصدير الملف بنجاح',
                'timerProgressBar' => true,
            ]);

            return $excel;
        }
    }

    public function cancelSale(SaleService $saleService, $sale_id)
    {
        $saleService->cancel($sale_id);

        $this->alert('success', '', [
            'toast' => true,
            'position' => 'center',
            'timer' => 3000,
            'text' => '👍 تم إلغاء الاتفاقية بنجاح',
            'timerProgressBar' => true,
        ]);

        $this->emit('refreshComponent');
        return true;
    }
}
