<div>
    <section class="app-user-list">
        <section id="basic-datatable">
            <div class="row" wire:ignore.self>

                <div class="col-12" wire:ignore.self>
                    <div class="card" wire:ignore.self>

                        @auth

                            @if (auth()->user()->user_type == 'superadmin' ||
                                auth()->user()->user_type == 'admin' ||
                                auth()->user()->user_type == 'marketer')
                                <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist" wire:ignore>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab-fill" data-bs-toggle="tab" href="#home-fill"
                                            role="tab" aria-controls="home-fill" aria-selected="true">العروض
                                            المباشرة</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="home2-tab-fill" data-bs-toggle="tab" href="#home2-fill"
                                            role="tab" aria-controls="home2-fill" aria-selected="false">العروض الغير
                                            مباشرة</a>
                                    </li>
                                </ul>
                            @endif

                            @if (auth()->user()->user_type == 'office')
                                <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist" wire:ignore>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab-fill" data-bs-toggle="tab" href="#home-fill"
                                            role="tab" aria-controls="home-fill" aria-selected="true">العروض</a>
                                    </li>
                                </ul>
                            @endif


                            <div class="tab-content pt-1" wire:ignore.self>

                                <div class="tab-pane active" id="home-fill" role="tabpanel" aria-labelledby="home-tab-fill"
                                    wire:ignore.self>

                                    <div class="dataTables_wrapper dt-bootstrap5 no-footer">


                                        <div class="d-flex justify-content-between align-items-center mx-0 row">

                                            {{-- Number of Rows Sections --}}
                                            <div class="col-sm-12 col-md-3">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="dataTables_length">
                                                        <label>أظهر
                                                            <select wire:model='rows_number' class="form-select">
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

                                                    <label>ابحث:<input type="search" wire:model='search'
                                                            class="form-control" placeholder="كود العرض"></label>

                                                </div>

                                            </div>

                                        </div>

                                        <table class="datatables-basic table" wire:ignore.self>
                                            <thead>
                                                <tr>
                                                    <th>كود العرض</th>
                                                    <th>نوع العقار</th>
                                                    <th>بيان العقار</th>
                                                    <th>المدينة</th>
                                                    <th>الحي</th>
                                                    <th>السعر</th>
                                                    <th>الفرع</th>
                                                    <th>الحالة</th>
                                                    <th>تحكم</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach ($direct_offers as $direct_offer)
                                                    <tr>
                                                        <td>{{ $direct_offer->offer_code }}</td>

                                                        <td>
                                                            @if ($direct_offer->realEstate->property_type_id == 1)
                                                                <span class="badge bg-primary">
                                                                    {{ getPropertyTypeName($direct_offer->realEstate->property_type_id) }}
                                                                </span>
                                                            @endif

                                                            @if ($direct_offer->realEstate->property_type_id == 2)
                                                                <span class="badge bg-warning">
                                                                    {{ getPropertyTypeName($direct_offer->realEstate->property_type_id) }}
                                                                </span>
                                                            @endif

                                                            @if ($direct_offer->realEstate->property_type_id == 3)
                                                                <span class="badge bg-danger">
                                                                    {{ getPropertyTypeName($direct_offer->realEstate->property_type_id) }}
                                                                </span>
                                                            @endif

                                                            @if ($direct_offer->realEstate->property_type_id == 4)
                                                                <span class="badge bg-success">
                                                                    {{ getPropertyTypeName($direct_offer->realEstate->property_type_id) }}
                                                                </span>
                                                            @endif

                                                            @if ($direct_offer->realEstate->property_type_id == 5)
                                                                <span class="badge bg-secondary">
                                                                    {{ getPropertyTypeName($direct_offer->realEstate->property_type_id) }}
                                                                </span>
                                                            @endif
                                                        </td>

                                                        <td>{{ 'OOO' }}</td>
                                                        <td>{{ getCityName($direct_offer->realEstate->city_id) }}</td>
                                                        <td>{{ getNeighborhoodName($direct_offer->realEstate->neighborhood_id) }}
                                                        </td>
                                                        <td>ريال
                                                            {{ number_format($direct_offer->realEstate->total_price) }}
                                                        </td>
                                                        <td>{{ getBranchName($direct_offer->realEstate->branch_id) }}
                                                        </td>

                                                        <td>
                                                            @if ($direct_offer->realEstate->property_status_id == 1)
                                                                <span class="badge bg-success"> شاغر</span>
                                                            @endif

                                                            @if ($direct_offer->realEstate->property_status_id == 2)
                                                                <span class="badge bg-info"> محجوز</span>
                                                            @endif


                                                            @if ($direct_offer->realEstate->property_status_id == 3)
                                                                <span class="badge bg-danger"> تم البيع</span>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <div class="d-inline-flex">

                                                                @can('showOffer', $direct_offer)
                                                                    <a href="{{ route('panel.offer', $direct_offer->id) }}"
                                                                        class="item-view">
                                                                        <i class="fas fa-eye"></i>
                                                                    </a>
                                                                @endcan

                                                                @can('updateOffer', $direct_offer)
                                                                    <a href="{{ route('panel.update.offer', $direct_offer->id) }}"
                                                                        class="item-edit">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                @endcan

                                                                @can('changeOfferStatus', $direct_offer)
                                                                    <button class="btn item-edit"
                                                                        style="padding:0;color:#EA5455 ">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                @endcan

                                                            </div>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <div class="d-flex justify-content-between mx-0 row">


                                            <div class="col-sm-12 col-md-6">
                                                <div class="dataTables_info" id="DataTables_Table_0_info" role="status"
                                                    aria-live="polite">
                                                    إظهار
                                                    {{ $direct_offers->perPage() }} من اصل
                                                    {{ $direct_offers->total() }}
                                                </div>
                                            </div>


                                            <div class="col-sm-12 col-md-6">
                                                <div class="dataTables_paginate paging_simple_numbers"
                                                    id="DataTables_Table_0_paginate">
                                                    <ul class="pagination">
                                                        {{ $direct_offers->withQueryString()->onEachSide(0)->links() }}
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                @if (auth()->user()->user_type == 'superadmin' ||
                                    auth()->user()->user_type == 'admin' ||
                                    auth()->user()->user_type == 'marketer')
                                    <div class="tab-pane" id="home2-fill" role="tabpanel" aria-labelledby="home2-tab-fill"
                                        wire:ignore.self>

                                        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                                            <div class="d-flex justify-content-between align-items-center mx-0 row">


                                                <div class="col-sm-12 col-md-3">
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="dataTables_length">
                                                            <label>أظهر
                                                                <select class="form-select" wire:model='in_rows_number'>
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



                                                        <label>ابحث:<input type="search" wire:model='in_search'
                                                                class="form-control" placeholder="كود العرض"></label>

                                                    </div>
                                                </div>
                                            </div>

                                            <table class="datatables-basic table" wire:ignore.self>
                                                <thead>
                                                    <tr>
                                                        <th>كود العرض</th>
                                                        <th>نوع العقار</th>
                                                        <th>بيان العقار</th>
                                                        <th>المدينة</th>
                                                        <th>الحي</th>
                                                        <th>السعر</th>
                                                        <th>الفرع</th>
                                                        <th>الحالة</th>
                                                        <th>تحكم</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @foreach ($in_direct_offers as $in_direct_offer)
                                                        <tr>
                                                            <td>{{ $in_direct_offer->offer_code }}</td>

                                                            <td>
                                                                @if ($in_direct_offer->realEstate->property_type_id == 1)
                                                                    <span class="badge bg-primary">
                                                                        {{ getPropertyTypeName($in_direct_offer->realEstate->property_type_id) }}
                                                                    </span>
                                                                @endif

                                                                @if ($in_direct_offer->realEstate->property_type_id == 2)
                                                                    <span class="badge bg-warning">
                                                                        {{ getPropertyTypeName($in_direct_offer->realEstate->property_type_id) }}
                                                                    </span>
                                                                @endif


                                                                @if ($in_direct_offer->realEstate->property_type_id == 3)
                                                                    <span class="badge bg-danger">
                                                                        {{ getPropertyTypeName($in_direct_offer->realEstate->property_type_id) }}
                                                                    </span>
                                                                @endif

                                                                @if ($in_direct_offer->realEstate->property_type_id == 4)
                                                                    <span class="badge bg-success">
                                                                        {{ getPropertyTypeName($in_direct_offer->realEstate->property_type_id) }}
                                                                    </span>
                                                                @endif


                                                                @if ($in_direct_offer->realEstate->property_type_id == 5)
                                                                    <span class="badge bg-secondary">
                                                                        {{ getPropertyTypeName($in_direct_offer->realEstate->property_type_id) }}
                                                                    </span>
                                                                @endif
                                                            </td>
                                                            <td>{{ 'OOO' }}</td>

                                                            <td>{{ getCityName($in_direct_offer->realEstate->city_id) }}
                                                            </td>
                                                            <td>{{ getNeighborhoodName($in_direct_offer->realEstate->neighborhood_id) }}
                                                            </td>
                                                            <td>ريال {{ $in_direct_offer->realEstate->total_price }}</td>
                                                            <td>{{ getBranchName($in_direct_offer->realEstate->branch_id) }}
                                                            </td>

                                                            <td>
                                                                @if ($in_direct_offer->realEstate->property_status_id == 1)
                                                                    <span class="badge bg-success"> شاغر</span>
                                                                @endif

                                                                @if ($in_direct_offer->realEstate->property_status_id == 2)
                                                                    <span class="badge bg-info"> محجوز</span>
                                                                @endif


                                                                @if ($in_direct_offer->realEstate->property_status_id == 3)
                                                                    <span class="badge bg-danger"> تم البيع</span>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                <div class="d-inline-flex">
                                                                    @can('showOffer', $in_direct_offer)
                                                                        <a href="{{ route('panel.offer', $in_direct_offer->id) }}"
                                                                            class="item-view">
                                                                            <i class="fas fa-eye"></i>
                                                                        </a>
                                                                    @endcan

                                                                    @can('updateOffer', $in_direct_offer)
                                                                        <a href="{{ route('panel.update.offer', $in_direct_offer->id) }}"
                                                                            class="item-edit">
                                                                            <i class="fas fa-edit"></i>
                                                                        </a>
                                                                    @endcan

                                                                    @can('changeOfferStatus', $in_direct_offer)
                                                                        <button class="btn item-edit"
                                                                            style="padding:0;color:#EA5455 ">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </button>
                                                                    @endcan
                                                                </div>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                            @if (!$in_direct_offers->count())
                                                <div class="d-flex justify-content-center">
                                                    <h4 class="btn btn-danger w-75">
                                                        لا يوجد طلبات مسندة
                                                    </h4>
                                                </div>
                                            @endif


                                            <div class="d-flex justify-content-between mx-0 row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="dataTables_info" role="status" aria-live="polite"> إظهار
                                                        {{ $in_direct_offers->perPage() }} من اصل
                                                        {{ $in_direct_offers->total() }}
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-6">
                                                    <div class="dataTables_paginate paging_simple_numbers">
                                                        <ul class="pagination">
                                                            {{ $in_direct_offers->withQueryString()->onEachSide(0)->links() }}
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif



                            </div>

                        @endauth
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>
