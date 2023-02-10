<?php

namespace App\Http\Livewire;

use App\Exports\OrdersExport;
use App\Models\Order;
use App\Models\OrderEditor;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class OrderMarket extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['updateOrderMarketer', 'refreshComponent' => '$refresh'];

    public $os_rows_number = 10;
    public $os_search = '';
    public $os_sort_field = 'id';
    public $os_sort_direction = 'asc';
    public $os_style_sort_direction = 'sorting_asc';

    public $os_order_status_id = null;
    public $os_property_type_id = null;
    public $os_city_id = null;
    public $os_branch_type_id = null;
    public $os_date_from = null;
    public $os_date_to = null;
    public $os_filters = [];
    public $os_paginate_ids = [];

    public $oo_rows_number = 10;
    public $oo_search = '';
    public $oo_sort_field = 'id';
    public $oo_sort_direction = 'asc';
    public $oo_style_sort_direction = 'sorting_asc';

    public $oo_order_status_id = null;
    public $oo_property_type_id = null;
    public $oo_city_id = null;
    public $oo_branch_type_id = null;
    public $oo_date_from = null;
    public $oo_date_to = null;
    public $oo_filters = [];
    public $oo_paginate_ids = [];

    public function updateOrderMarketer()
    {
        $this->emit('refreshComponent');
        $this->oo_date_from = Order::min('created_at');
        $this->oo_date_to = Order::max('created_at');
        $this->oo_filters['date_from'] = $this->oo_date_from;
        $this->oo_filters['date_to'] = $this->oo_date_to;
        $this->os_filters['date_from'] = $this->oo_date_from;
        $this->os_filters['date_to'] = $this->oo_date_to;
    }

    public function mount()
    {
        $this->oo_date_from = Order::min('created_at');
        $this->oo_date_to = Order::max('created_at');
        $this->oo_filters['date_from'] = $this->oo_date_from;
        $this->oo_filters['date_to'] = $this->oo_date_to;
        $this->os_filters['date_from'] = $this->oo_date_from;
        $this->os_filters['date_to'] = $this->oo_date_to;
    }

    public function getMarketOrders()
    {
        $this->oo_order_status_id == 'all' ? $this->oo_order_status_id = null : null;
        $this->oo_property_type_id == 'all' ? $this->oo_property_type_id = null : null;
        $this->oo_city_id == 'all' ? $this->oo_city_id = null : null;
        $this->oo_branch_type_id == 'all' ? $this->oo_branch_type_id = null : null;

        $this->oo_filters['order_status_id'] = $this->oo_order_status_id;
        $this->oo_filters['property_type_id'] = $this->oo_property_type_id;
        $this->oo_filters['city_id'] = $this->oo_city_id;
        $this->oo_filters['branch_type_id'] = $this->oo_branch_type_id;
        $this->oo_filters['search'] = $this->oo_search;

        $models = Order::data()->filters($this->oo_filters)->reorder($this->oo_sort_field, $this->oo_sort_direction)->where('user_id', auth()->id());

        if ($this->oo_rows_number == 'all') {
            $this->oo_rows_number = $models->count();
        }

        $data = $models->paginate($this->oo_rows_number);

        $this->oo_paginate_ids = $data->pluck('id')->toArray();

        return $data;
    }

    public function getAssignMarketOrders()
    {
        $this->os_order_status_id == 'all' ? $this->os_order_status_id = null : null;
        $this->os_property_type_id == 'all' ? $this->os_property_type_id = null : null;
        $this->os_city_id == 'all' ? $this->os_city_id = null : null;
        $this->os_branch_type_id == 'all' ? $this->os_branch_type_id = null : null;

        $this->os_filters['order_status_id'] = $this->os_order_status_id;
        $this->os_filters['property_type_id'] = $this->os_property_type_id;
        $this->os_filters['city_id'] = $this->os_city_id;
        $this->os_filters['branch_type_id'] = $this->os_branch_type_id;
        $this->os_filters['search'] = $this->os_search;

        $models = Order::data()->filters($this->os_filters)->reorder($this->os_sort_field, $this->os_sort_direction)->where('assign_to', auth()->id());

        if ($this->os_rows_number == 'all') {
            $this->os_rows_number = $models->count();
        }

        $data = $models->paginate($this->os_rows_number);

        $this->os_paginate_ids = $data->pluck('id')->toArray();

        return $data;
    }

    public function os_sortBy($field)
    {
        if ($this->os_sort_field == $field) {
            if ($this->os_sort_direction === 'asc') {
                $this->os_sort_direction = 'desc';
                $this->os_style_sort_direction = 'sorting_desc';
            } else {
                $this->os_sort_direction = 'asc';
                $this->os_style_sort_direction = 'sorting_asc';
            }
        } else {
            $this->os_sort_direction = 'asc';
            $this->os_style_sort_direction = 'sorting_asc';
        }

        $this->os_sort_field = $field;
    }

    public function oo_sortBy($field)
    {
        if ($this->oo_sort_field == $field) {
            if ($this->oo_sort_direction === 'asc') {
                $this->oo_sort_direction = 'desc';
                $this->oo_style_sort_direction = 'sorting_desc';
            } else {
                $this->oo_sort_direction = 'asc';
                $this->oo_style_sort_direction = 'sorting_asc';
            }
        } else {
            $this->oo_sort_direction = 'asc';
            $this->oo_style_sort_direction = 'sorting_asc';
        }

        $this->oo_sort_field = $field;
    }

    public function render()
    {
        $assign_market_orders = $this->getAssignMarketOrders();
        $market_orders = $this->getMarketOrders();

        return view('livewire.order-market', [
            'assign_market_orders' => $assign_market_orders,
            'market_orders' => $market_orders
        ]);
    }

    public function ooDateFrom()
    {
        $this->oo_filters['date_from'] = $this->oo_date_from;
    }

    public function ooDateTo()
    {
        $this->oo_filters['date_to'] = $this->oo_date_to;
    }

    public function osDateFrom()
    {
        $this->os_filters['date_from'] = $this->os_date_from;
    }

    public function osDateTo()
    {
        $this->os_filters['date_to'] = $this->os_date_to;
    }

    public function callOrderModal($order_id)
    {
        $this->emit('openOrderModal', $order_id);
    }

    public function closeOrder($order_id)
    {
        $order = Order::find($order_id);
        $user = auth()->user();

        if ($order) {
            if ($order->order_status_id == 3) {

                $order->update(['order_status_id' =>  5]);

                if ($user->user_type == 'marketer') {
                    $marketer_name = getUserName($user->id);
                    $link_marketer = route('panel.user', $user->id);
                    $marketer = "<a href='$link_marketer'> $marketer_name</a>";
                    $note = "قام المسوق $marketer بإغلاق الطلب";
                }

                if ($user->user_type == 'office') {
                    $office_name = getUserName($user->id);
                    $link_office = route('panel.user', $user->id);
                    $office = "<a href='$link_office'> $office_name</a>";
                    $note = "قام المكتب $office بإغلاق الطلب";
                }

                OrderEditor::create([
                    'order_id' => $order->id,
                    'user_id' => $user->id,
                    'note' => $note,
                    'action' => 'active',
                ]);
            } else {
                $order->update(['order_status_id' => 3]);

                if ($user->user_type == 'marketer') {
                    $marketer_name = getUserName($user->id);
                    $link_marketer = route('panel.user', $user->id);
                    $marketer = "<a href='$link_marketer'> $marketer_name</a>";
                    $note = "قام المسوق $marketer بإغلاق الطلب";
                }

                if ($user->user_type == 'office') {
                    $office_name = getUserName($user->id);
                    $link_office = route('panel.user', $user->id);
                    $office = "<a href='$link_office'> $office_name</a>";
                    $note = "قام المكتب $office بإغلاق الطلب";
                }

                OrderEditor::create([
                    'order_id' => $order->id,
                    'user_id' => $user->id,
                    'note' => $note,
                    'action' => 'cancel',
                ]);
            }
        }

        $this->alert('success', '', [
            'toast' => true,
            'position' => 'center',
            'timer' => 3000,
            'text' => '👍 تم تغيير حالة الطلب بنجاح',
            'timerProgressBar' => true,
        ]);
    }

    public function export($type, $check)
    {
        if ($check == 'MarketOrders') {
            $user_field = 'user_id';
            $order_export = new OrdersExport($this->oo_filters, $this->oo_sort_field, $this->oo_sort_direction, $this->oo_rows_number, $this->oo_paginate_ids, $user_field);
        } elseif ($check == 'AssignMarketOrders') {
            $user_field = 'assign_to';
            $order_export = new OrdersExport($this->os_filters, $this->os_sort_field, $this->os_sort_direction, $this->os_rows_number, $this->os_paginate_ids, $user_field);
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
            $excel = Excel::download($order_export, 'orders.xlsx');

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
