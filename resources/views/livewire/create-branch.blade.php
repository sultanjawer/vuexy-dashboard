<div class="content-header-right  col-md-3 col-12 d-md-block d-none" wire:ignore.self>
    <div class="mb-1 text-md-end breadcrumb-right" wire:ignore.self>
        <a href="javascript:;" data-bs-target="#addNewBranch" data-bs-toggle="modal" class="btn btn-primary">
            <span>

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-plus me-50 font-small-4">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>إضافة فرع
            </span>
        </a>
    </div>



    <div class="modal fade" id="addNewBranch" tabindex="-1" aria-labelledby="addNewAddressTitle" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" wire:ignore.self>
            <div class="modal-content" wire:ignore.self>
                <div class="modal-header bg-transparent" wire:ignore>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-4 mx-50" wire:ignore.self>
                    <h1 class="address-title text-center mb-1" id="addNewAddressTitle">إضافة
                        فرع
                    </h1>
                    <p class="address-subtitle text-center mb-2 pb-75"></p>

                    <div class="row gy-1 gx-2 form form-horizontal" wire:ignore.self>

                        <div class="col-12 col-md-6">
                            <label class="form-label" for="name">اسم الفرع</label>
                            <input type="text" wire:model='branch_name' class="form-control"
                                placeholder="اسم الفرع" />
                            @error('branch_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label" for="code">كود الفرع</label>
                            <input type="text" id="branch-code" wire:model='branch_code' class="form-control"
                                placeholder="مثال : QTF " />
                            @error('branch_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="city_id">المدينة</label>
                            <select id="city-id" wire:model='city_id' class="select2 form-select">
                                @foreach (getCities() as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                            @error('city_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 text-center mt-2 pt-50">
                            <button type="button" class="btn btn-primary btn-submit me-1"
                                wire:click='store'>حفظ</button>
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">الغاء </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('order-create')
        <script>
            window.livewire.on('submitBranch', () => {
                $('#addNewBranch').modal('hide');
                console.log('Ok');
            })
        </script>
    @endpush
</div>
