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
                            <span class="bs-stepper-title">بيانات العميل</span>
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
                            <span class="bs-stepper-title">العنوان الوطني</span>
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

                        <div class="col-md-6 mb-1">
                            <label class="form-label">الضريبة</label>
                            <div class="input-group input-group-merge" wire:ignore.self>
                                <input type="text" class="form-control" wire:model='vat' placeholder="الضريبة">
                                <span class="input-group-text">%</span>
                                @error('vat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1" wire:ignore.self>
                            <label class="form-label">السعي</label>
                            <select class="form-control" wire:model='saee_type' wire:ignore.self>
                                <option value="saee_prc">نسبة</option>
                                <option value="saee_price">سعر</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-1 saee_prc" style="display: block;" wire:ignore.self>
                            <label class="form-label">نسبة السعي</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" wire:model='saee_prc'
                                    placeholder="السعي">
                                <span class="input-group-text">%</span>
                                @error('saee_prc')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-1 saee_price" style="display: none;" wire:ignore.self>
                            <label class="form-label">سعر السعي</label>
                            <div class="input-group input-group-merge" wire:ignore.self>
                                <input type="text" class="form-control" wire:model='saee_price'
                                    placeholder="السعي">
                                @error('saee_price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">السعر الكلى</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control " placeholder="السعر الكلى" disabled
                                    wire:model='total_price' />
                                <span class="input-group-text" wire:ignore.self>ريال</span>
                                @error('total_price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label">المبلغ المدفوع</label>
                            <input type="text" class="form-control" wire:model='paid_amount'
                                placeholder="المبلغ المدفوع" />
                            @error('paid_amount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-1">
                            <label class="form-label"> طريقة الدفع الحالية</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" wire:model='cash' id="inlineRadio1"
                                    value="option1" checked="">
                                <label class="form-check-label" for="inlineRadio3">كاش</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" wire:model='check' id="inlineRadio2"
                                    value="option2">
                                <label class="form-check-label" for="inlineRadio4">تحويل</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" wire:model='bank' id="inlineRadio2"
                                    value="option3">
                                <label class="form-check-label" for="inlineRadio4">تحويل</label>
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
                        <h2 class="fw-bolder mb-75">بيانات العميل</h2>
                    </div>


                    <div class="row" wire:ignore>

                        <div class="col-md-12 mb-1">
                            <label class="form-label" for="search">رقم الجوال /
                                الهوية</label>

                            <select wire:model='customer_id' class="select2 search-customer form-select">
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">
                                        {{ $customer->name . ' :: ' . $customer->phone . ' :: ' . $customer->nationality_id }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-danger text-select"></small>
                        </div>

                        {{-- <div class="col-md-6 mb-1">
                                <button class="btn btn-primary " style="margin-top: 20px">
                                    <i data-feather="search" class="align-middle me-sm-25 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">بحث</span>
                                </button>
                            </div> --}}
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">الاسم</label>
                            <input type="text" class="form-control " wire:model='customer_name'
                                placeholder="الاسم" />
                            @error('customer_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">رقم الجوال</label>
                            <input type="text" class="form-control " wire:model='customer_phone'
                                placeholder="رقم الجوال" />
                            @error('customer_phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">البريد الالكترونى</label>
                            <input type="email" class="form-control " wire:model='customer_email'
                                placeholder="البريد الالكترونى" />
                            @error('customer_email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">رقم الهوية</label>
                            <input type="text" class="form-control " wire:model='customer_id_number'
                                placeholder="رقم الهوية" />
                            @error('customer_id_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">الجنسية</label>
                            <select class="form-control" wire:model='customer_nationality'>
                                @foreach (getNationalities() as $nationality)
                                    <option value="{{ $nationality->id }}" selected>{{ $nationality->name }}</option>
                                @endforeach
                            </select>
                            @error('customer_nationality')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">المنطقة</label>
                            <select class="form-control" wire:model='customer_city_name'>
                                @foreach (getCities() as $city)
                                    <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                                @endforeach
                            </select>
                            @error('customer_city_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">موظف</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" wire:model='public' id="inlineRadio1"
                                    value="option1">
                                <label class="form-check-label" for="inlineRadio1">قطاع
                                    عام</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" wire:model='private'
                                    id="inlineRadio2" value="option2">
                                <label class="form-check-label" for="inlineRadio2">خاص</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">هل مدعوم من الإسكان </label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" wire:model='yes' id="inlineRadio1"
                                    value="option1">
                                <label class="form-check-label" for="inlineRadio1">نعم</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" wire:model='no' id="inlineRadio2"
                                    value="option2">
                                <label class="form-check-label" for="inlineRadio2">لا</label>
                            </div>
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
                        <h2 class="fw-bolder mb-75">الهنوان الوطني</h2>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">رقم المبنى</label>
                            <input type="text" class="form-control " wire:model='building_number'
                                placeholder="رقم المبنى" />
                            @error('building_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">اسم الشارع</label>
                            <input type="text" class="form-control " wire:model='street_name'
                                placeholder="اسم الشارع" />
                            @error('street_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">اسم الحي</label>
                            <input type="text" class="form-control " wire:model='neighborhood'
                                placeholder="اسم الحي" />
                            @error('neighborhood')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">الرمز البريدي</label>
                            <input type="text" class="form-control " wire:model='zip_code'
                                placeholder="الرمز البريدي" />
                            @error('zip_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">الرقم الاضافي</label>
                            <input type="text" class="form-control " wire:model='addtional_number'
                                placeholder="الرقم الاضافي" />
                            @error('addtional_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label">رقم الوحدة</label>
                            <input type="text" class="form-control " wire:model='unit_number'
                                placeholder="رقم الوحدة" />
                            @error('unit_number')
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

                window.createSaleSelect2 = () => {
                    $('.search-customer').select2({
                        placeholder: 'رقم الهاتف/ رقم الهوية',
                        closeOnSelect: true,
                        tags: true,
                    });
                }

                $('.search-customer').on('change', function() {
                    var customer_id = $(this).val();
                    @this.set('customer_id', customer_id);
                });

                window.Livewire.on('setSaee', function($value) {
                    if ($value == 'saee_price') {
                        $('.saee_price').css('display', 'block');
                        $('.saee_prc').css('display', 'none');
                    }

                    if ($value == 'saee_prc') {
                        $('.saee_price').css('display', 'none');
                        $('.saee_prc').css('display', 'block');
                    }
                });

                window.Livewire.on('message', function(message, check) {
                    if (check) {
                        $('.text-select').text(message);
                        $('.text-select').removeClass('text-danger');
                        $('.text-select').removeClass('text-warning');
                        $('.text-select').addClass('text-success');
                    } else {
                        $('.text-select').text(message);
                        $('.text-select').addClass('text-warning');
                        $('.text-select').removeClass('text-danger');
                        $('.text-select').removeClass('text-success');
                    }
                });

                $('.search-customer').on('select2:select', function(e) {
                    var value = $('.search-customer').val();
                    @this.set('customer_id', value);
                    // var search = $(".search-customer").data("select2").dropdown.$search;
                    // @this.set('customer_phone', search.val());
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
                    var search = $(".search-customer").data("select2").dropdown.$search;
                    if (x == 0) {
                        search.attr('wire:model', 'value');
                    }
                    var value = search.val();
                    var check = checkPhoneNumber(search, value);
                });


                $(document).bind("paste", function(e) {
                    var search = $(".search-customer").data("select2").dropdown.$search;
                    var value = e.originalEvent.clipboardData.getData('text');
                    var check = checkPhoneNumber(search, value);
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
