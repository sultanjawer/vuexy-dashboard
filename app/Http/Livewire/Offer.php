<?php

namespace App\Http\Livewire;

use App\Models\Offer as ModelsOffer;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Offer extends Component
{

    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';
    public $rows_number = 10;
    public $in_rows_number = 10;
    public $search = '';
    public $in_search = '';
    public $filters = [];
    public $in_filters = [];

    public $direct;
    public $in_direct;


    public function mount()
    {
        $this->resetPage();
        $this->settingData();
    }

    public function getDirectOffers()
    {

        $this->filters['search'] = $this->search;

        $user = auth()->user();

        if ($user->user_type == "office") {
            return ModelsOffer::data()->filters($this->filters)->where('offer_type_id', 2)->paginate($this->rows_number);
        }

        if ($user->user_type == "superadmin") {
            $offers = ModelsOffer::data()->filters($this->filters)->where('offer_type_id', 1)->paginate($this->rows_number);
        } else {
            $offers = ModelsOffer::data()->filters($this->filters)->where('offer_type_id', 1)->where('user_id', auth()->id())->paginate($this->rows_number);
        }

        return  $offers;
    }

    public function getInDirectOffers()
    {
        $this->in_filters['search'] = $this->in_search;

        $user = auth()->user();

        if ($user->user_type == "superadmin") {
            $offers = ModelsOffer::data()->filters($this->in_filters)->where('offer_type_id', 2)->paginate($this->in_rows_number);
        } else {
            $offers = ModelsOffer::data()->filters($this->in_filters)->where('offer_type_id', 2)->where('user_id', auth()->id())->paginate($this->in_rows_number);
        }

        return  $offers;
    }

    public function settingData()
    {
        $this->direct =  $this->getDirectOffers();
        $this->in_direct =  $this->getInDirectOffers();
    }

    public function render()
    {
        return view('livewire.offer', [
            'direct_offers' => $this->direct,
            'in_direct_offers' => $this->in_direct
        ]);
    }
}
