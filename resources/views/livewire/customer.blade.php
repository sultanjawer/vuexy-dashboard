<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="dataTables_wrapper dt-bootstrap5 no-footer">


                <div class="card-header border-bottom p-1">
                    <div class="head-label"></div>
                    <div class="btn-group">
                        <button class="btn btn-gradient-warning dropdown-toggle" type="button" id="dropdownMenuButton303"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            تصدير
                        </button>
                        <div class="dropdown-menu text-center export p-0" aria-labelledby="dropdownMenuButton303"
                            style="">

                            <button class="btn export" tabindex="0" wire:click="export('excel')"
                                aria-controls="DataTables_Table_0" type="button">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-file font-small-4 me-50">
                                        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z">
                                        </path>
                                        <polyline points="13 2 13 9 20 9"></polyline>
                                    </svg>Excel
                                </span>
                            </button>

                            {{-- <a class="dropdown-item" href="#">Excel</a> --}}
                        </div>
                    </div>
                </div>


                <div class="d-flex justify-content-between align-items-center mx-0 row">


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

                    <div class="col-sm-12 col-md-9">
                        <div class="dataTables_filter">



                            <label>المدن:
                                <select wire:model='customer_city_id' class="form-select"
                                    style="margin-left: .5em; display: inline-block; width: auto;">
                                    <option value="all" selected>الكل</option>
                                    @foreach (getCities() as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </label>

                            <label>القطاع:
                                <select wire:model='customer_sector' class="form-select"
                                    style="margin-left: .5em; display: inline-block; width: auto;">
                                    <option value="all" selected>الكل</option>
                                    <option value="public" selected>عام</option>
                                    <option value="private" selected>خاص</option>
                                </select>
                            </label>

                            <label>حالة العميل:
                                <select wire:model='customer_status' class="form-select"
                                    style="margin-left: .5em; display: inline-block; width: auto;">
                                    <option value="all" selected>الكل</option>
                                    <option value="1" selected>نشط</option>
                                    <option value="2" selected>غير نشط</option>
                                </select>
                            </label>

                            <label>هل اشترى:
                                <select wire:model='is_buy' class="form-select"
                                    style="margin-left: .5em; display: inline-block; width: auto;">
                                    <option value="all" selected>الكل</option>
                                    <option value="1" selected>اشترى</option>
                                    <option value="2" selected>لم يشتري</option>
                                </select>
                            </label>


                            <label>ابحث:<input type="search" wire:model='search' class="form-control"
                                    placeholder="الاسم/ رقم الهاتف"></label>
                        </div>
                    </div>

                </div>

                <table class="table dataTable no-footer text-center" role="grid">
                    <thead>
                        <tr role="row">
                            <th class="sorting {{$style_sort_direction}}" wire:click="sortBy('id')" tabindex="0" rowspan="1"
                                colspan="1" aria-sort="ascending">الترتيب</th>
                            <th tabindex="0" rowspan="1" colspan="1">الاسم</th>
                            <th tabindex="0" rowspan="1" colspan="1">رقم الجوال </th>
                            <th tabindex="0" rowspan="1" colspan="1">نوع المدينة </th>
                            <th tabindex="0" rowspan="1" colspan="1">القطاع</th>
                            <th tabindex="0" rowspan="1" colspan="1">الحالة</th>
                            <th tabindex="0" rowspan="1" colspan="1">هل اشترى</th>
                            <th tabindex="0" rowspan="1" colspan="1">تحكم</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($customers as $customer)
                            <tr class="odd">
                                <td class="sorting_1">{{ $customer->id }}</td>
                                <td class="sorting_1">{{ $customer->name }}</td>

                                <td> {{ $customer->phone }} </td>

                                <td class="sorting_1">{{ getCityName($customer->city_id) }}</td>

                                <td>
                                    @if ($customer->employee_type == 'public')
                                        <span class="badge bg-success">عام</span>
                                    @else
                                        <span class="badge bg-dark">خاص</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($customer->status == 1)
                                        <span class="badge bg-success">نشط</span>
                                    @else
                                        <span class="badge bg-danger"> غير نشط</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($customer->is_buy == 1)
                                        <span class="badge bg-success">نعم</span>
                                    @else
                                        <span class="badge bg-danger">ليس بعد</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="d-inline-flex">

                                        <a class="item-edit" data-bs-target="#editCustomerForms"
                                            wire:click='callCustomerModal({{ $customer->id }})'
                                            data-bs-toggle="modal">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <a class="btn item-edit"
                                            wire:click='changeCustomerStatus({{ $customer->id }})'
                                            style="padding:0;color:#EA5455 ">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-between mx-0 row">


                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                            إظهار
                            {{ $customers->perPage() }} من اصل {{ $customers->total() }}
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                            <ul class="pagination">
                                {{ $customers->withQueryString()->onEachSide(0)->links() }}
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
