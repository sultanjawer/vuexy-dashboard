<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Services\BranchService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CreateBranch extends Component
{
    use LivewireAlert;
    public $listeners = ['refreshComponent' => '$refresh'];

    public $branch_name = '';
    public $branch_code = '';
    public $city_id = '';

    public $branch;

    public function render()
    {
        return view('livewire.create-branch');
    }

    protected function rules()
    {
        return [
            'branch_name' => ['required', 'unique:branches,name'],
            'branch_code' => ['required', 'unique:branches,code'],
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

    public function store(BranchService $branchService)
    {
        $validatedData = $this->validate();

        $branchService->store($validatedData);
        $this->alert('success', '', [
            'toast' => true,
            'position' => 'center',
            'timer' => 3000,
            'text' => '👍 تم إضافة الفرع بنجاح',
            'timerProgressBar' => true,
        ]);
        $this->emit('updateBranches');
        $this->emit('refreshComponent');
        $this->emit('submitBranch');
    }
}
