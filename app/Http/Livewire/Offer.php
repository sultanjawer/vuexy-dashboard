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
    protected $listeners = ['refreshComponent' => '$refresh'];
    public $rows_number = 10;
    public $in_rows_number = 10;
    public $search = '';

    public $sort_field = 'id';
    public $sort_direction = 'asc';
    public $style_sort_direction = 'sorting_asc';

    public $in_sort_field = 'id';
    public $in_sort_direction = 'asc';
    public $in_style_sort_direction = 'sorting_asc';

    public $in_search = '';
    public $filters = [];
    public $in_filters = [];
    public $paginate_ids = [];
    public $in_paginate_ids = [];



    public function mount()
    {
        $this->resetPage();
    }

    public function getDirectOffers()
    {
        $this->filters['search'] = $this->search;

        $user = auth()->user();

        if ($user->user_type == "office") {
            $ids = $user->branches->pluck('id')->toArray();

            $collection = ModelsOffer::data()->with('realEstate.branch')->whereHas('realEstate.branch', function ($query) use ($ids) {
                $query->whereIn('id', $ids);
            })->filters($this->filters)->reorder($this->sort_field, $this->sort_direction);

            if ($this->rows_number == 'all') {
                $this->rows_number = $collection->count();
            }

            $data = $collection->paginate($this->rows_number);

            $this->paginate_ids = $data->pluck('id')->toArray();

            return $data;
        }

        $types = ['office', 'admin', 'superadmin', 'marketer'];

        if (in_array($user->user_type, $types)) {

            if ($user->user_type == 'superadmin') {
                $collection = ModelsOffer::data()->filters($this->filters)->where('offer_type_id', 1)->reorder($this->sort_field, $this->sort_direction);
            } else {
                $ids = $user->branches->pluck('id')->toArray();
                $collection = ModelsOffer::data()->with('realEstate.branch')->whereHas('realEstate.branch', function ($query) use ($ids) {
                    $query->whereIn('id', $ids);
                })->filters($this->filters)->where('offer_type_id', 1)->reorder($this->sort_field, $this->sort_direction);
            }

            if ($this->rows_number == 'all') {
                $this->rows_number = $collection->count();
            }
        }

        $data = $collection->paginate($this->rows_number);

        $this->paginate_ids = $data->pluck('id')->toArray();

        return $data;
    }

    public function getInDirectOffers()
    {
        $this->in_filters['search'] = $this->in_search;

        $user = auth()->user();

        $types = ['office', 'admin', 'superadmin', 'marketer'];

        if (in_array($user->user_type, $types)) {

            if ($user->user_type == 'superadmin') {
                $collection = ModelsOffer::data()->filters($this->in_filters)->where('offer_type_id', 2)->reorder($this->in_sort_field, $this->in_sort_direction);
            } else {
                $ids = $user->branches->pluck('id')->toArray();
                $collection = ModelsOffer::data()->with('realEstate.branch')->whereHas('realEstate.branch', function ($query) use ($ids) {
                    $query->whereIn('id', $ids);
                })->filters($this->in_filters)->where('offer_type_id', 2)->reorder($this->in_sort_field, $this->in_sort_direction);
            }
            if ($this->in_rows_number == 'all') {
                $this->in_rows_number = $collection->count();
            }
        }

        $data = $collection->paginate($this->in_rows_number);

        $this->in_paginate_ids = $data->pluck('id')->toArray();

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


    public function inSortBy($field)
    {
        if ($this->in_sort_field == $field) {
            if ($this->in_sort_direction === 'asc') {
                $this->in_sort_direction = 'desc';
                $this->in_style_sort_direction = 'sorting_desc';
            } else {
                $this->in_sort_direction = 'asc';
                $this->in_style_sort_direction = 'sorting_asc';
            }
        } else {
            $this->in_sort_direction = 'asc';
            $this->in_style_sort_direction = 'sorting_asc';
        }

        $this->in_sort_field = $field;
    }

    public function render()
    {
        $direct_offers =  $this->getDirectOffers();
        $in_direct_offers =  $this->getInDirectOffers();

        $this->paginate_ids = $direct_offers->pluck('id')->toArray();
        $this->in_paginate_ids = $in_direct_offers->pluck('id')->toArray();


        return view('livewire.offer', [
            'direct_offers' => $direct_offers,
            'in_direct_offers' => $in_direct_offers
        ]);
    }

    public function export($type, $offer_type_id)
    {
        if ($offer_type_id == 1) {
            $offers_export = new OffersExport($this->filters, $this->sort_field, $this->sort_direction, $this->rows_number, $this->paginate_ids, $offer_type_id);
        } elseif ($offer_type_id == 2) {
            $offers_export = new OffersExport($this->in_filters, $this->in_sort_field, $this->in_sort_direction, $this->in_rows_number, $this->in_paginate_ids, $offer_type_id);
        } else {
            $this->alert('danger', '', [
                'toast' => true,
                'position' => 'center',
                'timer' => 6000,
                'text' => 'حدث خطا ما في عملية التصدير يرجى مراجعة المبرمج المنشأ للتطبيق',
                'timerProgressBar' => true,
            ]);

            return false;
        }

        if ($type == 'excel') {
            $excel = Excel::download($offers_export, 'offers.xlsx');

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

    public function changeOfferStatus($offer_id)
    {
        $branch = ModelsOffer::find($offer_id);

        if ($branch->status == 1) {
            $branch->update(['status' => 2]);
        } else {
            $branch->update(['status' => 1]);
        }

        $this->emit('refreshComponent');

        $this->alert('success', '', [
            'toast' => true,
            'position' => 'center',
            'timer' => 6000,
            'text' => 'تم تغيير حالة العرض بنجاح',
            'timerProgressBar' => true,
        ]);
    }
}
