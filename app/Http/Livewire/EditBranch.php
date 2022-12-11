<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Services\BranchService;
use App\Models\Branch;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EditBranch extends Component
{
    use LivewireAlert;
    public $listeners = ["branchModal", 'refreshComponent' => '$refresh'];

    public $branch_name = '';
    public $branch_code = '';
    public $city_id = '';

    public $branch;

    public function render()
    {
        return view('livewire.edit-branch');
    }


    protected function rules()
    {
        return [
            'branch_name' => ['required', 'unique:branches,name, ' . $this->branch->id],
            'branch_code' => ['required', 'unique:branches,code,' . $this->branch->id],
            'city_id' => ['required'],
        ];
    }

    protected function messages()
    {
        return [
            'branch_name.required' => 'هذا الحقل مطلوب',
            'branch_code.required' => 'هذا الحقل مطلوب',
            'city_id.required' => 'هذا الحقل مطلوب',

            'branch_name.unique' => 'اسم الفرع موجود بشكل مسبق',
            'branch_code.unique' => 'كود الفرع موجود بشكل مسبق'
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function branchModal($branch_id)
    {
        $branch = Branch::data()->find($branch_id);

        $this->branch = $branch;
        $this->branch_code = $branch->code;
        $this->branch_name = $branch->name;
        $this->city_id = $branch->city_id;
    }

    public function editBranch(BranchService $branchService)
    {
        $validatedData = $this->validate();
        $branchService->update($this->branch, $validatedData);
        $this->alert('success', '', [
            'toast' => true,
            'position' => 'center',
            'timer' => 3000,
            'text' => '👍 تم تحديث الفرع بنجاح',
            'timerProgressBar' => true,
        ]);
        $this->emit('updateBranch');
        $this->emit('refreshComponent');
        $this->emit('updateBranches');
    }
}
