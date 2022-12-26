<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use Livewire\Component;

class SaleView extends Component
{

    public $sale_id;
    public $sale;

    public function mount($sale_id)
    {
        $this->sale_id = $sale_id;
        $this->sale = Sale::with(['offer', 'order', 'customer', 'realEstate'])->find($sale_id);
    }

    public function render()
    {
        return view('livewire.sale-view');
    }
}
