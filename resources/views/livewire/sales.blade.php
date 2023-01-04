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
                                    role="tab" aria-controls="home-fill" aria-selected="true">المبيعات المتوفرة</a>
                            </li>
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

                                                {{-- <button class="btn export" tabindex="0" wire:click="export('pdf')"
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
                                                        </svg>PDF
                                                    </span>
                                                </button> --}}


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

                                                <label>الحالة:
                                                    <select wire:model='sale_status' class="form-select"
                                                        style="margin-left: .5em; display: inline-block; width: auto; ">
                                                        <option value="all" selected>الكل</option>
                                                        <option value="1">نشط</option>
                                                        <option value="2">غير نشط</option>
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
                                                        class="form-control" placeholder="كود البيع"></label>

                                            </div>

                                        </div>

                                    </div>

                                    <table class="table dataTable no-footer center text-center" role="grid">
                                        <thead>
                                            <tr role="row">
                                                {{-- <th>ID</th> --}}
                                                <th class="sorting {{ $style_sort_direction }}"
                                                    wire:click="sortBy('id')" tabindex="0"
                                                    rowspan="1"colspan="1">كود البيع</th>
                                                <th rowspan="1" colspan="1">التاريخ</th>
                                                <th rowspan="1" colspan="1">المدينة</th>
                                                <th rowspan="1" colspan="1">نوع العقار</th>
                                                <th rowspan="1" colspan="1">رقم الأرض</th>
                                                <th rowspan="1" colspan="1">مساحة</th>
                                                <th rowspan="1" colspan="1">سعر العقار</th>
                                                <th rowspan="1" colspan="1">نوع التوظيف للعميل المشتري</th>
                                                <th rowspan="1" colspan="1">الفرع</th>
                                                <th rowspan="1" colspan="1">الحالة</th>
                                                @auth
                                                    @if (auth()->user()->can('showSale', App\Models\Sale::class) ||
                                                        auth()->user()->can('updateSale', App\Models\Sale::class) ||
                                                        auth()->user()->can('changeSaleStatus', App\Models\Sale::class))
                                                        <th class="sorting" tabindex="0" rowspan="1"
                                                            colspan="1">
                                                            تحكم
                                                        </th>
                                                    @endif
                                                @endauth
                                            </tr>
                                        </thead>

                                        <tbody>


                                            @foreach ($sales as $sale)
                                                <tr class="odd">
                                                    <td class="sorting_1">{{ $sale->sale_code }}</td>
                                                    <td> {{ $sale->created_at->format('Y-m-d') }} </td>
                                                    <td> {{ $sale->realEstate->city->name }} </td>

                                                    <td>
                                                        @if ($sale->realEstate->property_type_id == 1)
                                                            <span class="badge bg-primary">
                                                                {{ $sale->realEstate->propertyType->name }}
                                                            </span>
                                                        @endif

                                                        @if ($sale->realEstate->property_type_id == 2)
                                                            <span class="badge bg-warning">
                                                                {{ $sale->realEstate->propertyType->name }}
                                                            </span>
                                                        @endif

                                                        @if ($sale->realEstate->property_type_id == 3)
                                                            <span class="badge bg-danger">
                                                                {{ $sale->realEstate->propertyType->name }}
                                                            </span>
                                                        @endif


                                                        @if ($sale->realEstate->property_type_id == 4)
                                                            <span class="badge bg-dark">
                                                                {{ $sale->realEstate->propertyType->name }}
                                                            </span>
                                                        @endif

                                                        @if ($sale->realEstate->property_type_id == 5)
                                                            <span class="badge bg-success">
                                                                {{ $sale->realEstate->propertyType->name }}
                                                            </span>
                                                        @endif
                                                    </td>

                                                    <td> {{ $sale->realEstate->land_number }} </td>
                                                    <td> {{ number_format($sale->realEstate->space) }} </td>
                                                    <td> {{ number_format($sale->realEstate->total_price) }}
                                                    </td>

                                                    @if ($sale->customer->employee_type == 'public')
                                                        <td>
                                                            <span class="badge bg-success">{{ 'عام' }}</span>
                                                        </td>
                                                    @endif

                                                    @if ($sale->customer->employee_type == 'private')
                                                        <td>
                                                            <span class="badge bg-success">{{ 'خاص' }}</span>
                                                        </td>
                                                    @endif

                                                    <td> {{ $sale->realEstate->branch->name }} </td>

                                                    <td>
                                                        @if ($sale->sale_status == 1)
                                                            <span class="badge bg-success">نشط</span>
                                                        @else
                                                            <span class="badge bg-danger"> غير نشط</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <div class="d-inline-flex">

                                                            @auth
                                                                @if (auth()->user()->can('showSale', App\Models\Sale::class))
                                                                    <a href="{{ route('panel.sale', $sale->id) }}"
                                                                        class="item-view">
                                                                        <i class="fas fa-eye"></i>
                                                                    </a>
                                                                @endif

                                                                @if (auth()->user()->can('updateSale', App\Models\Sale::class))
                                                                    <a href="{{ route('panel.update.sale', $sale->id) }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                @endif

                                                                {{-- @if (auth()->user()->can('cancelSale', App\Models\Sale::class))
                                                                    <a class="btn item-edit"
                                                                        wire:click='cancelSale({{ $sale->id }})'
                                                                        style="padding:0;color:#EA5455 ">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </a>
                                                                @endif --}}

                                                            @endauth

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                    @if (!$sales->count())
                                        <div class="d-flex justify-content-center">
                                            <h4 class="btn btn-danger w-75">
                                                لا يوجد مبيعات حاليا
                                            </h4>
                                        </div>
                                    @endif
                                    {{-- Pagination Pages --}}
                                    <div class="d-flex justify-content-between mx-0 row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dataTables_info" role="status" aria-live="polite"> إظهار
                                                {{ $sales->perPage() }} من اصل {{ $sales->total() }}
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="dataTables_paginate paging_simple_numbers"
                                                id="DataTables_Table_0_paginate">
                                                <ul class="pagination">
                                                    {{ $sales->withQueryString()->onEachSide(0)->links() }}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

</div>
