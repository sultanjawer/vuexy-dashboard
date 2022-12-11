<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Select2 extends Component
{
    protected $listeners = ['testing', 'set', 'refreshSelect2' => '$refresh'];

    public $branches_ids = [];

    public function render()
    {
        return view('livewire.select2');
    }

    public function hydrate()
    {
        $this->emit('select2', $this->branches_ids);
    }

    public function testing()
    {
        $this->emit('refreshSelect2');
        $this->emit('getBranches', $this->branches_ids);
    }
}
