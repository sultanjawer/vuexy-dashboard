<?php

namespace App\Http\Livewire;

use App\Exports\ReservationsExport;
use App\Models\Reservation as ModelsReservation;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Reservation extends Component
{
    use LivewireAlert;
    use WithPagination;
    protected $listeners = ['updateReservation', 'changeWebsiteMode', 'refreshComponent' => '$refresh'];
    protected $paginationTheme = 'bootstrap';

    public $rows_number = 10;
    public $search = '';

    public $sort_field = 'id';
    public $sort_direction = 'asc';
    public $style_sort_direction = 'sorting_asc';
    public $paginate_ids = [];

    public $reservation_status = null;
    public $filters = [];
    public $website_mode = false;
    public $date_from;
    public $date_to;

    public function updateReservation()
    {
        $this->emit('refreshComponent');
        $this->filters['date_from'] = ModelsReservation::min('created_at');
        $this->filters['date_to'] = ModelsReservation::max('created_at');
        $this->date_from = ModelsReservation::min('created_at');
        $this->date_to = ModelsReservation::max('created_at');
    }

    public function mount()
    {
        $user = User::find(auth()->id());

        $this->date_from = ModelsReservation::min('created_at');
        $this->date_to = ModelsReservation::max('created_at');
        $this->filters['date_from'] = $this->date_from;
        $this->filters['date_to'] = $this->date_to;

        if ($user) {
            if ($user->userSettings->website_mode == 'light-layout dark-layout') {
                $this->website_mode = true;
            } else {
                $this->website_mode = false;
            }
        }
    }
    public function changeWebsiteMode()
    {
        $user = User::find(auth()->id());
        if ($user) {
            if ($user->userSettings->website_mode == 'light-layout dark-layout') {
                $this->website_mode = true;
            } else {
                $this->website_mode = false;
            }
        }
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

    public function updated($propertyName)
    {

        if ($propertyName == 'rows_number') {
            $this->resetPage();
        }
    }

    public function getReservations()
    {
        $this->reservation_status == 'all' ? $this->reservation_status = null : null;

        $this->filters['search'] = $this->search;
        $this->filters['reservation_status'] = $this->reservation_status;

        $models = ModelsReservation::data()->filters($this->filters)->reorder($this->sort_field, $this->sort_direction);

        if ($this->rows_number == 'all') {
            $this->rows_number = $models->count();
        }

        $data = $models->paginate($this->rows_number);

        $this->paginate_ids = $data->pluck('id')->toArray();

        return $data;

    }

    public function dateFrom()
    {
        $this->filters['date_from'] = $this->date_from;
    }

    public function dateTo()
    {
        $this->filters['date_to'] = $this->date_to;
    }

    public function render()
    {
        $reservations = $this->getReservations();

        if ($reservations->count() < 9) {
            $this->resetPage();
        }

        return view('livewire.reservation', [
            'reservations' => $reservations
        ]);
    }

    public function changeReservationStatus($reservation_id)
    {
        $reservation = ModelsReservation::find($reservation_id);
        if ($reservation) {
            if ($reservation->status == 1) {
                $reservation->update(['status' => 2]);
            } else {
                $reservation->update(['status' => 1]);
            }
        }

        $this->alert('success', '', [
            'toast' => true,
            'position' => 'center',
            'timer' => 3000,
            'text' => '👍 تم تغيير حالة الحجز بنجاح',
            'timerProgressBar' => true,
        ]);
    }

    public function callReservationModal($reservation_id)
    {
        return $this->emit('reservationModal', $reservation_id);
    }

    public function export($type)
    {
        if ($type == 'excel') {
            $excel = Excel::download(new ReservationsExport($this->filters, $this->sort_field, $this->sort_direction, $this->rows_number, $this->paginate_ids), 'reservations.xlsx');

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
