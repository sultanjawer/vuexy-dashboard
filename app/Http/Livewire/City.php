<?php

namespace App\Http\Livewire;

use App\Exports\CitiesExport;
use App\Models\City as ModelsCity;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class City extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';
    public $rows_number = 10;
    public $search = '';

    public $sort_field = 'id';
    public $sort_direction = 'asc';
    public $style_sort_direction = 'sorting_asc';


    public $status = null;
    public $filters = [];
    public $paginate_ids = [];

    public function render()
    {
        $this->status == 'all' ? $this->status = null : null;

        $this->filters['status'] = $this->status;
        $this->filters['search'] = $this->search;


        $models = ModelsCity::data()->filters($this->filters)->reorder($this->sort_field, $this->sort_direction);

        if ($this->rows_number == 'all') {
            $this->rows_number = $models->count();
        }

        $data = $models->paginate($this->rows_number);

        $this->paginate_ids = $data->pluck('id')->toArray();

        if ($data->count() < 9) {
            $this->resetPage();
        }

        return view('livewire.city', ['cities' => $data]);
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

    public function callCityModal($city_id)
    {
        $this->emit('cityModal', $city_id);
    }

    public function updateStatus($city_id)
    {
        $city = ModelsCity::find($city_id);
        if ($city->status == 1) {
            $city->update(['status' => 2]);
        } else {
            $city->update(['status' => 1]);
        }
    }

    public function export($type)
    {
        if ($type == 'excel') {
            $excel = Excel::download(new CitiesExport($this->filters, $this->sort_field, $this->sort_direction, $this->rows_number, $this->paginate_ids), 'cities.xlsx');

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
