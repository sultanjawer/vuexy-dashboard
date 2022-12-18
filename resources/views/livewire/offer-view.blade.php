<div class="app-content content" wire:ignore.self>
    <div class="content-overlay" wire:ignore.self></div>
    <div class="header-navbar-shadow" wire:ignore.self></div>
    <div class="content-wrapper container-xxl p-0" wire:ignore.self>
        <div class="content-header row" wire:ignore.self></div>

        <div class="content-body" wire:ignore.self>
            <section class="app-user-view-account" wire:ignore.self>
                <div class="row" wire:ignore.self>
                    <div class="col-md-12" wire:ignore.self>
                        <div class="row match-height" wire:ignore.self>
                            <!-- Medal Card -->
                            <div class="col-xl-12 col-md-6 col-12" wire:ignore.self>
                                <div class="card card-congratulation-medal" wire:ignore.self>
                                    <div class="card-body" wire:ignore.self>
                                        <h2>كود العرض</h2>

                                        <h3 class="mb-75 mt-2 pt-50">
                                            <a href="#">{{ $offer->offer_code }}</a>
                                        </h3>

                                        @if ($real_estate->property_type_id == 1)
                                            <div class="mb-2">
                                                <a class="btn bg-light-warning waves-effect waves-float waves-light">
                                                    <span>
                                                        أرض
                                                    </span>
                                                </a>
                                            </div>
                                        @endif



                                        @if ($real_estate->property_type_id == 2)
                                            <div class="mb-2">
                                                <a class="btn bg-light-success waves-effect waves-float waves-light">
                                                    <span>
                                                        دبلكس
                                                    </span>
                                                </a>
                                            </div>
                                        @endif

                                        @if ($real_estate->property_type_id == 3)
                                            <div class="mb-2">
                                                <a class="btn bg-light-success waves-effect waves-float waves-light">
                                                    <span>
                                                        عمارة
                                                    </span>
                                                </a>
                                            </div>
                                        @endif


                                        @if ($real_estate->property_type_id == 4)
                                            <div class="mb-2">
                                                <a class="btn bg-light-danger waves-effect waves-float waves-light">
                                                    <span>
                                                        شقة
                                                    </span>
                                                </a>
                                            </div>
                                        @endif


                                        @if ($real_estate->property_type_id == 5)
                                            <div class="mb-2">
                                                <a class="btn bg-light-info waves-effect waves-float waves-light">
                                                    <span>
                                                        شاليه
                                                    </span>
                                                </a>
                                            </div>
                                        @endif


                                        <img src="{{ asset('app-assets/images/illustration/badge.svg') }}"
                                            class="congratulation-medal" alt="Medal Pic">
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-xl-8 col-md-6 col-12" wire:ignore.self>
                                <div class="card card-statistics" wire:ignore.self>



                                    <div class="card-header" wire:ignore.self>
                                        <h4 class="card-title" wire:ignore.self>معلومات العميل</h4>
                                        <div class="d-flex align-items-center" wire:ignore.self>
                                            <p class="card-text font-small-2 me-25 mb-0">{{ $last_update_time }}</p>
                                        </div>
                                    </div>



                                    <div class="card-boady card-statistics" wire:ignore.self>
                                        <div class="row" wire:ignore.self>

                                            <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                                <label class="form-label fw-bold fs-4 text-primary"> الاسم :</label>
                                                <label class="form-label fs-6">{{ $offer->customer_name }}</label>
                                            </div>


                                            <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                                <label class="form-label fw-bold fs-4 text-primary"> رقم الجوال
                                                    :</label>
                                                <label class="form-label fs-6">{{ $offer->customer_phone }}</label>
                                            </div>
                                            <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                                <label class="form-label fw-bold fs-4 text-primary">هل مدعوم من
                                                    الاسكان:</label>
                                                @if ($offer->support_eskan)
                                                    <span class="badge badge-glow bg-success">نعم</span>
                                                @else
                                                    <span class="badge badge-glow bg-danger">لا</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row" wire:ignore.self>

                                            <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                                <label class="form-label fw-bold fs-4 text-primary"> جهة العمل :</label>
                                                <label class="form-label fs-6">{{ $offer->employer_name }}</label>
                                            </div>

                                            <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                                <label class="form-label fw-bold fs-4 text-primary"> نوع القطاع
                                                    :</label>
                                                <label class="form-label fs-6">قطاع
                                                    {{ $offer->employee_type == 'public' ? 'عام' : 'خاص' }}</label>
                                            </div>
                                        </div>

                                    </div>
                                    @if (!($offer->order_status_id == 3) && !($offer->order_status_id == 6))
                                        <div class="col-md-12" wire:ignore.self>
                                            <div class="mb-1 text-center" wire:ignore.self>
                                                <a href="javascript:;" class="btn bg-light-warning"
                                                    data-bs-target="#addNote" data-bs-toggle="modal">

                                                    <span wire:ignore>
                                                        <i data-feather='plus-square'></i> إضافة ملاحظة
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div> --}}


                        </div>
                    </div>

                    <div class="col-md-12" wire:ignore.self>
                        <div class="card card-statistics" wire:ignore.self>

                            <div class="card-header" wire:ignore.self>
                                <h2 wire:ignore.self>معلومات العقار</h2>
                                <div class="d-flex align-items-center" wire:ignore.self>
                                    <p class="card-text font-small-2 me-25 mb-0">{{ $last_update_time }}</p>
                                </div>
                            </div>

                            @if ($real_estate->property_type_id == 1)
                                <div class="card-boady card-statistics" wire:ignore.self>
                                    <div class="row">
                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> نوع العقار
                                                :</label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->propertyType->name }}</label>
                                        </div>


                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> المساحة
                                                :</label>
                                            <label
                                                class="form-label fs-6">{{ number_format((int) $real_estate->space) }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> الاتجاه
                                                :</label>
                                            <label class="form-label fs-6">{{ $real_estate->direction->name }}</label>
                                        </div>


                                    </div>

                                    <div class="row" wire:ignore.self>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">المدينة:</label>
                                            <label class="form-label fs-6">{{ $real_estate->city->name }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">الحي:
                                            </label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->neighborhood->name }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">عرض الشارع:
                                            </label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->streetWidth->street_number }}</label>
                                        </div>

                                    </div>


                                    <div class="row" wire:ignore.self>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">نوع الأرض:</label>
                                            <label class="form-label fs-6">{{ $real_estate->landType->name }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">طول الواجهة:
                                            </label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->interfaceLength->name }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">الترخيص:
                                            </label>
                                            <label class="form-label fs-6">{{ $real_estate->licensed->name }}</label>
                                        </div>

                                    </div>


                                    <div class="row" wire:ignore.self>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">حالة العقار:</label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->propertyStatus->name }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">الفرع:
                                            </label>
                                            <label class="form-label fs-6">{{ $real_estate->branch->name }}</label>
                                        </div>
                                    </div>


                                    <div class="row" wire:ignore.self>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> ملاحظات على الطلب:
                                            </label>
                                            <p>{{ $real_estate->notes }}</p>
                                        </div>

                                        <div class="mb-1 text-center">
                                            <div class="d-flex justify-content-center pt-2 clear">
                                                <a href="javascript:;"
                                                    class="btn btn-success me-1 waves-effect waves-float waves-light"
                                                    data-bs-target="#editUser" data-bs-toggle="modal">
                                                    حجز
                                                </a>
                                                <a href="create-sell.html"
                                                    class="btn btn-primary  waves-effect waves-float waves-light">بيع</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($real_estate->property_type_id == 2)
                                <div class="card-boady card-statistics" wire:ignore.self>


                                    <div class="row">

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> نوع العقار
                                                :</label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->propertyType->name }}</label>
                                        </div>


                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> المساحة
                                                :</label>
                                            <label
                                                class="form-label fs-6">{{ number_format((int) $real_estate->space) }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> الاتجاه
                                                :</label>
                                            <label class="form-label fs-6">{{ $real_estate->direction->name }}</label>
                                        </div>


                                    </div>

                                    <div class="row" wire:ignore.self>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">المدينة:</label>
                                            <label class="form-label fs-6">{{ $real_estate->city->name }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">الحي:
                                            </label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->neighborhood->name }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">عرض الشارع:
                                            </label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->streetWidth->street_number }}</label>
                                        </div>

                                    </div>


                                    <div class="row" wire:ignore.self>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">نوع الأرض:</label>
                                            <label class="form-label fs-6">{{ $real_estate->landType->name }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">طول الواجهة:
                                            </label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->interfaceLength->name }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">الترخيص:
                                            </label>
                                            <label class="form-label fs-6">{{ $real_estate->licensed->name }}</label>
                                        </div>

                                    </div>


                                    <div class="row" wire:ignore.self>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">حالة العقار:</label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->propertyStatus->name }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">نوع البناء:
                                            </label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->buildingType->name }}</label>
                                        </div>

                                    </div>

                                    <div class="row" wire:ignore.self>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">حالة البناء:</label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->buildingStatus->name }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">تسليم البناء:
                                            </label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->constructionDelivery->name }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">الفرع:
                                            </label>
                                            <label class="form-label fs-6">{{ $real_estate->branch->name }}</label>
                                        </div>

                                    </div>



                                    <div class="row" wire:ignore.self>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> ملاحظات على الطلب:
                                            </label>
                                            <p>{{ $real_estate->notes }}</p>
                                        </div>

                                        <div class="mb-1 text-center">

                                            <div class="d-flex justify-content-center pt-2 clear">
                                                <a href="javascript:;"
                                                    class="btn btn-success me-1 waves-effect waves-float waves-light"
                                                    data-bs-target="#editUser" data-bs-toggle="modal">
                                                    حجز
                                                </a>
                                                <a href="create-sell.html"
                                                    class="btn btn-primary  waves-effect waves-float waves-light">بيع</a>
                                            </div>

                                        </div>
                                    </div>



                                </div>
                            @endif

                            @if ($real_estate->property_type_id == 3)
                                <div class="card-boady card-statistics" wire:ignore.self>
                                    <div class="row">

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> نوع العقار
                                                :</label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->propertyType->name }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> المساحة
                                                :</label>
                                            <label
                                                class="form-label fs-6">{{ number_format((int) $real_estate->space) }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> الدخل السنوي
                                                :</label>
                                            <label
                                                class="form-label fs-6">{{ number_format((int) $real_estate->annual_income) }}</label>
                                        </div>

                                    </div>

                                    <div class="row" wire:ignore.self>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">المدينة:</label>
                                            <label class="form-label fs-6">{{ $real_estate->city->name }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">الحي:
                                            </label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->neighborhood->name }}</label>
                                        </div>
                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">رقم الأرض:</label>
                                            <label class="form-label fs-6">{{ $real_estate->land_number }}</label>
                                        </div>
                                    </div>


                                    <div class="row" wire:ignore.self>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">رقم البلوك:
                                            </label>
                                            <label class="form-label fs-6">{{ $real_estate->block_number }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> عدد الأدوار
                                                :</label>
                                            <label
                                                class="form-label fs-6">{{ number_format($real_estate->floors_number) }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> عدد الشقق
                                                :</label>
                                            <label
                                                class="form-label fs-6">{{ number_format($real_estate->flats_number) }}</label>
                                        </div>
                                    </div>


                                    <div class="row" wire:ignore.self>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> عدد المحلات
                                                :</label>
                                            <label
                                                class="form-label fs-6">{{ number_format($real_estate->stores_number) }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> عدد غرف الشقة
                                                :</label>
                                            <label
                                                class="form-label fs-6">{{ number_format($real_estate->flat_rooms_number) }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">حالة العقار:</label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->propertyStatus->name }}</label>
                                        </div>

                                    </div>

                                    <div class="row" wire:ignore.self>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">الفرع:
                                            </label>
                                            <label class="form-label fs-6">{{ $real_estate->branch->name }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">السعر الكلي:</label>
                                            <label class="form-label fs-6">{{ $real_estate->total_price }}</label>
                                        </div>
                                    </div>


                                    <div class="row" wire:ignore.self>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> ملاحظات على الطلب:
                                            </label>
                                            <p>{{ $real_estate->notes }}</p>
                                        </div>

                                        <div class="mb-1 text-center">
                                            <div class="d-flex justify-content-center pt-2 clear">
                                                <a href="javascript:;"
                                                    class="btn btn-success me-1 waves-effect waves-float waves-light"
                                                    data-bs-target="#editUser" data-bs-toggle="modal">
                                                    حجز
                                                </a>
                                                <a href="create-sell.html"
                                                    class="btn btn-primary  waves-effect waves-float waves-light">بيع</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($real_estate->property_type_id == 4)
                                <div class="card-boady card-statistics" wire:ignore.self>
                                    <div class="row">

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> نوع العقار
                                                :</label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->propertyType->name }}</label>
                                        </div>


                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> المساحة
                                                :</label>
                                            <label
                                                class="form-label fs-6">{{ number_format((int) $real_estate->space) }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">المدينة:</label>
                                            <label class="form-label fs-6">{{ $real_estate->city->name }}</label>
                                        </div>

                                    </div>

                                    <div class="row" wire:ignore.self>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">الحي:
                                            </label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->neighborhood->name }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">حالة العقار:</label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->propertyStatus->name }}</label>
                                        </div>


                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">رقم الأرض:</label>
                                            <label class="form-label fs-6">{{ $real_estate->land_number }}</label>
                                        </div>

                                    </div>

                                    <div class="row" wire:ignore.self>
                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">رقم البلوك:</label>
                                            <label class="form-label fs-6">{{ $real_estate->block_number }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">رقم الطابق:</label>
                                            <label
                                                class="form-label fs-6">{{ number_format($real_estate->floor_number) }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">الفرع:
                                            </label>
                                            <label class="form-label fs-6">{{ $real_estate->branch->name }}</label>
                                        </div>
                                    </div>


                                    <div class="row" wire:ignore.self>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> ملاحظات على الطلب:
                                            </label>
                                            <p>{{ $real_estate->notes }}</p>
                                        </div>

                                        <div class="mb-1 text-center">

                                            <div class="d-flex justify-content-center pt-2 clear">
                                                <a href="javascript:;"
                                                    class="btn btn-success me-1 waves-effect waves-float waves-light"
                                                    data-bs-target="#editUser" data-bs-toggle="modal">
                                                    حجز
                                                </a>
                                                <a href="create-sell.html"
                                                    class="btn btn-primary  waves-effect waves-float waves-light">بيع</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($real_estate->property_type_id == 5)
                                <div class="card-boady card-statistics" wire:ignore.self>


                                    <div class="row">

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> نوع العقار
                                                :</label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->propertyType->name }}</label>
                                        </div>


                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> المساحة
                                                :</label>
                                            <label
                                                class="form-label fs-6">{{ number_format((int) $real_estate->space) }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">رقم الأرض:</label>
                                            <label class="form-label fs-6">{{ $real_estate->land_number }}</label>
                                        </div>
                                    </div>

                                    <div class="row" wire:ignore.self>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">رقم البلوك:</label>
                                            <label class="form-label fs-6">{{ $real_estate->block_number }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">المدينة:</label>
                                            <label class="form-label fs-6">{{ $real_estate->city->name }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">الحي:
                                            </label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->neighborhood->name }}</label>
                                        </div>

                                    </div>


                                    <div class="row" wire:ignore.self>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">عرض الشارع:
                                            </label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->streetWidth->street_number }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">الاتجاه:
                                            </label>
                                            <label class="form-label fs-6">{{ $real_estate->direction->name }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">حالة العقار:</label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->propertyStatus->name }}</label>
                                        </div>
                                    </div>


                                    <div class="row" wire:ignore.self>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">نوع الملكية:
                                            </label>
                                            <label
                                                class="form-label fs-6">{{ $real_estate->ownerShipType->name }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> السعر
                                                :</label>
                                            <label
                                                class="form-label fs-6">{{ number_format($real_estate->price) }}</label>
                                        </div>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> عمر العقار
                                                :</label>
                                            <label
                                                class="form-label fs-6">{{ number_format($real_estate->real_estate_age) }}</label>
                                        </div>

                                    </div>

                                    <div class="row" wire:ignore.self>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary">الفرع:
                                            </label>
                                            <label class="form-label fs-6">{{ $real_estate->branch->name }}</label>
                                        </div>

                                    </div>



                                    <div class="row" wire:ignore.self>

                                        <div class="col-md-3 mb-1 ms-4" wire:ignore.self>
                                            <label class="form-label fw-bold fs-4 text-primary"> ملاحظات على الطلب:
                                            </label>
                                            <p>{{ $real_estate->notes }}</p>
                                        </div>

                                        <div class="mb-1 text-center">

                                            <div class="d-flex justify-content-center pt-2 clear">
                                                <a href="javascript:;"
                                                    class="btn btn-success me-1 waves-effect waves-float waves-light"
                                                    data-bs-target="#editUser" data-bs-toggle="modal">
                                                    حجز
                                                </a>
                                                <a href="create-sell.html"
                                                    class="btn btn-primary  waves-effect waves-float waves-light">بيع</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>

                    {{--
                    <div class="col-md-12" wire:ignore.self>
                        <div class="row" wire:ignore.self>
                            <div class="col-lg-6" wire:ignore.self>
                                <div class="card" wire:ignore.self>
                                    <div class="card-header" wire:ignore>
                                        <h4 class="card-title ">تتبع حالة العرض</h4>
                                    </div>
                                    <div class="card-body" wire:ignore.self>
                                        <ul class="timeline" wire:ignore.self>

                                           @foreach ($offer->orderNotes as $note)
                                                <li class="timeline-item" wire:ignore.self>
                                                    <span
                                                        class="timeline-point
                                                        @if ($note->status == 1) timeline-point-success @endif
                                                        @if ($note->status == 2) timeline-point-warning @endif
                                                        @if ($note->status == 3) timeline-point-danger @endif
                                                         timeline-point-indicator"
                                                        wire:ignore.self></span>
                                                    <div class="timeline-event" wire:ignore.self>

                                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1"
                                                            wire:ignore.self>
                                                            <h6>{{ getUserName($note->user_id) }}</h6>
                                                            <span
                                                                class="timeline-event-time ">{{ $note->created_at->format('Y-m-d') }}</span>
                                                        </div>

                                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1"
                                                            wire:ignore.self>
                                                            <h6>{{ $note->note }}</h6>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>


                            @auth
                                @if (auth()->user()->user_type == 'superadmin' || auth()->user()->user_type == 'admin')
                                    <div class="col-lg-6" wire:ignore.self>
                                        <div class="card" wire:ignore.self>
                                            <div class="card-header" wire:ignore>
                                                <h4 class="card-title ">حالات التعديل والإضافة على العرض</h4>
                                            </div>
                                            <div class="card-body" wire:ignore.self>
                                                <ul class="timeline" wire:ignore.self>

                                                    {{-- @foreach ($offer->offerEdits as $offer_edit)
                                                        @if ($offer_edit->action == 'edit')
                                                            <li class="timeline-item">
                                                                <span
                                                                    class="timeline-point timeline-point-warning timeline-point-indicator "></span>
                                                                <div class="timeline-event ">
                                                                    <div
                                                                        class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1 ">
                                                                        <h6> {!! $offer_edit->note !!}</h6>
                                                                        <span
                                                                            class="timeline-event-time ">{{ $this->getLastUpateOrderEditTime($offer_edit->id) }}</span>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endif

                                                        @if ($offer_edit->action == 'add')
                                                            <li class="timeline-item">
                                                                <span
                                                                    class="timeline-point timeline-point-success timeline-point-indicator "></span>
                                                                <div class="timeline-event ">
                                                                    <div
                                                                        class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1 ">
                                                                        <h6>{!! $offer_edit->note !!}</h6>
                                                                        <span
                                                                            class="timeline-event-time ">{{ $this->getLastUpateOrderEditTime($offer_edit->id) }}</span>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endif

                                                        @if ($offer_edit->action == 'cancel')
                                                            <li class="timeline-item">
                                                                <span
                                                                    class="timeline-point timeline-point-danger timeline-point-indicator "></span>
                                                                <div class="timeline-event ">
                                                                    <div
                                                                        class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1 ">
                                                                        <h6>{!! $offer_edit->note !!}</h6>
                                                                        <span
                                                                            class="timeline-event-time ">{{ $this->getLastUpateOrderEditTime($offer_edit->id) }}</span>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endif

                                                        @if ($offer_edit->action == 'active')
                                                            <li class="timeline-item">
                                                                <span
                                                                    class="timeline-point timeline-point-warning timeline-point-indicator "></span>
                                                                <div class="timeline-event ">
                                                                    <div
                                                                        class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1 ">
                                                                        <h6>{!! $offer_edit->note !!}</h6>
                                                                        <span
                                                                            class="timeline-event-time ">{{ $this->getLastUpateOrderEditTime($offer_edit->id) }}</span>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                     --}}

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

    @push('order-create')
        <script>
            window.livewire.on('submitNote', () => {
                $('#addNote').modal('hide');
                console.log('Ok');
            })
        </script>
    @endpush

</div>
