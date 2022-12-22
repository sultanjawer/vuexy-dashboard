<?php

namespace App\Http\Livewire;

use App\Exports\OffersExport;
use App\Models\Offer as ModelsOffer;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

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


    public function mount()
    {
        $this->resetPage();
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

    public function render()
    {
        $direct_offers =  $this->getDirectOffers();
        $in_direct_offers =  $this->getInDirectOffers();

        return view('livewire.offer', [
            'direct_offers' => $direct_offers,
            'in_direct_offers' => $in_direct_offers
        ]);
    }

    public function export($type)
    {
        if ($type == 'excel') {
            $excel = Excel::download(new OffersExport, 'offers.xlsx');

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
