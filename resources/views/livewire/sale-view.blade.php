<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">

            <section class="invoice-preview-wrapper">
                <div class="row invoice-preview">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="card card-developer-meetup">

                            <div class="meetup-img-wrapper rounded-top text-center">
                                <img src="{{ asset('app-assets/images/illustration/email.svg') }}" alt="Meeting Pic"
                                    height="170">
                            </div>

                            <div class="card-body">

                                <div class="meetup-header d-flex align-items-center">
                                    <div class="meetup-day">
                                        <h3 class="mb-0">{{ $sale->created_at->format('Y') }}</h3>
                                        <h6 class="mb-0">{{ strtoupper($sale->created_at->format('D')) }}</h6>
                                        <h3 class="mb-0">{{ $sale->created_at->format('d') }}</h3>
                                    </div>

                                    <div class="my-auto flex-fill col-sm-6">
                                        <h4 class="card-title mb-25">معلومات العقار</h4>
                                        <div class="d-flex">

                                            <div>
                                                @if (in_array(auth()->user()->user_type, ['office', 'marketer']) && $sale->offer)
                                                    @if (auth()->id() == $sale->user_id)
                                                        @if (auth()->user()->can('updateSale', App\Models\Sale::class))
                                                            <a class="  btn btn-sm bg-light-warning waves-effect waves-float waves-light"
                                                                href="{{ route('panel.update.sale', $sale->id) }}">تعديل
                                                                الاتفاقية</a>
                                                        @endif
                                                    @endif
                                                @endif

                                                @if (in_array(auth()->user()->user_type, ['admin', 'superadmin']) && $sale->offer)
                                                    @if (auth()->user()->can('updateSale', App\Models\Sale::class))
                                                        <a class="  btn btn-sm bg-light-warning waves-effect waves-float waves-light"
                                                            href="{{ route('panel.update.sale', $sale->id) }}">تعديل
                                                            الاتفاقية</a>
                                                    @endif
                                                @endif
                                            </div>


                                            <div class="ms-1">
                                                <a href="javascript:;"
                                                    class=" btn btn-sm bg-light-info waves-effect waves-float waves-light"
                                                    data-bs-target="#showPDF" data-bs-toggle="modal">العربون</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4 mb-2">
                                        <div class="avatar float-start bg-light-success rounded me-1">
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
                                            <h6 class="mb-0">نوع العقار</h6>
                                            <span>{{ $sale->realEstate->propertyType->name }}</span>
                                        </div>
                                    </div>

                                    <div class="col-4 mb-2">
                                        <div class="avatar float-start bg-light-danger rounded me-1">
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
                                            <h6 class="mb-0">رقم البلوك</h6>
                                            <span>{{ $sale->realEstate->block_number }}</span>
                                        </div>
                                    </div>

                                    <div class="col-4 mb-2">
                                        <div class="avatar float-start bg-light-danger rounded me-1">
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
                                            <h6 class="mb-0">رقم الأرض</h6>
                                            <span>{{ $sale->realEstate->land_number }}</span>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-4 mb-2">
                                        <div class="avatar float-start bg-light-warning rounded me-1">
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
                                        <div class="more-info">
                                            <h6 class="mb-0">المدينة</h6>
                                            <span>{{ $sale->realEstate->city->name }}</span>
                                        </div>
                                    </div>

                                    <div class="col-4 mb-2">
                                        <div class="avatar float-start bg-light-success rounded me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-maximize-2">
                                                    <polyline points="15 3 21 3 21 9"></polyline>
                                                    <polyline points="9 21 3 21 3 15"></polyline>
                                                    <line x1="21" y1="3" x2="14"
                                                        y2="10">
                                                    </line>
                                                    <line x1="3" y1="21" x2="10"
                                                        y2="14">
                                                    </line>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="more-info">
                                            <h6 class="mb-0">مساحة العقار</h6>
                                            <span>{{ number_format($sale->realEstate->space) }}</span>
                                        </div>
                                    </div>

                                    <div class="col-4 mb-2">
                                        <div class="avatar float-start bg-light-success rounded me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign avatar-icon font-medium-3">
                                                    <line x1="12" y1="1" x2="12"
                                                        y2="23">
                                                    </line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="more-info">
                                            <h6 class="mb-0">سعر العقار</h6>
                                            <span>{{ number_format($sale->realEstate->total_price) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="meetup-header d-flex align-items-center">
                                    <div class="meetup-day">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-users font-medium-5">
                                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        </svg>
                                    </div>

                                    <div class="my-auto col-sm-3">
                                        <h4 class="card-title mb-25">معلومات العميل</h4>
                                        <p class="card-text mb-0">
                                        </p>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-4 mb-2">
                                        <div class="avatar float-start bg-light-success rounded me-1">
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
                                            <h6 class="mb-0">الاسم</h6>
                                            <span>{{ $sale->customer->name }}</span>
                                        </div>
                                    </div>

                                    <div class="col-4 mb-2">
                                        <div class="avatar float-start bg-light-danger rounded me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-phone">
                                                    <path
                                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="more-info">
                                            <h6 class="mb-0">رقم الهاتف</h6>
                                            <span>{{ $sale->customer->phone }}</span>
                                        </div>
                                    </div>

                                    <div class="col-4 mb-2">
                                        <div class="avatar float-start bg-light-danger rounded me-1">
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
                                            <h6 class="mb-0">رقم الهوية</h6>
                                            <span>{{ $sale->customer->nationality_id }}</span>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-4 mb-2">
                                        <div class="avatar float-start bg-light-warning rounded me-1">
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
                                        <div class="more-info">
                                            <h6 class="mb-0">المدينة</h6>
                                            <span>{{ $sale->customer->city->name }}</span>
                                        </div>
                                    </div>

                                    <div class="col-4 mb-2">
                                        <div class="avatar float-start bg-light-success rounded me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-briefcase">
                                                    <rect x="2" y="7" width="20"
                                                        height="14" rx="2" ry="2"></rect>
                                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="more-info">
                                            <h6 class="mb-0">نوع التوظيف</h6>
                                            @if ($sale->customer->employee_type == 'public')
                                                <span>موظيف عام</span>
                                            @endif

                                            @if ($sale->customer->employee_type == 'private')
                                                <span>موظف قطاع خاص</span>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="col-4 mb-2">
                                        <div class="avatar float-start bg-light-success rounded me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign avatar-icon font-medium-3">
                                                    <line x1="12" y1="1" x2="12"
                                                        y2="23">
                                                    </line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="more-info">
                                            <h6 class="mb-0">جهة العمل</h6>
                                            <span>{{ $sale->customer->employer_name }}</span>
                                        </div>
                                    </div>

                                </div>

                                <div class="meetup-header d-flex align-items-center">

                                    <div class="meetup-day">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-file-text">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                            </path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line x1="16" y1="13" x2="8" y2="13">
                                            </line>
                                            <line x1="16" y1="17" x2="8" y2="17">
                                            </line>
                                            <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                    </div>

                                    <div class="my-auto col-sm-3">
                                        <h4 class="card-title mb-25">تفاصيل الاتفاقية</h4>
                                        <p class="card-text mb-0">
                                        </p>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-4 mb-2">
                                        <div class="avatar float-start bg-light-success rounded me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign avatar-icon font-medium-3">
                                                    <line x1="12" y1="1" x2="12"
                                                        y2="23">
                                                    </line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="more-info">

                                            @if ($sale->saee_price)
                                                <h6 class="mb-0">مبلغ السعي</h6>
                                                <span>{{ number_format($sale->saee_price) }}</span>
                                            @endif

                                            @if ($sale->saee_prc)
                                                <h6 class="mb-0">نسبة السعي</h6>
                                                <span>{{ $sale->saee_prc }}%</span>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="col-4 mb-2">
                                        <div class="avatar float-start bg-light-danger rounded me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign avatar-icon font-medium-3">
                                                    <line x1="12" y1="1" x2="12"
                                                        y2="23">
                                                    </line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="more-info">
                                            <h6 class="mb-0">مبلغ العربون</h6>
                                            <span>{{ number_format($sale->paid_amount) }}</span>
                                        </div>
                                    </div>

                                    <div class="col-4 mb-2">
                                        <div class="avatar float-start bg-light-danger rounded me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign avatar-icon font-medium-3">
                                                    <line x1="12" y1="1" x2="12"
                                                        y2="23">
                                                    </line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="more-info">
                                            <h6 class="mb-0">المبلغ المتبقي</h6>
                                            <span>{{ number_format($sale->tatal_req_amount - $sale->paid_amount) }}</span>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row pb-50">

                                    <div
                                        class="col-sm-6 col-12 d-flex justify-content-between flex-column order-sm-1 order-2 mt-1 mt-sm-0">

                                        <div class="mb-1 mb-sm-0">
                                            <h2 class="fw-bolder mb-25">كود الاتفاقية</h2>

                                            <p class="card-text fw-bold mb-2">
                                                <a class="btn text-primary fs-3"
                                                    href="#">{{ $sale->sale_code }}</a>
                                            </p>

                                        </div>
                                        <button type="button"
                                            class="btn btn-primary waves-effect waves-float waves-light"
                                            wire:click="download">تحميل صفقة
                                            البيع</button>
                                    </div>

                                    <div class="col-sm-6 col-12 d-flex justify-content-between flex-column text-end order-sm-2 order-1"
                                        style="position: relative;">
                                        <div class="dropdown chart-dropdown">
                                            <button
                                                class="btn btn-sm border-1 p-50 waves-effect waves-float waves-light text-white"
                                                type="button">
                                                {{ $last_update_time }}
                                            </button>
                                        </div>

                                        <div class="resize-triggers">
                                            <div class="expand-trigger">
                                                <div style="width: 346px; height: 229px;"></div>
                                            </div>
                                            <div class="contract-trigger"></div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="row avg-sessions pt-50">
                                    <div class="col-6 mb-2">
                                        <p class="mb-50">Goal: $100000</p>
                                        <div class="progress progress-bar-primary" style="height: 6px">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="50"
                                                aria-valuemin="50" aria-valuemax="100" style="width: 50%"></div>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <p class="mb-50">Users: 100K</p>
                                        <div class="progress progress-bar-warning" style="height: 6px">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="60"
                                                aria-valuemin="60" aria-valuemax="100" style="width: 60%"></div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-50">Retention: 90%</p>
                                        <div class="progress progress-bar-danger" style="height: 6px">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                                aria-valuemin="70" aria-valuemax="100" style="width: 70%"></div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-50">Duration: 1yr</p>
                                        <div class="progress progress-bar-success" style="height: 6px">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="90"
                                                aria-valuemin="90" aria-valuemax="100" style="width: 90%"></div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row avg-sessions pt-50">

                                    <iframe id="pdf-frame" src="{{ $pdf_path }}" width="100%" height="570px">
                                    </iframe>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div hidden class="row invoice-preview">
                    <!-- Invoice -->
                    <div class="col-xl-12 col-md-8 col-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">

                                        <div class="mb-1 text-md-end">
                                            <a href="javascript:;" class="btn bg-light-primary"
                                                data-bs-target="#addNote" data-bs-toggle="modal">

                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-plus me-50 font-small-4">
                                                        <line x1="12" y1="5" x2="12"
                                                            y2="19"></line>
                                                        <line x1="5" y1="12" x2="19"
                                                            y2="12"></line>
                                                    </svg>إضافة سند</span></a>
                                        </div>

                                    </div>
                                </div>

                                <hr>

                                <div class="divider">المراحل</div>
                                <div class="row ">
                                    <div class="progress progress-bar-success">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="52"
                                            aria-valuemin="52" aria-valuemax="100" style="width: 52%">
                                            52%
                                        </div>
                                    </div>
                                </div>

                                <hr class="">
                                <div class="row ">
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressFirstName ">المرحلة</label>

                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">نوع المرحلة</label>
                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressFirstName ">المبلغ</label>

                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">النسبة</label>
                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressFirstName ">الحالة</label>

                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">السند</label>
                                    </div>

                                </div>
                                <div class="row ">
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressFirstName ">1</label>

                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">عند الافراغ</label>
                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">250,000
                                            ريال</label>

                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">20%</label>
                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label badge bg-light-success"
                                            for="modalAddressFirstName ">تم الدفع</label>

                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <button id="select-files" class="btn btn-outline-primary mb-1"
                                            data-bs-target="#showPDF" data-bs-toggle="modal">
                                            <i data-feather="file"></i> عرض السند
                                        </button>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressFirstName ">2</label>

                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">بعد بناء
                                            القاعدة</label>
                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">300,000
                                            ريال</label>

                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">24%</label>
                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label badge bg-light-success "
                                            for="modalAddressFirstName ">تم الدفع</label>

                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <button id="select-files" class="btn btn-outline-primary mb-1"
                                            data-bs-target="#showPDF" data-bs-toggle="modal">
                                            <i data-feather="file"></i> عرض السند
                                        </button>
                                    </div>

                                </div>
                                <div class="row ">
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressFirstName ">3</label>

                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">بعد الدور
                                            الأرضي</label>
                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">0 ريال</label>

                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">0%</label>
                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label badge bg-light-danger "
                                            for="modalAddressFirstName ">لم يتم الدفع</label>

                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <button id="select-files" class="btn btn-outline-secondary mb-1">
                                            <i data-feather="file"></i> لايوجد سند
                                        </button>
                                    </div>

                                </div>
                                <div class="row ">
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressFirstName ">4</label>

                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">بعد بناء الدور
                                            الأول</label>
                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">0 ريال</label>

                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">0%</label>
                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label badge bg-light-danger"
                                            for="modalAddressFirstName ">لم يتم الدفع</label>

                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <button id="select-files" class="btn btn-outline-secondary mb-1">
                                            <i data-feather="file"></i> لايوجد سند
                                        </button>
                                    </div>

                                </div>
                                <div class="row ">
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressFirstName ">5</label>

                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">بعد إكتمال
                                            العظم</label>
                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">0 ريال</label>

                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">0%</label>
                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label badge bg-light-danger"
                                            for="modalAddressFirstName ">لم يتم الدفع</label>

                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <button id="select-files" class="btn btn-outline-secondary mb-1">
                                            <i data-feather="file"></i> لايوجد سند
                                        </button>
                                    </div>

                                </div>

                                <div class="row ">
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressFirstName ">6</label>

                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">بعد التشطيب</label>
                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">0 ريال</label>

                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">0%</label>
                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <label class="form-label badge bg-light-danger "
                                            for="modalAddressFirstName ">لم يتم الدفع</label>

                                    </div>
                                    <div class="col-md-2 mb-1 ">
                                        <button id="select-files" class="btn btn-outline-secondary mb-1">
                                            <i data-feather="file"></i> لايوجد سند
                                        </button>
                                    </div>

                                </div>

                                <hr>




                            </div>
                        </div>

                    </div>
                    <!-- /Invoice -->
                    <!-- Invoice Actions -->
                    <!-- /Invoice Actions -->
                </div>

                <div hidden class="row invoice-preview">
                    <!-- Invoice -->
                    <div class="col-xl-12 col-md-8 col-12">
                        <div class="card">

                            <div class="card-body">
                                <hr>

                                <div class="divider">المرفقات</div>

                                <hr class="">
                                <div class="row ">
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressFirstName ">م</label>

                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">نوع المرفق</label>
                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressFirstName ">رقم الأرض</label>

                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">المرفق</label>
                                    </div>

                                </div>
                                <div class="row ">
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressFirstName ">1</label>

                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">تحديد الأرض</label>
                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">1231</label>

                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <button id="select-files" class="btn btn-outline-primary mb-1">
                                            <i data-feather="file"></i> عرض
                                        </button>
                                    </div>

                                </div>
                                <div class="row ">
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressFirstName ">2</label>

                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">محضر فرز </label>
                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">1231</label>

                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <button id="select-files" class="btn btn-outline-secondary mb-1">
                                            <i data-feather="file"></i> إضافة
                                        </button>
                                    </div>

                                </div>
                                <div class="row ">
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressFirstName ">3</label>

                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">فحص التربة </label>
                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">1231</label>

                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <button id="select-files" class="btn btn-outline-secondary mb-1">
                                            <i data-feather="file"></i> إضافة
                                        </button>
                                    </div>

                                </div>
                                <div class="row ">
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressFirstName ">4</label>

                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">سكتش </label>
                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">1231</label>

                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <button id="select-files" class="btn btn-outline-primary mb-1">
                                            <i data-feather="file"></i> عرض
                                        </button>
                                    </div>

                                </div>
                                <div class="row ">
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressFirstName ">5</label>

                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">المخططات </label>
                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">1231</label>

                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <button id="select-files" class="btn btn-outline-primary mb-1">
                                            <i data-feather="file"></i> عرض
                                        </button>
                                    </div>

                                </div>
                                <div class="row ">
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressFirstName ">6</label>

                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">رخصة البناء
                                        </label>
                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">1231</label>

                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <button id="select-files" class="btn btn-outline-secondary mb-1">
                                            <i data-feather="file"></i> إضافة
                                        </button>
                                    </div>

                                </div>
                                <div class="row ">
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressFirstName ">7</label>

                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">عقد مقاول </label>
                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">1231</label>

                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <button id="select-files" class="btn btn-outline-primary mb-1">
                                            <i data-feather="file"></i> عرض
                                        </button>
                                    </div>

                                </div>
                                <div class="row ">
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressFirstName ">8</label>

                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">ملاذ تأمين </label>
                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">1231</label>

                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <button id="select-files" class="btn btn-outline-secondary mb-1">
                                            <i data-feather="file"></i> إضافة
                                        </button>
                                    </div>

                                </div>
                                <div class="row ">
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressFirstName ">9</label>

                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">الاشراف الهندسي
                                        </label>
                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <label class="form-label " for="modalAddressLastName ">1231</label>

                                    </div>
                                    <div class="col-md-3 mb-1 ">
                                        <button id="select-files" class="btn btn-outline-secondary mb-1">
                                            <i data-feather="file"></i> إضافة
                                        </button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="modal fade" id="addNote" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body pb-5 px-sm-5 pt-50">
                            <div class="text-center mb-2">
                                <h1 class="mb-1">إضافة سند قبض</h1>
                            </div>
                            <form id="editUserForm" class="row gy-1 pt-75" onsubmit="return false">


                                <div class="col-12 col-md-6 ">
                                    <label class="form-label" for="fp-range">التاريخ</label>
                                    <input type="text" id="fp-range" class="form-control flatpickr-basic"
                                        placeholder="2022-09-15" disabled />
                                </div>
                                <div class="col-12 col-md-6 ">
                                    <label class="form-label" for="fp-range">رقم الإتفاقية</label>
                                    <input type="text" class="form-control" placeholder="S-QTF-1001" disabled />
                                </div>
                                <div class="col-12 col-md-6 ">
                                    <label class="form-label" for="fp-range">اسم العميل</label>
                                    <input type="text" class="form-control" placeholder="علي جعفر التاروتي"
                                        disabled />
                                </div>
                                <div class="col-12 col-md-6 ">
                                    <label class="form-label" for="fp-range">رقم جوال العميل</label>
                                    <input type="text" class="form-control" placeholder="0597555447" disabled />
                                </div>
                                <div class="col-12 col-md-6 ">
                                    <label class="form-label"> المرحلة :</label>
                                    <select class="form-select">
                                        <option value="">اختيار المرحلة</option>
                                        <option value="1">عند الافراغ </option>
                                        <option value="2">بعد بناء القاعدة </option>
                                        <option value="3">بعد الدور الأرضي </option>
                                        <option value="4">بعد بناء الدور الأول </option>
                                        <option value="5">بعد إكتمال العظم </option>
                                        <option value="6">بعد التشطيب </option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6 ">
                                    <label class="form-label" for="fp-range">المبلغ</label>
                                    <input type="text" class="form-control" placeholder="" />
                                </div>

                                <div class="col-12 col-md-6 ">
                                    <label class="form-label"> طريقة الدفع :</label>
                                    <select class="form-select">
                                        <option value="">اختيار طريقة الدفع</option>
                                        <option value="1">نقداً </option>
                                        <option value="2">شيك </option>
                                        <option value="3">تحويل </option>

                                    </select>
                                </div>
                                <div class="col-12 col-md-6 ">
                                    <label class="form-label" for="fp-range">رقم الشيك / رقم الايبان
                                        للحوالة</label>
                                    <input type="text" class="form-control" />
                                </div>
                                <div class="col-12 col-md-6 ">
                                    <label class="form-label" for="fp-range">هل أنت المستلم ؟</label>
                                </div>
                                <div class="col-12 col-md-6 ">

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptionsAA"
                                            id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">نعم</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptionsAA"
                                            id="inlineRadio2" value="option2" checked>
                                        <label class="form-check-label" for="inlineRadio2">لا</label>
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <label class="form-label"> المستلم :</label>
                                    <select class="form-select">
                                        <option value="">اختيار المستلم</option>
                                        <option value="1">زهير السكيري </option>
                                        <option value="2">مصطفى الهلال </option>
                                        <option value="3">خالد الشكر </option>

                                    </select>
                                </div>




                                <div class="col-12 text-center mt-2 pt-50">
                                    <button type="submit" class="btn btn-primary btn-submit me-1"
                                        id="type-success">إضافة</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        الغاء
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="showPDF" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body pb-5 px-sm-5 pt-50">
                            <iframe id="pdf-frame" src="{{ $pdf_path_amount }}" width="100%" height="570px">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal modal-slide-in fade" id="send-invoice-sidebar" aria-hidden="true">
                <div class="modal-dialog sidebar-lg">
                    <div class="modal-content p-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title">
                                <span class="align-middle">Send Invoice</span>
                            </h5>
                        </div>
                        <div class="modal-body flex-grow-1">
                            <form>
                                <div class="mb-1">
                                    <label for="invoice-from" class="form-label">From</label>
                                    <input type="text" class="form-control" id="invoice-from"
                                        value="shelbyComapny@email.com" placeholder="company@email.com" />
                                </div>
                                <div class="mb-1">
                                    <label for="invoice-to" class="form-label">To</label>
                                    <input type="text" class="form-control" id="invoice-to"
                                        value="qConsolidated@email.com" placeholder="company@email.com" />
                                </div>
                                <div class="mb-1">
                                    <label for="invoice-subject" class="form-label">Subject</label>
                                    <input type="text" class="form-control" id="invoice-subject"
                                        value="Invoice of purchased Admin Templates"
                                        placeholder="Invoice regarding goods" />
                                </div>
                                <div class="mb-1">
                                    <label for="invoice-message" class="form-label">Message</label>
                                    <textarea class="form-control" name="invoice-message" id="invoice-message" cols="3" rows="11"
                                        placeholder="Message...">
                                        Dear Queen Consolidated,

                                        Thank you for your business, always a pleasure to work with you!

                                        We have generated a new invoice in the amount of $95.59

                                        We would appreciate payment of this invoice by 05/11/2019
                                    </textarea>
                                </div>
                                <div class="mb-1">
                                    <span class="badge badge-light-primary">
                                        <i data-feather="link" class="me-25"></i>
                                        <span class="align-middle">Invoice Attached</span>
                                    </span>
                                </div>
                                <div class="mb-1 d-flex flex-wrap mt-2">
                                    <button type="button" class="btn btn-primary me-1"
                                        data-bs-dismiss="modal">Send</button>
                                    <button type="button" class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
