<div class="row" wire:ignore.self>
    <div class="col-12" wire:ignore.self>
        <div class="card" wire:ignore.self>

            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">


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
                                        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
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
                        <div class="col-sm-12 col-md-3">
                            <div class="dataTables_length">
                                <label>أظهر
                                    <select aria-controls="DataTables_Table_0" wire:model='rows_number'
                                        class="form-select">
                                        <option value="10">10</option>
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

                            <label>التاريخ من:
                                <input type="date" wire:change='dateFrom' wire:model='date_from'
                                    class="form-control">
                            </label>

                            <label>التاريخ الى:
                                <input type="date" wire:change='dateTo' wire:model='date_to' class="form-control">
                            </label>

                            <label>حالة الحجز:
                                <select wire:model='reservation_status' class="form-select"
                                    style="margin-left: .5em; display: inline-block; width: auto;" wire:ignore.self>
                                    <option value="all" selected>الكل</option>
                                    <option value="1" selected>نشط</option>
                                    <option value="2" selected>غير نشط</option>
                                </select>
                            </label>

                            <label>ابحث:<input type="search" wire:model='search' class="form-control"
                                    placeholder="الاسم/الهاتف/الكود ID"></label>
                        </div>
                    </div>

                </div>


                <table class="table dataTable no-footer text-center" role="grid"
                    aria-describedby="DataTables_Table_0_info" wire:ignore.self>
                    <thead>
                        <tr>
                            <th>رقم الحجز</th>
                            <th>التاريخ</th>
                            <th>اسم العميل</th>
                            <th>السعر</th>
                            <th>فترة الحجز</th>
                            <th>الحالة</th>
                            <th>تحكم</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->id }}</td>
                                <td>{{ $reservation->created_at->format('Y-m-d') }}</td>
                                <td>{{ getCustomerName($reservation->customer_id) }}</td>
                                <td>{{ number_format($reservation->price) }}</td>
                                <td>{{ $reservation->date_from }} - {{ $reservation->date_to }}</td>

                                <td>
                                    @if ($reservation->status == 1)
                                        <span class="badge bg-success">نشط</span>
                                    @else
                                        <span class="badge bg-danger"> غير نشط</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="d-inline-flex">
                                        <a class="item-edit" data-bs-target="#EditReservationForm"
                                            wire:click='callReservationModal({{ $reservation->id }})'
                                            data-bs-toggle="modal">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn item-edit"
                                            wire:click='changeReservationStatus({{ $reservation->id }})'
                                            style="padding:0;color:#EA5455 ">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination Pages --}}
                <div class="d-flex justify-content-between mx-0 row" wire:ignore.self>

                    <div class="col-sm-12 col-md-6" wire:ignore.self>
                        <div class="dataTables_info" role="status" aria-live="polite" wire:ignore.self> إظهار
                            {{ $reservations->perPage() }} من اصل {{ $reservations->total() }}
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6" wire:ignore.self>
                        <div class="dataTables_paginate paging_simple_numbers" wire:ignore.self>
                            <ul class="pagination" wire:ignore.self>
                                {{ $reservations->withQueryString()->onEachSide(0)->links() }}
                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
