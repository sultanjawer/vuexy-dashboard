<?php

namespace App\Http\Livewire;

use App\Exports\NeighborhoodsExport;
use App\Models\Neighborhood as ModelsNeighborhood;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Neighborhood extends Component
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
    public $city_id = null;
    public $filters = [];
    public $paginate_ids = [];

    public function render()
    {
        $this->status == 'all' ? $this->status = null : null;
        $this->city_id == 'all' ? $this->city_id = null : null;
        $this->filters['status'] = $this->status;
        $this->filters['city_id'] = $this->city_id;
        $this->filters['search'] = $this->search;

        $models = ModelsNeighborhood::data()->filters($this->filters)->reorder($this->sort_field, $this->sort_direction);

        if ($this->rows_number == 'all') {
            $this->rows_number = $models->count();
        }

        $data = $models->paginate($this->rows_number);

        $this->paginate_ids = $data->pluck('id')->toArray();

        if ($data->count() < 9) {
            $this->resetPage();
        }

        return view('livewire.neighborhood', [
            'neighborhoods' => $data
        ]);
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

    public function callNeighborhoodModal($neighborhood_id)
    {
        $this->emit('neighborhoodModal', $neighborhood_id);
    }

    public function updateStatus($neighborhood_id)
    {
        $neighborhood = ModelsNeighborhood::find($neighborhood_id);
        if ($neighborhood->status == 1) {
            $neighborhood->update(['status' => 2]);
        } else {
            $neighborhood->update(['status' => 1]);
        }
    }

    public function export($type)
    {
        if ($type == 'excel') {
            $excel = Excel::download(new NeighborhoodsExport($this->filters, $this->sort_field, $this->sort_direction, $this->rows_number, $this->paginate_ids), 'neighborhoods.xlsx');

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
