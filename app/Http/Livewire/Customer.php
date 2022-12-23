<?php

namespace App\Http\Livewire;

use App\Exports\CustomersExport;
use App\Models\Customer as ModelsCustomer;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Customer extends Component
{
    use LivewireAlert;
    use WithPagination;
    protected $listeners = ['updateCustomers'];
    protected $paginationTheme = 'bootstrap';

    public $rows_number = 10;
    public $search;
    public $sort_field = 'id';
    public $sort_direction = 'asc';
    public $style_sort_direction = 'sorting_asc';

    public $customer_status = null;
    public $customer_city_id;
    public $customer_sector;
    public $is_buy;
    public $filters = [];
    public $paginate_ids = [];

    public function updateCustomers()
    {
        $this->reset();
    }

    public function getCustomers()
    {
        $this->customer_status == 'all' ? $this->customer_status = null : null;
        $this->customer_sector == 'all' ? $this->customer_sector = null : null;
        $this->customer_city_id == 'all' ? $this->customer_city_id = null : null;
        $this->is_buy == 'all' ? $this->is_buy = null : null;

        $this->filters['search'] = $this->search;
        $this->filters['customer_status'] = $this->customer_status;
        $this->filters['city_id'] = $this->customer_city_id;
        $this->filters['employee_type'] = $this->customer_sector;
        $this->filters['is_buy'] = $this->is_buy;

        $models = ModelsCustomer::data()->filters($this->filters)->reorder($this->sort_field, $this->sort_direction);

        if ($this->rows_number == 'all') {
            $this->rows_number = $models->count();
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

    public function changeCustomerStatus($customer_id)
    {
        $customer = ModelsCustomer::find($customer_id);
        if ($customer) {
            if ($customer->status == 1) {
                $customer->update(['status' => 2]);
            } else {
                $customer->update(['status' => 1]);
            }
        }

        $this->alert('success', '', [
            'toast' => true,
            'position' => 'center',
            'timer' => 3000,
            'text' => '👍 تم تغيير حالة العميل بنجاح',
            'timerProgressBar' => true,
        ]);
    }

    public function callCustomerModal($customer_id)
    {
        return $this->emit('customerModal', $customer_id);
    }

    public function render()
    {
        $customers = $this->getCustomers();
        if ($customers->count() < 9) {
            $this->resetPage();
        }

        return view('livewire.customer', [
            'customers' => $customers
        ]);
    }

    public function export($type)
    {
        if ($type == 'excel') {
            $excel = Excel::download(new CustomersExport($this->filters, $this->sort_field, $this->sort_direction, $this->rows_number, $this->paginate_ids), 'customers.xlsx');

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
}
