<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class Select2Search extends Component
{
    public $search;
    public $customers = [];
    public $filters = [];

    public function render()
    {
        return view('livewire.select2-search');
    }

    public function updated($propertyName, $value)
    {
        if ($propertyName == 'search') {
            $this->searchCustomers($value);
        }
    }

    public function searchCustomers($value)
    {
        $this->filters['search'] = $value;
        $customers = Customer::filters($this->filters)->get(['id', 'phone', 'name', 'nationality_id'])->toArray();

        foreach ($customers as $key => $customer) {
            foreach ($customer as $index => $value) {

                if ($index == 'name') {
                    $customer['text'] = $value . ' :: ' . $customer['phone'];
                    unset($customer['name']);
                    unset($customer['phone']);
                    unset($customer['nationality_id']);
                    $customers[$key] = $customer;
                }
            }
        }

        $customers_json = json_decode(json_encode($customers));
        $this->emit('setCustomers', $customers_json);
    }
}
