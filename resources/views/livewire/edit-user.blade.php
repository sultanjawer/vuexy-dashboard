<div class="col-lg-9 d-flex align-items-center auth-bg px-2 px-sm-3 px-lg-5 pt-3">
    <div class="width-700 mx-auto">
        <div class="bs-stepper register-multi-steps-wizard shadow-none">
            <div class="bs-stepper-header px-0" role="tablist">


                <div class="step {{ $info }}" data-target="#account-details" role="tab"
                    id="account-details-trigger">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box" wire:ignore>
                            <i data-feather="home" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">بيانات المستخدم</span>
                        </span>
                    </button>
                </div>

                <div class="line" wire:ignore>
                    <i data-feather="chevron-right" class="font-medium-2"></i>
                </div>

                <div class="step {{ $permissions }}" role="tab">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box" wire:ignore>
                            <i data-feather="user" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">الصلاحيات</span>
                        </span>
                    </button>
                </div>

            </div>

            <div class="bs-stepper-content px-0 mt-4">


                <div style="display: @if (!$info) none @endif;">
                    <div class="content-header mb-2">
                        <h2 class="fw-bolder mb-75">بيانات المستخدم</h2>
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-1">
                            <label class="form-label">الاسم</label>
                            <input type="text" class="form-control" placeholder="الاسم" wire:model='name' />
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="email">البريد الالكترونى</label>
                            <input type="email" class="form-control" placeholder="البريد الالكترونى"
                                wire:model='email' />
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="phone">رقم الجوال</label>
                            <input type="text" class="form-control" placeholder="رقم الجوال" maxlength="10"
                                wire:model='phone' />
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        {{-- <div class="col-md-6 mb-1">
                            <label class="form-label" for="password">كلمة المرور</label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" class="form-control" placeholder="كلمة المرور"
                                    wire:model='password' />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div> --}}
                    </div>

                    <div class="d-flex justify-content-between mt-2">
                        <a href="{{ route('panel.users') }}" class="btn btn-outline-primary btn-prev">
                            <i data-feather="chevron-left" class="align-middle me-sm-25 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">الرجوع لصفحة المستخدمين</span>
                        </a>

                        <button class="btn btn-primary" wire:click="step('permissions')">
                            <span class="align-middle d-sm-inline-block d-none">التالى</span>
                            <i data-feather="chevron-right" class="align-middle ms-sm-25 ms-0"></i>
                        </button>

                    </div>

                </div>

                <div style="display: @if (!$permissions) none @endif;">
                    <div class="content-header mb-2">
                        <h2 class="fw-bolder mb-75">الصلاحيات</h2>
                    </div>

                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody>

                                    <tr>
                                        <div>
                                            @livewire('select2')
                                            @error('branches_ids')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </tr>

                                    <tr>
                                        <div class="col-md-6 mt-1">
                                            <label class="form-label">اختيار نوع
                                                المستخدم</label>
                                            <select class="select2 form-select" wire:model='user_type'>
                                                <option value="admin">مدير</option>
                                                <option value="office">مكتب</option>
                                                <option value="marketer">مسوق</option>
                                            </select>
                                            @error('user_type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        @if ($is_officer)
                                            <div class="form-input form-input-primary form-input col-md-6 mt-1">
                                                <input type="text" class="form-control" placeholder="رقم المعلن"
                                                    wire:model='advertiser_number'>
                                                @error('advertiser_number')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        @endif

                                    </tr>

                                    <tr>
                                        <td class="text-nowrap fw-bolder">الوسطاء</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox"
                                                        wire:model="manage_mediators">
                                                    <label class="form-check-label" for="manageMediators">
                                                        تحكم </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-nowrap fw-bolder">الرسائل الجماعية</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox"
                                                        wire:model="can_send_sms_collection">
                                                    <label class="form-check-label">
                                                        تحكم
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-nowrap fw-bolder">الرسائل الفردية</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox"
                                                        wire:model="can_send_sms_individually">
                                                    <label class="form-check-label"> تحكم
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-nowrap fw-bolder">الطلبات</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox"
                                                        wire:model='can_show_orders'>
                                                    <label class="form-check-label"> رؤية </label>
                                                </div>

                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox"
                                                        wire:model='can_add_orders'>
                                                    <label class="form-check-label" for="canAdd"> اضافة </label>
                                                </div>

                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox"
                                                        wire:model='can_edit_orders'>
                                                    <label class="form-check-label" for="canEdit"> تعديل
                                                    </label>
                                                </div>

                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox"
                                                        wire:model='can_cancel_orders'>
                                                    <label class="form-check-label" for="canCancel">إلغاء</label>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-nowrap fw-bolder">الحالة</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check form-check-primary form-switch">
                                                    <input type="checkbox" class="form-check-input"
                                                        wire:model='user_status'>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="d-flex justify-content-between mt-1">
                        <button class="btn btn-primary" wire:click="step('info')">
                            <i data-feather="chevron-left" class="align-middle me-sm-25 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">السابق</span>
                        </button>

                        <button class="btn btn-success" wire:click="update">
                            <i data-feather="check" class="align-middle me-sm-25 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">حفظ</span>
                        </button>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>
