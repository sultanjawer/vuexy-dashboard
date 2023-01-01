<div class="app-content content" wire:ignore.self>
    <div class="content-overlay" wire:ignore.self></div>
    <div class="header-navbar-shadow" wire:ignore.self></div>
    <div class="content-wrapper container-xxl p-0" wire:ignore.self>


        <div class="content-header row" wire:ignore.self></div>
        <div class="content-body" wire:ignore.self>

            <section id="dashboard-analytics">
                <div class="row match-height">
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row pb-40">
                                    <div
                                        class="col-sm-6 col-12 d-flex justify-content-between flex-column order-sm-1 order-2 mt-1 mt-sm-0">
                                        <div class="mb-1 mb-sm-0">
                                            <h2 wire:ignore.self="">كود العرض</h2>
                                            <h2 class="fw-bolder mb-25"><a href="#"> {{ $offer->offer_code }}</a>
                                            </h2>
                                            <div class="font-medium-2">
                                                {{-- <span class="fs-6">صاحب العرض: </span>
                                                <a href="{{ route('panel.user', $offer->user_id) }}">
                                                    <span class="text-success me-25 fs-6">
                                                        {{ getUserName($offer->user_id) }}</span>
                                                </a> --}}

                                                <a
                                                    class="btn  bg-light-warning waves-effect waves-float waves-light mt-1">
                                                    <span>
                                                        {{ $offer->realEstate->propertyType->name }}
                                                    </span>
                                                </a>

                                            </div>
                                        </div>

                                        <a href="javascript:;"
                                            class="btn bg-light-success mt-2 waves-effect waves-float waves-light"
                                            data-bs-target="#addReservation" wire:click='reservationData'
                                            data-bs-toggle="modal">
                                            @if (!$is_booked)
                                                حجز
                                            @endif

                                            @if ($is_booked)
                                                تفاصيل الحجز
                                            @endif
                                        </a>

                                        @auth
                                            @if (($is_booked && auth()->id() == $user_id) || ($is_booked && auth()->user()->user_type == 'superadmin'))
                                                <a href="javascript:;" wire:click="cancelReservation"
                                                    class="btn bg-light-danger mt-1 waves-effect waves-float waves-light">
                                                    إلغاء الحجز
                                                </a>
                                            @endif
                                        @endauth

                                        <a href="{{ route('panel.create.sale', $offer->id) }}"
                                            class="btn bg-light-primary mt-1 waves-effect waves-float waves-light">
                                            بيع
                                        </a>

                                    </div>

                                    <div class="col-sm-6 col-12 d-flex justify-content-between flex-column text-end order-sm-2 order-1"
                                        style="position: relative;">
                                        <div class="dropdown chart-dropdown">
                                            <button
                                                class="btn btn-sm border-0 dropdown-toggle p-50 waves-effect waves-float waves-light text-white"
                                                type="button">
                                                {{ $last_update_time }}
                                            </button>
                                        </div>

                                        <div style="min-height: 150px;">
                                            <div class="d-flex justify-content-center">

                                            </div>
                                        </div>

                                        <div class="resize-triggers">
                                            <div class="expand-trigger">
                                                <div style="width: 300px; height: 229px;"></div>
                                            </div>
                                            <div class="contract-trigger"></div>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="row avg-sessions pt-50">
                                    <div class="col-6 mb-2">
                                        <div class="avatar bg-light-primary rounded float-start me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-package font-medium-5">
                                                    <line x1="16.5" y1="9.4" x2="7.5" y2="4.21">
                                                    </line>
                                                    <path
                                                        d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                                                    </path>
                                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                                    <line x1="12" y1="22.08" x2="12" y2="12">
                                                    </line>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="transaction-percentage">
                                            <h6 class="transaction-title">{{ 'رقم الارض' }}:</h6>
                                            <span>{{ $offer->realEstate->land_number }}</span>
                                        </div>
                                    </div>

                                    <div class="col-6 mb-2">
                                        <div class="avatar bg-light-primary rounded float-start me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-package font-medium-5">
                                                    <line x1="16.5" y1="9.4" x2="7.5" y2="4.21">
                                                    </line>
                                                    <path
                                                        d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                                                    </path>
                                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                                    <line x1="12" y1="22.08" x2="12" y2="12">
                                                    </line>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="transaction-percentage">
                                            <h6 class="transaction-title">{{ 'رقم البلوك' }}:</h6>
                                            <span>{{ $offer->realEstate->block_number }}</span>
                                        </div>
                                    </div>

                                    <div class="col-6 mb-2">
                                        <div class="avatar bg-light-primary rounded float-start me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-map-pin avatar-icon font-medium-3">
                                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                    <circle cx="12" cy="10" r="3"></circle>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="transaction-percentage">
                                            <h6 class="transaction-title">{{ 'المدينة' }}:</h6>
                                            <span>{{ $offer->realEstate->city->name }}</span>
                                        </div>
                                    </div>

                                    <div class="col-6 mb-2">
                                        <div class="avatar bg-light-primary rounded float-start me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-map-pin avatar-icon font-medium-3">
                                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                    <circle cx="12" cy="10" r="3"></circle>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="transaction-percentage">
                                            <h6 class="transaction-title">{{ 'الحي' }}:</h6>
                                            <span>{{ $offer->realEstate->neighborhood->name }}</span>
                                        </div>
                                    </div>

                                    <div class="col-6 mb-2">
                                        <div class="avatar bg-light-primary rounded float-start me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-package font-medium-5">
                                                    <line x1="16.5" y1="9.4" x2="7.5"
                                                        y2="4.21"></line>
                                                    <path
                                                        d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                                                    </path>
                                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                                    <line x1="12" y1="22.08" x2="12"
                                                        y2="12"></line>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="transaction-percentage">
                                            <h6 class="transaction-title">{{ 'بيان العقار' }}:</h6>
                                            <span>{{ $offer->realEstate->real_estate_statement }}</span>
                                        </div>
                                    </div>

                                    <div class="col-6 mb-2">
                                        <div class="avatar bg-light-primary rounded float-start me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-package font-medium-5">
                                                    <line x1="16.5" y1="9.4" x2="7.5"
                                                        y2="4.21"></line>
                                                    <path
                                                        d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                                                    </path>
                                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                                    <line x1="12" y1="22.08" x2="12"
                                                        y2="12"></line>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="transaction-percentage">
                                            <h6 class="transaction-title">{{ 'نوع العقار' }}:</h6>
                                            <span>{{ $offer->realEstate->propertyType->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-6 col-12">
                        <div class="card card-developer-meetup">
                            <div class="meetup-img-wrapper rounded-top text-center">
                                <img src="{{ asset('app-assets/images/illustration/email.svg') }}" alt="Meeting Pic"
                                    height="170">
                            </div>

                            <div class="card-body">
                                <div class="meetup-header d-flex align-items-center">
                                    <div class="meetup-day">
                                        <h3 class="mb-0">{{ $offer->created_at->format('Y') }}</h3>
                                        <h6 class="mb-0">{{ strtoupper($offer->created_at->format('D')) }}</h6>
                                        <h3 class="mb-0">{{ $offer->created_at->format('d') }}</h3>
                                    </div>

                                    <div class="my-auto col-sm-3">
                                        <h4 class="card-title mb-25">معلومات العقار</h4>
                                        <p class="card-text mb-0">

                                            @can('updateOffer', $offer)
                                                <a class="btn btn-sm bg-light-danger waves-effect waves-float waves-light"
                                                    href="{{ route('panel.update.offer', $offer->id) }}"> تعديل هذا
                                                    العقار</a>
                                            @endcan

                                        </p>
                                    </div>

                                    @if ($offer->realEstate->property_type_id == 1 ||
                                        $offer->realEstate->property_type_id == 2 ||
                                        $offer->realEstate->property_type_id == 3)

                                        <div
                                            class="col-sm-5 col-12 d-flex justify-content-between flex-column text-end order-sm-2 order-1">
                                            <div class="dropdown chart-dropdown">
                                                <button class="btn btn-sm border-0 dropdown-toggle p-50"
                                                    type="button" id="dropdownItem5" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <a
                                                        class="btn btn-sm bg-light-success waves-effect waves-float waves-light">
                                                        <span>
                                                            الاتجاهات
                                                        </span>
                                                    </a>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="dropdownItem5">
                                                    @if (!$offer->realEstate->directions->count())
                                                        <a class="dropdown-item"
                                                            href="#">{{ 'البيانات غير متوفرة' }}</a>
                                                    @endif
                                                    @foreach ($offer->realEstate->directions as $direction)
                                                        <a class="dropdown-item"
                                                            href="#">{{ $direction->name }}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div id="avg-sessions-chart"></div>
                                        </div>

                                        <div
                                            class="col-sm-2 col-12 d-flex justify-content-between flex-column text-end order-sm-2 order-1">
                                            <div class="dropdown chart-dropdown">
                                                <button class="btn btn-sm border-0 dropdown-toggle p-50"
                                                    type="button" id="dropdownItem5" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <a
                                                        class="btn btn-sm bg-light-success waves-effect waves-float waves-light">
                                                        <span>
                                                            عرض الشوارع
                                                        </span>
                                                    </a>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="dropdownItem5">
                                                    @if (!$offer->realEstate->streetWidths->count())
                                                        <a class="dropdown-item"
                                                            href="#">{{ 'البيانات غير متوفرة' }}</a>
                                                    @endif
                                                    @foreach ($offer->realEstate->streetWidths as $street_width)
                                                        <a class="dropdown-item"
                                                            href="#">{{ $street_width->street_number }}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div id="avg-sessions-chart"></div>
                                        </div>
                                    @endif

                                </div>

                                <div class="row">

                                    <div class="col-3 mb-2">
                                        <div class="avatar float-start bg-light-success rounded me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-maximize-2">
                                                    <polyline points="15 3 21 3 21 9"></polyline>
                                                    <polyline points="9 21 3 21 3 15"></polyline>
                                                    <line x1="21" y1="3" x2="14"
                                                        y2="10"></line>
                                                    <line x1="3" y1="21" x2="10"
                                                        y2="14"></line>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="more-info">
                                            <h6 class="mb-0">مساحة العقار</h6>
                                            <span>{{ number_format($offer->realEstate->space) }}</span>
                                        </div>
                                    </div>

                                    @if ($offer->realEstate->property_type_id == 1)
                                        <div class="col-3 mb-2">
                                            <div class="avatar float-start bg-light-success rounded me-1">
                                                <div class="avatar-content">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-dollar-sign avatar-icon font-medium-3">
                                                        <line x1="12" y1="1" x2="12"
                                                            y2="23">
                                                        </line>
                                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="more-info">
                                                <h6 class="mb-0">سعر المتر</h6>
                                                <span>{{ number_format($offer->realEstate->price_by_meter) }}</span>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-3 mb-2">
                                        <div class="avatar float-start bg-light-success rounded me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign avatar-icon font-medium-3">
                                                    <line x1="12" y1="1" x2="12"
                                                        y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="more-info">
                                            <h6 class="mb-0">السعر بالكامل</h6>
                                            <span>{{ number_format($offer->realEstate->total_price) }}</span>
                                        </div>
                                    </div>

                                    @if ($offer->realEstate->property_type_id == 3)
                                        <div class="col-3 mb-2">
                                            <div class="avatar float-start bg-light-success rounded me-1">
                                                <div class="avatar-content">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-dollar-sign avatar-icon font-medium-3">
                                                        <line x1="12" y1="1" x2="12"
                                                            y2="23">
                                                        </line>
                                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="more-info">
                                                <h6 class="mb-0">الدخل السنوي</h6>
                                                <span>{{ $offer->realEstate->annual_income }}</span>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($offer->realEstate->property_type_id == 1 || $offer->realEstate->property_type_id == 2)
                                        <div class="col-3 mb-2">
                                            <div class="avatar float-start bg-light-warning rounded me-1">
                                                <div class="avatar-content">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-pocket avatar-icon font-medium-3">
                                                        <path
                                                            d="M4 3h16a2 2 0 0 1 2 2v6a10 10 0 0 1-10 10A10 10 0 0 1 2 11V5a2 2 0 0 1 2-2z">
                                                        </path>
                                                        <polyline points="8 10 12 14 16 10"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="more-info">
                                                <h6 class="mb-0">نوع الأرض</h6>
                                                <span>{{ $offer->realEstate->landType->name }}</span>
                                            </div>
                                        </div>

                                        <div class="col-3 mb-2">
                                            <div class="avatar float-start bg-light-info rounded me-1">
                                                <div class="avatar-content">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-credit-card avatar-icon font-medium-3">
                                                        <rect x="1" y="4" width="22"
                                                            height="16" rx="2" ry="2"></rect>
                                                        <line x1="1" y1="10" x2="23"
                                                            y2="10">
                                                        </line>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="more-info">
                                                <h6 class="mb-0">الترخيص</h6>
                                                <span>{{ $offer->realEstate->licensed->name }}</span>
                                            </div>
                                        </div>

                                        <div class="col-3 mb-2">
                                            <div class="avatar float-start bg-light-warning rounded me-1">
                                                <div class="avatar-content">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-pocket avatar-icon font-medium-3">
                                                        <path
                                                            d="M4 3h16a2 2 0 0 1 2 2v6a10 10 0 0 1-10 10A10 10 0 0 1 2 11V5a2 2 0 0 1 2-2z">
                                                        </path>
                                                        <polyline points="8 10 12 14 16 10"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="more-info">
                                                <h6 class="mb-0">طول الواجهة</h6>
                                                <span>{{ $offer->realEstate->interfaceLength->id }}</span>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($offer->realEstate->property_type_id == 2)
                                        <div class="col-3 mb-2">
                                            <div class="avatar float-start bg-light-warning rounded me-1">
                                                <div class="avatar-content">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-pocket avatar-icon font-medium-3">
                                                        <path
                                                            d="M4 3h16a2 2 0 0 1 2 2v6a10 10 0 0 1-10 10A10 10 0 0 1 2 11V5a2 2 0 0 1 2-2z">
                                                        </path>
                                                        <polyline points="8 10 12 14 16 10"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="more-info">
                                                <h6 class="mb-0">حالة العقار</h6>
                                                <span>{{ $offer->realEstate->propertyStatus->name }}</span>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($offer->realEstate->property_type_id == 2 ||
                                        $offer->realEstate->property_type_id == 3 ||
                                        $offer->realEstate->property_type_id == 4 ||
                                        $offer->realEstate->property_type_id == 5)
                                        <div class="col-3 mb-2">
                                            <div class="avatar float-start bg-light-warning rounded me-1">
                                                <div class="avatar-content">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-pocket avatar-icon font-medium-3">
                                                        <path
                                                            d="M4 3h16a2 2 0 0 1 2 2v6a10 10 0 0 1-10 10A10 10 0 0 1 2 11V5a2 2 0 0 1 2-2z">
                                                        </path>
                                                        <polyline points="8 10 12 14 16 10"></polyline>
                                                    </svg>
                                                </div>
                                            </div>

                                            <div class="more-info">
                                                <h6 class="mb-0">عمر العقار</h6>
                                                @if ($offer->realEstate->real_estate_age == 0)
                                                    <span>{{ 'جديد' }}</span>
                                                @else
                                                    <span> عمر العقار: {{ $offer->realEstate->real_estate_age }}
                                                        عاما</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    @if ($offer->realEstate->property_type_id == 1 || $offer->realEstate->property_type_id == 2)
                                        <div class="col-3 mb-2">
                                            <div class="avatar float-start bg-light-info rounded me-1">
                                                <div class="avatar-content">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-pocket avatar-icon font-medium-3">
                                                        <path
                                                            d="M4 3h16a2 2 0 0 1 2 2v6a10 10 0 0 1-10 10A10 10 0 0 1 2 11V5a2 2 0 0 1 2-2z">
                                                        </path>
                                                        <polyline points="8 10 12 14 16 10"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="more-info">
                                                <h6 class="mb-0">الحرف أو المجاور</h6>
                                                <span>{{ $offer->realEstate->character }}</span>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-3 mb-2">
                                        <div class="avatar float-start bg-light-info rounded me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-pocket avatar-icon font-medium-3">
                                                    <path
                                                        d="M4 3h16a2 2 0 0 1 2 2v6a10 10 0 0 1-10 10A10 10 0 0 1 2 11V5a2 2 0 0 1 2-2z">
                                                    </path>
                                                    <polyline points="8 10 12 14 16 10"></polyline>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="more-info">
                                            <h6 class="mb-0">الفرع</h6>
                                            <span>{{ $offer->realEstate->branch->name }}</span>
                                        </div>
                                    </div>

                                    @if ($offer->realEstate->property_type_id == 2)
                                        <div class="col-3 mb-2">
                                            <div class="avatar float-start bg-light-danger rounded me-1">
                                                <div class="avatar-content">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-pocket avatar-icon font-medium-3">
                                                        <path
                                                            d="M4 3h16a2 2 0 0 1 2 2v6a10 10 0 0 1-10 10A10 10 0 0 1 2 11V5a2 2 0 0 1 2-2z">
                                                        </path>
                                                        <polyline points="8 10 12 14 16 10"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="more-info">
                                                <h6 class="mb-0">نوع البناء</h6>
                                                <span>{{ $offer->realEstate->buildingType->name }}</span>
                                            </div>
                                        </div>

                                        <div class="col-3 mb-2">
                                            <div class="avatar float-start bg-light-danger rounded me-1">
                                                <div class="avatar-content">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-pocket avatar-icon font-medium-3">
                                                        <path
                                                            d="M4 3h16a2 2 0 0 1 2 2v6a10 10 0 0 1-10 10A10 10 0 0 1 2 11V5a2 2 0 0 1 2-2z">
                                                        </path>
                                                        <polyline points="8 10 12 14 16 10"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="more-info">
                                                <h6 class="mb-0">حالة البناء</h6>
                                                <span>{{ $offer->realEstate->buildingStatus->name }}</span>
                                            </div>
                                        </div>

                                        <div class="col-3 mb-2">
                                            <div class="avatar float-start bg-light-danger rounded me-1">
                                                <div class="avatar-content">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-pocket avatar-icon font-medium-3">
                                                        <path
                                                            d="M4 3h16a2 2 0 0 1 2 2v6a10 10 0 0 1-10 10A10 10 0 0 1 2 11V5a2 2 0 0 1 2-2z">
                                                        </path>
                                                        <polyline points="8 10 12 14 16 10"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="more-info">
                                                <h6 class="mb-0">تسليم البناء</h6>
                                                <span>{{ $offer->realEstate->constructionDelivery->name }}</span>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($offer->realEstate->property_type_id == 5)
                                        <div class="col-3 mb-2">
                                            <div class="avatar float-start bg-light-danger rounded me-1">
                                                <div class="avatar-content">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-pocket avatar-icon font-medium-3">
                                                        <path
                                                            d="M4 3h16a2 2 0 0 1 2 2v6a10 10 0 0 1-10 10A10 10 0 0 1 2 11V5a2 2 0 0 1 2-2z">
                                                        </path>
                                                        <polyline points="8 10 12 14 16 10"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="more-info">
                                                <h6 class="mb-0">نوع التمليك</h6>
                                                <span>{{ $offer->realEstate->ownerShipType->name }}</span>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($offer->realEstate->property_type_id == 4)
                                        <div class="col-3 mb-2">
                                            <div class="avatar float-start bg-light-danger rounded me-1">
                                                <div class="avatar-content">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-pocket avatar-icon font-medium-3">
                                                        <path
                                                            d="M4 3h16a2 2 0 0 1 2 2v6a10 10 0 0 1-10 10A10 10 0 0 1 2 11V5a2 2 0 0 1 2-2z">
                                                        </path>
                                                        <polyline points="8 10 12 14 16 10"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="more-info">
                                                <h6 class="mb-0">رقم الطابق</h6>
                                                <span>{{ $offer->realEstate->floor_number }}</span>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($offer->realEstate->property_type_id == 3)
                                        <div class="col-3 mb-2">
                                            <div class="avatar float-start bg-light-danger rounded me-1">
                                                <div class="avatar-content">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-pocket avatar-icon font-medium-3">
                                                        <path
                                                            d="M4 3h16a2 2 0 0 1 2 2v6a10 10 0 0 1-10 10A10 10 0 0 1 2 11V5a2 2 0 0 1 2-2z">
                                                        </path>
                                                        <polyline points="8 10 12 14 16 10"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="more-info">
                                                <h6 class="mb-0">عدد الأدوار</h6>
                                                <span>{{ $offer->realEstate->floors_number }}</span>
                                            </div>
                                        </div>

                                        <div class="col-3 mb-2">
                                            <div class="avatar float-start bg-light-danger rounded me-1">
                                                <div class="avatar-content">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-pocket avatar-icon font-medium-3">
                                                        <path
                                                            d="M4 3h16a2 2 0 0 1 2 2v6a10 10 0 0 1-10 10A10 10 0 0 1 2 11V5a2 2 0 0 1 2-2z">
                                                        </path>
                                                        <polyline points="8 10 12 14 16 10"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="more-info">
                                                <h6 class="mb-0">عدد الشقق</h6>
                                                <span>{{ $offer->realEstate->flats_numbers }}</span>
                                            </div>
                                        </div>


                                        <div class="col-3 mb-2">
                                            <div class="avatar float-start bg-light-danger rounded me-1">
                                                <div class="avatar-content">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-pocket avatar-icon font-medium-3">
                                                        <path
                                                            d="M4 3h16a2 2 0 0 1 2 2v6a10 10 0 0 1-10 10A10 10 0 0 1 2 11V5a2 2 0 0 1 2-2z">
                                                        </path>
                                                        <polyline points="8 10 12 14 16 10"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="more-info">
                                                <h6 class="mb-0">عدد غرف الشقة</h6>
                                                <span>{{ $offer->realEstate->flat_rooms_number }}</span>
                                            </div>
                                        </div>


                                        <div class="col-3 mb-2">
                                            <div class="avatar float-start bg-light-danger rounded me-1">
                                                <div class="avatar-content">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-pocket avatar-icon font-medium-3">
                                                        <path
                                                            d="M4 3h16a2 2 0 0 1 2 2v6a10 10 0 0 1-10 10A10 10 0 0 1 2 11V5a2 2 0 0 1 2-2z">
                                                        </path>
                                                        <polyline points="8 10 12 14 16 10"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="more-info">
                                                <h6 class="mb-0">عدد المحلات</h6>
                                                <span>{{ $offer->realEstate->stores_number }}</span>
                                            </div>
                                        </div>
                                    @endif

                                </div>

                                <div class="row meetup-footer d-flex align-items-center">
                                    <div class="my-auto">
                                        <h4 class="card-title mb-25">ملاحظات العقار</h4>
                                        <p class="card-text mb-0">
                                            <textarea class="form-control" rows="2" disabled>{{ $offer->realEstate->notes }}</textarea>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row match-height">

                    <div class="col-lg-4 col-12">
                        <div class="card card-user-timeline">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-list user-timeline-title-icon">
                                        <line x1="8" y1="6" x2="21" y2="6"></line>
                                        <line x1="8" y1="12" x2="21" y2="12"></line>
                                        <line x1="8" y1="18" x2="21" y2="18"></line>
                                        <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                        <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                        <line x1="3" y1="18" x2="3.01" y2="18"></line>
                                    </svg>

                                    @if ($offer->mediators->count())
                                        <h4 class="card-title">الوسطاء</h4>
                                    @else
                                        <h4 class="card-title">لا يوجد وسطاء للعرض</h4>
                                    @endif

                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="timeline ms-50">

                                    @foreach ($offer->mediators as $mediator)
                                        <li class="timeline-item">
                                            <span
                                                class="timeline-point timeline-point-danger timeline-point-indicator"></span>
                                            <div class="timeline-event">
                                                <h6>{{ $mediator->name }}</h6>
                                                {{-- <p class="mb-0">{{ $mediator }}</p> --}}
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>


                    @auth
                        @if (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'superadmin')
                            <div class="col-lg-6">
                                <div class="card card-user-timeline">

                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-list user-timeline-title-icon">
                                                <line x1="8" y1="6" x2="21" y2="6">
                                                </line>
                                                <line x1="8" y1="12" x2="21" y2="12">
                                                </line>
                                                <line x1="8" y1="18" x2="21" y2="18">
                                                </line>
                                                <line x1="3" y1="6" x2="3.01" y2="6">
                                                </line>
                                                <line x1="3" y1="12" x2="3.01" y2="12">
                                                </line>
                                                <line x1="3" y1="18" x2="3.01" y2="18">
                                                </line>
                                            </svg>

                                            @if ($offer->offerEdits->count())
                                                <h4 class="card-title">التعديلات</h4>
                                            @else
                                                <h4 class="card-title">لا يوجد عمليات تعديل على العرض</h4>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <ul class="timeline ms-50">

                                            @foreach ($offer->offerEdits as $offer_edit)
                                                <li class="timeline-item">

                                                    @if ($offer_edit->action == 'add')
                                                        <span
                                                            class="timeline-point timeline-point-success timeline-point-indicator"></span>
                                                    @endif

                                                    @if ($offer_edit->action == 'edit')
                                                        <span
                                                            class="timeline-point timeline-point-danger timeline-point-indicator"></span>
                                                    @endif

                                                    @if ($offer_edit->action == 'book')
                                                        <span
                                                            class="timeline-point timeline-point-warning timeline-point-indicator"></span>
                                                    @endif

                                                    @if ($offer_edit->action == 'cancel')
                                                        <span
                                                            class="timeline-point timeline-point-danger timeline-point-indicator"></span>
                                                    @endif

                                                    <div class="timeline-event">
                                                        <div
                                                            class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                                            <h6>{!! $offer_edit->note !!} </h6>
                                                            <span
                                                                class="timeline-event-time">{{ $this->getLastUpateOfferEditTime($offer_edit->id) }}</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endauth

                </div>
            </section>

        </div>
    </div>

    <div class="modal fade" id="addNote" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user" wire:ignore.self>
            <div class="modal-content" wire:ignore.self>
                <div class="modal-header bg-transparent" wire:ignore>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50" wire:ignore.self>


                    <div class="text-center mb-2" wire:ignore>
                        <h1 class="mb-1">إضافة ملاحظة</h1>
                    </div>


                    <div class="row gy-1 pt-75" wire:ignore.self>

                        <div class="col-12 col-md-6 " wire:ignore.self>
                            <label class="form-label" for="fp-range">التاريخ</label>
                            <input type="text" id="fp-range" class="form-control"
                                placeholder="{{ now()->format('Y-m-d') }}" disabled />
                        </div>

                        <div class="col-12 col-md-6" wire:ignore.self>
                            <label class="form-label"> الحالة :</label>
                            <select class="form-select" wire:model='status_note'>
                                @foreach (getOrderNoteStatuse() as $order_status)
                                    <option value="{{ $order_status->id }}">{{ $order_status->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12" wire:ignore.self>
                            <label class="form-label" for="modalEditUserEmail">ملاحظات:</label>
                            <textarea class="form-control" id="notes" wire:model='text' rows="3" placeholder="ملاحظات"></textarea>
                            @error('text')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 text-center mt-2 pt-50" wire:ignore.self>
                            <button class="btn btn-primary btn-submit me-1" wire:click='addNote'>حفظ</button>
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">الغاء</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="connectToOffer" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user" wire:ignore.self>
            <div class="modal-content" wire:ignore.self>
                <div class="modal-header bg-transparent" wire:ignore.self>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50" wire:ignore.self>
                    <div class="text-center mb-2" wire:ignore.self>
                        <h1 class="mb-1 ">قريبا...</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addReservation" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user" wire:ignore.self>
            <div class="modal-content" wire:ignore.self>
                <div class="modal-header bg-transparent" wire:ignore>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">تفاصيل الحجز</h1>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 customer-name" wire:ignore>
                            <label class="form-label">اسم العميل</label>
                            <select class="js-select2-customer-name select2 form-select" wire:model='customer_id'
                                @if ($is_booked) disabled @endif wire:ignore.self>
                                @foreach (getCustomers() as $customer)
                                    <option value="{{ $customer->id }}" selected>
                                        {{ $customer->name . '::' . $customer->phone }}</option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="col-12 col-md-6">
                            <div class="row">
                                <label class="form-label" for="price">السعر</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" wire:model='price'
                                        placeholder="السعر" @if ($is_booked) disabled @endif>
                                    <span class="input-group-text">ريال</span>
                                </div>
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="fp-range">التاريخ</label>
                            <input type="text" dir="ltr" wire:model='date'
                                class="form-control flatpickr-range" placeholder="YYYY-MM-DD to YYYY-MM-DD"
                                @if ($is_booked) disabled @endif />
                            @error('date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserEmail">ملاحظات:</label>
                            <textarea class="form-control" wire:model='reservation_notes' rows="3" placeholder="ملاحظات"
                                @if ($is_booked) disabled @endif></textarea>
                            @error('reservation_notes')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12 text-center mt-2 pt-50">
                        @if (!$is_booked)
                            <button type="submit" class="btn btn-primary btn-submit me-1"
                                wire:click='storeReservation'>حفظ</button>
                        @endif

                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close">
                            الغاء
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('test')
        <script>
            $(document).ready(function() {

                window.initSelectCompanyDrop = () => {
                    $('.js-select2-customer-name').select2({
                        placeholder: 'اختار العميل',
                        closeOnSelect: true,
                        tags: true,
                    });
                }

                $(".js-select2-customer-name").on('change', function() {
                    var data = $('.js-select2-customer-name').val();
                    @this.set('customer_id', data);
                });

                window.livewire.on('select2', (check) => {
                    if (check) {
                        $(".js-select2-customer-name").prop('disabled', true);
                    } else {
                        $(".js-select2-customer-name").prop('disabled', false);
                    }
                });
            });

            window.livewire.on('submitReservation', () => {
                $('#addReservation').modal('hide');
                console.log('Ok');
            });
        </script>
    @endpush



</div>
