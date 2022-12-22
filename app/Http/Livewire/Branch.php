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
    public $status = null;
    public $filters = [];

    public function updateBranches()
    {
        $this->reset();
    }


    public function getBranches()
    {
        $this->status == 'all' ? $this->status = null : null;

        $this->filters['status'] = $this->status;
        $this->filters['search'] = $this->search;

        return ModelsBranch::data()->filters($this->filters)->paginate($this->rows_number);
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
            $excel = Excel::download(new BranchesExport, 'branches.xlsx');

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
