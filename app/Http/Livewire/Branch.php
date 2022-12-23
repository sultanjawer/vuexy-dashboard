<?php

namespace App\Http\Livewire;

use App\Exports\BranchesExport;
use App\Models\Branch as ModelsBranch;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Branch extends Component
{
    use WithPagination;
    use LivewireAlert;
    protected $listeners = ['updateBranches'];
    protected $paginationTheme = 'bootstrap';
    public $rows_number = 10;
    public $search = '';

    public $sort_field = 'id';
    public $sort_direction = 'asc';
    public $style_sort_direction = 'sorting_asc';
    public $status = null;
    public $filters = [];
    public $paginate_ids = [];

    public function updateBranches()
    {
        $this->reset();
    }

    public function getBranches()
    {
        $this->status == 'all' ? $this->status = null : null;

        $this->filters['status'] = $this->status;
        $this->filters['search'] = $this->search;

        $models = ModelsBranch::data()->filters($this->filters)->reorder($this->sort_field, $this->sort_direction);

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

    public function render()
    {
        $branches = $this->getBranches();
        if ($branches->count() < 9) {
            $this->resetPage();
        }
        return view('livewire.branch', [
            'branches' => $branches
        ]);
    }

    public function callBranchModal($branch_id)
    {
        $this->emit('branchModal', $branch_id);
    }

    public function updateStatus($branch_id)
    {
        $branch = ModelsBranch::find($branch_id);
        if ($branch->status == 1) {
            $branch->update(['status' => 2]);
        } else {
            $branch->update(['status' => 1]);
        }
    }

    public function export($type)
    {
        if ($type == 'excel') {
            $excel = Excel::download(new BranchesExport($this->filters, $this->sort_field, $this->sort_direction, $this->rows_number, $this->paginate_ids), 'branches.xlsx');

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
