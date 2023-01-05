<div class="col-lg-9 d-flex align-items-center auth-bg px-2 px-sm-3 px-lg-5 pt-3" wire:ignore.self>
    <div class="width-700 mx-auto" wire:ignore.self>
        <div class="bs-stepper register-multi-steps-wizard shadow-none" wire:ignore.self>
            <div class="bs-stepper-header px-0" role="tablist" wire:ignore.self>

                <div class="step first-step" role="tab" wire:ignore>
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">
                            <i data-feather="map-pin" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">تفاصيل العرض</span>
                        </span>
                    </button>
                </div>

                <div class="line" wire:ignore>
                    <i data-feather="chevron-right" class="font-medium-2"></i>
                </div>

                <div class="step second-step" role="tab" wire:ignore>
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">
                            <i data-feather="user" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">بيانات العميل المشتري</span>
                        </span>
                    </button>
                </div>

                <div class="line" wire:ignore>
                    <i data-feather="chevron-right" class="font-medium-2"></i>
                </div>

                <div class="step third-step" role="tab" wire:ignore>
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">
                            <i data-feather="home" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">بيانات العميل البائع</span>
                        </span>
                    </button>
                </div>

            </div>

            <div class="bs-stepper-content px-0 mt-4" wire:ignore.self>

                <div class="personal-info" style="display: block;" wire:ignore.self>
                    <div class="content-header mb-2">
                        <h2 class="fw-bolder mb-75"> تفاصيل العرض</h2>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">كود العرض</label>
                            <input type="text" class="form-control" wire:model='offer_code' disabled />
                            @error('offer_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">الحي/ الخطط </label>
                            <div class="input-group input-group-merge" wire:ignore.self>
                                <input type="text" class="form-control " wire:model='neighborhood_name' disabled />
                                <span class="input-group-text" wire:ignore.self>متر</span>
                                @error('neighborhood_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1" wire:ignore.self>
                            <label class="form-label">رقم الارض</label>
                            <input type="text" class="form-control " placeholder="رقم الارض" wire:model='land_number'
                                disabled />
                            @error('land_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">مساحة العقار</label>
                            <div class="input-group input-group-merge" wire:ignore.self>
                                <input type="text" class="form-control " placeholder="مساحة العقار"
                                    wire:model='space' disabled />
                                <span class="input-group-text" wire:ignore.self>متر</span>
                                @error('space')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">سعر العقار</label>
                            <div class="input-group input-group-merge" wire:ignore.self>
                                <input type="text" class="form-control " placeholder="سعر العقار" wire:model='price'
                                    disabled />
                                <span class="input-group-text">ريال</span>
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="content-header mb-2">
                        <h2 class="fw-bolder mb-75">حساب الضريبة</h2>
                    </div>

                    <div class="row">


                        @if (in_array($offer->realEstate->property_type_id, [2, 3, 4, 5]))
                            <div class="col-md-6 mb-1">
                                <label class="form-label"> هل مسكن اول</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            wire:change="isFirstHome('yes')" wire:model='is_first_yes'
                                            id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio3">نعم</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            wire:change="isFirstHome('no')" wire:model='is_first_no'
                                            id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio4">لا</label>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (in_array($offer->realEstate->property_type_id, [2, 3, 4, 5]))
                            @if ($is_first_yes)
                                <div class="col-md-6 mb-1">
                                    <label class="form-label">المبلغ المستحق</label>
                                    <div class="input-group input-group-merge" wire:ignore.self>
                                        <input type="text" step="0.01" class="form-control "
                                            placeholder="المبلغ المستحق" wire:change="deservedAmount"
                                            wire:model='deserved_amount' />
                                    </div>

                                    @if ($deserved_amount_mesage)
                                        <small class="text-success">{{ $deserved_amount_mesage }}</small>
                                    @endif

                                    @error('deserved_amount')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            @endif
                        @endif

                        @if (!$is_first_yes)
                            <div class="col-md-6 mb-1">
                                <label class="form-label">الضريبة</label>
                                <div class="input-group input-group-merge" wire:ignore.self>
                                    <input type="number" class="form-control" step="0.01" min="0"
                                        max="100" placeholder="الضريبة" wire:change="vat('vat')"
                                        wire:model='vat'>
                                    <span class="input-group-text">%</span>
                                </div>
                                @error('vat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                                @if ($message_vat)
                                    <small class="text-danger">{{ $message_vat }}</small>
                                @endif

                                @if ($success_message_vat)
                                    <small class="text-success">{{ $success_message_vat }}</small>
                                @endif

                            </div>
                        @endif

                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1" wire:ignore.self>
                            <label class="form-label">السعي</label>
                            <select class="form-control" wire:change="changeSaeeType" wire:model='saee_type'
                                wire:ignore.self>
                                <option value="saee_prc">نسبة</option>
                                <option value="saee_price">سعر</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-1 saee_prc" style="display: block;" wire:ignore.self>
                            <label class="form-label">نسبة السعي</label>
                            <div class="input-group input-group-merge">
                                <input type="number" class="form-control" step="0.01" min="0"
                                    max="100" placeholder="السعي" wire:change="saeePrc('saee_prc')"
                                    wire:model='saee_prc'>
                                <span class="input-group-text">%</span>
                            </div>

                            @error('saee_prc')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            @if ($success_message_saee_prc)
                                <small class="text-success">{{ $success_message_saee_prc }}</small>
                            @endif

                            @if ($error_message_saee_prc)
                                <small class="text-danger">{{ $error_message_saee_prc }}</small>
                            @endif
                        </div>

                        <div class="col-md-6 mb-1 saee_price" style="display: none;" wire:ignore.self>
                            <label class="form-label">سعر السعي</label>
                            <div class="input-group input-group-merge" wire:ignore.self>
                                <input type="text" class="form-control" step="0.01" placeholder="السعي"
                                    wire:change="saeePrice('saee_price')" wire:model='saee_price'>
                            </div>
                            @error('saee_price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">السعر الكلى</label>
                            <div class="input-group input-group-merge"wire:ignore.self>
                                <input type="text" class="form-control " placeholder="السعر الكلى"
                                    wire:change="totalPrice('total_price')" wire:model='total_price' disabled />
                                <span class="input-group-text" wire:ignore.self>ريال</span>
                            </div>

                            @error('total_price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            @if ($paid_amount)
                                <small class="text-success">مقدار المبلغ المتبقي:
                                    {{ $still_amount }} ريال سعودي</small>
                            @endif
                        </div>


                        <div class="col-md-6 mb-1">
                            <label class="form-label">المبلغ المدفوع</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" wire:change="paidAmount('paid_amount')"
                                    wire:model='paid_amount' placeholder="المبلغ المدفوع" />
                            </div>
                            @error('paid_amount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            @if ($message_paid_amount)
                                <small class="text-danger">{{ $message_paid_amount }}</small>
                            @endif

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label"> طريقة الدفع الحالية</label>

                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"
                                        wire:change="paymentMethod('cash')" wire:model='cash' id="inlineRadio1"
                                        value="option1" checked="">
                                    <label class="form-check-label" for="inlineRadio3">كاش</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"
                                        wire:change="paymentMethod('check')" wire:model='check' id="inlineRadio2"
                                        value="option2">
                                    <label class="form-check-label" for="inlineRadio4">شيك</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"
                                        wire:change="paymentMethod('bank')" wire:model='bank' id="inlineRadio2"
                                        value="option3">
                                    <label class="form-check-label" for="inlineRadio4">تحويل بنكي</label>
                                </div>

                            </div>

                            @error('bank')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            @error('check')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            @error('cash')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        @if ($check)
                            <div class="col-md-6 mb-1">
                                <label class="form-label">رقم الشيك</label>
                                <div class="input-group input-group-merge" wire:ignore.self>
                                    <input type="text" class="form-control " placeholder="رقم الشيك"
                                        wire:model='check_number' />
                                </div>
                                @error('check_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        @endif

                        @if ($bank)
                            <div class="col-md-6 mb-1">
                                <label class="form-label">البنك</label>
                                <select class="form-control select2" wire:model='bank_id'>
                                    @foreach (getBanks() as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('bank_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        @endif


                    </div>



                    <div class="d-flex justify-content-between mt-2">
                        <button class="btn btn-outline-secondary btn-prev" disabled>
                            <i data-feather="chevron-left" class="align-middle me-sm-25 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">السابق</span>
                        </button>
                        <button class="btn btn-primary btn-next first-next">
                            <span class="align-middle d-sm-inline-block d-none">التالى</span>
                            <i data-feather="chevron-right" class="align-middle ms-sm-25 ms-0"></i>
                        </button>
                    </div>
                </div>

                <div class="account-details" style="display: none;" wire:ignore.self>

                    <div class="content-header mb-2">
                        <h2 class="fw-bolder mb-75">بيانات العميل المشتري</h2>
                    </div>


                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">صفة العميل المشتري</label>
                            <input type="text" class="form-control " wire:model='buyer_adj'
                                placeholder="صفة العميل المشتري" />
                            @error('buyer_adj')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row" wire:ignore>

                        <div class="col-md-12 mb-1">
                            <label class="form-label" for="search">رقم الجوال /
                                الهوية</label>

                            <select wire:model='customer_buyer_id' class="select2 search-customer-buyer form-select">
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">
                                        {{ $customer->name . ' :: ' . $customer->phone . ' :: ' . $customer->nationality_id }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-danger text-select-buyer"></small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">الاسم</label>
                            <input type="text" class="form-control " wire:model='customer_buyer_name'
                                placeholder="الاسم" />
                            @error('customer_buyer_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">رقم الجوال</label>
                            <input type="text" class="form-control " wire:model='customer_buyer_phone'
                                placeholder="رقم الجوال" />
                            @error('customer_buyer_phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">البريد الالكترونى</label>
                            <input type="email" class="form-control " wire:model='customer_buyer_email'
                                placeholder="البريد الالكترونى" />
                            @error('customer_buyer_email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">رقم الهوية</label>
                            <input type="text" class="form-control " wire:model='customer_buyer_id_number'
                                placeholder="رقم الهوية" />
                            @error('customer_buyer_id_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">الجنسية</label>
                            <select class="form-control" wire:model='customer_buyer_nationality'>
                                @foreach (getNationalities() as $nationality)
                                    <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                                @endforeach
                            </select>
                            @error('customer_buyer_nationality')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">المنطقة</label>
                            <select class="form-control" wire:model='customer_buyer_city_name'>
                                @foreach (getCities() as $city)
                                    <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                                @endforeach
                            </select>
                            @error('customer_buyer_city_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">موظف</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"
                                    wire:change="customerBuyerType('public')" wire:model='customer_buyer_public'
                                    id="inlineRadio1" value="option1">
                                <label class="form-check-label" for="inlineRadio1">قطاع
                                    عام</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"
                                    wire:change="customerBuyerType('private')" wire:model='customer_buyer_private'
                                    id="inlineRadio2" value="option2">
                                <label class="form-check-label" for="inlineRadio2">خاص</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">هل مدعوم من الإسكان </label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"
                                    wire:change="customerBuyerEskan('yes')" wire:model='customer_buyer_yes'
                                    id="inlineRadio1" value="option1">
                                <label class="form-check-label" for="inlineRadio1">نعم</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" wire:change="customerBuyerEskan('no')"
                                    wire:model='customer_buyer_no' id="inlineRadio2" value="option2">
                                <label class="form-check-label" for="inlineRadio2">لا</label>
                            </div>
                        </div>

                    </div>

                    <div class="content-header mb-2">
                        <h2 class="fw-bolder mb-75">العنوان الوطني</h2>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">رقم المبنى</label>
                            <input type="number" class="form-control " wire:model='customer_buyer_building_number'
                                placeholder="رقم المبنى" />
                            @error('customer_buyer_building_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">اسم الشارع</label>
                            <input type="text" class="form-control " wire:model='customer_buyer_street_name'
                                placeholder="اسم الشارع" />
                            @error('customer_buyer_street_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">اسم الحي</label>
                            <input type="text" class="form-control " wire:model='customer_buyer_neighborhood'
                                placeholder="اسم الحي" />
                            @error('customer_buyer_neighborhood')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">الرمز البريدي</label>
                            <input type="text" class="form-control " wire:model='customer_buyer_zip_code'
                                placeholder="الرمز البريدي" />
                            @error('customer_buyer_zip_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">الرقم الاضافي</label>
                            <input type="number" class="form-control " wire:model='customer_buyer_addtional_number'
                                placeholder="الرقم الاضافي" />
                            @error('customer_buyer_addtional_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">رقم الوحدة</label>
                            <input type="text" class="form-control " wire:model='customer_buyer_unit_number'
                                placeholder="رقم الوحدة" />
                            @error('customer_buyer_unit_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                    <div class="d-flex justify-content-between mt-2">
                        <button class="btn btn-outline-secondary btn-prev second-prev">
                            <i data-feather="chevron-left" class="align-middle me-sm-25 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">السابق</span>
                        </button>
                        <button class="btn btn-primary btn-next second-next">
                            <span class="align-middle d-sm-inline-block d-none">التالى</span>
                            <i data-feather="chevron-right" class="align-middle ms-sm-25 ms-0"></i>
                        </button>
                    </div>

                </div>

                <div class="account-home-details" style="display: none;" wire:ignore.self>

                    <div class="content-header mb-2">
                        <h2 class="fw-bolder mb-75">بيانات العميل البائع</h2>
                    </div>


                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">صفة العميل البائع</label>
                            <input type="text" class="form-control " wire:model='seller_adj'
                                placeholder="صفة العميل البائع" />
                            @error('seller_adj')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row" wire:ignore>

                        <div class="col-md-12 mb-1">
                            <label class="form-label" for="search">رقم الجوال /
                                الهوية</label>

                            <select wire:model='customer_seller_id'
                                class="select2 search-customer-seller form-select">
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">
                                        {{ $customer->name . ' :: ' . $customer->phone . ' :: ' . $customer->nationality_id }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-danger text-select-seller"></small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">الاسم</label>
                            <input type="text" class="form-control " wire:model='customer_seller_name'
                                placeholder="الاسم" />
                            @error('customer_seller_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">رقم الجوال</label>
                            <input type="text" class="form-control " wire:model='customer_seller_phone'
                                placeholder="رقم الجوال" />
                            @error('customer_seller_phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">البريد الالكترونى</label>
                            <input type="email" class="form-control " wire:model='customer_seller_email'
                                placeholder="البريد الالكترونى" />
                            @error('customer_seller_email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">رقم الهوية</label>
                            <input type="text" class="form-control " wire:model='customer_seller_id_number'
                                placeholder="رقم الهوية" />
                            @error('customer_seller_id_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">الجنسية</label>
                            <select class="form-control" wire:model='customer_seller_nationality'>
                                @foreach (getNationalities() as $nationality)
                                    <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                                @endforeach
                            </select>
                            @error('customer_seller_nationality')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">المنطقة</label>
                            <select class="form-control" wire:model='customer_seller_city_name'>
                                @foreach (getCities() as $city)
                                    <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                                @endforeach
                            </select>
                            @error('customer_seller_city_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">موظف</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"
                                    wire:change="customerSellerType('public')" wire:model='customer_seller_public'
                                    id="inlineRadio1" value="option1">
                                <label class="form-check-label" for="inlineRadio1">قطاع
                                    عام</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"
                                    wire:change="customerSellerType('private')" wire:model='customer_seller_private'
                                    id="inlineRadio2" value="option2">
                                <label class="form-check-label" for="inlineRadio2">خاص</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">هل مدعوم من الإسكان </label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"
                                    wire:change="customerSellerEskan('yes')" wire:model='customer_seller_yes'
                                    id="inlineRadio1" value="option1">
                                <label class="form-check-label" for="inlineRadio1">نعم</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"
                                    wire:change="customerSellerEskan('no')" wire:model='customer_seller_no'
                                    id="inlineRadio2" value="option2">
                                <label class="form-check-label" for="inlineRadio2">لا</label>
                            </div>
                        </div>

                    </div>

                    <div class="content-header mb-2">
                        <h2 class="fw-bolder mb-75">العنوان الوطني</h2>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">رقم المبنى</label>
                            <input type="number" class="form-control" wire:model='customer_seller_building_number'
                                placeholder="رقم المبنى" />
                            @error('customer_seller_building_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">اسم الشارع</label>
                            <input type="text" class="form-control " wire:model='customer_seller_street_name'
                                placeholder="اسم الشارع" />
                            @error('customer_seller_street_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">اسم الحي</label>
                            <input type="text" class="form-control " wire:model='customer_seller_neighborhood'
                                placeholder="اسم الحي" />
                            @error('customer_seller_neighborhood')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">الرمز البريدي</label>
                            <input type="text" class="form-control " wire:model='customer_seller_zip_code'
                                placeholder="الرمز البريدي" />
                            @error('customer_seller_zip_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">الرقم الاضافي</label>
                            <input type="number" class="form-control " wire:model='customer_seller_addtional_number'
                                placeholder="الرقم الاضافي" />
                            @error('customer_seller_addtional_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">رقم الوحدة</label>
                            <input type="text" class="form-control " wire:model='customer_seller_unit_number'
                                placeholder="رقم الوحدة" />
                            @error('customer_seller_unit_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-1">
                        <button class="btn btn-primary btn-prev third-prev">
                            <i data-feather="chevron-left" class="align-middle me-sm-25 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">السابق</span>
                        </button>
                        <button class="btn btn-success btn-submit " wire:click='update' wire:ignore.self>
                            <i data-feather="check" class="align-middle me-sm-25 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">حفظ</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('test')
        <script>
            $(document).ready(function() {

                $value = "{{ $saee_type }}";

                if ($value == 'saee_price') {
                    $('.saee_price').css('display', 'block');
                    $('.saee_prc').css('display', 'none');
                }

                if ($value == 'saee_prc') {
                    $('.saee_price').css('display', 'none');
                    $('.saee_prc').css('display', 'block');
                }


                window.createSaleSelect2 = () => {
                    $('.search-customer-buyer').select2({
                        placeholder: 'رقم الهاتف/ رقم الهوية',
                        closeOnSelect: true,
                        tags: true,
                    });

                    $('.search-customer-seller').select2({
                        placeholder: 'رقم الهاتف/ رقم الهوية',
                        closeOnSelect: true,
                        tags: true,
                    });
                }

                $('.search-customer-buyer').on('change', function() {
                    var customer_buyer_id = $(this).val();
                    @this.set('customer_buyer_id', customer_buyer_id);
                });

                $('.search-customer-seller').on('change', function() {
                    var customer_seller_id = $(this).val();
                    @this.set('customer_seller_id', customer_seller_id);
                });


                window.Livewire.on('message_buyer', function(message, check) {
                    if (check) {
                        $('.text-select-buyer').text(message);
                        $('.text-select-buyer').removeClass('text-danger');
                        $('.text-select-buyer').removeClass('text-warning');
                        $('.text-select-buyer').addClass('text-success');
                    } else {
                        $('.text-select-buyer').text(message);
                        $('.text-select-buyer').addClass('text-warning');
                        $('.text-select-buyer').removeClass('text-danger');
                        $('.text-select-buyer').removeClass('text-success');
                    }
                });

                window.Livewire.on('message_seller', function(message, check) {
                    if (check) {
                        $('.text-select-seller').text(message);
                        $('.text-select-seller').removeClass('text-danger');
                        $('.text-select-seller').removeClass('text-warning');
                        $('.text-select-seller').addClass('text-success');
                    } else {
                        $('.text-select-seller').text(message);
                        $('.text-select-seller').addClass('text-warning');
                        $('.text-select-seller').removeClass('text-danger');
                        $('.text-select-seller').removeClass('text-success');
                    }
                });


                $('.search-customer-buyer').on('select2:select', function(e) {
                    var value = $('.search-customer-buyer').val();
                    @this.set('customer_buyer_id', value);
                });

                $('.search-customer-seller').on('select2:select', function(e) {
                    var value = $('.search-customer-seller').val();
                    @this.set('customer_seller_id', value);
                });

                var x = 0;

                window.checkPhoneNumber = (search, value) => {
                    if (value.length > 2) {
                        if (value.slice(0, 2) == '05') {
                            if (x == 0) {
                                search.attr('maxlength', '10');
                                $(".danger-message").remove();
                                $(".success-message").remove();
                                search.css('border-color', 'red');
                                var message =
                                    "<small class='text-danger danger-message'>❌ رقم الهاتف يتكون من 10 أرقام ويبدأ ب 05 ❌</small>";
                                $('.select2-search--dropdown').append(message);
                                x = x + 1;
                            }

                            if (value.length == 10) {
                                search.attr('maxlength', '10');
                                $(".danger-message").remove();
                                $(".success-message").remove();
                                search.css('border-color', '#008000');
                                var message =
                                    "<small class='text-success success-message'>✅ تم التأكد من الرقم بنجاح ✅</small>";
                                $('.select2-search--dropdown').append(message);
                                return true;
                            }

                            return false;
                        }
                    }
                }

                $(document).keyup(function() {
                    var select_search_buyer = $(".search-customer-buyer").data("select2").dropdown.$search;
                    var select_search_seller = $(".search-customer-seller").data("select2").dropdown.$search;

                    if (select_search_buyer.val()) {
                        var value = select_search_buyer.val();
                        @this.set('customer_buyer_phone', value);
                        var check = checkPhoneNumber(select_search_buyer, value);
                    }

                    if (select_search_seller.val()) {
                        var value = select_search_seller.val();
                        @this.set('customer_seller_phone', value);
                        var check = checkPhoneNumber(select_search_seller, value);
                    }

                });


                $(document).bind("paste", function(e) {
                    var select_search_buyer = $(".search-customer-buyer").data("select2").dropdown.$search;
                    var select_search_seller = $(".search-customer-seller").data("select2").dropdown.$search;


                    if (select_search_buyer.val()) {
                        var value = e.originalEvent.clipboardData.getData('text');
                        var check = checkPhoneNumber(select_search_buyer, value);
                    }

                    if (select_search_seller.val()) {
                        var value = e.originalEvent.clipboardData.getData('text');
                        var check = checkPhoneNumber(select_search_seller, value);
                    }
                });

                var first = $(".personal-info");
                var second = $(".account-details");
                var third = $(".account-home-details");

                var first_step = $(".first-step");
                var second_step = $(".second-step");
                var third_step = $(".third-step");
                first_step.addClass('active');


                $(".first-next").on('click', function() {
                    createSaleSelect2();
                    first_step.removeClass('active');
                    second_step.addClass('active');
                    third_step.removeClass('active');
                    first.css('display', 'none');
                    second.css('display', 'block');
                    third.css('display', 'none');
                });

                $(".second-prev").on('click', function() {
                    first_step.addClass('active');
                    second_step.removeClass('active');
                    third_step.removeClass('active');
                    first.css('display', 'block');
                    second.css('display', 'none');
                    third.css('display', 'none');
                });

                $(".second-next").on('click', function() {
                    first_step.removeClass('active');
                    second_step.removeClass('active');
                    third_step.addClass('active');
                    first.css('display', 'none');
                    second.css('display', 'none');
                    third.css('display', 'block');
                });

                $(".third-prev").on('click', function() {
                    createSaleSelect2();
                    first_step.removeClass('active');
                    second_step.addClass('active');
                    third_step.removeClass('active');
                    first.css('display', 'none');
                    second.css('display', 'block');
                    third.css('display', 'none');
                });

            });
        </script>
    @endpush
</div>
