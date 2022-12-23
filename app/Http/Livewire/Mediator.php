<?php

namespace App\Http\Livewire;

use App\Exports\MediatorsExport;
use App\Models\Mediator as ModelsMediator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Mediator extends Component
{
    use LivewireAlert;
    use WithPagination;
    protected $listeners = ['updateMediators', 'refreshComponent' => '$refresh'];
    protected $paginationTheme = 'bootstrap';

    public $rows_number = 10;
    public $search;

    public $sort_field = 'id';
    public $sort_direction = 'asc';
    public $style_sort_direction = 'sorting_asc';

    public $mediator_status = null;
    public $mediator_type = null;
    public $filters = [];
    public $paginate_ids = [];


    public function updateMediators()
    {
        $this->emit('refreshComponent');
    }

    public function getMediators()
    {
        $this->mediator_status == 'all' ? $this->mediator_status = null : null;
        $this->mediator_type == 'all' ? $this->mediator_type = null : null;

        $this->filters['search'] = $this->search;
        $this->filters['mediator_status'] = $this->mediator_status;
        $this->filters['mediator_type'] = $this->mediator_type;

        $models = ModelsMediator::data()->filters($this->filters)->reorder($this->sort_field, $this->sort_direction);

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

    public function changeMediatorStatus($mediator_id)
    {
        $mediator = ModelsMediator::find($mediator_id);
        if ($mediator) {
            if ($mediator->status == 1) {
                $mediator->update(['status' => 2]);
            } else {
                $mediator->update(['status' => 1]);
            }
        }

        $this->alert('success', '', [
            'toast' => true,
            'position' => 'center',
            'timer' => 3000,
            'text' => '👍 تم تغيير حالة الوسيط بنجاح',
            'timerProgressBar' => true,
        ]);
    }

    public function callMediatorModal($mediator_id)
    {
        return $this->emit('mediatorModal', $mediator_id);
    }

    public function render()
    {
        $mediators = $this->getMediators();
        if ($mediators->count() < 9) {
            $this->resetPage();
        }

        return view('livewire.mediator', [
            'mediators' => $mediators
        ]);
    }

    public function export($type)
    {
        if ($type == 'excel') {
            $excel = Excel::download(new MediatorsExport($this->filters, $this->sort_field, $this->sort_direction, $this->rows_number, $this->paginate_ids), 'mediators.xlsx');

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
