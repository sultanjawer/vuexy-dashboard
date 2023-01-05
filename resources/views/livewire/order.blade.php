<div>
    <section class="app-user-list">
        <section id="basic-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- Navbar Sections --}}
                        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist" wire:ignore>

                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab-fill" data-bs-toggle="tab" href="#home-fill"
                                    role="tab" aria-controls="home-fill" aria-selected="true">طلبات مضافة من
                                    قبلي</a>
                            </li>

                            @auth
                                @if (auth()->user()->user_type == 'marketer')
                                    <li class="nav-item">
                                        <a class="nav-link" id="home2-tab-fill" data-bs-toggle="tab" href="#home2-fill"
                                            role="tab" aria-controls="home2-fill" aria-selected="false">طلبات تم
                                            إسنادها إلي</a>
                                    </li>
                                @endif
                            @endauth
                        </ul>

                        {{-- Navbar Sections --}}
                        <div class="tab-content pt-1">
                            <div class="tab-pane active" id="home-fill" role="tabpanel" aria-labelledby="home-tab-fill"
                                wire:ignore.self>
                                <div class="dataTables_wrapper dt-bootstrap5 no-footer">

                                    {{-- Export Section --}}
                                    <div class="card-header border-bottom p-1">
                                        <div class="head-label"></div>
                                        <div class="btn-group">
                                            <button class="btn btn-gradient-warning dropdown-toggle" type="button"
                                                id="dropdownMenuButton303" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                تصدير
                                            </button>
                                            <div class="dropdown-menu text-center export p-0"
                                                aria-labelledby="dropdownMenuButton303" style="">

                                                <button class="btn export" tabindex="0" wire:click="export('excel')"
                                                    aria-controls="DataTables_Table_0" type="button">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-file font-small-4 me-50">
                                                            <path
                                                                d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z">
                                                            </path>
                                                            <polyline points="13 2 13 9 20 9"></polyline>
                                                        </svg>Excel
                                                    </span>
                                                </button>


                                                {{-- <a class="dropdown-item" href="#">Excel</a> --}}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Export Section --}}

                                    <div class="d-flex justify-content-between align-items-center mx-0 row">

                                        {{-- Number of Rows Sections --}}
                                        <div class="col-sm-12 col-md-3">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="dataTables_length">
                                                    <label>أظهر
                                                        <select wire:model='rows_number' class="form-select">
                                                            <option value="all">الكل</option>
                                                            <option value="10" selected>10</option>
                                                            <option value="25">25</option>
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                        </select> مدخلات
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Search Sections --}}
                                        <div class="col-sm-12 col-md-9">
                                            <div class="dataTables_filter">
                                                <label>حالة الطلب:
                                                    <select wire:model='order_status_id' class="form-select"
                                                        style="margin-left: .5em; display: inline-block; width: auto; ">
                                                        <option value="all" selected>الكل</option>
                                                        @foreach (getOrderStatuses() as $order_status)
                                                            <option value="{{ $order_status->id }}">
                                                                {{ $order_status->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </label>

                                                <label>نوع العقار:
                                                    <select wire:model='property_type_id' class="form-select"
                                                        style="margin-left: .5em; display: inline-block; width: auto; ">
                                                        <option value="all" selected>الكل</option>
                                                        @foreach (getPropertyTypes() as $property_type)
                                                            <option value="{{ $property_type->id }}">
                                                                {{ $property_type->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </label>
                                                <label>الفرع:
                                                    <select wire:model='branch_type_id' class="form-select"
                                                        style="margin-left: .5em; display: inline-block; width: auto; ">
                                                        <option value="all" selected>الكل</option>
                                                        @foreach (getBranches() as $branch)
                                                            <option value="{{ $branch->id }}">{{ $branch->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </label>

                                                <label>المدينة:
                                                    <select wire:model='city_id' class="form-select"
                                                        style="margin-left: .5em; display: inline-block; width: auto;">
                                                        <option value="all" selected>الكل</option>
                                                        @foreach (getCities() as $city)
                                                            <option value="{{ $city->id }}">{{ $city->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </label>

                                                <label>ابحث:<input type="search" wire:model='search'
                                                        class="form-control"
                                                        placeholder="رقم الجوال/ رقم الطلب"></label>

                                                <label>التاريخ من:
                                                    <input type="date" wire:change='dateFrom' wire:model='date_from'
                                                        class="form-control">
                                                </label>

                                                <label>التاريخ الى:
                                                    <input type="date" wire:change='dateTo' wire:model='date_to'
                                                        class="form-control">
                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                    <table class="table dataTable no-footer center text-center" role="grid">
                                        <thead>
                                            <tr role="row">
                                                {{-- <th>ID</th> --}}
                                                <th class="sorting {{ $style_sort_direction }}"
                                                    wire:click="sortBy('id')" tabindex="0"
                                                    rowspan="1"colspan="1">كود الطلب </th>

                                                <th rowspan="1" colspan="1">التاريخ</th>
                                                <th rowspan="1" colspan="1">نوع العقار</th>
                                                @if (in_array(auth()->user()->user_type, ['superadmin', 'admin', 'marketer']))
                                                    <th rowspan="1" colspan="1">صاحب الطلب</th>
                                                @endif
                                                <th rowspan="1" colspan="1">المدينة</th>
                                                <th rowspan="1" colspan="1">اسم العميل</th>
                                                <th rowspan="1" colspan="1">الميزانية</th>
                                                <th rowspan="1" colspan="1">الحالة</th>
                                                <th rowspan="1" colspan="1">الطلب مسند ل</th>
                                                <th rowspan="1" colspan="1">الفرع</th>

                                                @auth
                                                    @if (auth()->user()->can('showOrder', App\Models\Order::class) ||
                                                        auth()->user()->can('updateOrder', App\Models\Order::class) ||
                                                        auth()->user()->can('changeOrderStatus', App\Models\Order::class))
                                                        <th class="sorting" tabindex="0" rowspan="1"
                                                            colspan="1">
                                                            تحكم
                                                        </th>
                                                    @endif
                                                @endauth
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($orders as $order)
                                                <tr class="odd">
                                                    {{-- <td class="sorting_1">{{ $order->id }}</td> --}}
                                                    <td class="sorting_1">{{ $order->order_code }}</td>
                                                    <td> {{ $order->created_at->format('Y-m-d') }} </td>

                                                    <td>
                                                        @if ($order->property_type_id == 1)
                                                            <span class="badge bg-primary">
                                                                {{ getPropertyTypeName($order->property_type_id) }}
                                                            </span>
                                                        @endif

                                                        @if ($order->property_type_id == 2)
                                                            <span class="badge bg-warning">
                                                                {{ getPropertyTypeName($order->property_type_id) }}
                                                            </span>
                                                        @endif

                                                        @if ($order->property_type_id == 3)
                                                            <span class="badge bg-danger">
                                                                {{ getPropertyTypeName($order->property_type_id) }}
                                                            </span>
                                                        @endif


                                                        @if ($order->property_type_id == 4)
                                                            <span class="badge bg-dark">
                                                                {{ getPropertyTypeName($order->property_type_id) }}
                                                            </span>
                                                        @endif

                                                        @if ($order->property_type_id == 5)
                                                            <span class="badge bg-success">
                                                                {{ getPropertyTypeName($order->property_type_id) }}
                                                            </span>
                                                        @endif
                                                    </td>


                                                    @if (in_array(auth()->user()->user_type, ['superadmin', 'admin', 'marketer']))
                                                        <td>
                                                            @if (getUser($order->user_id)->user_type == 'marketer')
                                                                {{ 'المسوق ' . $order->user->name }}
                                                            @endif

                                                            @if (getUser($order->user_id)->user_type == 'office')
                                                                {{ 'المكتب ' . $order->user->name }}
                                                            @endif

                                                            @if (in_array(getUser($order->user_id)->user_type, ['admin', 'superadmin']))
                                                                {{ 'المدير ' . $order->user->name }}
                                                            @endif
                                                        </td>
                                                    @endif

                                                    <td>
                                                        <span class="badge bg-dark">
                                                            {{ getCityName($order->city_id) }}
                                                        </span>
                                                    </td>

                                                    <td>{{ getCustomerName($order->customer_id) }}</td>
                                                    <td>{{ number_format($order->price_from) }} -
                                                        {{ number_format($order->price_to) }}
                                                    </td>


                                                    <td>
                                                        @if ($order->order_status_id == 1)
                                                            <span class="badge bg-warning">
                                                                {{ getOrderStatusName($order->order_status_id) }}
                                                            </span>
                                                        @endif

                                                        @if ($order->order_status_id == 2)
                                                            <span class="badge bg-success">
                                                                {{ getOrderStatusName($order->order_status_id) }}
                                                            </span>
                                                        @endif

                                                        @if ($order->order_status_id == 3)
                                                            <span class="badge bg-danger">
                                                                {{ getOrderStatusName($order->order_status_id) }}
                                                            </span>
                                                        @endif


                                                        @if ($order->order_status_id == 4)
                                                            <span class="badge bg-dark">
                                                                {{ getOrderStatusName($order->order_status_id) }}
                                                            </span>
                                                        @endif

                                                        @if ($order->order_status_id == 5)
                                                            <span class="badge bg-warning">
                                                                {{ getOrderStatusName($order->order_status_id) }}
                                                            </span>
                                                        @endif


                                                        @if ($order->order_status_id == 6)
                                                            <span class="badge bg-warning">
                                                                {{ getOrderStatusName($order->order_status_id) }}
                                                            </span>
                                                        @endif
                                                    </td>

                                                    @if (whoType($order->who_add) == 'marketer')
                                                        <td>
                                                            <strong class="fs-4">--</strong>
                                                        </td>
                                                    @else
                                                        @if (getUserName($order->assign_to))
                                                            <td>
                                                                USR{{ $order->assign_to }}
                                                            </td>
                                                        @else
                                                            <td>
                                                                <span class="badge bg-danger">
                                                                    غير مسند
                                                                </span>
                                                            </td>
                                                        @endif
                                                    @endif

                                                    <td>
                                                        <span class="badge bg-primary">
                                                            {{ getBranchName($order->branch_id) }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <div class="d-inline-flex">

                                                            @auth
                                                                @if (auth()->user()->can('showOrder', App\Models\Order::class))
                                                                    <a href="{{ route('panel.order', $order->id) }}"
                                                                        class="item-view">
                                                                        <i class="fas fa-eye"></i>
                                                                    </a>
                                                                @endif

                                                                @if (auth()->user()->can('updateOrder', App\Models\Order::class))
                                                                    <a class="item-edit" data-bs-target="#editOrderForms"
                                                                        data-bs-toggle="modal"
                                                                        wire:click='callOrderModal({{ $order->id }})'>
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                @endif

                                                                @if (auth()->user()->can('changeOrderStatus', App\Models\Order::class))
                                                                    <a class="btn item-edit"
                                                                        wire:click='closeOrder({{ $order->id }})'
                                                                        style="padding:0;color:#EA5455 ">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </a>
                                                                @endif

                                                            @endauth

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                    @if (!$orders->count())
                                        <div class="d-flex justify-content-center">
                                            <h4 class="btn btn-danger w-75">
                                                لا يوجد طلبات حاليا
                                            </h4>
                                        </div>
                                    @endif
                                    {{-- Pagination Pages --}}
                                    <div class="d-flex justify-content-between mx-0 row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dataTables_info" role="status" aria-live="polite"> إظهار
                                                {{ $orders->perPage() }} من اصل {{ $orders->total() }}
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="dataTables_paginate paging_simple_numbers"
                                                id="DataTables_Table_0_paginate">
                                                <ul class="pagination">
                                                    {{ $orders->withQueryString()->onEachSide(0)->links() }}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            @auth
                                @if (auth()->user()->user_type == 'marketer')
                                    <div class="tab-pane " id="home2-fill" role="tabpanel"
                                        aria-labelledby="home2-tab-fill" wire:ignore.self>
                                        <div class="dataTables_wrapper dt-bootstrap5 no-footer">


                                            <div class="d-flex justify-content-between align-items-center mx-0 row">


                                                <div class="col-sm-12 col-md-3">
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="dataTables_length">
                                                            <label>أظهر
                                                                <select class="form-select" wire:model='os_rows_number'>
                                                                    <option value="10">10</option>
                                                                    <option value="25">25</option>
                                                                    <option value="50">50</option>
                                                                    <option value="100">100</option>
                                                                </select> مدخلات
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>


                                                {{-- Search Sections --}}
                                                <div class="col-sm-12 col-md-9">
                                                    <div class="dataTables_filter">
                                                        <label>حالة الطلب:
                                                            <select wire:model='os_order_status_id' class="form-select"
                                                                style="margin-left: .5em; display: inline-block; width: auto;">
                                                                <option value="all" selected>الكل</option>
                                                                @foreach (getOrderStatuses() as $order_status)
                                                                    <option value="{{ $order_status->id }}">
                                                                        {{ $order_status->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </label>

                                                        <label>نوع العقار:
                                                            <select wire:model='os_property_type_id' class="form-select"
                                                                style="margin-left: .5em; display: inline-block; width: auto;">
                                                                <option value="all" selected>الكل</option>
                                                                @foreach (getPropertyTypes() as $property_type)
                                                                    <option value="{{ $property_type->id }}">
                                                                        {{ $property_type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </label>
                                                        <label>الفرع:
                                                            <select wire:model='os_branch_type_id' class="form-select"
                                                                style="margin-left: .5em; display: inline-block; width: auto;">
                                                                <option value="all" selected>الكل</option>
                                                                @foreach (getBranches() as $branch)
                                                                    <option value="{{ $branch->id }}">
                                                                        {{ $branch->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </label>

                                                        <label>المدينة:
                                                            <select wire:model='os_city_id' class="form-select"
                                                                style="margin-left: .5em; display: inline-block; width: auto;">
                                                                <option value="all" selected>الكل</option>
                                                                @foreach (getCities() as $city)
                                                                    <option value="{{ $city->id }}">
                                                                        {{ $city->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </label>

                                                        <label>ابحث:<input type="search" wire:model='os_search'
                                                                class="form-control"
                                                                placeholder="رقم الجوال/ رقم الطلب"></label>


                                                        <label>التاريخ من:
                                                            <input type="date" wire:change='osDateFrom'
                                                                wire:model='os_date_from' class="form-control">
                                                        </label>

                                                        <label>التاريخ الى:
                                                            <input type="date" wire:change='osDateTo'
                                                                wire:model='os_date_to' class="form-control">
                                                        </label>

                                                    </div>

                                                </div>

                                            </div>

                                            <table class="table dataTable no-footer text-center" role="grid">

                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting {{ $style_sort_direction }}"
                                                            wire:click="os_sortBy('id')" tabindex="0"
                                                            rowspan="1"colspan="1">رقم الطلب </th>
                                                        <th class="sorting" tabindex="0" rowspan="1"
                                                            colspan="1">التاريخ</th>
                                                        <th class="sorting" tabindex="0" rowspan="1"
                                                            colspan="1">نوع العقار</th>
                                                        @if (in_array(auth()->user()->user_type, ['superadmin', 'admin', 'marketer']))
                                                            <th rowspan="1" colspan="1">صاحب الطلب</th>
                                                        @endif
                                                        <th class="sorting" tabindex="0" rowspan="1"
                                                            colspan="1">المدينة</th>
                                                        <th class="sorting" tabindex="0" rowspan="1"
                                                            colspan="1">اسم العميل</th>
                                                        <th class="sorting" tabindex="0" rowspan="1"
                                                            colspan="1">الميزانية</th>
                                                        <th class="sorting" tabindex="0" rowspan="1"
                                                            colspan="1">الحالة</th>
                                                        <th class="sorting" tabindex="0" rowspan="1"
                                                            colspan="1">الفرع</th>

                                                        @auth
                                                            @if (auth()->user()->can('showOrder', App\Models\Order::class) ||
                                                                auth()->user()->can('updateOrder', App\Models\Order::class))
                                                                <th class="sorting" tabindex="0" rowspan="1"
                                                                    colspan="1">
                                                                    تحكم
                                                                </th>
                                                            @endif
                                                        @endauth

                                                    </tr>
                                                </thead>

                                                <tbody>


                                                    @foreach ($assign_market_orders as $market_order)
                                                        <tr class="odd">

                                                            <td class="sorting_1">{{ $market_order->order_code }}</td>
                                                            <td> {{ $market_order->created_at->format('Y-m-d') }} </td>

                                                            <td>
                                                                @if ($market_order->property_type_id == 1)
                                                                    <span class="badge bg-primary">
                                                                        {{ getPropertyTypeName($market_order->property_type_id) }}
                                                                    </span>
                                                                @endif

                                                                @if ($market_order->property_type_id == 2)
                                                                    <span class="badge bg-warning">
                                                                        {{ getPropertyTypeName($market_order->property_type_id) }}
                                                                    </span>
                                                                @endif

                                                                @if ($market_order->property_type_id == 3)
                                                                    <span class="badge bg-danger">
                                                                        {{ getPropertyTypeName($market_order->property_type_id) }}
                                                                    </span>
                                                                @endif


                                                                @if ($market_order->property_type_id == 4)
                                                                    <span class="badge bg-dark">
                                                                        {{ getPropertyTypeName($market_order->property_type_id) }}
                                                                    </span>
                                                                @endif

                                                                @if ($market_order->property_type_id == 5)
                                                                    <span class="badge bg-success">
                                                                        {{ getPropertyTypeName($market_order->property_type_id) }}
                                                                    </span>
                                                                @endif
                                                            </td>

                                                            @if (in_array(auth()->user()->user_type, ['superadmin', 'admin', 'marketer']))
                                                                <td>
                                                                    @if (getUser($order->user_id)->user_type == 'marketer')
                                                                        {{ 'المسوق ' . $order->user->name }}
                                                                    @endif

                                                                    @if (getUser($order->user_id)->user_type == 'office')
                                                                        {{ 'المكتب ' . $order->user->name }}
                                                                    @endif

                                                                    @if (in_array(getUser($order->user_id)->user_type, ['admin', 'superadmin']))
                                                                        {{ 'المدير ' . $order->user->name }}
                                                                    @endif
                                                                </td>
                                                            @endif


                                                            <td>
                                                                <span class="badge bg-dark">
                                                                    {{ getCityName($market_order->city_id) }}
                                                                </span>
                                                            </td>

                                                            <td>{{ getCustomerName($market_order->customer_id) }}</td>
                                                            <td>{{ number_format($market_order->price_from) }} -
                                                                {{ number_format($market_order->price_to) }}</td>


                                                            <td>
                                                                @if ($market_order->order_status_id == 1)
                                                                    <span class="badge bg-warning">
                                                                        {{ getOrderStatusName($market_order->order_status_id) }}
                                                                    </span>
                                                                @endif

                                                                @if ($market_order->order_status_id == 2)
                                                                    <span class="badge bg-success">
                                                                        {{ getOrderStatusName($market_order->order_status_id) }}
                                                                    </span>
                                                                @endif

                                                                @if ($market_order->order_status_id == 3)
                                                                    <span class="badge bg-danger">
                                                                        {{ getOrderStatusName($market_order->order_status_id) }}
                                                                    </span>
                                                                @endif


                                                                @if ($market_order->order_status_id == 4)
                                                                    <span class="badge bg-dark">
                                                                        {{ getOrderStatusName($market_order->order_status_id) }}
                                                                    </span>
                                                                @endif

                                                                @if ($market_order->order_status_id == 5)
                                                                    <span class="badge bg-warning">
                                                                        {{ getOrderStatusName($market_order->order_status_id) }}
                                                                    </span>
                                                                @endif

                                                                @if ($market_order->order_status_id == 6)
                                                                    <span class="badge bg-warning">
                                                                        {{ getOrderStatusName($market_order->order_status_id) }}
                                                                    </span>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                <span class="badge bg-primary">
                                                                    {{ getBranchName($market_order->branch_id) }}
                                                                </span>
                                                            </td>

                                                            <td>
                                                                <div class="d-inline-flex">

                                                                    @auth
                                                                        @can('showOrder', App\Models\Order::class)
                                                                            <a href="{{ route('panel.order', $market_order->id) }}"
                                                                                class="item-view">
                                                                                <i class="fas fa-eye"></i>
                                                                            </a>
                                                                        @endcan
                                                                    @endauth
                                                                    {{-- @if (auth()->user()->permissions->can_edit_orders == 1)
                                                                <a class="item-edit" data-bs-target="#editOrderForms"
                                                                    data-bs-toggle="modal"
                                                                    wire:click='callOrderModal({{ $market_order->id }})'>
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                            @endif --}}

                                                                    {{--   @if (auth()->user()->permissions->can_cancel_orders == 1)
                                                                <button
                                                                class="btn item-edit waves-effect waves-float waves-light"
                                                                style="padding:0;color:#EA5455 ">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                            @endif --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                            @if (!$assign_market_orders->count())
                                                <div class="d-flex justify-content-center">
                                                    <h4 class="btn btn-danger w-75">
                                                        لا يوجد طلبات مسندة
                                                    </h4>
                                                </div>
                                            @endif

                                            <div class="d-flex justify-content-between mx-0 row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="dataTables_info" role="status" aria-live="polite"> إظهار
                                                        {{ $assign_market_orders->perPage() }} من اصل
                                                        {{ $assign_market_orders->total() }}
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-6">
                                                    <div class="dataTables_paginate paging_simple_numbers">
                                                        <ul class="pagination">
                                                            {{ $assign_market_orders->withQueryString()->onEachSide(0)->links() }}
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>
